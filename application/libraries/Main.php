<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Codeigniter Main class
*
* @package	  CodeIgniter
* @subpackage Libraries
* @category	  Libraries
* @author	  Yurii Kirichenko
* @copyright  Copyright (c) 2017
* @since	  Version 1.0.0
*/
class Main
{
	protected $CI;

	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->model('Main_model');
	}

	public function hello($login) {
		echo '<h1 style="color: green;">Hello, '.$login.'</h1>';
	}

	/**
	* Get data to current user
	*/
	public function get_user_data() {
		if(isset($this->CI->session->reguser) || isset($this->CI->session->regadmin)) {
			if(isset($this->CI->session->reguser)) {
				$login = $this->CI->session->reguser;
			}
			else {
				$login = $this->CI->session->regadmin;
			}
			$data = $this->CI->Main_model->get_user_data($login);
			return $data;
		}
	}

	/**
	* Get datato current user by ID
	*
	* @param $ID - user ID
	*/
	public function get_user_data_by_id($id) {
		$data = $this->CI->Main_model->get_user_data_by_id($id);
		return $data;
	}

	/**
	* Get data to all users
	*/
	public function get_users_data() {
		$data = $this->CI->Main_model->get_users_data();
		return $data;
	}

	/**
	* Open session for currents user
	*
	* @param $login - user login
	*/
	public function open_sess($login) {
		$user = $this->CI->Main_model->get_user_data($login);
		switch($user['roleid']) {
			case 2:
				$this->CI->session->regadmin = $login;
				break;
			default:
				$this->CI->session->reguser = $login;
				break;
		}
		$orderid = $this->CI->Main_model->get_purchase_order($login);
		if(!$orderid) {
			$orderid = $this->CI->Main_model->get_cart_order($login);
		}
		if($orderid) {
			$this->CI->session->orderid = $orderid;
			return $orderid;
		}
	}

	/**
	* Get number of products in the cart for current user
	*/
	public function get_cart() {
		if(isset($this->CI->session->orderid)) {
			$orderid = $this->CI->session->orderid;
			$data = $this->CI->Main_model->get_cart($orderid);
			return $data;
		}
	}

	/**
	* Get items count
	*/
	public function get_items_count() {
		$data = $this->CI->Main_model->get_items_count();
		return $data;
	}

	public function upd_item_count($item_id, $count) {
		$data = $this->CI->Main_model->upd_item_count($item_id, $count);
		return $data;
	}

	/**
	* Get all categories
	*/
	public function get_categories() {
		$data = $this->CI->Main_model->get_categories();
		return $data;
	}

	/**
	* Get category by ID
	*
	* @param $id - category ID
	*/
	public function get_category($id) {
		$data = $this->CI->Main_model->get_category($id);
		return $data;
	}

	/**
	* Get all items
	*/
	public function get_items() {
		$data = $this->CI->Main_model->get_items();
		return $data;
	}

	/**
	* Get item by ID
	*
	* @param $id - item ID
	*/
	public function get_item($id) {
		$data = $this->CI->Main_model->get_item($id);
		return $data;
	}

	/**
	* Get all images for current item
	*
	* @param $id - item ID
	*/
	public function get_item_imgs($id) {
		$data = $this->CI->Main_model->get_item_imgs($id);
		return $data;
	}

	/**
	* Get first image for current item
	*
	* @param $id - item ID
	*/
	public function get_first_img($id) {
		$data = $this->CI->Main_model->get_first_img($id);
		return $data;
	}

	/**
	* Get next 'ID' field from necessary table
	*
	* @param $table - string, table name
	*/
	public function get_next_id($tablename) {
		$data = $this->CI->Main_model->get_next_id($tablename);
		return $data;
	}
}