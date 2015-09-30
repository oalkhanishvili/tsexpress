<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manager extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('manager_model');
		if(!$this->session->has_userdata('logged') && $this->uri->segment(2)!='login'){
			redirect('manager/login');
		}
	}
	public function index(){

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->count_reg_users();
		$data['user_count'] = $result;
		$this->load->view('manager/index', $data);
		$this->load->view('manager/footer');
	}
	public function login(){
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		if ( $this->manager_model->admin_login($username, $password) == FALSE ){
		$this->load->view('manager/login-form');
		}else{
			$this->session->set_userdata('logged', $username);
			redirect('manager');
		}
	}
	public function logout(){
		$this->session->unset_userdata('logged');
		redirect('manager');
	}
	public function amanatebi($sort_by='id', $sort_order='desc', $offset='0'){
		$this->session->mark_as_flash('message');
		$limit = 50;
		$result = $this->manager_model->select_all_parcels($limit, $offset, $sort_by, $sort_order);
		$data['num_results'] = $result['num_rows'];
		$data['parcels'] = $result['rows'];
		$this->load->library('pagination');
		$config['base_url'] = site_url('manager/amanatebi/'.$sort_by.'/'.$sort_order);
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config["uri_segment"] = 5;

		//სტილები
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();
		$data['fields'] = array(
			'amanati' => 'ამანათის ნომერი',
			'kodi' => 'ოთახის ნომერი',
			'status' => 'სტატუსი',
			'weight' => 'წონა',
			'price' => 'ფასი',
			'freight' => 'რეისის ნომერი',
			'send_date' => 'გამოგზავნის დრო',
			'declaration' => 'დეკლარაცია',
			'payed' => 'გადახდილია'
			);
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$data['status'] = $this->manager_model->select_all_freight();
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');

		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$this->load->view('manager/amanati-table', $data);
		$this->load->view('manager/footer');
	}
	public function amanati_add(){
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
		$data = array(
			'amanati' => $this->input->post('amanati'),
			'saxeli' => $this->input->post('saxeli'),
			'kodi' => $this->input->post('kodi'),
			'status' => $this->input->post('status'),
			'weight' => $this->input->post('weight'),
			'price' => $this->input->post('price'),
			'freight' => $this->input->post('freight'),
			'send_date' => $this->input->post('send_date')
			);
		$result = $this->manager_model->insert_obj('amanati', $data);
		$_SESSION['message'] = 'ჩანაწერი დამატებულია';
		$this->session->mark_as_flash('message');
		}
		$this->load->view('manager/add_parcel');
		$this->load->view('manager/footer');
	}
	public function amanati_edit($id){
		$result = $this->manager_model->select_single_obj('amanati', $id);
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$data['single_parcel'] = $result;
		$this->load->view('manager/single_parcel', $data);
		$this->load->view('manager/footer');
	}
	public function amanati_update($id){
		$data = array(
			'amanati' => $this->input->post('amanati'),
			'saxeli' => $this->input->post('saxeli'),
			'kodi' => $this->input->post('kodi'),
			'status' => $this->input->post('status'),
			'weight' => $this->input->post('weight'),
			'price' => $this->input->post('price'),
			'freight' => $this->input->post('freight'),
			'send_date' => $this->input->post('send_date'),
			'webpage' => $this->input->post('webpage'),
			'item' => $this->input->post('item'),
			'item_price' => $this->input->post('item_price')
			);
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->manager_model->update_obj('amanati', $id, $data);
			$_SESSION['message'] = 'ჩანაწერი დამატებულია';
			$this->session->mark_as_flash('message');
			redirect ('manager/amanati_edit/'.$id);
		}
	}
	public function taken($id){
		$key = $this->input->post('taken');
		$data = array(
			'taken' => $key
			);
		$this->manager_model->taken($id,$data);
	}
	public function parcel_search(){
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');

		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		if (! $this->manager_model->search_parcel() ){
			$data['error'] = 'ჩანაწერი არ მოიძებნა';
			$this->load->view('manager/search_parcel', $data);
		}else{
		$data['parcels'] = $this->manager_model->search_parcel();
		$this->load->view('manager/search_parcel', $data);
		}
		$this->load->view('manager/footer');
	}
	//ამანათების განახლება excel
	public function update_forma(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'xlsx';
	        $config['file_name']        = 'file';
	        $config['overwrite']        = true;

			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload() ){
			$error = array( 'error' => $this->upload->display_errors() );
			// $this->load->view( 'add_news', $error );
			}else{
				$data = array( 'upload_data' => $this->upload->data() );
			}
		

		$file = './uploads/file.xlsx';
		$this->load->library('excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		foreach ($cell_collection as $cell) {
		    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		    if ($row == 1) {
		        $header[$row][$column] = $data_value;
		    } else {
		        $arr_data[$row][$column] = $data_value;
		    }
		}
		$data['header'] = $header;
		$data['values'] = $arr_data;
			foreach ( $data['values'] as $value):
			$data1[]=array(
				'id' => $value['A'],
				'amanati' =>  $value['B'],
				'saxeli' =>  $value['C'],
				'kodi' =>  $value['D'],
				'weight' =>  $value['E'],
				'price' =>  $value['F'],
				'freight' =>  $value['G'],
				'send_date' =>  $value['H']
				);
			endforeach;
		$this->manager_model->upload_exel($data1);
		$_SESSION['message'] = 'წარმატებით აიტვირთა';
		redirect('manager/amanatebi');
		}
	}
	//ამანათების ატვირთვა excel
	public function insert_forma(){
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'xlsx';
	        $config['file_name']        = 'file';
	        $config['overwrite']        = true;

			$this->load->library('upload', $config);
			if ( !$this->upload->do_upload() ){
			$error = array( 'error' => $this->upload->display_errors() );
			// $this->load->view( 'add_news', $error );
			}else{
				$data = array( 'upload_data' => $this->upload->data() );
			}
		

		$file = './uploads/file.xlsx';
		$this->load->library('excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		foreach ($cell_collection as $cell) {
		    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		    if ($row == 1) {
		        $header[$row][$column] = $data_value;
		    } else {
		        $arr_data[$row][$column] = $data_value;
		    }
		}
		$data['header'] = $header;
		$data['values'] = $arr_data;
			foreach ( $data['values'] as $value):
			$data1[]=array(
				'amanati' =>  $value['A'],
				'saxeli' =>  $value['B'],
				'kodi' =>  $value['C'],
				'status' =>  $value['D'],
				'weight' =>  $value['E'],
				'price' =>  $value['F'],
				'freight' =>  $value['G'],
				'send_date' =>  $value['H']
				);
			endforeach;
		$this->manager_model->exel($data1);
		$_SESSION['message'] = 'წარმატებით აიტვირთა';
		redirect('manager/amanatebi');
		}
	}
	//ამანათების ექსპორტი excel
	public function export_exel(){
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('testworksheet');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()
		->setCellValue('A1', 'id')
		->setCellValue('B1', 'ამანათი')
		->setCellValue('C1', 'მფლობელი')
		->setCellValue('D1', 'ოთახის ნომერი')
		->setCellValue('E1', 'წონა')
		->setCellValue('F1', 'ფასი')
		->setCellValue('G1', 'რეისი')
		->setCellValue('H1', 'გამოგზავნის დრო')
		->setCellValue('I1', 'ნივთი')
		->setCellValue('J1', 'საიტი')
		->setCellValue('K1', 'ფასი');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setSize(15);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
		//merge cell A1 until D1
		// $this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		// $this->excel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$result = $this->manager_model->search_parcel();
		$dataArray= array();
		foreach ( $result as $row ){
	    $row_array['id'] = $row['id'];
	    $row_array['amanati'] = $row['amanati'];
	    $row_array['saxeli'] = $row['saxeli'];
	    $row_array['kodi'] = $row['kodi'];
	    $row_array['weight'] = $row['weight'];
	    $row_array['price'] = $row['price'];
	    $row_array['freight'] = $row['freight'];
	    $row_array['send_date'] = $row['send_date'];
	    $row_array['item'] = $row['item'];
	    $row_array['webpage'] = $row['webpage'];
	    $row_array['item_price'] = $row['item_price'];
	   	array_push($dataArray,$row_array);
	   	}
	   	$this->excel->getActiveSheet()->fromArray($dataArray, NULL, 'A2');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		ob_end_clean();
		$filename='just.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		header('Content-Disposition: attachment;filename="parcels.xlsx"'); //tell browser what's the file name
		    
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
// ზედა გვერდები
	public function insert_page(){
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
		$data = array(
			'menu_name' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'position' => $this->input->post('position'),
			'visible' => '1'
			);
		$result = $this->manager_model->insert_top_page($data);
		$_SESSION['message'] = 'ჩანაწერი დამატებულია';
		$this->session->mark_as_flash('message');
		}
		$this->load->view('manager/add_page');
		$this->load->view('manager/footer');
	}
	public function top_page(){
		$this->session->mark_as_flash('message');

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->select_top_pages();
		$data['pages'] = $result;
		$this->load->view('manager/top_page', $data);
		$this->load->view('manager/footer');
	}
	public function edit_top_page($id){
		$this->session->mark_as_flash('message');

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->select_top_page_by_id($id);
		$data['page'] = $result;
		$this->load->view('manager/single_top_page', $data);
		$this->load->view('manager/footer');
	}
	public function update_top_page($id){
		$data = array(
			'menu_name' => $this->input->post('title'),
			'position' => $this->input->post('position'),
			'content' => $this->input->post('content')
			);
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->manager_model->update_top_page($id, $data);
			$_SESSION['message'] = 'წარმატებით აიტვირთა';
			redirect ('manager/edit_top_page/'.$id);
		}
	}
	public function delete_top_page($id){
		$this->manager_model->delete_obj('pages', $id);
		$_SESSION['message'] = 'ჩანაწერი წაიშალა';
		redirect ('manager/top_page');
	}
// მარცხენა ნავიგაცია
	public function insert_navigation(){

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
		$data = array(
			'nav_name' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'visible' => '1',
			'position' => $this->input->post('position')
			);
		$result = $this->manager_model->insert_left_navigation($data);
		$_SESSION['message'] = 'ჩანაწერი დამატებულია';
		$this->session->mark_as_flash('message');
		}
		$this->load->view('manager/add_navigation');
		$this->load->view('manager/footer');
	}
	public function left_navigation(){

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->select_left_navigation();
		$data['navigation'] = $result;
		$this->load->view('manager/left_navigation', $data);
		$this->load->view('manager/footer');
	}
	public function edit_left_navigation($id){
		$this->session->mark_as_flash('message');

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->select_left_navigation_by_id($id);
		$data['navigation'] = $result;
		$this->load->view('manager/single_left_navigation', $data);
		$this->load->view('manager/footer');
	}
	public function update_left_navigation($id){
		$data = array(
			'nav_name' => $this->input->post('title'),
			'position' => $this->input->post('position'),
			'visible' => '1',
			'content' => $this->input->post('content')
			);
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->manager_model->update_left_navigation($id, $data);
			$_SESSION['message'] = 'წარმატებით აიტვირთა';
			redirect ('manager/edit_left_navigation/'.$id);
		}
	}
	public function delete_left_navigation($id){
		$this->manager_model->delete_obj('navigation', $id);
		$_SESSION['message'] = 'ჩანაწერი წაიშალა';
		redirect ('manager/left_navigation');
	}
// სლაიდერი
	public function insert_slider(){

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');

		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        // $this->load->view('upload_success', $data);
                        $image = $data['upload_data']['file_name'];
                }

		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($image)){
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('content'),
			'image' => $image,
			'link' => $this->input->post('link'),
			'position' => $this->input->post('position')
			);
		$result = $this->manager_model->insert_slider($data);
		$_SESSION['message'] = 'ჩანაწერი დამატებულია';
		$this->session->mark_as_flash('message');
		}
		$this->load->view('manager/add_slider');
		$this->load->view('manager/footer');
	}
	public function slider(){
		$this->session->mark_as_flash('message');

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->select_slider();
		$data['slider'] = $result;
		$this->load->view('manager/slider', $data);
		$this->load->view('manager/footer');
	}
	public function edit_slider($id){
		$this->session->mark_as_flash('message');

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$result = $this->manager_model->select_slider_by_id($id);
		$data['slider'] = $result;
		$this->load->view('manager/single_slider', $data);
		$this->load->view('manager/footer');
	}
	public function update_slider($id){

		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        // $this->load->view('upload_success', $data);
                        $image = $data['upload_data']['file_name'];
                }
		$data = array(
			'title' => $this->input->post('title'),
			'position' => $this->input->post('position'),
			'description' => $this->input->post('content'),
			'link' => $this->input->post('link')
			);
		if (!empty($image)){$data['image'] = $image;}
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$this->manager_model->update_slider($id, $data);
			$_SESSION['message'] = 'წარმატებით აიტვირთა';
			redirect ('manager/edit_slider/'.$id);
		}
	}
	public function delete_slider($id){
		$this->manager_model->delete_obj('slider', $id);
		$_SESSION['message'] = 'ჩანაწერი წაიშალა';
		redirect ('manager/slider');
	}
	public function users_list(){
		$this->session->mark_as_flash('message');
		$this->load->library('pagination');
		$config['base_url'] = site_url('manager/user_list');
		$config['total_rows'] = $this->manager_model->record_count('users');
		$config['per_page'] = 50;
		$config["uri_segment"] = 3;

		//სტილები
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		

		$this->pagination->initialize($config);
	 	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	 	$data['users'] = $this->manager_model->select_all_users($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');

		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$this->load->view('manager/users-table', $data);
		$this->load->view('manager/footer');
	}
	public function user_add(){
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
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
				'required' => 'პაროლის შევსება სავალდებულოა',
				'min_length' => 'პაროლის სიგრძე უნდა იყოს 5 სიმბოლოზე მეტი',
				)
			);
		$this->form_validation->set_rules('conf_password', 'გაიმეორეთ პაროლი', 'trim|required|md5|matches[password]',
			array(
				'required' => ' გამეორებით პაროლის შევსება სავალდებულოა',
				'matches' => 'პაროლები ერთმანეთს არ ემთხვევა'
				)
			);
		$this->form_validation->set_rules('mobile', 'მობილური', 'trim|numeric|exact_length[9]',
			array(
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
				)
			);
		$this->form_validation->set_rules('personal_id', 'პირადი ნომერი', 'trim|numeric|exact_length[11]',
			array(
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'პირადი ნომერი უნდა იყოს 11 სიმბოლო'
				)
			);
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' && !$this->form_validation->run() == FALSE){
			$data = array(
			'name_en' => $this->input->post('name_en'),
			'name_ge' => $this->input->post('name_ge'),
			'birthday' => $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year'),
			'mobile' => $this->input->post('mobile'),
			'personal_id' => $this->input->post('personal_id'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'is_company' => $this->input->post('is_company'),
			'company_id' => $this->input->post('company_id'),
			'company_name' => $this->input->post('company_name'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email')
			);
			$this->manager_model->insert_obj('users', $data);
			$_SESSION['message'] = 'ჩანაწერი დამატებულია';
			$this->session->mark_as_flash('message');
		}
		$this->load->helper('birthdate');
		$data['birth_date_year'] = buildYearDropdown();
		$data['birth_date_month'] = buildMonthDropdown();
		$data['birth_date_day'] = buildDayDropdown();
		$this->load->view('manager/add_user' ,$data);
		$this->load->view('manager/footer');
	}
	public function user_edit($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'პაროლი', 'trim|min_length[5]|md5',
			array(
				'min_length' => 'პაროლის სიგრძე უნდა იყოს 5 სიმბოლოზე მეტი',
				)
			);
		$this->form_validation->set_rules('conf_password', 'გაიმეორეთ პაროლი', 'trim|md5|matches[password]',
			array(
				'matches' => 'პაროლები ერთმანეთს არ ემთხვევა'
				)
			);
		$this->form_validation->set_rules('mobile', 'მობილური', 'trim|numeric|exact_length[9]',
			array(
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
				)
			);
		$this->form_validation->set_rules('personal_id', 'პირადი ნომერი', 'trim|numeric|exact_length[11]',
			array(
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'პირადი ნომერი უნდა იყოს 11 სიმბოლო'
				)
			);
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' && !$this->form_validation->run() == FALSE){
			$data = array(
			'name_en' => $this->input->post('name_en'),
			'name_ge' => $this->input->post('name_ge'),
			'birthday' => $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year'),
			'mobile' => $this->input->post('mobile'),
			'personal_id' => $this->input->post('personal_id'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'is_company' => $this->input->post('is_company'),
			'company_id' => $this->input->post('company_id'),
			'company_name' => $this->input->post('company_name'),
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email')
			);
			if ( !empty($this->input->post('password')) ){
			$data['password'] = $this->input->post('password');
			}
			$this->manager_model->update_obj('users', $id, $data);
			$_SESSION['message'] = 'ჩანაწერი დამატებულია';
			$this->session->mark_as_flash('message');
			$this->db->where('id', $id);
			$this->db->update('users', $data);
		}
		$this->load->helper('birthdate');
		$data['birth_date_year'] = buildYearDropdown();
		$data['birth_date_month'] = buildMonthDropdown();
		$data['birth_date_day'] = buildDayDropdown();
		$result = $this->manager_model->select_single_obj('users', $id);
		$birthday = explode('/', $result['birthday']);
		$data['birthday'] = $birthday;
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');
		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$data['user'] = $result;
		$this->load->view('manager/single_user', $data);
		$this->load->view('manager/footer');
	}
	public function user_update($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'პაროლი', 'trim|min_length[5]|md5',
			array(
				'min_length' => 'პაროლის სიგრძე უნდა იყოს 5 სიმბოლოზე მეტი',
				)
			);
		$this->form_validation->set_rules('conf_password', 'გაიმეორეთ პაროლი', 'trim|required|md5|matches[password]',
			array(
				'matches' => 'პაროლები ერთმანეთს არ ემთხვევა'
				)
			);
		$this->form_validation->set_rules('mobile', 'მობილური', 'trim|numeric|exact_length[9]',
			array(
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'ტელეფონი უნდა იყოს 9 სიმბოლო'
				)
			);
		$this->form_validation->set_rules('personal_id', 'პირადი ნომერი', 'trim|numeric|exact_length[11]',
			array(
				'numeric' => '%s ველი უნდა შეიცავდეს მხოლოდ ნიფრებს ყოვლგვარი გამოტოვების და "-" გარეშე ',
				'exact_length' => 'ტელეფონი უნდა იყოს 11 სიმბოლო'
				)
			);
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' && !$this->form_validation->run() == FALSE){
			$data = array(
			'name_en' => $this->input->post('name_en'),
			'name_ge' => $this->input->post('name_ge'),
			'birthday' => $this->input->post('day').'/'.$this->input->post('month').'/'.$this->input->post('year'),
			'mobile' => $this->input->post('mobile'),
			'personal_id' => $this->input->post('personal_id'),
			'city' => $this->input->post('city'),
			'address' => $this->input->post('address'),
			'is_company' => $this->input->post('is_company'),
			'company_id' => $this->input->post('company_id'),
			'company_name' => $this->input->post('company_name'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email')
			);
			$this->manager_model->update_obj('users', $id, $data);
			$_SESSION['message'] = 'ჩანაწერი დამატებულია';
			$this->session->mark_as_flash('message');
			$this->db->where('id', $id);
			$this->db->update('users', $data);
		}else{
			redirect ('manager/user_edit/'.$id);
		}
	}
	public function user_delete($id){
		$this->manager_model->delete_obj('users', $id);
		$_SESSION['message'] = 'ჩანაწერი წაიშალა';
		redirect ('manager/users_list');
	}
	public function user_search(){
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');

		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		if (! $this->manager_model->search_user() ){
			$data['error'] = 'ჩანაწერი არ მოიძებნა';
			$this->load->view('manager/search_user', $data);
		}else{
		$data['users'] = $this->manager_model->search_user();
		$this->load->view('manager/search_user', $data);
		}
		$this->load->view('manager/footer');
	}
	public function update_freight(){
		$this->manager_model->update_freight();
		redirect('manager/amanatebi');
	}
	public function transaction(){
		$this->load->library('pagination');
		$config['base_url'] = site_url('manager/transaction');
		$config['total_rows'] = $this->manager_model->record_count('payment');
		$config['per_page'] = 50;
		$config["uri_segment"] = 3;

		//სტილები
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		

		$this->pagination->initialize($config);
	 	$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

	 	$data['transaction'] = $this->manager_model->select_transaction($config['per_page'], $page);
		$data['links'] = $this->pagination->create_links();

		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');

		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		$this->load->view('manager/transaction-table', $data);
		$this->load->view('manager/footer');
	}
	public function transaction_search(){
		$this->load->view('manager/header');
		$data['admin_name'] = $this->session->userdata('logged');

		$this->load->view('manager/top-menu' ,$data);
		$this->load->view('manager/side-navigation');
		if (! $this->manager_model->search_user() ){
			$data['error'] = 'ჩანაწერი არ მოიძებნა';
			$this->load->view('manager/search_transaction', $data);
		}else{
		$data['transaction'] = $this->manager_model->search_transaction();
		$this->load->view('manager/search_transaction', $data);
		}
		$this->load->view('manager/footer');
	}
}