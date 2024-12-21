<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
	
	protected $CI;

	protected $_login_attempts;
	protected $_login_attempts_expire;

	protected $_user;
	protected $_error_string = '';

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function allows($roles)
	{
		if (is_array($roles) === FALSE)
		{
			return $this->user()->role === $roles;
		}
		else
		{
			return in_array($this->user()->role, $roles);
		}
	}

	public function attempt($username, $password, $remember = FALSE)
	{
		$this->_login_attempts = $this->CI->session->tempdata('login_attempts')??1;
		$this->_login_attempts_expire = $this->CI->config->item('login_attempts_expire')*60;

		if ($this->_login_attempts >= $this->CI->config->item('login_attempts_max'))
		{
			$this->_error_string = sprintf($this->CI->lang->line('auth_throttle'), $this->_login_attempts_expire);

			return FALSE;
		}

		if ($this->login($username, $password, $remember) === FALSE)
		{
			$this->_increment_login_attempts();

			return FALSE;
		}
		else
		{
			$this->_clear_login_attempts();

			return TRUE;
		}
	}

	public function check()
	{
		if ($this->via_remember())
		{
			return TRUE;
		}

		if ($this->CI->session->has_userdata('user'))
		{
			if ( ! empty($this->user()))
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	public function denies($roles)
	{
		return ( ! $this->allows($roles));
	}

	public function error_string()
	{
		return $this->_error_string;
	}

	public function get_remember_token()
	{
		return $this->CI->input->cookie('remember');
	}

	public function guard($roles = array())
	{
		if ($this->guest())
		{
			redirect($this->CI->config->item('redirect')['unauthenticated']);
		}

		if ( ! empty($roles))
		{
			if (is_array($roles) === FALSE)
			{
				if ($this->user()->role !== $roles)
				{
					show_error($this->CI->lang->line('auth_forbidden_message'), 403, $this->CI->lang->line('auth_forbidden_heading'));
				}
			}
			else
			{
				if ( ! in_array($this->user()->role, $roles))
				{
					show_error($this->CI->lang->line('auth_forbidden_message'), 403, $this->CI->lang->line('auth_forbidden_heading'));
				}
			}
		}
	}

	public function guest()
	{
		return ( ! $this->check());
	}

	public function via_remember()
	{
		if ($this->get_remember_token())
		{
			if ($this->user()->remember_token === $this->get_remember_token())
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	public function login($username, $password, $remember = FALSE)
	{
		if ($this->once($username, $password) === FALSE)
		{
			$this->_error_string = $this->CI->lang->line('auth_failed');

			return FALSE;
		}
		else
		{
			$this->CI->session->sess_regenerate();
			$this->CI->session->set_userdata('user', $this->_user->id);

			if ($remember)
			{
				$this->_set_remember_token();
			}

			return TRUE;
		}
	}

	public function logout()
	{
		$this->CI->session->sess_regenerate();
		$this->CI->session->sess_destroy();

		if ($this->via_remember())
		{
			$this->_delete_remember_token();
		}

		redirect($this->CI->config->item('redirect')['unauthenticated']);
	}

	public function once($username, $password)
	{
		$user = $this->_retrieve_user(array('username' => $username));

		if (empty($user))
		{
			return FALSE;
		}
		
		if ( ! password_verify($password, $user->password))
		{
			return FALSE;
		}

		$this->_user = $user;
		return TRUE;
	}

	public function user()
	{
		return $this->_retrieve_user(array('id' => $this->CI->session->userdata('user')));
	}

	protected function _clear_login_attempts()
	{
		$this->CI->session->sess_regenerate();
		$this->CI->session->unset_tempdata('login_attempts');
	}

	protected function _delete_remember_token()
	{
		$this->CI->input->set_cookie('remember');
	}

	protected function _increment_login_attempts()
	{
		$this->CI->session->set_tempdata('login_attempts', ++$this->_login_attempts, $this->_login_attempts_expire);
	}

	protected function _retrieve_user($where)
	{
		return $this->CI->db->get_where('users', $where)->row();
	}

	protected function _set_remember_token()
	{
		$this->CI->input->set_cookie('remember', $this->_user->remember_token, $this->CI->config->item('remember_expire') * 86400);
	}
}
