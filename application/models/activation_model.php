<?php
if(!defined('BASEPATH')) exit('No sirect script access allowed');

class activation_model extends CI_Model {
	public function insert($data) {
		return $this->db->insert('activation', $data);
	}

	public function get($username) {
		$this->db->where('user_username', $username);

		return $this->db->get('activation')->result();
	}

	public function delete($username) {
		$this->db->where('user_username', $username);

		return $this->db->delete('activation');
	}
}

?>