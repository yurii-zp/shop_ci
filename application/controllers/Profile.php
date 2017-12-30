<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Profile extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('Main');
			$this->load->model('Profile_model');
		}

		public function index() {
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();
			$login = $data['user']['login'];
			$curr_avatar = $data['user']['avatar'];
			$data['count'] = $this->Profile_model->get_purchase_count($login);
			$data['amount'] = $this->Profile_model->purchase_amount($login);

			// If user updated profile
			$edit = $this->input->post('edit_prof');
			if($edit) {
				$this->edit_profile($login, $curr_avatar);
			}
			$this->load->view('profile/index', $data);
		}

		private function edit_profile($login, $curr_avatar) {
			$email = trim($this->input->post('email_prof'));
			if($_FILES['avatar_prof']['error'] != 0) {
				$avatar = $curr_avatar;
			}
			else {
				$fn = $_FILES['avatar_prof']['tmp_name'];
				$file = fopen($fn, 'rb');
				$avatar = fread($file, filesize($fn));
				fclose($file);
			}
			$this->Profile_model->upd_profile($email, $avatar, $login);
			$location = $_SERVER["REQUEST_URI"];
			header("Location: ".$location);
			exit;
		}
	}