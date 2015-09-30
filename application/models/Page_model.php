<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class page_model extends CI_Model{
	public function show_pages(){
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('visible', true);
		$this->db->order_by('position', 'asc');
		$query = $this->db->get();

		foreach ( $query->result_array() as $row ){
			$pages[]=$row;
		}
		return $pages;
	}
	public function get_page($id){
		$this->db->select('content');
		$this->db->from('pages');
		$this->db->where('id', $id);
		$query = $this->db->get();
		
		$page_show = $query->row_array();
		return $page_show['content'];
	}
	public function print_pages(){
		$this->show_pages();
	}
	public function show_navigation(){
		$this->db->select('id, nav_name');
		$this->db->from('navigation');
		$this->db->where('visible', true);
		$this->db->order_by('position', 'asc');
		$query = $this->db->get();

		if ( $query->num_rows() > 0 ){
			foreach ( $query->result_array() as $row ){
				$result[] = $row;
			}
			return $result;
		}
	}
	public function get_navigation($id){
		$this->db->select('content');
		$this->db->from('navigation');
		$this->db->where('id', $id);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ){
			$result = $query->row_array();
			return $result['content'];
		}
	}
	public function show_slider(){
		$query  = $this->db->select('*')
				->from('slider')
				->get();
		$result = $query->result();
		return $result;
	}
	public function getInvoice($id){
		$query = $this->db->select('*')
			->from('amanati')
			->where('amanati.id' , $id)
			->join('users','users.id=amanati.kodi')
			->get();
		$result = $query->row();
		return $result;
	}
}
 ?>
