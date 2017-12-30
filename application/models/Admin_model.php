<?php
	class Admin_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}
		// Category tab
		public function category_insert($data) {
			$this->db->insert('categories', $data);
		}

		public function delete_category($id, $dir_path) {
			$this->db->delete('categories', array('id' => $id));
			$this->db->delete('items', array('catid' => $id));
			$this->db->delete('images', array('catid' => $id));
			$this->delete_directory($dir_path);
		}

		public function get_like_category($search) {
			$this->db->like('category', $search);
			$query = $this->db->get('categories');
			return $query->result();
		}
		// Items tab
		public function get_items_with_category() {
			$this->db->select('it.id, it.item, it.catid, ca.category');
			$this->db->from('items it');
			$this->db->join('categories ca', 'it.catid = ca.id', 'left');
			$this->db->order_by('it.id', 'ASC');
			$query = $this->db->get();
			return $query->result();
		}

		public function images_insert($data) {
			$this->db->insert('images', $data);
		}

		public function item_insert($data) {
			$this->db->insert('items', $data);
		}

		public function item_update($id, $data) {
			$this->db->update('items', $data, array('id' => $id));
		}

		public function get_like_items($search) {
			$this->db->select('it.id, it.item, it.catid, ca.category');
			$this->db->from('items it');
			$this->db->join('categories ca', 'it.catid = ca.id', 'left');
			$this->db->like('it.item', $search);
			$this->db->or_like('ca.category', $search);
			$this->db->order_by('it.id', 'ASC');
			$query = $this->db->get();
			return $query->result();
		}

		public function delete_item($id, $dir_path) {
			$this->db->delete('items', array('id' => $id));
			$this->db->delete('carts', array('itemid' => $id));
			$this->db->delete('images', array('itemid' => $id));
			$this->delete_directory($dir_path);
		}

		// Users tab
		public function get_users_list($login) {
			$this->db->select('id, login, email, roleid');
			$this->db->where_not_in('login', $login);
			$query = $this->db->get('users');
			return $query->result();
		}

		public function get_like_users_list($search, $login) {
			$this->db->select('id, login, email, roleid');
			$this->db->like('login', $search);
			$this->db->where_not_in('login', $login);
			$query = $this->db->get('users');
			return $query->result();
		}

		public function upd_user_role($id, $roleid) {
			switch($roleid) {
				case 2:
					$data = array(
						'roleid' => 1,
					);
					break;
				default:
					$data = array(
						'roleid' => 2,
					);
					break;
			}
			$this->db->update('users', $data, array('id' => $id));
		}

		public function delete_user($id) {
			$this->db->delete('users', array('id' => $id));
		}

		private function delete_directory($dir_path) {
			if($dir_path) {
				if (substr($dir_path, strlen($dir_path) - 1, 1) != '/') {
					$dir_path .= '/';
				}
				$files = glob($dir_path . '*', GLOB_MARK);
				foreach ($files as $file) {
					if(is_dir($file)) {
						self::delete_directory($file);
					}
					else {
						unlink($file);
					}
				}
				@rmdir($dir_path);
			}
		}
	}