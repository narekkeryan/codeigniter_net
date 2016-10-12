<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index() {
		$this->load->helper(array('form', 'url'));

		$this->load->database();

        $this->load->library(array('form_validation', 'session'));

        $this->load->model('user_model');

		$config = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'htmlspecialchars|trim|required',
				'errors' => array(
					'required' => '%s is required'
				)
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'htmlspecialchars|trim|required',
				'errors' => array(
					'required' => '%s is required'
				)
			)
		);

		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE) {
			$this->load->view('login_form');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->user_model->get_user($username, $password);

			if(count($user) > 0) {
				switch($user[0]->status) {
					case 'active':
						$userData = array(
							'user_id' => $user[0]->id,
							'username' => $user[0]->username,
							'email' => $user[0]->email,
							'fname' => $user[0]->fname,
							'lname' => $user[0]->lname,
							'status' => $user[0]->status
						);
						$this->session->set_userdata($userData);
						redirect(base_url());
						break;
					case 'waiting':
						$this->session->set_flashdata('msg','<div class="alert alert-warning text-center">You need to activate your profile.</div>');
						redirect($this->uri->uri_string());
						break;
					case 'freezed':
						$userData = array(
							'user_id' => $user[0]->id,
							'username' => $user[0]->username,
							'email' => $user[0]->email,
							'fname' => $user[0]->fname,
							'lname' => $user[0]->lname,
							'status' => $user[0]->status
						);
						$this->session->set_userdata($userData);
						$this->session->set_flashdata('msg','<div class="alert alert-info text-center">Account has been recovered.</div>');
						redirect(base_url());
						break;
					case 'deleted':
						$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Wrong Username or Password.</div>');
						redirect($this->uri->uri_string());
						break;
				}
			} else {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Wrong Username or Password.</div>');
				redirect($this->uri->uri_string());
			}
		}
	}
}

?>