<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$error = null;
		$client_id = isset($_GET['client_id']) ? $_GET['client_id'] : 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9';
		$redirect_uri = isset($_GET['redirect_uri']) ? urldecode($_GET['redirect_uri']) : $this->config->item('sp').'dashboard';
		$parsed = parse_url($redirect_uri);

		if( isset($parsed['query']) )
			parse_str($parsed['query'], $query_args);

		if( ! isset($_SESSION['is_provider_login']) )
		{
			if($this->input->post()){
				$sql ="SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".md5($_POST['password'])."'";
				$rst = $this->db->query($sql);
				if( $rst->num_rows() ) 
				{
					$user = $rst->row();
					if( $client_id != 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9' )
						$query_args['code'] = bin2hex(openssl_random_pseudo_bytes(16));
					
					$access_token = bin2hex(openssl_random_pseudo_bytes(16));
					$expires = strtotime('next hour');
					$parsed['host'] = rtrim($parsed['host'], '/').':'.$parsed['port'].'/';
					$redirect_to = $parsed['scheme'].'://'.$parsed['host'];
					
					if( isset($parsed['path']) )
						$redirect_to .= ltrim($parsed['path'], '/');
					
					$redirect_to .= '?'.http_build_query( $query_args );
					
					if( isset($parsed['fragment']) )
						$redirect_to .= '#'.$parsed['fragment'];
					
					$this->db->query("DELETE FROM access_privileges WHERE client_id = '$client_id' AND user_id = $user->id");
					$this->db->query("INSERT INTO access_privileges (client_id, user_id, code, access_token, redirect_uri, expires) VALUES ('$client_id', '$user->id', '".$query_args['code']."', '$access_token', '$redirect_uri', '$expires')");
					
					$_SESSION['is_provider_login'] = $user->id;
					$_SESSION['name'] = $user->name;
					
					header('Location:'.$redirect_to);
				}
				$data['error'] = '<p>Maaf. username atau password salah.</p>';
			}
		}else{
			if( $user = $this->db->query("SELECT * FROM users WHERE id = ".$_SESSION['is_provider_login'])->row() ) {
            
				if( $client_id != 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9' )
					$query_args['code'] = rand();
				
				$access_token = rand();
				$expires = strtotime('next hour');
				$parsed['host'] = rtrim($parsed['host'], '/').':'.$parsed['port'].'/';
	
				$redirect_to = $parsed['scheme'].'://'.$parsed['host'];
				
				if( isset($parsed['path']) )
					$redirect_to .= ltrim($parsed['path'], '/');
				
				$redirect_to .= '?'.http_build_query( $query_args );
				
				if( isset($parsed['fragment']) )
					$redirect_to .= '#'.$parsed['fragment'];
				
				$this->db->query("DELETE FROM access_privileges WHERE client_id = '$client_id' AND user_id = $user->id");
				$this->db->query("INSERT INTO access_privileges (client_id, user_id, code, access_token, redirect_uri, expires) VALUES ('$client_id', '$user->id', '".$query_args['code']."', '$access_token', '$redirect_uri', '$expires')");
				
				header('Location:'.$redirect_to);
			}
		}
		
		$data['info'] ='';
		$this->load->view('authLogin', $data);
	}

	public function signout(){
		session_destroy();
		$result = $this->db->query( "SELECT logout_url FROM apps_clients" );
		foreach ($result->result() as $row){
			echo '<img src="'.$row->logout_url.'" width="0" height="0" alt="" />';
		}
		if( ! isset($_GET['redirect_to']) )
			$_GET['redirect_to'] =  $this->config->item('sp');
		echo '<meta http-equiv="refresh" content="0; url=&#39;'.$_GET['redirect_to'].'&#39;">';
	}

	public function token()
	{
		if( isset($_GET['access_token']) && ! isset($_GET['get_data']) )
		{	
			$code = $_GET['code'];
			$client_id = $_GET['client_id'];
			$client_secret = $_GET['client_secret'];
			$redirect_uri = $_GET['redirect_uri'];
			$sql = "
			SELECT
				access_privileges.access_token, access_privileges.expires
			FROM
				access_privileges, apps_clients
			WHERE
				apps_clients.client_id = access_privileges.client_id AND
				apps_clients.client_id = '$client_id' AND
				apps_clients.client_secret = '$client_secret' AND
				access_privileges.redirect_uri = '$redirect_uri' AND
				access_privileges.code = '$code'
			";
			$data = $this->db->query($sql)->row_array();
			if( ! $data )
				$data['error'] = 'Argument query yang Anda berikan tidak cocok.';
			echo json_encode($data);
		}
	}

	public function resource()
	{
		if( isset($_GET['get_data']) ){
			$access_token = $_GET['access_token'];

			$sql = "
			SELECT
				users.id, users.username, users.name
			FROM
				access_privileges, users
			WHERE
				users.id = access_privileges.user_id AND
				access_privileges.access_token = '$access_token'
			";
			$data = $this->db->query($sql)->row_array();

			if( ! $data )
				$data['error'] = 'Argument query yang Anda berikan tidak cocok.';
			
			echo json_encode($data);
		}
	}
}
