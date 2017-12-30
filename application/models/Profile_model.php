<?php
	class Profile_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function get_purchase_count($login) {
			$query = $this->db->where('username', $login);
			$num_rows = $query->count_all_results('purchases');
			return $num_rows;
		}

		public function purchase_amount($login) {
			$this->db->select_sum('price');
			$this->db->where('username', $login);
			$query = $this->db->get('purchases')->row('price');
			return floatval($query);
		}

		public function upd_profile($email, $avatar, $login) {
			$data = array(
				'email'  => $email,
				'avatar' => $avatar
			);
			$this->db->update('users', $data, array('login' => $login));
		}
	}