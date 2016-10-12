<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper(array('url', 'file'));

		$this->load->database();

		$this->load->library('session');
	}

	public function album($title = null) {
		if(!isset($title)) {
			redirect(base_url());
		}

		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('album_title', $title);
		$pictures = $this->db->get('pictures')->result();

		if(count($pictures)) {
			foreach($pictures as $picture) {
				delete_files('./uploads/' . $this->session->userdata('username') . '/' . $title . '/');
			}

			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('title', $title);
			$this->db->delete('albums');

			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('album_title', $title);
			$this->db->delete('pictures');
		}

		rmdir('./uploads/' . $this->session->userdata('username') . '/' . $title . '/');

		redirect(base_url('index.php/profile/albums/' . $this->session->userdata('username') . '/'));
	}

	public function picture($id = NULL) {
		if(!isset($id)) {
			redirect(base_url());
		}

		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->where('id', $id);
		$picture = $this->db->get('pictures')->result();

		if(count($picture)) {
			delete_files($picture[0]->path);
			
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('id', $id);
			$this->db->delete('pictures');
		}

		redirect(base_url('index.php/profile/albums/' . $this->session->userdata('username') . '/'));
	}
}

?>