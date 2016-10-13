<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class message_model extends CI_Model {
	public function get_messages($user_id, $other_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('deleted', 0);
		$this->db->where("(from_id='".$other_id."' OR to_id='".$other_id."')", NULL, FALSE);

		return $this->db->get('messages')->result();
	}

	public function get_msg($id, $unseen = FALSE) {
		if($unseen == FALSE) {
			$this->db->where('id', $id);

			return $this->db->get('messages')->result();
		} else {
			$this->db->where('user_id', $id);
			$this->db->where('seen', FALSE);

			return $this->db->get('messages')->result();
		}
	}

	public function insert($data) {
		return $this->db->insert('messages', $data);
	}

	public function delete($id) {
		$this->db->set('deleted', TRUE);
		$this->db->where('id', $id);
		return $this->db->update('messages');
	}
}