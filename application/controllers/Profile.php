<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));

		$this->load->library(array('form_validation', 'session'));

		$this->load->database();
	}

	public function albums($username, $title = null) {
		if(isset($title)) {
			$this->db->where('title', $title);
			if(!count($this->db->get('albums')->result())) {
				redirect(base_url());
			}
		}

		if($username == $this->session->userdata('username')) {
			$data['edit'] = array('allowed' => true);
		} else {
			$data['edit'] = array('allowed' => false);
		}

		$this->db->where('username', $username);
		$user = $this->db->get('users')->result();

		if(count($user)) {
			$this->db->where('user_id', $user[0]->id);
			$data['username'] = $username;

			if(!isset($title)) {
				$data['albums'] = $this->db->get('albums')->result();
				$data['pictures'] = array();				
			} else {
				$this->db->where('album_title', $title);
				$data['pictures'] = $this->db->get('pictures')->result();
				$data['albums'] = array();
			}

			$this->load->view('albums', $data);
		} else {
			redirect('home');
		}
	}

	public function addalbum() {
		if($this->session->userdata('user_id')) {
			$this->load->view('addalbum');
		} else {
			redirect(base_url());
		}
	}

	public function addpicture($album) {
		if($this->session->userdata('user_id')) {
			$data['album'] = $album;
			$this->load->view('addpicture', $data);
		} else {
			redirect(base_url());
		}
	}
}
?>