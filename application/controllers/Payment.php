<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_controller{
	public function __construct(){
		parent::__construct();
	}
	public function ok(){
		$this->load->view('pages/ok');
		redirect('user/parcels');
	}
	public function fail(){
		$this->load->view('pages/fail');
	}
	public function start(){
		$this->load->view('pages/start');
	}
	public function close_day(){
		$this->load->view('pages/close_day');
	}
}