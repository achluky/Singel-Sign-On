<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['is_provider_login'])){
			redirect($this->config->item('sp'));
		}
	}
	public function index()
	{
        $this->create();
    }
    
    public function create($action="")
	{
		if($action=="action"){
			$client_id = bin2hex(openssl_random_pseudo_bytes(32));
			$client_secret = bin2hex(openssl_random_pseudo_bytes(16));
			$logout_url = $_POST['logout_url'];
			$name = $_POST['name'];
			$pic = $_POST['pic'];
			$redirect_url = $_POST['redirect_url'];
			$rst = $this->db->query("INSERT INTO apps_clients (client_id, client_secret, logout_url, `name`, pic, redirect_url, `date`) VALUES ('$client_id', '$client_secret', '".$logout_url."', '$name', '$pic', '$redirect_url', '".date('Y-m-d H:i:s')."')");
			if($rst){
				$info = "Data berhasil disimpan";
			}else{
				$info = "Data gagal disimpan";
			}
		}
		$data['info'] = (isset($info))?$info:"";
		$this->load->view('clientCreate', $data);
    }
    
    public function daftar()
	{
		$data['result'] = $this->db->query('SELECT * FROM apps_clients');
		$this->load->view('clientList', $data);
	}

	public function detail($id){
		$data['result'] = $this->db->query('SELECT * FROM apps_clients WHERE client_id= "'.$id.'" ')->row();
		$this->load->view('clientDetail', $data);
	}
}
