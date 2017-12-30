<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Catalog extends CI_Controller
	{	
		public function __construct() {
			parent::__construct();
			$this->load->library('Main');
			$this->load->model('Catalog_model');
		}

		public function index() {
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();
			$data['count'] = $this->main->get_items_count();
			if($data['count']) {
				$data['categories'] = $this->main->get_categories();
				$data['items'] = $this->main->get_items();
				$this->load->view('catalog/index', $data);
			}
			else {
				$this->load->view('catalog/no_items');
			}
		}

		/**
		* Get all items from selected category
		*/
		public function item_filter() {
			$cat_id = $this->input->post('cat_catid');
			$full_range = $this->input->post('range');
			if(isset($cat_id) && !isset($full_range)) {
				if(!empty($cat_id)) {
					$data['items'] = $this->Catalog_model->get_cat_items($cat_id);
				}
				else {
					$data['items'] = $this->main->get_items();
				}

				if($data['items']) {
					$this->load->view('catalog/items', $data);
				}
				else {
					echo '<h3 class="text-center">Unfortunately, this category not has a products.</h3>';
				}
			}
			else {
				$range = explode('-', $full_range);
				$symbol = '$';
				if(stristr($range[0], $symbol) && stristr($range[1], $symbol)) {
					$range[0] = substr($range[0], 1);
					$range[1] = substr($range[1], 2);
				}
				if(!empty($cat_id)) {
					$data['items'] = $this->Catalog_model->get_cat_range_items($cat_id, $range[0], $range[1]);
					if($data['items']) {
						$this->load->view('catalog/items', $data);
					}
					else {
						$this->load->view('catalog/not_found');
					}
				}
				else {
					$data['items'] = $this->Catalog_model->get_range_items($range[0], $range[1]);
					if($data['items']) {
						$this->load->view('catalog/items', $data);
					}
					else {
						$this->load->view('catalog/not_found');
					}
				}
			}
		}

		/**
		* Add Item to cart & Update items count in the 'items' DB table
		*/
		public function cart_insert() {
			$cat_id = $this->input->post('cat_catid');
			$cartid = $this->input->post('cartid');

			$data['item'] = $this->main->get_item($cartid);
			$item = $data['item'];
			$item_id = $item->id;
			$count = $item->count - 1;

			$data['user'] = $this->main->get_user_data();
			if(!$data['user']) 
				$data['user'] == null;
			$login = $data['user'];

			if(!isset($this->session->orderid))
				$this->session->orderid = uniqid();
			$orderid = $this->session->orderid;

			$tz = date_default_timezone_set('Europe/Kiev');
			$datein = @date('Y-m-d H:i:s');

			$fields = array(
				'itemid'   => $cartid,
				'price'    => $item->pricesale,
				'username' => $login['login'],
				'orderid'  => $orderid,
				'datein'   => $datein
			);
			$this->Catalog_model->cart_insert($fields);
			$this->main->upd_item_count($item_id, $count);

			if(!empty($cat_id)) {
				$data['items'] = $this->Catalog_model->get_cat_items($cat_id);
			}
			else {
				$data['items'] = $this->main->get_items();
			}
			$this->load->view('catalog/items', $data);
		}

		/**
		* Get single item data
		*/
		public function item() {
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();
			$data['id'] = $this->uri->segment(3, 0);
			if($data['id']) {
				$id = intval($data['id']);
				$data['item'] = $this->main->get_item($id);
				$data['images'] = $this->main->get_item_imgs($id);
				$data['comments'] = $this->Catalog_model->get_comments($id);
				$this->load->view('catalog/item', $data);
			}
			else {
				$this->load->view('catalog/no_items');
			}
		}

		/**
		* Insert comment to current item
		*/
		public function comment_insert() {
			if(isset($this->session->reguser)) {
				$login = $this->session->reguser;
			}
			else {
				$login = $this->session->regadmin;
			}
			$itemid = intval($this->input->post('itemid'));
			$title = trim($this->input->post('comm_title'));
			$comm = trim($this->input->post('comm'));
			$ratingin = $this->input->post('ratingin');
			$tz = date_default_timezone_set('Europe/Kiev');
			$curdate = @date('Y-m-d H:i:s');

			$fields = array(
				'username' => $login,
				'itemid'   => $itemid,
				'title'	   => $title,
				'comment'  => $comm,
				'rating'   => $ratingin,
				'curdate'  => $curdate
			);
			$this->Catalog_model->comment_insert($fields);
			$data['comments'] = $this->Catalog_model->get_comments($itemid);
			$this->load->view('catalog/comment', $data);
		}
	}