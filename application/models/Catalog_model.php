<?php
	class Catalog_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		// For Catalog template
		public function get_cat_items($cat_id) {
			$this->db->select('it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath');
			$this->db->from('items it');
			$this->db->join('images img', 'it.id = img.itemid', 'left');
			$this->db->where('it.catid', $cat_id);
			$this->db->group_by('it.id');
			$this->db->order_by('it.id', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_range_items($range_min, $range_max) {
			$this->db->select('it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath');
			$this->db->from('items it');
			$this->db->join('images img', 'it.id = img.itemid', 'left');
			$this->db->where('it.pricesale >', $range_min);
			$this->db->where('it.pricesale <', $range_max);
			$this->db->group_by('it.id');
			$this->db->order_by('it.id', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_cat_range_items($cat_id, $range_min, $range_max) {
			$this->db->select('it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath');
			$this->db->from('items it');
			$this->db->join('images img', 'it.id = img.itemid', 'left');
			$this->db->where('it.pricesale >', $range_min);
			$this->db->where('it.pricesale <', $range_max);
			$this->db->where('it.catid', $cat_id);
			$this->db->group_by('it.id');
			$this->db->order_by('it.id', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function cart_insert($data) {
			$this->db->insert('carts', $data);
		}

		// For Single Items Template
		public function get_comments($id) {
			$query = $this->db->get_where('comments', array('itemid' => $id));
			return $query->result();
		}

		public function comment_insert($data) {
			$this->db->insert('comments', $data);
		}
	}
?>