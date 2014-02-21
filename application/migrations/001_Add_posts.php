<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_post extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field( array(
			'id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'user_id' => array(
				'type' => 'INT',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'titulo' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE
			),
			'contenido' => array(
				'type' => 'TEXT',
				'null' => FALSE
			),
			'fecha' => array(
				'type' => 'DATE',
				'null' => FALSE
			),
			'tema' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
				'null' => FALSE
			)
		) );

		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('post');

		//Añadimos unos cuantos post de ejemplo:
		$posts = array(
			array("user_id" => "1", "titulo" => "Hola Mundo", "contenido" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", "fecha" => "2012/03/09", "tema" => "familia"),
			array("user_id" => "1", "titulo" => "Hola Amovens!", "contenido" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", "fecha" => "2012/03/09", "tema" => "estudios"),
			array("user_id" => "2", "titulo" => "Lorem Ipsum", "contenido" => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidun", "fecha" => "2012/03/09", "tema" => "salud"),
			array("user_id" => "3", "titulo" => "Carpooling for dummies", "contenido" => "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?", "fecha" => "2012/03/09", "tema" => "salud")
		);

		$this->db->insert_batch('post', $posts);
	}

	public function down()
	{
		$this->dbforge->drop_table('post');
	}
}