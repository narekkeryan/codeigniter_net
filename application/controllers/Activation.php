<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {
	public function activate($username, $hash) {
		$this->load->database();

		$this->load->helper('url');

		$this->load->library('session');

        $query = $this->db->get_where('activation', array('user_username' => $username));

        if($query->result()[0]->valid_time >= round(microtime(true) * 1000) && $hash == $query->result()[0]->hash) {
        	$this->db->set('status', 'active');
			$this->db->where('username', $username);
			$this->db->update('users');

			$this->db->delete('activation', array('user_username' => $username));

			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You are Successfully Activated Your Profile! You can now Sign In</div>');
				redirect(base_url());
        } else {
        	$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Activation link is not valid</div>');
				redirect(base_url());
        }
	}
}
?>