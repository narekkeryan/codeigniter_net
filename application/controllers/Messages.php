<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->helper(array('form', 'url'));

		$this->load->database();

		$this->load->library(array('form_validation', 'session'));

		$this->load->model(array('message_model', 'user_model'));
	}

	public function index($username = NULL) {
		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		if(!$username) {
			$data['users'] = $this->user_model->get_users('id !=', $this->session->userdata('user_id'));

			$this->load->view('profiles.php', $data);
		} else {
			$data['other_username'] = $username;

			$other_user = $this->user_model->get_users('username', $username);

			if(count($other_user)) {
				$data['messages'] = $this->message_model->get_messages($this->session->userdata('user_id'), $other_user[0]->id);
			} else {
				$data['messages'] = array();
			}

			$this->load->view('messages.php', $data);
		}
	}

	public function sent($username) {
		if(!$this->session->userdata('user_id') || !$username) {
			redirect(base_url());
		}

		$user = $this->user_model->get_users('username', $username);
		if(!count($user)) {
			redirect(base_url());
		} else {
			$this->form_validation->set_rules('message', 'Message', 'htmlspecialchars|trim|required');

			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">' . form_error('message') . '</div>');
				redirect(base_url('index.php/messages/index/' . $username));
			} else {
				$data = array(
					'user_id' => $this->session->userdata('user_id'),
					'from_id' => $this->session->userdata('user_id'),
					'to_id' => $user[0]->id,
					'message' => $this->input->post('message')
				);
				$this->message_model->insert($data);

				$data = array(
					'user_id' => $user[0]->id,
					'from_id' => $this->session->userdata('user_id'),
					'to_id' => $user[0]->id,
					'message' => $this->input->post('message')
				);
				$this->message_model->insert($data);

				redirect(base_url('index.php/messages/index/' . $username));
			}
		}
	}

	public function delete($msg_id, $username) {
		if(!$this->session->userdata('user_id')) {
			redirect(base_url());
		}

		$msg = $this->message_model->get_msg($msg_id);
		if(count($msg)) {
			$msg = $msg[0];
			if($this->session->userdata('user_id') == $msg->user_id) {
				$this->message_model->delete($msg_id);
			}
		}

		redirect(base_url('index.php/messages/index/' . $username . '/'));
	}
}

?>