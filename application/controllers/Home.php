<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index() {
		$this->load->helper('url');

		$this->load->database();

		$this->load->library('session');

		$this->load->model(array('user_model', 'message_model'));

		if(!$this->session->userdata('user_id')) {
			$this->load->view('home.php');
		} else {
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('profile_picture', 1);
			$profile_picture = $this->db->get('pictures')->result();

			$unseenMSGs = $this->message_model->get_msg($this->session->userdata('user_id'), TRUE);

			if(count($unseenMSGs)) {
				$data['unseenCount'] = count($unseenMSGs);
			} else {
				$data['unseenCount'] = '';
			}

			if(count($profile_picture)) {
				$this->session->set_userdata(array('profile_picture' => $profile_picture[0]->path));
			}

			$this->load->view('profile.php', $data);
		}
	}
}
?>