<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['is_provider_login'])){
			redirect($this->config->item('sp'));
		}
	}
	public function index(){
		$this->load->view('dashboard');
	}
}
