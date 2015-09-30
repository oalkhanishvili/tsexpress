<?php 

class News extends CI_Controller{
	public function index(){
		$this->db->select('id, title, content, image_name');
		$this->db->from('news');
		$query=$this->db->get();

		if ( $query->num_rows() > 0 ){
			foreach($query->result_array() as $row ){
				$news[]=$row;
			}

			$data['news']=$news;
			$this->load->view('news_list',$data);
		}else{
			echo 'not found';
		}
	}
	public function show($id){
		$this->db->select('title,content');
		$this->db->from('news');
		$this->db->where('id',$id);
		$news=$this->db->get()->row_array();

		$data['single_news']=$news;
		$this->load->view('single_news',$data);
	}
	public function add(){
		$this->load->view('add_news');
	}
	public function create(){
		$this->load->library('form_validation');

		if ( $_SERVER['REQUEST_METHOD'] != 'POST'){
			redirect('news/add');
		}
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload() ){
			$error = array( 'error' => $this->upload->display_errors() );
			$this->load->view( 'add_news', $error );
		}else{
			$data = array( 'upload_data' => $this->upload->data() );
			$imageName=$data['upload_data']['file_name'];
		}
		
		$t=$this->input->post('title');
		$c=$this->input->post('content');
		
		// $data=array('title'=>$t,'content'=>$c);
		// $this->db->set($data);
		if ( !empty($image_name) )
			{
				$this->db->set('title',$t);
				$this->db->set('content',$c);
				$this->db->set('image_name',$imageName);
				$this->db->insert('news');
		
				redirect('news/index');
			}

	}
	public function delete($id){
		
	}

}