<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
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

			$this->pictures_model->update_profile_picture($this->session->userdata('user_id'));

			$album = $this->pictures_model->get_album($this->session->userdata('user_id'), 'profile_pictures');

			if(!count($album)) {
				$dataToInsert = array(
					'user_id' => $this->session->userdata('user_id'),
					'title' => 'profile_pictures',
					'name' => 'Profile pictures'
				);
				$this->pictures_model->insert_album($dataToInsert);
				$album_id = $this->pictures_model->get_last_album_id();
			} else {
				$album_id = $album[0]->id;
			}

			$dataToInsert = array(
				'user_id' => $this->session->userdata('user_id'),
				'album_id' => $album_id,
				'path' => $config['upload_path'] . $data['upload_data']['file_name'],
				'profile_picture' => 1
			);
			$this->pictures_model->insert_picture($dataToInsert);

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

			$album = $this->pictures_model->get_album($this->session->userdata('user_id'), str_replace(' ', '_', $this->input->post('title')));

			if(!count($album)) { //sharnakel
				$dataToInsert = array(
					'user_id' => $this->session->userdata('user_id'),
					'title' => str_replace(' ', '_', $this->input->post('title')),
					'name' => $this->input->post('title')
				);
				$this->pictures_model->insert_album($dataToInsert);
				$album_id = $this->pictures_model->get_last_album_id();
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Album with this name exists!</div>');
				redirect(base_url() . 'index.php/profile/albums/' . $this->session->userdata('username'));
			}

			for($i = 0; $i < $cpt; ++$i) {
				$dataToInsert = array(
					'user_id' => $this->session->userdata('user_id'),
					'album_id' => $album_id,
					'path' => $config['upload_path'] . $data[$i]['upload_data']['file_name'],
					'profile_picture' => 0
				);
				$this->pictures_model->insert_picture($dataToInsert);
			}

			redirect(base_url() . 'index.php/profile/albums/' . $this->session->userdata('username') . '/');
		}
	}

	public function picture($title) {
		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$album = $this->pictures_model->get_album($this->session->userdata('user_id'), $title);
		if(!count($album)) {
			redirect(base_url());
		}

		$album_id = $album[0]->id;

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
				'album_id' => $album_id,
				'path' => $config['upload_path'] . $data[$i]['upload_data']['file_name'],
				'profile_picture' => 0
			);
			$this->pictures_model->insert_picture($dataToInsert);
		}

		redirect(base_url() . 'index.php/profile/albums/' . $this->session->userdata('username') . '/' . $title . '/');
	}
}

?>