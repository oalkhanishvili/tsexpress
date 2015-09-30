<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class login_model extends CI_model{
	public function __construct(){
		parent::__construct();

	}
	public function login($username, $password){
		$this->db->select('id, username, password');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query=$this->db->get();
		if ( $query->num_rows() > 0 ){
			$result=$query->row_array();
			return $result['id'];
		}else{
			return false;
		}
		
	}
	public function user_info(){
		$this->db->select('*');
			$this->db->from('users');
			$this->db->where('username', $this->session->userdata('username'));
			$query=$this->db->get();
			
			$result = $query->row_array();
			return $result;
	}
	public function parcels_info(){
		$query = $this->db->select('id')
			->where('declaration', 0)
			->get('amanati');
		if ( $query->num_rows > 0 ){
			$parcels['number'][] = $query->num_rows;
		}else{
			$parcels['number'] = '0';
		}
		$this->db->select('*');
		$this->db->from('amanati');
		$this->db->where('kodi', $this->session->userdata('user_id'));
		$query=$this->db->get();
		if( $query->num_rows() > 0 ){
			foreach ( $query->result_array() as $row ){
				$parcels['parcels'][] = $row;
			}
			return $parcels;
		}


		return false;
	}
	public function add_declaration($id, $data){
		
		$this->db->where('id', $id);
		$this->db->update('amanati', $data);
		return true;
	}
	public function add_balance($amount, $id){
		$query = $this->db->select('balance')
			->where('id', $id)
			->get('users');
		if ( $query->num_rows() > 0 ){
			$result = $query->row();
			$update_amount = $result->balance + $amount;
			$this->db->set('balance',$update_amount);
			$this->db->where('id', $id);
			$this->db->update('users');
			return true;
		}
		return false;

	}
	public function pay($amount, $list, $id){
		$query = $this->db->select('balance')
			->where('id', $id)
			->get('users');
			$result = $query->row();
		if ( $result->balance >= $amount ){
			$balance = $result->balance - $amount;
			$this->db->set('balance',$balance);
			$this->db->where('id', $id);
			$this->db->update('users');
			$this->db->set('payed', 1);
			$this->db->where_in('id', $list);
			$this->db->update('amanati');
			return true;
		}
		return false;
	}
}
?>
