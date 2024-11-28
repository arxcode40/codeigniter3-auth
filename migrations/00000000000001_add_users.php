<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
      'id' => array(
        'auto_increment' => TRUE,
        'type' => 'BIGINT',
        'unsigned' => TRUE
      ),
      'name' => array(
        'constraint' => '255',
        'type' => 'VARCHAR'
      ),
      'username' => array(
        'constraint' => '16',
        'type' => 'VARCHAR',
        'unique' => TRUE
      ),
      'password' => array(
        'constraint' => '60',
        'type' => 'VARCHAR'
      ),
      'remember_token' => array(
        'constraint' => '16',
        'type' => 'VARCHAR'
      ),
      'role' => array(
        'constraint' => '255',
        'type' => 'VARCHAR'
      )
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('users', TRUE);
	}

	public function down()
	{
		 $this->dbforge->drop_table('users', TRUE);
	}
}
