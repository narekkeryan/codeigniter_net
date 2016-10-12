<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper('url');

		$this->load->database();

		$this->load->library('session');
	}

	public function index() {
		$this->db->where('id !=', $this->session->userdata('user_id'));
		$data['users'] = $this->db->get('users')->result();

		$this->load->view('profiles', $data);
	}

	public function user($username = null, $albums = NULL, $album = NULL) {
		if(!isset($albums)) {
			if(!isset($username)) {
				redirect(base_url());
			}

			if($this->session->userdata('user_id') && $this->session->userdata('username') == $username) {
				redirect(base_url());
			}

			$this->db->where('username', $username);
			$data['user'] = $this->db->get('users')->result();

			if(count($data['user'])) {
				$data['user'] = $data['user'][0];

				$this->db->where('user_id', $data['user']->id);
				$this->db->where('profile_picture', 1);
				$pp = $this->db->get('pictures')->result();

				if(count($pp)) {
					$data['pp'] = $pp[0]->path;
				}

				$this->load->view('user_profile', $data);
			} else {
				redirect(base_url());
			}
		} else if(!isset($album)) {
			if($albums != 'albums') {
				redirect(base_url());
			}

			$this->db->where('username', $username);
			$user = $this->db->get('users')->result();
			
			if(!count($user)) {
				redirect(base_url());
			}

			$user = $user[0];

			$this->db->where('user_id', $user->id);
			$albums = $this->db->get('albums')->result();

			$data['username'] = $username;

			if(count($albums)) {
				$data['albums'] = $albums;
			} else {
				$data['albums'] = array();
			}

			$this->load->view('user_albums.php', $data);
		} else {
			if($albums != 'albums') {
				redirect(base_url());
			}

			$this->db->where('username', $username);
			$user = $this->db->get('users')->result();

			if(!count($user)) {
				redirect(base_url());
			}

			$user = $user[0];

			$this->db->where('user_id', $user->id);
			$this->db->where('album_title', $album);
			$pictures = $this->db->get('pictures')->result();

			if(count($pictures)) {
				$data['pictures'] = $pictures;
			} else {
				$data['pictures'] = array();
			}

			$this->load->view('user_pictures', $data);
		}
	}
}

?>