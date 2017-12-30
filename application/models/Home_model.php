<?php
	class Home_model extends CI_Model
	{
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function last_products() {
			$this->db->select('i1.id, i1.item, i1.catid, i1.pricesale');
			$this->db->from('items i1');
			$this->db->join('items i2', 'i1.catid = i2.catid AND i1.id < i2.id', 'left outer');
			$this->db->group_by('i1.id');
			$this->db->having('count(*) < 3');
			$this->db->order_by('i1.catid');
			$query = $this->db->get();
			return $query->result();
		}
	}