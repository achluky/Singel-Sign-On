<?php

session_start();

$link = mysql_connect('localhost', 'root', '');
$db_selected = mysql_select_db('sso', $link);

$sp = "http://localhost:8002/";

if( isset($_GET['signin']) ) {
    
    $error = null;
    $client_id = isset($_GET['client_id']) ? $_GET['client_id'] : 'abcdef';
    $redirect_uri = isset($_GET['redirect_uri']) ? urldecode($_GET['redirect_uri']) : $sp.'user.php?restricted_page';
    $parsed = parse_url($redirect_uri);
    
    if( isset($parsed['query']) )
        parse_str($parsed['query'], $query_args);
    
    if( ! isset($_SESSION['is_provider_login']) ){
        
        if( isset($_POST['submit']) ){
            $sql ="SELECT * FROM users WHERE username = '".$_POST['username']."' AND password = '".md5($_POST['password'])."'";
            $rst = mysql_query($sql);

            if( $user = mysql_fetch_object($rst) ) {
                if( $client_id != 'abcdef' )
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
                
                mysql_query("DELETE FROM access_privileges WHERE client_id = '$client_id' AND user_id = $user->id");
                mysql_query("INSERT INTO access_privileges (client_id, user_id, code, access_token, redirect_uri, expires) VALUES ('$client_id', '$user->id', '".$query_args['code']."', '$access_token', '$redirect_uri', '$expires')");
                
                $_SESSION['is_provider_login'] = $user->id;
                $_SESSION['name'] = $user->name;
                
                header('Location:'.$redirect_to);
            }
            
            $error = '<p>Username atau password salah.</a>';
        }
        
        echo $error;
        echo '<form action="" method="post">';
        echo 'Username: <input type="text" name="username" /><br />';
        echo 'Password: <input type="password" name="password" /><br />';
        echo '<input type="submit" name="submit" value="Sign In" /><br />';
        echo '</form>';
    }
    else {
        
        if( $user = mysql_fetch_object( mysql_query("SELECT * FROM users WHERE id = ".$_SESSION['is_provider_login'])) ) {
            
            if( $client_id != 'abcdef' )
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
            
            mysql_query("DELETE FROM access_privileges WHERE client_id = '$client_id' AND user_id = $user->id");
            mysql_query("INSERT INTO access_privileges (client_id, user_id, code, access_token, redirect_uri, expires) VALUES ('$client_id', '$user->id', '".$query_args['code']."', '$access_token', '$redirect_uri', '$expires')");
            
            header('Location:'.$redirect_to);
        }
    }
}

if( isset($_GET['restricted_page']) ){
    
    if( isset($_SESSION['is_provider_login']) )
        echo 'Hallo <b>'.$_SESSION['name'].'</b> Saat ini Anda sudah login di OAuth Provider | <a href="?signout">Sign Out</a>';
    else
        header('Location:user.php');
}

if( isset($_GET['signout']) ) {
    
    session_destroy();
    
    $result = mysql_query( "SELECT logout_url FROM apps_clients" );
    
    while ($row = mysql_fetch_object($result)) {
        echo '<img src="'.$row->logout_url.'" width="0" height="0" alt="" />';
    }
        
    echo 'Anda kini telah logout dari OAuth Provider. Silahkan klik di <a href="?signin">sini</a> untuk login.';
    
    if( ! isset($_GET['redirect_to']) )
        $_GET['redirect_to'] = 'user.php';
        
    echo '<meta http-equiv="refresh" content="0; url=&#39;'.$_GET['redirect_to'].'&#39;">';
}

if( isset($_GET['access_token']) && ! isset($_GET['get_data']) ){
    
    $code = $_GET['code'];
    $client_id = $_GET['client_id'];
    $client_secret = $_GET['client_secret'];
    $redirect_uri = $_GET['redirect_uri'];
    
    $data = mysql_fetch_array(
                            mysql_query("
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
                                    
                            "), MYSQL_ASSOC);
    
    if( ! $data )
        $data['error'] = 'Argument query yang Anda berikan tidak cocok.';
    
    echo urldecode(http_build_query($data));
}

if( isset($_GET['get_data']) ){
    
    $access_token = $_GET['access_token'];
    
    $data = mysql_fetch_object(
                        mysql_query("
                            SELECT
                                users.id, users.username, users.name
                            FROM
                                access_privileges, users
                            WHERE
                                users.id = access_privileges.user_id AND
                                access_privileges.access_token = '$access_token'
                        ")
                    );
    
    if( ! $data )
        $data['error'] = 'Argument query yang Anda berikan tidak cocok.';
    
    echo json_encode($data);
}

if( isset($_GET['redirector']) ){
    header("Content-type: text/javascript");
    
    if( isset($_SESSION['is_provider_login']) )
        echo 'top.location.href=" http://localhost:8002/user.php?signin&client_id=c4ca4238a0b923820dcc509a6f75849b&redirect_uri=localhost:8001/auth.php?callback";';
        
}

if( count($_GET) == 0 ){
    
    if( isset($_SESSION['is_provider_login']) )
        header('Location:user.php?restricted_page');
        
     echo 'Anda belum login pada SSO Provider. Silahkan klik di <a href="user.php?signin">sini</a> untuk login.';
}