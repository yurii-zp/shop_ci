<?php
	class Main_model extends CI_Model
	{
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function get_user_data($login) {
			$query = $this->db->get_where('users', array('login' => $login));
			return $query->row_array();
		}

		public function get_user_data_by_id($id) {
			$query = $this->db->get_where('users', array('id' => $id))->row();
			return $query;
		}
		
		public function get_users_data() {
			$query = $this->db->get('users');
			return $query->result();
		}

		public function get_purchase_order($login) {
			$query = $this->db->get_where('purchases', array('username' => $login))->row('orderid');
			return $query;
		}

		public function get_cart_order($login) {
			$query = $this->db->get_where('carts', array('username' => $login))->row('orderid');
			return $query;
		}

		public function get_cart($orderid) {
			$query = $this->db->where('orderid', $orderid);
			$num_rows = $query->count_all_results('carts');
			//$num_rows = $this->db->count_all_results('carts');
			return $num_rows;
		}

		public function get_categories() {
			$query = $this->db->get('categories');
			return $query->result();
		}

		public function get_category($id) {
			$query = $this->db->get_where('categories', array('id' => $id))->row();
			return $query;
		}

		public function get_items_count() {
			$query = $this->db->get('items');
			return $query->num_rows();
		}

		public function upd_item_count($id, $count) {
			$this->db->set('count', $count);
			$this->db->where('id', $id);
			$this->db->update('items');
		}
		
		public function get_items() {
			$this->db->select('it.id, it.item, it.pricesale, it.info, it.count, MIN(img.imagepath) AS imagepath');
			$this->db->from('items it');
			$this->db->join('images img', 'it.id = img.itemid', 'left');
			$this->db->group_by('it.id');
			$this->db->order_by('it.id', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_item($id) {
			$query = $this->db->get_where('items', array('id' => $id))->row();
			return $query;
		}

		public function get_item_imgs($id) {
			$this->db->select('imagepath');
			$this->db->from('images');
			$this->db->where('itemid', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function get_first_img($itemid) {
			$query = $this->db->get_where('images', array('itemid' => $itemid))->row('imagepath');
			return $query;
			// get first image for each item ('row' method get one string)
			/* second option
				$this->db->select('imagepath');
				$this->db->from('images');
				$this->db->where('itemid', $itemid);
				$this->db->limit(1);
				$query = $this->db->get();
				return $query->result_array();
			*/
		}

		public function get_next_id($tablename) {
			$dbname = $this->db->database;
			$this->db->select('AUTO_INCREMENT AS ai');
			$this->db->from('INFORMATION_SCHEMA.TABLES');
			$this->db->where('TABLE_SCHEMA', $dbname);
			$this->db->where('TABLE_NAME', $tablename);
			$query = $this->db->get();
			return $query->row();
		}
	}