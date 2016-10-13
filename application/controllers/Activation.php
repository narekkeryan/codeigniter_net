<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activation extends CI_Controller {
	public function activate($username, $hash) {
        $query = $this->activation_model->get($username);

        if(count($query)) {
        	$query = $query[0];
        	if($query->valid_time >= round(microtime(true) * 1000) && $hash == $query->hash) {
        		$this->user_model->update_status($username, 'active');

				$this->activation_model->delete($username);

				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You are Successfully Activated Your Profile! You can now Sign In</div>');
					redirect(base_url());
	        } else {
	        	$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Activation link is not valid</div>');
					redirect(base_url());
	        }
        }  else {
        	$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Activation link is not valid</div>');
				redirect(base_url());
        }
	}
}
?>