<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

	public function login()
	{
		$this->form_validation->set_rules('username', $this->lang->line('auth_username_label'), $this->config->item('rules')['login']['username']);
		$this->form_validation->set_rules('password', $this->lang->line('auth_password_label'), $this->config->item('rules')['login']['password']);

		if ($this->form_validation->run() === FALSE)
		{
			$data['title'] = $this->lang->line('auth_login_title');

			$this->load->view('layouts/begin', $data);
			$this->load->view('auth/login');
			$this->load->view('layouts/end');
		}
		else
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = (bool)$this->input->post('remember');

			if ($this->auth->attempt($username, $password, $remember) === FALSE)
			{
				$this->_set_alert_message($this->auth->error_string());

				redirect(uri_string());
			}
			else
			{
				redirect($this->config->item('redirect')['authenticated']);
			}
		}
	}

	public function logout()
	{
		$this->auth->logout();
	}

	protected function _set_alert_message($text, $status = 'danger')
	{
		$this->session->set_flashdata(
			'alert',
			array(
				'text' => $text,
				'status' => $status
			)
		);
	}
}
