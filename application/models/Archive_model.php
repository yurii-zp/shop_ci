<?php
	class Archive_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function get_arch_items() {
			$query = $this->db->get('archives');
			return $query->result();
		}

		public function del_arch_item($id) {
			$this->db->delete('archives', array('id' => $id));
		}
	}