<?php
	class Database_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function create_db() {
			$this->load->dbforge();
			if($this->dbforge->create_database('shop_ci')) {
				echo 'DB created';
			}
			else {
				echo 'Fail';
				die();
			}
			// create roles table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'role' => array(
					'type' => 'VARCHAR',
					'constraint' => '32',
					'unique' => TRUE
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('roles');

			// create users table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'login' => array(
					'type' => 'VARCHAR',
					'constraint' => '64',
					'unique' => TRUE
				),
				'pass' => array(
					'type' => 'VARCHAR',
					'constraint' => '64'
				),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => '64'
				),
				'roleid' => array(
					'type' => 'INT',
					'default' => '1'
				),
				'avatar' => array(
					'type' => 'MEDIUMBLOB',
					'null' => TRUE
				),
				'discount' => array(
					'type' => 'INT',
					'default' => '1'
				),
				'rating' => array(
					'type' => 'INT',
					'default' => '0'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (roleid) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('users');

			// create categories table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'category' => array(
					'type' => 'VARCHAR',
					'constraint' => '64',
					'unique' => TRUE
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('categories');

			// create items table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'item' => array(
					'type' => 'VARCHAR',
					'constraint' => '64',
					'unique' => TRUE
				),
				'catid' => array(
					'type' => 'INT'
				),
				'pricein' => array(
					'type' => 'DECIMAL',
					'constraint' => '7,2'
				),
				'pricesale' => array(
					'type' => 'DECIMAL',
					'constraint' => '7,2'
				),
				'info' => array(
					'type' => 'TEXT',
					'null' => TRUE
				),
				'count' => array(
					'type' => 'INT'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (catid) REFERENCES categories(id) ON DELETE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('items');

			// create images table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'imagepath' => array(
					'type' => 'VARCHAR',
					'constraint' => '256'
				),
				'itemid' => array(
					'type' => 'INT'
				),
				'catid' => array(
					'type' => 'INT'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (itemid) REFERENCES items(id) ON DELETE CASCADE');
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (catid) REFERENCES categories(id) ON DELETE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('images');

			// create comments table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'username' => array(
					'type' => 'VARCHAR',
					'constraint' => '64'
				),
				'itemid' => array(
					'type' => 'INT'
				),
				'title' => array(
					'type' => 'VARCHAR',
					'constraint' => '128',
					'null' => TRUE
				),
				'comment' => array(
					'type' => 'TEXT'
				),
				'rating' => array(
					'type' => 'INT'
				),
				'curdate' => array(
					'type' => 'DATETIME'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (username) REFERENCES users(login) ON DELETE CASCADE');
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (itemid) REFERENCES items(id) ON DELETE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('comments');

			// create carts table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'itemid' => array(
					'type' => 'INT'
				),
				'price' => array(
					'type' => 'DECIMAL',
					'constraint' => '7,2'
				),
				'username' => array(
					'type' => 'VARCHAR',
					'constraint' => '64',
					'null' => TRUE
				),
				'orderid' => array(
					'type' => 'VARCHAR',
					'constraint' => '32'
				),
				'datein' => array(
					'type' => 'DATETIME'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (itemid) REFERENCES items(id) ON DELETE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('carts');

			// create purchases table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'itemid' => array(
					'type' => 'INT'
				),
				'price' => array(
					'type' => 'DECIMAL',
					'constraint' => '7,2'
				),
				'username' => array(
					'type' => 'VARCHAR',
					'constraint' => '64',
					'null' => TRUE
				),
				'orderid' => array(
					'type' => 'VARCHAR',
					'constraint' => '32'
				),
				'datein' => array(
					'type' => 'DATETIME'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (itemid) REFERENCES items(id) ON DELETE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('purchases');

			// create archives table
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'item' => array(
					'type' => 'VARCHAR',
					'constraint' => '64'
				),
				'itemid' => array(
					'type' => 'INT'
				),
				'pricein' => array(
					'type' => 'DECIMAL',
					'constraint' => '7,2'
				),
				'pricesale' => array(
					'type' => 'DECIMAL',
					'constraint' => '7,2'
				),
				'datesale' => array(
					'type' => 'DATETIME'
				),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (itemid) REFERENCES items(id) ON DELETE CASCADE');
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('archives');
		}
	}