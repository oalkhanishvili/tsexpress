<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class manager_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function admin_login($username, $password){
		$this->db->select('id, username, password');
		$this->db->from('admins');
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
	public function count_reg_users(){
		$result = $this->db->count_all('users');
		return $result;
	}
	public function select_all_parcels($limit, $start, $sort_by, $sort_order){
		$sort_order = ( $sort_order == 'desc' )?'desc':'asc';
		$sort_columns = array(
			'amanati','kodi',
			'status','weight',
			'price','freight',
			'send_date','declaration',
			'id','saxeli'
			);
		$sort_by = (in_array($sort_by, $sort_columns))?$sort_by:'id';
		$this->db->select('*');
		$this->db->from('amanati');
		$this->db->limit($limit, $start);
		$this->db->order_by($sort_by, $sort_order);
		$query = $this->db->get();
		$result['rows'] = $query->result();

		$query = $this->db->select('COUNT(*) as count', FALSE)
				->from('amanati');
		$row = $query->get()->result();
		$result['num_rows'] = $row[0]->count;
		return $result;
	}
	public function select_all_freight(){
		$this->db->select('freight');
		$this->db->order_by('freight', 'desc');
		$query = $this->db->get('amanati');
		if ( $query->num_rows() >0 ){
			foreach ( $query->result_array() as $row ){
			$result[] = $row;
			}
			return $result;
		}
		return false;
	}
	public function record_count($table) {
        return $this->db->count_all($table);
    }
    /**
     * ბაზაში დამატების ფუნქცია უნიკალური
     * @param  string $table
     * @param  array $data
     */
    public function insert_obj($table, $data){
    	$this->db->insert($table, $data);
    }
    /**
     * ბაზაში განახლების ფუნქცია უნიკალური
     * @param  string $table
     * @param  numeric $id
     * @param  array $data
     */
	public function update_obj($table, $id, $data){
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
	/**
	 * ბაზაში ცალკეული ველის მონიშვნა უნიკალური
	 * @param  string $
	 * @param  numeric $idtable
	 */
	public function select_single_obj($table, $id){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id', $id);
		$query = $this->db->get();

		$result = $query->row_array();
		return $result;

	}
	public function search_parcel(){
		$match = $this->input->post('search');
		$kodi = ltrim($match,"tsgTSG");
		$kodi = ltrim($kodi,"0");
		$this->db->like('amanati', $match);
		$this->db->or_like('saxeli', $match);
		$this->db->or_like('freight', $match);
		$this->db->or_like('kodi', $kodi);
		$query = $this->db->get('amanati');

		if ( $query->num_rows() > 0 ){
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function select_parcels_by_freight($id){
		$this->db->select('*');
		$this->db->where('freight', $id);
		$query = $this->db->get('amanati');
		if ( $query->num_rows() > 0 ){
			foreach ( $query->result_array() as $row ){
				$result[] = $row;
			}
			return $result;
		}
		return false;
		
	}
	public function taken($id, $data){
		$this->db->where('id', $id);
		$this->db->update('amanati', $data);
		return true;
	}
	public function exel($data){
		$this->db->insert_batch('amanati', $data);
	}
	public function upload_exel($data){
		$this->db->update_batch('amanati', $data, 'id');
	}
// ზედა გვერდები
	public function insert_top_page($data){
		$this->db->insert('pages', $data);
	}
	public function select_top_pages(){
		$this->db->select('id, menu_name');
		$this->db->from('pages');
		$this->db->order_by('position','asc');
		$query = $this->db->get();

		if( $query->num_rows() >0 ){
			foreach ( $query->result_array() as $row ) {
				$result[] = $row;
			}
			return $result;
			}
		return false;
		
	}
	public function select_top_page_by_id($id){
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('id', $id);
		$query = $this->db->get();

		$result = $query->row_array();
		return $result;
	}
	public function update_top_page($id, $data){
		$this->db->where('id', $id);
		$this->db->update('pages', $data);
	}
	/**
	 * მონაცემის წაშლა ბაზიდან
	 * @param  string $table
	 * @param  numeric $id
	 */
	public function delete_obj($table, $id){
		$this->db->where('id', $id);
		$this->db->delete($table); 
	}
// გვერდითა ნავიგაცია
	public function insert_left_navigation($data){
		$this->db->insert('navigation', $data);
	}
	public function select_left_navigation(){
		$this->db->select('id, nav_name');
		$this->db->from('navigation');
		$this->db->order_by('position','asc');
		$query = $this->db->get();

		if( $query->num_rows() >0 ){
			foreach ( $query->result_array() as $row ) {
				$result[] = $row;
			}
			return $result;
			}
		return false;
	}
	public function select_left_navigation_by_id($id){
		$this->db->select('*');
		$this->db->from('navigation');
		$this->db->where('id', $id);
		$query = $this->db->get();

		$result = $query->row_array();
		return $result;
	}
	public function update_left_navigation($id, $data){
		$this->db->where('id', $id);
		$this->db->update('navigation', $data);
	}
//სლაიდერი
	public function insert_slider($data){
		$this->db->insert('slider', $data);
	}
	public function select_slider(){
		$this->db->select('*');
		$this->db->from('slider');
		$query = $this->db->get();

		foreach ( $query->result_array() as $row ) {
			$result[] = $row;
		}
		return $result;
	}
	public function select_slider_by_id($id){
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('id', $id);
		$query = $this->db->get();

		$result = $query->row_array();
		return $result;
	}
	public function update_slider($id, $data){
		$this->db->where('id', $id);
		$this->db->update('slider', $data);
	}

	/**
	 * ყველა მომხმარებელი
	 * @param numeric $limit
	 * @param numeric $start
	 * @return array $result
	 */

	public function select_all_users($limit, $start){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		foreach ( $query->result_array() as $row ){
			$result[] = $row;
		}
		return $result;
	}
	/**
	 * მომხმარებლის დამატება
	 * @param  array $data
	 */
	public function insert_parcel($data){
    	$this->db->insert('users', $data);
    }
    public function search_user(){
		$match = $this->input->post('search');
		$kodi = ltrim($match,"tsgTSG");
		$kodi = ltrim($kodi,"0");
		$this->db->like('name_en', $match);
		$this->db->or_like('name_ge', $match);
		$this->db->or_like('email', $match);
		$this->db->or_like('id', $kodi);
		$this->db->or_like('username', $match);
		$this->db->or_like('personal_id', $match);
		$this->db->or_like('company_id', $match);
		$this->db->or_like('company_name', $match);
		$this->db->or_like('mobile', $match);
		$query = $this->db->get('users');

		if ( $query->num_rows() > 0 ){
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function update_freight(){
		$freight = $this->input->post('freight');
		$status = $this->input->post('status');
		$this->db->where('freight', $freight);
		$this->db->set('status' , $status);
		$this->db->update('amanati');
	}
	public function select_transaction($limit, $start){
		$this->db->select('payment.*,users.name_en');
		$this->db->where('ok',1);
		$this->db->from('payment');
		$this->db->join('users','users.id=payment.user_id');
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		foreach ( $query->result_array() as $row ){
			$result[] = $row;
		}
		return $result;
	}
	public function search_transaction(){
		$match = $this->input->post('search');
		$kodi = ltrim($match,"tsgTSG");
		$kodi = ltrim($kodi,"0");
		$this->db->like('transaction_id', $match);
		$this->db->or_like('user_id', $kodi);
		$query = $this->db->get('payment');

		if ( $query->num_rows() > 0 ){
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
}