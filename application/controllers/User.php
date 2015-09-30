<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('page_model');
		$this->load->model('login_model');
		$this->load->model('schelude_model');
	}
	public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$this->load->model('login_model');
		$row=$this->login_model->login( $username, $password);

		if ( $this->login_model->login( $username, $password) !== false ){
			$this->session->set_userdata('username', $username);
			$this->session->set_userdata('user_id', $this->login_model->login( $username, $password));
			redirect('');
		}else{
			redirect('');
		}
	}
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_id');
		redirect('');
	}
	public function userPanel($id){
		$this->load->view('pages/user-panel');
	}
	public function userEdit(){
		$this->load->view('pages/header');
		$pages = $this->page_model->show_pages();

		if ( !$this->session->has_userdata('username') ){
			$this->load->view('pages/user-login');
			$this->load->view('pages/section');

		}else{
			$this->load->model('login_model');
			$result=$this->login_model->user_info();
			$day = 31;
			$year[] = 'წელი';
			$month = array( '','იანვარი','თებერვალი','მარტი','აპრილი','მაისი','ივნისი','ივლისი','აგვისტო','სექტემბერი','ოქტომბერი','ნოემბერი','დეკემბერი' );
			for ( $i=(date('Y')-100); $i <= (date('Y')-16); $i++ ){
				$year[] = $i;
			}
			$birthday[] = explode('/', $result['birthday']);
			$data['birthday'] = $birthday;
			$data['day'] = $day;
			$data['month'] = $month;
			$data['year'] = $year;
			$data['user_info'] = $result;
			$this->load->view('pages/section-useredit',$data);

			$parcels=$this->login_model->parcels_info();
			$userdata = $this->login_model->user_info();
			$data['user'] = $userdata;
			$data['number'] = $parcels['number'];
			$data['parcels'] = $parcels['parcels'];
			$this->load->view('pages/user-panel',$data);
		}
		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;

		$this->load->view('pages/reisebi', $data);
		$this->load->view('pages/footer');
		$this->load->library('form_validation');
		// $this->form_validation->set_rules('password', 'პაროლი', 'trim|required|min_length[5]|md5',
		// 	array(
		// 		'required' => 'პაროლის შევსება უცილებელია',
		// 		'min_length' => 'პაროლის სიგრძე უნდა იყოს 5 სიმბოლოზე მეტი',
		// 		)
		// 	);
		// $this->form_validation->set_rules('passconf', 'გაიმეორეთ პაროლი', 'trim|required|md5|matches[password]',
		// 	array(
		// 		'required' => '%s ველის შევსება აუცილებელია',
		// 		'matches' => 'პაროლები ერთმანეთს არ ემთხვევა'
		// 		)
		// 	);
		$this->form_validation->set_rules('mobile', 'მობილური', 'trim|required|numeric|exact_length[9]',
			array(
				'required' => '%s ველის შევსება აუცილებელია',
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
				)
			);
		$this->form_validation->set_rules('personal_id', 'პირადი ნომერი', 'trim|required|numeric|exact_length[11]',
			array(
				'required' => '%s ველის შევსება აუცილებელია',
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'პირადი ნომერი უნდა იყოს 11 სიმბოლო'
				)
			);
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !$this->form_validation->run() == FALSE ){
		$is_company  = $this->input->post('is_company');
		$username 	 = $this->input->post('username');
		$password 	 = $this->input->post('password');
		$email    	 = $this->input->post('email');
		$name_en  	 = $this->input->post('name_en');
		$name_ge  	 = $this->input->post('name_ge');
		$mobile  	 = $this->input->post('mobile');
		$personal_id = $this->input->post('personal_id');
		$city 		 = $this->input->post('city');
		$address 	 = $this->input->post('address');
		$company_id  = $this->input->post('company_id');
		$birthday	 = $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year');
		
		$data = array(
			'is_company' => $is_company,
			'username' => $username,
			'email' => $email,
			'name_en' => $name_en,
			'name_ge' => $name_ge,
			'mobile' => $mobile,
			'personal_id' => $personal_id,
			'city' => $city,
			'address' => $address,
			'company_id' => $company_id,
			'birthday' => $birthday,
			);
		if ( !empty($this->input->post('password')) ){
			$data = ['password' => $this->input->post('password')];
			}
		$this->db->where('id', $this->session->userdata('user_id'));
		$this->db->update('users', $data);
		redirect('user/userEdit');
		}
		
	}
	public function parcels(){

		
		$this->load->view('pages/header');
		if ( !$this->session->has_userdata('username') ){
			$this->load->view('pages/user-login');
			$this->load->view('pages/section');

		}else{
		$this->load->model('login_model');
		$parcels = $this->login_model->parcels_info();
		$userdata = $this->login_model->user_info();
		$data['user'] = $userdata;
		$data['number'] = $parcels['number'];
		$data['parcels'] = $parcels['parcels'];
		$this->load->view('pages/userparcels', $data);
		$this->load->view('pages/user-panel',$data);
		}
		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;

		$this->load->view('pages/reisebi', $data);
		$this->load->view('pages/footer');
		
	}
	public function registration(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'ნიკი', 'trim|required|min_length[4]|max_length[12]|is_unique[users.username]',
			array(
				'required' => 'შეავსე სია %s',
				'min_length' => '%s ზომა უნდა იყოს 5 სიმბოლოზე მეტი',
				'max_length' => '%s ზომა უნდა იყოს მაქსიმუმ 12 სიმბოლო',
				'is_unique' => 'მსგავსი %s უკვე არსებობს სისტემაში'
				)
			);
		$this->form_validation->set_rules('password', 'პაროლი', 'trim|required|min_length[5]|md5',
			array(
				'required' => 'პაროლის შევსება უცილებელია',
				'min_length' => 'პაროლის სიგრძე უნდა იყოს 5 სიმბოლოზე მეტი',
				)
			);
		$this->form_validation->set_rules('passconf', 'გაიმეორეთ პაროლი', 'trim|required|md5|matches[password]',
			array(
				'required' => '%s ველის შევსება აუცილებელია',
				'matches' => 'პაროლები ერთმანეთს არ ემთხვევა'
				)
			);
		$this->form_validation->set_rules('email', 'ელ.ფოსტა', 'trim|required|valid_email|is_unique[users.email]',
			array(
				'required' => '%s ველის შევსება აუცილებელია',
				'valid_email' => 'გთხოვთ შეიყვანოთ %s სწორად',
				'is_unique' => 'მომხმარებელი მსგავსი ელ.ფოსტით უკვე დარეგისტრირებულია'
				)
			);
		$this->form_validation->set_rules('mobile', 'მობილური', 'trim|required|numeric|exact_length[9]',
			array(
				'required' => '%s ველის შევსება აუცილებელია',
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
				)
			);
		$this->form_validation->set_rules('personal_id', 'პირადი ნომერი', 'trim|required|numeric|exact_length[11]',
			array(
				'required' => '%s ველის შევსება აუცილებელია',
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'პირადი ნომერი უნდა იყოს 11 სიმბოლო'
				)
			);
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !$this->form_validation->run() == FALSE ){
		$is_company  = $this->input->post('is_company');
		$username 	 = $this->input->post('username');
		$password 	 = $this->input->post('password');
		$email    	 = $this->input->post('email');
		$name_en  	 = $this->input->post('name_en');
		$name_ge  	 = $this->input->post('name_ge');
		$mobile  	 = $this->input->post('mobile');
		$personal_id = $this->input->post('personal_id');
		$city 		 = $this->input->post('city');
		$address 	 = $this->input->post('address');
		$company_id  = $this->input->post('company_id');
		$company_name  = $this->input->post('company_name');
		$birthday	 = $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year');
		
		$data = array(
			'is_company' => $is_company,
			'username' => $username,
			'password' => $password,
			'email' => $email,
			'name_en' => $name_en,
			'name_ge' => $name_ge,
			'mobile' => $mobile,
			'personal_id' => $personal_id,
			'city' => $city,
			'address' => $address,
			'company_id' => $company_id,
			'company_name' => $company_name,
			'birthday' => $birthday,
			);
		$this->db->insert('users', $data);
		$_SESSION['message'] = 'ჩანაწერი დამატებულია';
		$this->session->mark_as_flash('message');
		}
		$this->load->view('pages/header');
		if ( !$this->session->has_userdata('username') ){
			$day = 31;
			$year[] = '-წელი-';
			$month = array(
				'-აირჩიე თვე-',
				'იანვარი',
				'თებერვალი',
				'მარტი',
				'აპრილი',
				'მაისი',
				'ივნისი',
				'ივლისი',
				'აგვისტო',
				'სექტემბერი',
				'ოქტომბერი',
				'ნოემბერი',
				'დეკემბერი'
				);
			for ( $i=(date('Y')-100); $i <= (date('Y')-16); $i++ ){
				$year[] = $i;
			}
			$data['day'] = $day;
			$data['month'] = $month;
			$data['year'] = $year;
			$data['slider'] = $this->page_model->show_slider();
			$this->load->view('pages/user-login',$data);

			

		}else{
			$userdata = $this->login_model->user_info();
			$data['user'] = $userdata;
			$this->load->view('pages/user-panel',$data);
		}
		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;
		$this->load->view('pages/reisebi', $data);
		$this->load->view('pages/user-registration', $data);
		$this->load->view('pages/footer');
	}
	public function forgot_password(){
		$this->load->view('pages/header');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
       if ($this->form_validation->run() == FALSE)
      {
      	$data['slider'] = $this->page_model->show_slider();
		$this->load->view('pages/user-login',$data);
		$schelude=$this->schelude_model->schelude();
		$data['schelude'] = $schelude;
		$this->load->view('pages/reisebi', $data);
             $this->load->view('pages/email_check');

       }
       else
      {
         $email= $this->input->post('email');

      $this->load->helper('string');
      $rs= random_string('alnum', 12);

      $data = array(
                     'rs' => $rs
                  );
      $this->db->where('email', $email);
      $this->db->update('users', $data);

      //now we will send an email

      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'ssl://smtp.googlemail.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'oalkhanishvili@gmail.com';
      $config['smtp_pass'] = '557692211';


      $this->load->library('email', $config);

      $this->email->from('oalkhanishvili@gmail.com', 'Ikz.php');
      $this->email->to($email);

      $this->email->subject('Get your forgotten Password');
      $this->email->message('Please go to this link to get your password.
             http://localhost/ci/get_password/index/'.$rs );

      $this->email->send();
      echo "Please check your email address.";
     	}
     	
     	
		$this->load->view('pages/footer');
	}
	public function email_check($str)
            {
      $query = $this->db->get_where('users', array('email' => $str), 1);
       
            if ($query->num_rows()== 1)
            {
                   return true;
                  }
                  else
                  {    
                   $this->form_validation->set_message('email_check', 'This Email does not exist.');
             return false;

            }
         }    
	public function declaration($id){
		$this->load->model('login_model');
		$data=array(
			'item' => $this->input->post('dec_item'),
			'webpage' => $this->input->post('dec_webpage'),
			'item_price' => $this->input->post('dec_price'),
			'declaration' => $this->input->post('declaration')
			);
	
		$this->login_model->add_declaration($id, $data);
		echo 'ok';
	}
	public function iframe($id){
		$this->load->model('login_model');
		$data=array(
			'item' => $this->input->post('dec_item'),
			'webpage' => $this->input->post('dec_webpage'),
			'item_price' => $this->input->post('dec_price')
			);
	
		$this->login_model->add_declaration($id, $data);
	}
	public function add_balance($id){
		$this->load->model('login_model');
		$amount = $this->input->post('amount');
		$this->login_model->add_balance($amount, $id);
		redirect('user/parcels');

	}
	public function pay(){
		$this->load->model('login_model');
		$amount = '';
		foreach ( $_POST['gadaxda'] as $value ){
			$parse = explode(':',$value);
			$user[] = $parse[1];
			$amount = $amount+$parse[0];
		}
		echo $this->login_model->pay($amount, $user, $_SESSION['user_id']);
	}
}