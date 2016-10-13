<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pictures_model extends CI_Model {
	public function update_profile_picture($user_id) {
		$this->db->set('profile_picture', 0);
		$this->db->where('profile_picture', 1);
		$this->db->where('user_id', $user_id);

		return $this->db->update('pictures');
	}

	public function get_album($user_id, $title = null) {
		if(isset($title)) {
			$this->db->where('user_id', $user_id);
			$this->db->where('title', $title);
		} else {
			$this->db->where('user_id', $user_id);
		}

		return $this->db->get('albums')->result();
	}

	public function get_album_by_title($title) {
		$this->db->where('title', $title);

		return $this->db->get('albums')->result();
	}

	public function get_picture($album_id) {
		$this->db->where('album_id', $album_id);

		return $this->db->get('pictures')->result();
	}

	public function get_picture_by_id($id, $user_id) {
		$this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		return $picture = $this->db->get('pictures')->result();
	}

	public function insert_album($data) {
		return $this->db->insert('albums', $data);
	}

	public function insert_picture($data) {
		return $this->db->insert('pictures', $data);
	}

	public function delete_album($user_id, $title) {
		$this->db->where('user_id', $user_id);
		$this->db->where('title', $title);
		
		return $this->db->delete('albums');
	}

	public function delete_picture($album_id) {
		$this->db->where('album_id', $album_id);

		return $this->db->delete('pictures');
	}

	public function delete_picture_by_id($id, $user_id) {
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		return $this->db->delete('pictures');
	}

	public function get_last_album_id() {
		$albums = $this->db->get('albums')->result();
		return $albums[count($albums)-1]->id;
	}
}
?>