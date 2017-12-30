<?php
	class Cart_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function get_order($ordernum) {
			$query = $this->db->get_where('carts', array('orderid' => $ordernum))->row('orderid');
			return $query;
		}

		public function get_cart_items($orderid) {
			$this->db->select('id, itemid, orderid');
			$this->db->where('orderid', $orderid);
			$query = $this->db->get('carts');
			return $query->result();
		}

		public function total_price($orderid) {
			$this->db->select_sum('price');
			$this->db->where('orderid', $orderid);
			$query = $this->db->get('carts')->row('price');
			$total = floatval($query);
			return $total;
		}

		public function total_price_get_discount($login, $price) {
			$this->db->select_sum('price');
			$this->db->where('username', $login);
			$query = $this->db->get('purchases')->row('price');
			$total = intval($query);

			if($total < 1000) {
				$discount = $price * 1 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
			elseif($total >= 1000 && $total <= 2999) {
				$discount = $price * 3 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
			elseif($total >= 3000 && $total <= 4999) {
				$discount = $price * 5 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
			else {
				$discount = $price * 7 / 100;
				$price = $price - $discount;
				return round($price, 2);
			}
		}

		public function total_price_set_discount($login) {
			$this->db->select_sum('price');
			$this->db->where('username', $login);
			$query = $this->db->get('purchases')->row('price');
			$total = intval($query);

			if($total >= 1000 && $total <= 2999) {
				$this->db->set('discount', 3);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
			elseif($total >= 3000 && $total <= 4999) {
				$this->db->set('discount', 5);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
			elseif($total >= 5000) {
				$this->db->set('discount', 7);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
		}

		public function set_rating($login) {
			$this->db->select_sum('price');
			$this->db->where('username', $login);
			$query = $this->db->get('purchases')->row('price');
			$total = intval($query);

			if($total >= 1000 && $total <= 1999) {
				$this->db->set('rating', 20);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
			elseif($total >= 2000 && $total <= 2999) {
				$this->db->set('rating', 40);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
			elseif($total >= 3000 && $total <= 3999) {
				$this->db->set('rating', 60);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
			elseif($total >= 4000 && $total <= 4999) {
				$this->db->set('rating', 80);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
			elseif($total >= 5000) {
				$this->db->set('rating', 100);
				$this->db->where('login', $login);
				$this->db->update('users');
			}
		}

		public function purchase_insert($data) {
			$this->db->insert('purchases', $data);
		}

		public function archive_insert($data) {
			$this->db->insert('archives', $data);
		}

		public function delete_cart($id) {
			$this->db->delete('carts', array('id' => $id));
		}
	}