<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model {
	public function insert_user($data) {
		return $this->db->insert('users', $data);
	}

	public function get_user($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', md5(hash('sha256', $password)));

		$query = $this->db->get('users');
		return $query->result();
	}

	public function get_users($where_1, $where_2) {
		$this->db->where($where_1,$where_2);
		
		return $this->db->get('users')->result();
	}

	public function update_status($username, $status) {
		$this->db->set('status', $status);
		$this->db->where('username', $username);

		return $this->db->update('users');
	}
}

?>