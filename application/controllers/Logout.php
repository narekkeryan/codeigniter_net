<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
	public function index() {
		$this->load->helper('url');

		$this->load->database();

		$this->load->library('session');

		$userData = array('user_id', 'username', 'email', 'fname', 'lname', 'status');

		$this->session->unset_userdata($userData);
		$this->session->sess_destroy();

		redirect(base_url());
	}
}

?>