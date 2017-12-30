<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Archive extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('Main');
			$this->load->model('Archive_model');
		}

		private function get_data() {
			$data['archive'] = $this->Archive_model->get_arch_items();
			$arch_item = $data['archive'];

			$items = array();
			$categories = array();
			foreach($arch_item as $key => $item) {
				// get category ID from 'items' table
				$item_id = intval($item->itemid);
				$items[] = $this->main->get_item($item_id);
				$cat_id = $items[$key]->catid;
				// get category Name from 'categories' table
				$categories[] = $this->main->get_category($cat_id);
			}
			$data['items'] = $items;
			$data['categories'] = $categories;
			return $data;
		}

		public function index() {
			$data = $this->get_data();
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();
			$this->load->view('archive/index', $data);
		}

		public function update() {
			$id = $this->input->post('upd_id');
			$item_id = $this->input->post('upd_itemid');
			$count = $this->input->post('upd_count');
			$this->main->upd_item_count($item_id, $count);
			$this->Archive_model->del_arch_item($id);

			$data = $this->get_data();
			$this->load->view('archive/update', $data);
		}
	}