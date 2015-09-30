<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class schelude_model extends CI_Model{
	public function schelude(){
		$this->db->select('freight,status,send_date');
		$this->db->from('amanati');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		foreach ( $query->result_array() as $row ){
			$schelude[] = $row;
		}
		return $schelude;
	}
}
?>