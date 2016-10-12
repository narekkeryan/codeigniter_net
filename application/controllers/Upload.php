<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));

		$this->load->database();

		$this->load->library(array('form_validation', 'session'));
	}

	public function upload_profile_picture() {
		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$config['upload_path'] = './uploads/' . $this->session->userdata('username') . '/profile_pictures/';
		$config['allowed_types'] = 'jpg|jpeg|png';

		$this->load->library('upload', $config);

		if(!is_dir('./uploads/' . $this->session->userdata('username') . '/profile_pictures/')) {
			mkdir('./uploads/' . $this->session->userdata('username') . '/profile_pictures/', 0777, true);
		}

		if(!$this->upload->do_upload('file')) {
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">' . $this->upload->display_errors() . '</div>');

			redirect(base_url());
		} else {
			$data = array('upload_data' => $this->upload->data());

			$this->db->set('profile_picture', 0);
			$this->db->where('profile_picture', 1);
			$this->db->update('pictures');

			$dataToInsert = array(
				'user_id' => $this->session->userdata('user_id'),
				'album_title' => 'profile_pictures',
				'album_name' => 'Profile pictures',
				'path' => $config['upload_path'] . $data['upload_data']['file_name'],
				'profile_picture' => 1
			);
			$this->db->insert('pictures', $dataToInsert);

			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('title', 'profile_pictures');
			$album = $this->db->get('albums')->result();

			if(!count($album)) {
				$dataToInsert = array(
					'user_id' => $this->session->userdata('user_id'),
					'title' => 'profile_pictures',
					'name' => 'Profile pictures'
				);

				$this->db->insert('albums', $dataToInsert);
			}

			redirect(base_url());
		}
	}

	public function album() {
		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$config = array(
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'htmlspecialchars|trim|required',
				'errors' => array(
					'required' => '%s is required.'
				)
			)
		);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE) {
			$this->load->view('addalbum');
		} else {
			$config['upload_path'] = './uploads/' . $this->session->userdata('username') . '/' . str_replace(' ', '_', $this->input->post('title')) . '/';
			$config['allowed_types'] = 'jpg|jpeg|png';

			$this->load->library('upload', $config);

			if(!is_dir('./uploads/' . $this->session->userdata('username') . '/' . str_replace(' ', '_', $this->input->post('title')) . '/')) {
				mkdir('./uploads/' . $this->session->userdata('username') . '/' . str_replace(' ', '_', $this->input->post('title')) . '/', 0777, true);
			}
			
			$files = $_FILES;
			$cpt = count($_FILES['files']['name']);
			for($i=0; $i<$cpt; $i++) {
				$_FILES['files']['name']= $files['files']['name'][$i];
				$_FILES['files']['type']= $files['files']['type'][$i];
				$_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
				$_FILES['files']['error']= $files['files']['error'][$i];
				$_FILES['files']['size']= $files['files']['size'][$i];

				$this->upload->initialize($config);
				$this->upload->do_upload('files');


				$data[$i] = array('upload_data' => $this->upload->data());
			}

			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('title', str_replace(' ', '_', $this->input->post('title')));
			$album = $this->db->get('albums')->result();

			if(!count($album)) {
				$dataToInsert = array(
					'user_id' => $this->session->userdata('user_id'),
					'title' => str_replace(' ', '_', $this->input->post('title')),
					'name' => $this->input->post('title')
				);
				$this->db->insert('albums', $dataToInsert);
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Album with this name exists!</div>');
				redirect(base_url() . 'index.php/profile/albums/' . $this->session->userdata('username'));
			}

			for($i = 0; $i < $cpt; ++$i) {
				$dataToInsert = array(
					'user_id' => $this->session->userdata('user_id'),
					'album_title' => str_replace(' ', '_', $this->input->post('title')),
					'album_name' => $this->input->post('title'),
					'path' => $config['upload_path'] . $data[$i]['upload_data']['file_name'],
					'profile_picture' => 0
				);
				$this->db->insert('pictures', $dataToInsert);
			}

			redirect(base_url() . 'index.php/profile/albums/' . $this->session->userdata('username') . '/');
		}
	}

	public function picture($title) {
		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$this->db->where('title', $title);
		$alb = $this->db->get('albums')->result();
		if(!count($alb)) {
			redirect(base_url());
		}

		$config['upload_path'] = './uploads/' . $this->session->userdata('username') . '/' . $title . '/';
		$config['allowed_types'] = 'jpg|jpeg|png';

		$this->load->library('upload', $config);
		
		$files = $_FILES;
		$cpt = count($_FILES['files']['name']);
		for($i=0; $i<$cpt; $i++) {
			$_FILES['files']['name']= $files['files']['name'][$i];
			$_FILES['files']['type']= $files['files']['type'][$i];
			$_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
			$_FILES['files']['error']= $files['files']['error'][$i];
			$_FILES['files']['size']= $files['files']['size'][$i];

			$this->upload->initialize($config);
			$this->upload->do_upload('files');


			$data[$i] = array('upload_data' => $this->upload->data());
		}

		for($i = 0; $i < $cpt; ++$i) {
			$dataToInsert = array(
				'user_id' => $this->session->userdata('user_id'),
				'album_title' => $title,
				'album_name' => str_replace('_', ' ', $title),
				'path' => $config['upload_path'] . $data[$i]['upload_data']['file_name'],
				'profile_picture' => 0
			);
			$this->db->insert('pictures', $dataToInsert);
		}

		redirect(base_url() . 'index.php/profile/albums/' . $this->session->userdata('username') . '/' . $title . '/');
	}
}

?>