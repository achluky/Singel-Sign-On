<?php

class Library_oauth2_client {
    
    public $client_id       = 'OAUTH_CLIENT_ID';
    public $client_secret   = 'OAUTH_CLIENT_SECREET';
    public $redirect_uri    = 'APP_CLIENT_URL_CALLBACK';
    
    public function __construct(){
        
        $this->rest = new Library_rest();
    }
    
    /**
     * Melakukan otentifikasi user ke OAuth provider.
     *
     * @param string $provider_auth_uri Alamat url halaman login provider.
     * @param array $more_args Parameter yang ingin ditambahkan ke url halaman login.
     * @return void. User akan langsung diredirect ke halaman login provider.
     */
    public function user_authentication( $provider_auth_uri, $more_args = array(), $return_uri = false ){
        
        $args['client_id']      = $this->client_id;
        $args['redirect_uri']   = $this->redirect_uri;
        
        if( ! empty($more_args) )
            foreach($more_args as $key => $val)
                $args[$key] = $val;
        
        $url = $provider_auth_uri.'?'.http_build_query($args);
        
        if($return_uri)
            return $url;
        
        header('Location:'.$url);
        exit;
    }
    
    /**
     * Menukarkan variable code untuk mendapatkan acces token dari app provider.
     *
     * @param string $provider_token_uri Alamat API provider untuk mendapatkan access token.
     * @param string $http_method Method yang digunakan untuk melakukan request http.
     * @return string String response dari API Provider.
     */
    public function get_access_token( $provider_token_uri, $code, $http_method = 'GET', $more_args = array() ){
        
        $args['client_id']      = $this->client_id;
        $args['client_secret']  = $this->client_secret;
        $args['code']           = $code;
        $args['redirect_uri']   = $this->redirect_uri;
        
        if( ! empty($more_args) )
            foreach($more_args as $key => $val)
                $args[$key] = $val;
        
        $url = $provider_token_uri.'?'.http_build_query($args);
        return $this->rest->send_request($url, $http_method, $args);
    }
    
    /**
     * Mengakses resurce user yang telah memberikan izin. Misalnya untuk
     * mendapatkan nama, foto, email atau untuk mem-posting artikel dll.
     *
     * @param string $provider_uri Alamat API OAuth Provider untuk melakukang request.
     * @param string $acces_token Nilai access token yang sudah didapatkan.
     * @param string $http_method Method yang digunakan untuk melakukan request http.
     * @param array $more_args Array untuk request tambahan.
     * @return string Tergantung dari masing-masing Provider namun umumnya string dengan format JSON ataupun XML.
     */
    public function access_user_resources($provider_uri, $acces_token, $http_method = 'GET', $more_args = array() ){
        
        $args['access_token']  = $acces_token;
        
        if( ! empty($more_args) )
            foreach($more_args as $key => $val)
                $args[$key] = $val;
        
        $url = $provider_uri.'?'.http_build_query($args);
        
        return $this->rest->send_request($url, $http_method, $args);
    }
} 
// End Library_oauth2_client Class