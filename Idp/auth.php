<?php

session_start();

require_once 'rest.php';
require_once 'oauth2_client.php';

$rest = new Library_rest();
$oauth2_client = new Library_oauth2_client();

$oauth2_client->client_id = 'dddb364bdca94789cdf55ff309e24440';
$oauth2_client->client_secret = 'a125e74ce7f9e74e2014d422dc8dc8cb';
$oauth2_client->redirect_uri = 'http://localhost:8001/auth.php?callback';

// SP LOGIN
$sp = "http://localhost:8000/";

if( isset($_GET['login']) ) {
    $provider_auth_uri = $sp;
    $more_args = array( 'scope' => 'email', 'signin' => 'true' );
    $oauth2_client->user_authentication( $provider_auth_uri, $more_args );
}

if( isset($_GET['callback']) ) {
    $code = $_GET['code'];
    
    $provider_token_uri = $sp.'welcome/token';
    $response = $oauth2_client->get_access_token( $provider_token_uri, $code, 'GET', array('access_token' => 'true') );
    $response = json_decode($response);

    $provider_uri = $sp.'welcome/resource/';
    $response = $oauth2_client->access_user_resources( $provider_uri, $response->access_token, 'GET', array('get_data' => 'true') );
    $data = json_decode($response);
    
    $_SESSION['is_login'] = 1;
    $_SESSION['name'] = $data->name;
    $_SESSION['id'] = $data->id;

    header('Location:auth.php?restricted_page');
    exit;
}

if( isset($_GET['restricted_page']) ) {
    if( ! isset($_SESSION['is_login']) )
        header('Location:auth.php');
    echo 'Selamat datang <b>' . $_SESSION['name'] . '</b> | <a href="auth.php?signout">Sign Out</a>';
}

if( isset($_GET['signout']) ) {
    session_unset();
    session_destroy();
    header('Location:'.$sp.'welcome/signout?redirect_to=http://localhost:8001/auth.php');
}

if ( isset($_GET['self_logout']) ){
    session_unset();
    session_destroy();
}

if( count($_GET) == 0 ){
    if( isset($_SESSION['is_login']) )
        header('Location:auth.php?restricted_page');
    echo 'Anda berada pada aplikasi SSO client dan saat ini belum login. Klik <a href="auth.php?login">Sign In</a> untuk login.';
    echo '<script type="text/javascript" src='.$sp.'user.php?redirector"></script>';
}
?>