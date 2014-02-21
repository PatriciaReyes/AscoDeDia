<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_usership extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field( array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'first_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'last_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'email_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			)
		) );

		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('usership');

		//Añadimos unos cuantos users de ejemplo:
		$users = array(
			array("id" => "1", "first_name" => "Juan", "last_name" => "Reyes", "username" => "juan", "email_address" => "juan@gmail.com", "password" => sha1('reyes')),
			array("id" => "2", "first_name" => "Patricia", "last_name" => "Reyes", "username" => "patricia", "email_address" => "patricia@gmail.com", "password" => sha1('reyes')),
			array("id" => "3", "first_name" => "Jose", "last_name" => "Trujillo", "username" => "jose", "email_address" => "2012/03/09", "password" => sha1('trujillo')),
			array("id" => "4", "first_name" => "Monica", "last_name" => "Ruiz", "username" => "monica", "email_address" => "2012/03/09", "password" => sha1('ruiz'))
		);

		$this->db->insert_batch('usership', $users);
	}

	public function down()
	{
		$this->dbforge->drop_table('usership');
	}
}002_Add_usership.php