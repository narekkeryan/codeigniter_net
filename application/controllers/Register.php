<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->database();

        $this->load->library(array('form_validation','session', 'email'));

        $this->load->model('user_model');

		$config = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'htmlspecialchars|trim|required|min_length[6]|max_length[16]|is_unique[users.username]',
				'errors' => array(
					'required' => '%s is required.',
					'min_length' => '%s must be at least %d characters in length.',
					'max_length' => '%s cannot exceed %d characters in length.',
					'is_unique' => 'This %s is already exists.'
				)
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'htmlspecialchars|trim|required|min_length[6]|max_length[32]',
				'errors' => array(
					'required' => '%s is required.',
					'min_length' => '%s must be at least %d characters in length.',
					'max_length' => '%s cannot exceed %d characters in length.'
				)
			),
			array(
				'field' => 're_password',
				'label' => 'Password Confirmation',
				'rules' => 'htmlspecialchars|trim|required|matches[password]',
				'errors' => array(
					'required' => '%s is required.',
					'matches' => '%s does not match the %s.'
				)
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'htmlspecialchars|trim|required|valid_email|is_unique[users.email]',
				'errors' => array(
					'required' => '%s is required.',
					'valid_email' => '%s must contain a valid email address.',
					'is_unique' => 'This %s is already exists.'
				)
			),
			array(
				'field' => 'fname',
				'label' => 'First name',
				'rules' => 'htmlspecialchars|trim|required|min_length[2]|max_length[16]',
				'errors' => array(
					'required' => '%s is required.'
				)
			),
			array(
				'field' => 'lname',
				'label' => 'Last name',
				'rules' => 'htmlspecialchars|trim|required|min_length[2]|max_length[16]',
				'errors' => array(
					'required' => '%s is required.'
				)
			)
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE) {
			$this->load->view('register_form');
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => md5(hash('sha256', $this->input->post('password'))),
				'email' => $this->input->post('email'),
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname')
			);

			if($this->user_model->insert_user($data)) {
				mkdir('./uploads/' . $data['username'], 0777, true);

				$milliseconds = round(microtime(true) * 1000) + 172800000;
				$hash = md5(hash('sha256', $milliseconds . $data['username']));

				$activationData = array(
					'user_username' => $data['username'],
					'valid_time' => $milliseconds,
					'hash' => $hash
				);

				$this->db->insert('activation', $activationData);

				$this->email->from('anonymouspr41@gmail.com', 'Codeigniter Tutorial Team');
				$this->email->to($data['email']);
				$this->email->subject('Codeigniter Tutorial Activation Link');
				$this->email->message(base_url() . 'index.php/activation/activate/' . $data['username'] . '/' . $hash);

				$this->email->send();

				$this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You are Successfully Registered! Please activate your profile and login to access your Profile!</div>');
				redirect(base_url());
			} else {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
				redirect(base_url());
			}
		}
	}
}
?>