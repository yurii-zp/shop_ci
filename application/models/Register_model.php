<?php
	class Register_model extends CI_Model
	{
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function signup($login) {
			$query = $this->db->get_where('users', array('login' => $login));
			if($query->num_rows() == 0) {
				echo $login;
			}
			else {
				return $query->result();
			}
		}

		public function login_valid($login) {
			$query = $this->db->get_where('users', array('login' => $login));
			if($query->num_rows() != 0) {
				echo $login;
			}
			else {
				return $query->result();
			}
		}

		public function signin($login, $pass) {
			$this->db->where('login', $login);
			$this->db->where('pass', $pass);
			$query = $this->db->get('users');
			if($query->num_rows() != 0) {
				echo $login;
				echo $pass;
			}
			else {
				return $query->result();
			}
		}

		public function add_user($data) {
			$this->db->insert('users', $data);
		}

		public function upd_pass($login, $pass) {
			$data = array(
				'pass' => $pass,
			);
			$this->db->where('login', $login);
			$this->db->update('users', $data);
		}

		// - example -
		//$this->db->where("status","live")->or_where("status","dead");
		//$this->db->where("(status='live' OR status='dead')");
	}