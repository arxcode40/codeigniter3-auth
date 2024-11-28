<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function register()
	{
		$this->form_validation->set_rules('name', $this->lang->line('auth_name_label'), $this->config->item('rules')['register']['name']);
		$this->form_validation->set_rules('username', $this->lang->line('auth_username_label'), $this->config->item('rules')['register']['username']);
		$this->form_validation->set_rules('password', $this->lang->line('auth_password_label'), $this->config->item('rules')['register']['password']);
		$this->form_validation->set_rules('confirm_password', $this->lang->line('auth_confirm_password_label'), $this->config->item('rules')['register']['confirm_password']);

		if ($this->form_validation->run() === FALSE)
		{
			$data['title'] = $this->lang->line('auth_register_title');

			$this->load->view('layouts/begin', $data);
			$this->load->view('auth/register');
			$this->load->view('layouts/end');
		}
		else
		{
			$user = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'remember_token' => random_string('alnum', 16),
				'role' => 'member'
			);

			$this->db->trans_start();
			$this->db->insert('users', $user);
			$this->db->trans_complete();

			redirect($this->config->item('redirect')['unauthenticated']);
		}
	}
}
