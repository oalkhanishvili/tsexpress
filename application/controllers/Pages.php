<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('page_model');
		$this->load->model('schelude_model');
		
	}
	public function index(){
 		$this->load->view('pages/header');
		$this->load->model('schelude_model');		
		if ( !$this->session->has_userdata('username') ){
			$data['slider'] = $this->page_model->show_slider();
			$this->load->view('pages/user-login' , $data);
		}else{
			$this->load->model('login_model');
			$parcels=$this->login_model->parcels_info();
			$this->load->model('login_model');
			$userdata = $this->login_model->user_info();
			$data['user'] = $userdata;
			$data['number'] = $parcels['number'];
			$data['parcels'] = $parcels['parcels'];
			$this->load->view('pages/user-panel', $data);
		}
		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;
		$this->load->view('pages/reisebi', $data);
		$this->load->view('pages/section',$data);
		

		$this->load->view('pages/footer');
	}
	public function page($id){	
		$this->load->view('pages/header');
		$page_show = $this->page_model->get_page($id);
		$data['page_show'] = $page_show;
		
		
		if ( !$this->session->has_userdata('username') ){
			$data['slider'] = $this->page_model->show_slider();
			$this->load->view('pages/user-login', $data);
		}else{
			$this->load->model('login_model');
			$parcels=$this->login_model->parcels_info();
			$this->load->model('login_model');
			$userdata = $this->login_model->user_info();
			$data['user'] = $userdata;
			$data['number'] = $parcels['number'];
			$data['parcels'] = $parcels['parcels'];
			$this->load->view('pages/user-panel', $data);
		}

		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;

		$this->load->view('pages/reisebi', $data);
		$this->load->view('pages/section_page' ,$data);
		$this->load->view('pages/footer');
	}
	public function navigation($id){
		$this->load->view('pages/header');
		if ( !$this->session->has_userdata('username') ){
			$data['slider'] = $this->page_model->show_slider();
			$this->load->view('pages/user-login' ,$data);
		}else{
			$this->load->model('login_model');
			$parcels=$this->login_model->parcels_info();
			$this->load->model('login_model');
			$userdata = $this->login_model->user_info();
			$data['user'] = $userdata;
			$data['number'] = $parcels['number'];
			$data['parcels'] = $parcels['parcels'];
			$this->load->view('pages/user-panel', $data);
		}
		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;

		$this->load->view('pages/reisebi', $data);

		$navigation_show = $this->page_model->get_navigation($id);
		$data['content'] = $navigation_show;
		$this->load->view('pages/section_navigation', $data);
		$this->load->view('pages/footer');
	}
	public function invoice($id){
		$data['invoice'] = $this->page_model->getInvoice($id);
		$this->load->view('pages/invoice', $data);
	}
}