<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['login_attempts_max'] = 3;
$config['login_attempts_expire'] = 1; // In minutes
$config['remember_expire'] = 30; // In days

$config['rules']['login']['username'] = array('max_length[16]', 'regex_match[/^[a-z\d]+$/]', 'required', 'trim');
$config['rules']['login']['password'] = array('max_length[16]', 'min_length[8]', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)(?!.*\s).+$/]', 'required', 'trim'); // Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.

$config['rules']['register']['name'] = array('max_length[255]', 'required', 'trim');
$config['rules']['register']['username'] = array('is_unique[users.username]', 'max_length[16]', 'regex_match[/^[a-z\d]+$/]', 'required', 'trim');
$config['rules']['register']['password'] = array('max_length[16]', 'min_length[8]', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)(?!.*\s).+$/]', 'required', 'trim'); // Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.
$config['rules']['register']['confirm_password'] = array('matches[password]', 'required', 'trim');

$config['redirect']['authenticated'] = '';
$config['redirect']['unauthenticated'] = 'login';
