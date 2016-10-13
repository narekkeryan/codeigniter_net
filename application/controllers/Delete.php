<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper(array('file'));
	}

	public function album($title = null) {
		if(!isset($title)) {
			redirect(base_url());
		}

		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$albums = $this->pictures_model->get_album($this->session->userdata('user_id'), $title);
		if(!count($albums)) {
			redirect(base_url());
		} else {
			$album_id = $albums[0]->id;
		}

		$pictures = $this->pictures_model->get_picture($albums[0]->id);

		if(count($pictures)) {
			foreach($pictures as $picture) {
				delete_files('./uploads/' . $this->session->userdata('username') . '/' . $title . '/');
			}

			$this->pictures_model->delete_album($this->session->userdata('user_id'), $title);

			$this->pictures_model->delete_picture($album_id);
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

		$picture = $this->pictures_model->get_picture_by_id($id, $this->session->userdata('user_id'));

		if(count($picture)) {
			delete_files('../../../.' . $picture[0]->path);
			
			$this->pictures_model->delete_picture_by_id($id, $this->session->userdata('user_id'));
		}

		redirect(base_url('index.php/profile/albums/' . $this->session->userdata('username') . '/'));
	}
}

?>