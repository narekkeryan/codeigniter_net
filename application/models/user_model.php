<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function insert_user($data) {
		return $this->db->insert('users', $data);
	}

	function get_user($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', md5(hash('sha256', $password)));

		$query = $this->db->get('users');
		return $query->result();
	}

	function get_users($where_1, $where_2) {
		$this->db->where($where_1,$where_2);
		
		return $this->db->get('users')->result();
	}
}

?>