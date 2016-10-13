<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function albums($username, $title = null) {
		if(isset($title)) {
			$album = $this->pictures_model->get_album_by_title($title);
			if(!count($album)) {
				redirect(base_url());
			}
		}

		if($username == $this->session->userdata('username')) {
			$data['edit'] = array('allowed' => true);
		} else {
			$data['edit'] = array('allowed' => false);
		}

		$user = $this->user_model->get_users('username', $username);

		if(count($user)) {
			$data['username'] = $username;

			if(!isset($title)) {
				$data['albums'] = $this->pictures_model->get_album($user[0]->id);
				$data['pictures'] = array();				
			} else {
				$data['pictures'] = $this->pictures_model->get_picture($album[0]->id);
				$data['album_title'] = $album[0]->title;
				$data['album_name'] = $album[0]->name;
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