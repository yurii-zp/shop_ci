<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Register extends CI_Controller
	{
		public function __construct() {
			parent::__construct();
			$this->load->model('Register_model');
			$this->load->library('Main');
		}

		public function signup() {
			$login = trim($this->input->post('login'));
			$signup = $this->input->post('signup');
			if($login && !$signup) {
				$this->Register_model->signup($login);
			}
			elseif($signup) {
				$pass = trim(md5($this->input->post('pass')));
				$email = trim($this->input->post('email'));
				if($_FILES['avatar']['error'] != 0) {
					$avatar = null;
				}
				else {
					$fn = $_FILES['avatar']['tmp_name'];
					$file = fopen($fn, 'rb');
					$avatar = fread($file, filesize($fn));
					fclose($file);
				}
				$data = array(
					'login' => $login,
					'pass'  => $pass,
					'email' => $email,
					'avatar' => $avatar
				);
				$this->Register_model->add_user($data);
				$this->session->reguser = $login;
				if(!empty($signup)) {
					if(isset($this->session->orderid)) {
						$this->session->unset_userdata('orderid');
					}
					$httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['SCRIPT_FILENAME'];
					header("Location: ".$httpReferer);
					exit;
				}
			}
			else {
				$this->load->view('templates/signup');
			}
		}

		public function signin() {
			$login_in = $this->input->post('login_in');
			$pass_in = $this->input->post('pass_in');
			$signin = $this->input->post('signin');
			if(!$signin && $login_in && $pass_in) {
				$this->Register_model->signin($login_in, $pass_in);
			}
			elseif($signin) {
				if(isset($this->session->orderid)) {
					$this->session->unset_userdata('orderid');
				}
				$this->main->open_sess($login_in);
				if(!empty($signin)) {
					$httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['SCRIPT_FILENAME'];
					// if unregistered user clicked 'Sign In' after enter order
					$method = 'get_order';
					if(stristr($httpReferer, $method)) {
						$need_method = 'index';
						$httpReferer = str_replace($method, $need_method, $httpReferer);
					}
					header("Location: ".$httpReferer);
					exit;
				}
			}
			else {
				$this->load->view('templates/signin');
			}
		}

		public function forgot_pass() {
			$login_ch = $this->input->post('login_ch');
			$conf_pass = trim(md5($this->input->post('conf_pass_ch')));
			$change_pass = $this->input->post('change_pass');
			if($login_ch && !$change_pass) {
				$this->Register_model->login_valid($login_ch);
			}
			elseif($change_pass) {
				if(isset($this->session->orderid)) {
					$this->session->unset_userdata('orderid');
				}
				$this->Register_model->upd_pass($login_ch, $conf_pass);
				$this->main->open_sess($login_ch);
				if(!empty($change_pass)) {
					$httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['SCRIPT_FILENAME'];
					// if unregistered user clicked 'Sign In' after enter order
					$method = 'get_order';
					if(stristr($httpReferer, $method)) {
						$need_method = 'index';
						$httpReferer = str_replace($method, $need_method, $httpReferer);
					}
					header("Location: ".$httpReferer);
					exit;
				}
			}
			else {
				$this->load->view('templates/forgot_pass');
			}
		}

		public function logout() {
			$logout = $this->input->post('logout');
			if($logout) {
				if(isset($this->session->reguser)) {
					$this->session->unset_userdata('reguser');
				}
				else {
					$this->session->unset_userdata('regadmin');
				}
				if(isset($this->session->orderid)) {
					$this->session->unset_userdata('orderid');
				}
				if(!empty($logout)) {
					$location = site_url('home/index');
					header("Location: ".$location);
					exit;
				}
			}
		}
	}