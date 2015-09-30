<?php

class User_mode extends CI_Model{
	public function getUserData($userid){
		// //SELECT username,password,email
		// //FROM users
		// //WHERE user_id=$userid
		$this->db->select('username,password,email');
		$this->db->where('id',$userid);
		$this->db->or_where('email','test@mail.com');
		$result=$this->db->get('users')->result_array();

		foreach($result as $user){
			echo $user->email;
		}

		return array(
			'id'=>$userid,
			'username'=>'giorgi',
		);
	}
}