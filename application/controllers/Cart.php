<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Cart extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('Main');
			$this->load->model('Cart_model');
		}

		public function index() {
			$orderid = $this->session->orderid;
			$data['cart_items'] = $this->Cart_model->get_cart_items($orderid);
			$cart_items = $data['cart_items'];

			$items = array();
			$img = array();
			foreach($cart_items as $item) {
				$item_id = intval($item->itemid);
				$items[] = $this->main->get_item($item_id);
				$img[] = $this->main->get_first_img($item_id);
			}

			$data['items'] = $items;
			$data['img'] = $img;
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();

			if($data['user']) {
				$login = $data['user']['login'];
				$price = $this->Cart_model->total_price($orderid);
				$data['discount'] = $this->Cart_model->total_price_get_discount($login, $price);
			}
			else {
				$data['discount'] = $this->Cart_model->total_price($orderid);
			}
			$this->load->view('cart/index', $data);
		}

		public function buy_delete() {
			$orderid = $this->session->orderid;
			$cart_id = $this->input->post('cart_id');
			$item_id = $this->input->post('item_id');
			$buy_id  = $this->input->post('buy_id');

			$data['item'] = $this->main->get_item($item_id);
			$data['user'] = $this->main->get_user_data();
			// if user buys product
			if(isset($buy_id)) {
				$curr_price = $data['item']->pricesale;
				if(isset($data['user'])) {
					$login = $data['user']['login'];
					$price = $data['item']->pricesale;
					$curr_price = $this->Cart_model->total_price_get_discount($login, $price);
				}
				else {
					$login = null;
				}
				$tz = date_default_timezone_set('Europe/Kiev');
				$datein = @date('Y-m-d H:i:s');

				$fields = array(
					'itemid'   => $item_id,
					'price'    => $curr_price,
					'username' => $login,
					'orderid'  => $orderid,
					'datein'   => $datein
				);
				$this->Cart_model->purchase_insert($fields);
				$this->Cart_model->total_price_set_discount($login);
				$this->Cart_model->set_rating($login);
				$this->Cart_model->delete_cart($cart_id);

				// If no more products
				$count = $data['item']->count;
				if($count == 0) {
					$item = $data['item']->item;
					$pricein = $data['item']->pricein;
					$arch_fields = array(
						'item' 	    => $item,
						'itemid'    => $item_id,
						'pricein'   => $pricein,
						'pricesale' => $curr_price,
						'datesale'  => $datein
					);
					$this->Cart_model->archive_insert($arch_fields);
				}
			}
			// if user delete product from cart
			else {
				$count = $data['item']->count + 1;
				$this->Cart_model->delete_cart($cart_id);
				$this->main->upd_item_count($item_id, $count);
			}
			$data['cart'] = $this->main->get_cart();

			if(!empty($data['cart'])) {
				$data['cart_items'] = $this->Cart_model->get_cart_items($orderid);
				$cart_items = $data['cart_items'];

				$items = array();
				$img = array();
				foreach($cart_items as $item) {
					$item_id = intval($item->itemid);
					$items[] = $this->main->get_item($item_id);
					$img[] = $this->main->get_first_img($item_id);
				}
				$data['items'] = $items;
				$data['img'] = $img;

				if($data['user']) {
					$login = $data['user']['login'];
					$price = $this->Cart_model->total_price($orderid);
					$data['discount'] = $this->Cart_model->total_price_get_discount($login, $price);
				}
				else {
					$data['discount'] = $this->Cart_model->total_price($orderid);
				}
				$this->load->view('cart/buy_delete', $data);
			}
			else {
				if(isset($buy_id)) {
					echo '<h3 class="text-center">All goods were purchased!<br>Want more shopping? Look our products on <a href="'.site_url('catalog/index').'">Catalog</a> page.</h3>';
				}
				else {
					echo '<h3 class="text-center">You have no shopping cart. Look our products on <a href="'.site_url('catalog/index').'">Catalog</a> page.</h3>';
				}
			}
		}

		public function get_order() {
			$ordernum = trim($this->input->post('ordernum'));
			$order = $this->Cart_model->get_order($ordernum);
			if($order) {
				$this->session->orderid = $order;
				$orderid = $this->session->orderid;
				$data['cart_items'] = $this->Cart_model->get_cart_items($orderid);
				$cart_items = $data['cart_items'];

				$items = array();
				$img = array();
				foreach($cart_items as $item) {
					$item_id = intval($item->itemid);
					$items[] = $this->main->get_item($item_id);
					$img[] = $this->main->get_first_img($item_id);
				}

				$data['items'] = $items;
				$data['img'] = $img;
				$data['cart'] = $this->main->get_cart();
				$data['discount'] = $this->Cart_model->total_price($orderid);
				$this->load->view('cart/index', $data);
			}
			else {
				$this->load->view('cart/empty');
			}
		}
	}