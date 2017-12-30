<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Admin extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->library('Main');
			$this->load->model('Admin_model');
		}

		public function index() {
			$login = $this->session->regadmin;
			$data['cart'] = $this->main->get_cart();
			$data['user'] = $this->main->get_user_data();
			$data['nextid'] = $this->main->get_next_id('categories');
			$data['categories'] = $this->main->get_categories();
			$data['items'] = $this->Admin_model->get_items_with_category();
			$data['users'] = $this->Admin_model->get_users_list($login);
			$this->load->view('admin/index', $data);
		}

		/**
		* Adding or delete a category & search category
		*/
		public function category() {
			$cat_name = trim($this->input->post('category'));
			$cat_id = intval($this->input->post('cat_id'));
			$search = trim($this->input->post('search'));
			// add new category
			if(!empty($cat_name)) {
				$fields = array(
					'category' => $cat_name,
				);
				$this->Admin_model->category_insert($fields);
				$data['message'] = 'Category "'.$cat_name.'" Added';
			}
			// delete selected category
			if(!empty($cat_id)) {
				$dir_path = 'assets/images/content/'.$cat_id.'/';
				$curr_cat = $this->main->get_category($cat_id);
				$data['message'] = 'Category "'.$curr_cat->category.'" Deleted';
				$this->Admin_model->delete_category($cat_id, $dir_path);
			}
			// search category
			if(!empty($search)) {
				$data['categories'] = $this->Admin_model->get_like_category($search);
				// if no categories are found
				if(empty($data['categories'])) {
					echo 'Category Not Found';
					exit();
				}
			} 
			else {
				$data['categories'] = $this->main->get_categories();
			}
			$this->load->view('admin/category', $data);
		}

		/**
		* Get the item data and show it in the modal
		*/
		public function get_item_data() {
			$item_id = intval($this->input->post('item_id'));
			$item = $this->main->get_item($item_id);
			echo json_encode($item);
		}

		/**
		* Adding & edit items
		*/
		public function item_insert() {
			$item_id = intval($this->input->post('item_id'));
			$item_name = trim($this->input->post('item'));
			$pricein = $this->input->post('pricein');
			$pricesale = $this->input->post('pricesale');
			$info = $this->input->post('item_info');
			$count = $this->input->post('count');
			// update item
			if(!empty($item_id)) {
				$item = $this->main->get_item($item_id);

				if(is_array($_FILES)) {
					foreach ($_FILES as $key => $val) {
						if(substr($key, 0, 3) == 'img') {
							foreach ($_FILES['img']['name'] as $key => $value) {
								if($_FILES['img']['error'][$key] != 0) {
									continue;
								}
								else {
									$value = $item->id.'-'.$value;
									$dir_path = 'assets/images/content/'.$item->catid.'/'.$item->id.'/';
									if(file_exists($dir_path)) {
										if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
											$fields = array(
												'imagepath' => $dir_path.$value,
												'itemid'	=> $item->id,
												'catid'		=> $item->catid
											);
											$this->Admin_model->images_insert($fields);
										}
									}
									else {
										mkdir($dir_path, 0777, true);

										if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
											$fields = array(
												'imagepath' => $dir_path.$value,
												'itemid'	=> $item->id,
												'catid'		=> $item->catid
											);
											$this->Admin_model->images_insert($fields);
										}
									}
								}
							}
						}
					}
				}

				$fields = array(
					'item'		=> $item_name,
					'pricein'	=> $pricein,
					'pricesale' => $pricesale,
					'info'		=> $info,
					'count'		=> $count
				);
				$this->Admin_model->item_update($item_id, $fields);
				$data['message'] = 'Item "'.$item->item.'" Updated';
			}
			// add item
			else {
				$catid = intval($this->input->post('catid'));

				if(is_array($_FILES)) {
					foreach ($_FILES['img']['name'] as $key => $value) {
						if($_FILES['img']['error'][$key] != 0) {
							continue;
						}
						else {
							$nextid = $this->main->get_next_id('items');
							$nextid = $nextid->ai;
							$value = $nextid.'-'.$value;
							$dir_path = 'assets/images/content/'.$catid.'/'.$nextid.'/';
							if(file_exists($dir_path)) {
								if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
									$fields = array(
										'imagepath' => $dir_path.$value,
										'itemid'	=> $nextid,
										'catid'		=> $catid
									);
									$this->Admin_model->images_insert($fields);
								}
							}
							else {
								mkdir($dir_path, 0777, true);

								if(move_uploaded_file($_FILES['img']['tmp_name'][$key], $dir_path.$value)) {
									$fields = array(
										'imagepath' => $dir_path.$value,
										'itemid'	=> $nextid,
										'catid'		=> $catid
									);
									$this->Admin_model->images_insert($fields);
								}
							}
						}
					}
				}

				$fields = array(
					'item'		=> $item_name,
					'catid'		=> $catid,
					'pricein'	=> $pricein,
					'pricesale' => $pricesale,
					'info'		=> $info,
					'count'		=> $count
				);
				$this->Admin_model->item_insert($fields);
				$data['message'] = 'Item "'.$item_name.'" Added';
			}
			$data['items'] = $this->Admin_model->get_items_with_category();
			$this->load->view('admin/item', $data);
		}

		public function item_search() {
			$search = trim($this->input->post('search'));
			if(!empty($search)) {
				$data['items'] = $this->Admin_model->get_like_items($search);
				// if no items are found
				if(empty($data['items'])) {
					echo 'Product Not Found';
					exit();
				}
			} 
			else {
				$data['items'] = $this->Admin_model->get_items_with_category();
			}
			$this->load->view('admin/item', $data);
		}

		public function delete_item() {
			$item_id = intval($this->input->post('item_id'));
			if(isset($item_id)) {
				$item = $this->main->get_item($item_id);
				$dir_path = 'assets/images/content/'.$item->catid.'/'.$item_id.'/';
				$this->Admin_model->delete_item($item_id, $dir_path);
				$data['message'] = 'Item '.$item->item.' deleted.';
				$data['items'] = $this->Admin_model->get_items_with_category();
				$this->load->view('admin/item', $data);
			}
		}

		/**
		* Change user role & search user
		*/
		public function user() {
			$login = $this->session->regadmin;
			$user_id = intval($this->input->post('user_id'));
			$search = trim($this->input->post('search'));
			// update user role
			if(!empty($user_id)) {
				$sel_user = $this->main->get_user_data_by_id($user_id);
				$this->Admin_model->upd_user_role($user_id, $sel_user->roleid);
				$data['message'] = 'User '.$sel_user->login.' role updated.';
			}
			// search user
			if(!empty($search)) {
				$data['users'] = $this->Admin_model->get_like_users_list($search, $login);
				// if no users are found
				if(empty($data['users'])) {
					echo 'User Not Found';
					exit();
				}
			} 
			else {
				$data['users'] = $this->Admin_model->get_users_list($login);
			}
			$this->load->view('admin/user', $data);
		}
		/**
		* Delete user
		*/
		public function user_delete() {
			$login = $this->session->regadmin;
			$user_id = intval($this->input->post('user_id'));
			if(isset($user_id)) {
				$sel_user = $this->main->get_user_data_by_id($user_id);
				$this->Admin_model->delete_user($user_id);
				$data['message'] = 'User '.$sel_user->login.' deleted.';
			}
			$data['users'] = $this->Admin_model->get_users_list($login);
			$this->load->view('admin/user', $data);
		}
	}
?>