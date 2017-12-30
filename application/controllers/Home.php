<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Home extends CI_Controller
	{
		public function __construct() {
			parent::__construct();
			$this->load->library('Main');
			$this->load->model('Home_model');
		}

		public function index() {
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();
			$data['items'] = $this->Home_model->last_products();
			$items = $data['items'];
			$result = array();
			foreach ($items as $item) {
				$item_id = intval($item->id);
				$result[] = $this->main->get_first_img($item_id);
			}
			$data['img'] = $result;
			//$data['img'] = $this->main->get_first_img($item->id);
			$this->load->view('home/index', $data);
		}
	}