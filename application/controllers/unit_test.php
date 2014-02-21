<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*  CONTROLADOR TESTER:
 *
 *  Este controlador se utiliza para realizar las pruebas unitarias sobre 
 *  cada una de las funciones que se encuentran en cada uno de los controladores. 
 *  No utiliza Datamapper.
 */ 

class Unit_test extends CI_Controller {

	public function __construct() {
    parent::__construct();
    $this->output->enable_profiler(TRUE);

    $this->twiggy->theme('/test');
  }

  /***********
	    LOGIN
	***********/   
	// site/login  
	function users_login()
  { 
		$this->db->trans_start();

		// CREAMOS user VALIDO
		$data = array(
      'first_name' =>  'user',
      'last_name'    =>  'user',
      'username' =>  'user',
      'email_address' =>  'user',
      'password'    =>  'user'
    );
		$insert = $this->user->crear_user($data);

		// user válido, Password válido
		$data = array(
      	'username' =>  'user',
      	'password' =>  'user'
    	);
		$user = $this->user->validate($data);
    $this->unit->run(sizeof($user),TRUE, 'user valido, password valido');

	  // user valido, password no valido
	  $data = array(
	      'username' =>  'user',
	      'password' =>  'paco'
	    );
		$user = $this->user->validate($data);
		$this->unit->run($user,FALSE, 'user valido, password no valido');
		
		// user no valido, password valido
		$data = array(
      'username' =>  'paco',
      'password' =>  'user'
    );
		$user = $this->user->validate($data);
  	$this->unit->run($user,FALSE, 'user no valido, password valido');
  
    // user no valido, password no valido
    $data = array(
      'username' =>  'paco',
      'password' =>  'paco'
    );
		$user = $this->user->validate($data);
    $this->unit->run($user,FALSE, 'user no válido, password no válido');
		
		// user no valido, password no valido
    $data = array(
      'username' =>  'paco',
      'password' =>  'paco'
    );
		$user = $this->user->validate($data);
    $this->unit->run($user,FALSE, 'Campos vacios');

		$resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

	/***********
	  users
	***********/
	// crud/crear_user
	function create_user()
  {

		// Datos de user correctos
		$this->db->trans_start();

		$data = array(
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }	
    else
    {
    	$insert = FALSE;
    }	
		$this->unit->run($insert, TRUE, 'Datos de user correctos');

		// No nombre
		$data = array(
      'first_name' =>  '',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }
    else
    {
    	$insert = FALSE;
    }
		$this->unit->run($insert, FALSE, 'No nombre');

		// No apellido
		$data = array(
      'first_name' =>  'paco',
      'last_name'    =>  '',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }
    else
    {
    	$insert = FALSE;
    }
		$this->unit->run($insert, FALSE, 'No apellido');

		// No username
		$data = array(
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  '',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }
    else
    {
    	$insert = FALSE;
    }
		$this->unit->run($insert, FALSE, 'No username');

		// No email
		$data = array(
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  '',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }
    else
    {
    	$insert = FALSE;
    }
		$this->unit->run($insert, FALSE, 'No email');

		// No password
		$data = array(
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  ''
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }
    else
    {
    	$insert = FALSE;
    }
		$this->unit->run($insert, FALSE, 'No password');

		// Campos vacios
		$data = array(
      'first_name' =>  '',
      'last_name'    =>  '',
      'username' =>  '',
      'email_address' =>  '',
      'password'    =>  ''
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$insert = $this->user->crear_user($data);
    }
    else
    {
    	$insert = FALSE;
    }
		$this->unit->run($insert, FALSE, 'Todos los campos vacios');

		$resultados = $this->unit->result();

		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

	// crud/editaru
	function edit_user()
	{
		$this->db->trans_start();

		// CREAMOS user EN LA BD
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		$insert = $this->user->crear_user($data);

		// Modificamos nombre
		$data = array(
      'id' => '99',
      'first_name' =>  'paco MODIFICADO',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
    if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, TRUE, 'Modificación de nombre');

    // Modificamos apellido
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco MODIFICADO',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, TRUE, 'Modificación de apellido');

    // Modificamos username
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco MODIFICADO',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, TRUE, 'Modificación de username');

    // Modificamos email
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco MODIFICADO',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, TRUE, 'Modificación de email');

    // Modificamos password
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco MODIFICADO'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, TRUE, 'Modificación de password');

    // No nombre
		$data = array(
      'id' => '99',
      'first_name' =>  '',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, FALSE, 'No nombre');

    // No apellido
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  '',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, FALSE, 'No apellido');

    // No username
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  '',
      'email_address' =>  'paco',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, FALSE, 'No username');

    // No email
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  '',
      'password'    =>  'paco'
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, FALSE, 'No email');

    // No password
		$data = array(
      'id' => '99',
      'first_name' =>  'paco',
      'last_name'    =>  'paco',
      'username' =>  'paco',
      'email_address' =>  'paco',
      'password'    =>  ''
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, FALSE, 'No password');

    // Campos vacios
		$data = array(
      'id' => '99',
      'first_name' =>  '',
      'last_name'    =>  '',
      'username' =>  '',
      'email_address' =>  '',
      'password'    =>  ''
    );
		if ($data['first_name'] != '' && $data['last_name'] != '' && $data['username'] != '' && $data['email_address'] != '' && $data['password'] != '')
    {
    	$edit = $this->user->editar_user($data);
    }
    else
    {
    	$edit = FALSE;
    }
    $this->unit->run($edit, FALSE, 'Campos vacios');

    $resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

	// crued/eliminaru
	function delete_user() 
  {

		$this->db->trans_start();

		// user, post, votes y comentarios existen
		$user_id = '3';
		$delete = $this->comment->eliminar_comment_user($user_id);
		$this->unit->run($delete, TRUE, '1.1 Eliminar comentario de user');
		
		$delete = $this->post->eliminar_post_user($user_id);
		$this->unit->run($delete, TRUE, '1.2 Eliminar posts de user');
		
		$delete = $this->vote->eliminar_vote_user($user_id);
		$this->unit->run($delete, TRUE, '1.3 Eliminar votes de user');
		
		$delete = $this->user->eliminar_user($user_id);
		$this->unit->run($delete, TRUE, '1.4 Eliminar user');

		// user, post, votes existen, Comentarios no existen
		$user_id = '18';
		$delete = $this->comment->eliminar_comment_user($user_id);
		$this->unit->run($delete, FALSE, '2.1 Eliminar comentario de user (no comentarios)');
		
		$delete = $this->post->eliminar_post_user($user_id);
		$this->unit->run($delete, TRUE, '2.2 Eliminar posts de user (no comentarios)');
		
		$delete = $this->vote->eliminar_vote_user($user_id);
		$this->unit->run($delete, TRUE, '2.3 Eliminar votes de user (no comentarios)');
		
		$delete = $this->user->eliminar_user($user_id);
		$this->unit->run($delete, TRUE, '2.4 Eliminar user (no comentarios)');

		// user, post y comentarios existen, votes no existen
		$user_id = '17';
		$delete = $this->comment->eliminar_comment_user($user_id);
		$this->unit->run($delete, TRUE, '3.1 Eliminar comentario de user (no votes)');
		
		$delete = $this->post->eliminar_post_user($user_id);
		$this->unit->run($delete, TRUE, '3.2 Eliminar posts de user (no votes)');
		
		$delete = $this->vote->eliminar_vote_user($user_id);
		$this->unit->run($delete, FALSE, '3.3 Eliminar votes de user (no votes)');
		
		$delete = $this->user->eliminar_user($user_id);
		$this->unit->run($delete, TRUE, '3.4 Eliminar user (no votes)');

		// user, votes y comentarios existen, No posts
		$user_id = '21';
		$delete = $this->comment->eliminar_comment_user($user_id);
		$this->unit->run($delete, TRUE, '4.1 Eliminar comentario de user (no posts)');
		
		$delete = $this->post->eliminar_post_user($user_id);
		$this->unit->run($delete, FALSE, '4.2 Eliminar posts de user (no posts)');
		
		$delete = $this->vote->eliminar_vote_user($user_id);
		$this->unit->run($delete, TRUE, '4.3 Eliminar votes de user (no posts)');
		
		$delete = $this->user->eliminar_user($user_id);
		$this->unit->run($delete, TRUE, '4.4 Eliminar user (no posts)');

		// user post existen, votes y comentarios no existen
		$user_id = '19';
		$delete = $this->comment->eliminar_comment_user($user_id);
		$this->unit->run($delete, FALSE, '5.1 Eliminar comentario de user (no votes ni comentarios)');
		
		$delete = $this->post->eliminar_post_user($user_id);
		$this->unit->run($delete, TRUE, '5.2 Eliminar posts de user (no votes ni comentarios)');
		
		$delete = $this->vote->eliminar_vote_user($user_id);
		$this->unit->run($delete, FALSE, '5.3 Eliminar votes de user (no votes ni comentarios)');
		
		$delete = $this->user->eliminar_user($user_id);
		$this->unit->run($delete, TRUE, '5.4 Eliminar user (no votes ni comentarios)');

		// user existe, Post, votes y comentarios no existen
		$user_id = '20';
		$delete = $this->comment->eliminar_comment_user($user_id);
		$this->unit->run($delete, FALSe, '6.1 Eliminar comentarios de user (no votes, comentarios ni posts)');
		
		$delete = $this->post->eliminar_post_user($user_id);
		$this->unit->run($delete, FALSE, '6.2 Eliminar posts de user (no votes, comentarios ni posts)');
		
		$delete = $this->vote->eliminar_vote_user($user_id);
		$this->unit->run($delete, FALSE, '6.3 Eliminar votes de user (no votes, comentarios ni posts)');
		
		$delete = $this->user->eliminar_user($user_id);
		$this->unit->run($delete, TRUE, '6.4 Eliminar user (no votes, comentarios ni posts)');

		$resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

  /***********
	    POSTS
	***********/
	// crud/crear_post
	function create_post()
  {

		$this->db->trans_start();

		// Todos los datos del post correctos
		$data = array(
      'titulo' =>  'paco',
      'contenido'    =>  'paco es el contenido del post.',
      'user_id' =>  '3',
      'fecha' =>  '2012-10-10',
      'tema'    =>  'salud'
    );

		if ($data['titulo'] != '' && $data['contenido'] != '')
    {
			$insert = $this->db->insert('post', $data);
		}	
		else
		{
			$insert = FALSE;
		}

		$this->unit->run($insert, TRUE, 'Datos de post correctos');
		
		// No titulo
		$data = array(
      'titulo' =>  '',
      'contenido'    =>  'paco es el contenido del post.',
      'user_id' =>  '3',
      'fecha' =>  '2012-10-10',
      'tema'    =>  'salud'
    );
		if ($data['titulo'] != '' && $data['contenido'] != '')
    {
			$insert = $this->db->insert('post', $data);
		}	
		else
		{
			$insert = FALSE;
		}
		$this->unit->run($insert, FALSE, 'No titulo');
		
		// No contenido
		$data = array(
      'titulo' =>  'paco',
      'contenido'    =>  '',
      'user_id' =>  '3',
      'fecha' =>  '2012-10-10',
      'tema'    =>  'salud'
    );
		if ($data['titulo'] != '' && $data['contenido'] != '')
    {
			$insert = $this->db->insert('post', $data);
		}	
		else
		{
			$insert = FALSE;
		}
		$this->unit->run($insert, FALSE, 'No contenido');
    /*		
    		// user ANONIMO
    		$data = array(
          'titulo' =>  'paco',
          'contenido'    =>  'paco es el contenido del post.',
          'user_id' =>  '',
          'fecha' =>  '2012-10-10',
          'tema'    =>  'salud'
        );
    		if ($data['titulo'] != '' && $data['contenido'] != '')
        {
    			$insert = $this->db->insert('post', $data);
    		}	
    		else
    		{
    			$insert = FALSE;
    		}
    		$this->unit->run($insert, FALSE, 'No user');
    */		
		
		$resultados = $this->unit->result();

		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

	// crud/ editarp
	function edit_post()
	{
		$this->db->trans_start();

		//CREAMOS EL POST EN LA BD
		$data = array(
		'id' => '72',
    'titulo' =>  'paco',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '3',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
  	$insert = $this->db->insert('post', $data);

  	// Modificación de título
		$data = array(
		'id' => '72',
    'titulo' =>  'paco MODIFICADO',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '3',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
    if ($data['titulo'] != '' && $data['contenido'] != '')
    {	
    	$edit = $this->post->editar_post($data);
    }
    else
    {
    	$edit = FALSE;
    }	
    $this->unit->run($edit, TRUE, 'Modificacion de campo titulo');

    // Modificación de contenido
    $data = array(
		'id' => '72',
    'titulo' =>  'paco',
    'contenido'    =>  'paco es el contenido del post MODIFICADO.',
    'user_id' =>  '3',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
    if ($data['titulo'] != '' && $data['contenido'] != '')
    {	
    	$edit = $this->post->editar_post($data);
    }
    else
    {
    	$edit = FALSE;
    }	
    $this->unit->run($edit, TRUE, 'Modificacion de campo contenido');

    // Modificación de tema
    $data = array(
		'id' => '72',
    'titulo' =>  'paco',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '7',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'familia'
  	);
    if ($data['titulo'] != '' && $data['contenido'] != '')
    {	
    	$edit = $this->post->editar_post($data);
    }
    else
    {
    	$edit = FALSE;
    }	
    $this->unit->run($edit, TRUE, 'Modificacion de campo tema');

    // No título
    $data = array(
		'id' => '72',
    'titulo' =>  '',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '7',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
    if ($data['titulo'] != '' && $data['contenido'] != '')
    {	
    	$edit = $this->post->editar_post($data);
    }
    else
    {
    	$edit = FALSE;
    }	
    $this->unit->run($edit, FALSE, 'No titulo');

    // No contenido
    $data = array(
		'id' => '72',
    'titulo' =>  'paco',
    'contenido'    =>  '',
    'user_id' =>  '7',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
    if ($data['titulo'] != '' && $data['contenido'] != '')
    {	
    	$edit = $this->post->editar_post($data);
    }
    else
    {
    	$edit = FALSE;
    }	
    $this->unit->run($edit, FALSE, 'No contenido');

    // Campos vacios
    $data = array(
		'id' => '72',
    'titulo' =>  '',
    'contenido'    =>  '',
    'user_id' =>  '',
    'fecha' =>  '',
    'tema'    =>  ''
  	);
    if ($data['titulo'] != '' && $data['contenido'] != '')
    {	
    	$edit = $this->post->editar_post($data);
    }
    else
    {
    	$edit = FALSE;
    }	
    $this->unit->run($edit, FALSE, 'Campos vacios');

    $resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

	// crud/eliminarp
	function delete_post() 
	{
		$this->db->trans_start();

		// Post, comentarios y votes existen
		$post_id = '99';
		$delete = $this->comment->eliminar_comment_post($post_id);
		$this->unit->run($delete, TRUE, '1.1 Eliminar comentarios de post a eliminar');
		
		$delete = $this->vote->eliminar_vote_post($post_id);
		$this->unit->run($delete, TRUE, '1.2 Eliminar votes de post a eliminar');
		
		$delete = $this->post->eliminar_post($post_id);
		$this->unit->run($delete, TRUE, '1.3 Eliminar post');

		// Post y comentarios existen, votes no existen
		$post_id = '100';
		$delete = $this->comment->eliminar_comment_post($post_id);
		$this->unit->run($delete, TRUE, '2.1 Eliminar comentarios de post a eliminar (no votes)');
		
		$delete = $this->vote->eliminar_vote_post($post_id);
		$this->unit->run($delete, FALSE, '2.2 Eliminar votes (no existen) de post a eliminar');
		
		$delete = $this->post->eliminar_post($post_id);
		$this->unit->run($delete, TRUE, '2.3 Eliminar post (no votes)');


		// Post y votes existen, Comentarios no existen
		$post_id = '101';
		$delete = $this->comment->eliminar_comment_post($post_id);
		$this->unit->run($delete, FALSE, '3.1 Eliminar comentarios de post a eliminar (no existen)');
		
		$delete = $this->vote->eliminar_vote_post($post_id);
		$this->unit->run($delete, TRUE, '3.2 Eliminar votes de post a eliminar (no comentarios)');
		
		$delete = $this->post->eliminar_post($post_id);
		$this->unit->run($delete, TRUE, '3.3 Eliminar post (no comentarios)');


		// Post existe, comentarios y votes no existen
		$post_id = '102';
		$delete = $this->comment->eliminar_comment_post($post_id);
		$this->unit->run($delete, FALSE, '4.1 Eliminar comentarios (no existen) de post a eliminar');
		
		$delete = $this->vote->eliminar_vote_post($post_id);
		$this->unit->run($delete, FALSE, '4.2 Eliminar votes (no existen) de post a eliminar');
		
		$delete = $this->post->eliminar_post($post_id);
		$this->unit->run($delete, TRUE, '4.3 Eliminar post (no votes ni comentarios)');

		
		$resultados = $this->unit->result();

		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');		
	}

  /***********
	 COMENTARIOS
	***********/
	// crud/crear_comment
	function create_comment()
  {

		$this->db->trans_start();

		// Todos los datos del post correctos
		$data = array(
      'user_id' =>  '3',
      'post_id'    =>  '55',
      'texto' =>  'este es el texto del comentario.'
    );
		if ($data['texto'] != '')
		{
			$insert = $this->comment->crear_comment($data);
		}		
		else
		{
			$insert = FALSE;
		}
		$this->unit->run($insert, TRUE, 'Datos de comment correctos');
    /*
    		// No user
    		$data = array(
          'user_id' =>  '',
          'post_id'    =>  '55',
          'texto' =>  'este es el texto del comentario.'
        );
        if ($data['texto'] != '')
    		{
    			$insert = $this->comment->crear_comment($data);
    		}		
    		else
    		{
    			$insert = FALSE;
    		}
    		$this->unit->run($insert, FALSE, 'No user');
    */
		// No contenido
		$data = array(
      'user_id' =>  '3',
      'post_id'    =>  '55',
      'texto' =>  ''
    );
    if ($data['texto'] != '')
		{
			$insert = $this->comment->crear_comment($data);
		}		
		else
		{
			$insert = FALSE;
		}
		$this->unit->run($insert, FALSE, 'No contenido');

		// Campos vacios
		$data = array(
      'user_id' =>  '',
      'post_id'    =>  '',
      'texto' =>  ''
    );
    if ($data['texto'] != '')
		{
			$insert = $this->comment->crear_comment($data);
		}		
		else
		{
			$insert = FALSE;
		}
		$this->unit->run($insert, FALSE, 'Campos vacios');

		$resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}

	// crud/editarc
	function edit_comment()
	{
		$this->db->trans_start();

		// CREAMOS COMENTARIO EN LA BD
		$data = array(
			'id' => '500',
      'user_id' =>  '3',
      'post_id'    =>  '100',
      'texto' =>  'esto es un comentario'
    );
		$insert = $this->comment->crear_comment($data);

		// Modificamos el comentario
		$data = array(
      'id' => '500',
      'user_id' =>  '3',
      'post_id'    =>  '100',
      'texto' =>  'esto es un comentario MODIFICADO'
    );

		if ($data['texto'] != '')
		{
			$edit = $this->comment->editar_comment($data);
		}		
		else
		{
			$edit = FALSE;
		}	
		$this->unit->run($edit, TRUE, 'Modificación del comentario');

		// Campo de comentario vacío.
		$data = array(
      'id' => '500',
      'user_id' =>  '3',
      'post_id'    =>  '100',
      'texto' =>  ''
    );
		if ($data['texto'] != '')
		{
			$edit = $this->comment->editar_comment($data);
		}		
		else
		{
			$edit = FALSE;
		}	
		$this->unit->run($edit, FALSE, 'Campos comentario vacío');

		$resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');    
	}

	// crud/eliminarc
	public function delete_comment()
	{
		$this->db->trans_start();

		// CREAMOS user VALIDO
		$data = array(
			'id' => '100',
      'first_name' =>  'user',
      'last_name'    =>  'user',
      'username' =>  'user',
      'email_address' =>  'user',
      'password'    =>  'user'
    );
		$insert = $this->user->crear_user($data);

		//CREAMOS EL POST EN LA BD
		$data = array(
		'id' => '800',
    'titulo' =>  'paco',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '100',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
  	$insert = $this->db->insert('post', $data);

		// CREAMOS COMENTARIO EN LA BD
		$data = array(
			'id' => '500',
      'user_id' =>  '100',
      'post_id'    =>  '800',
      'texto' =>  'esto es un comentario'
    );
		$insert = $this->comment->crear_comment($data);

		// Eliminamos comentario
		$id_comment = '500';
		$delete = $this->comment->eliminar_comment($id_comment);
		$this->unit->run($delete, TRUE, 'Eliminar comentario');

		$resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');	
	}

  /***********
	 	voteS
	***********/
	// crud/guardarv
	function save_votes()
  {
		
		$this->db->trans_start();

		//CREAMOS EL POST A COMENTAR EN LA BD
		$data = array(
		'id' => '500',
    'titulo' =>  'paco',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '3',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
  	);
  	$insert = $this->db->insert('post', $data);

    $data2 = array(
    'id' => '501',
    'titulo' =>  'paco',
    'contenido'    =>  'paco es el contenido del post.',
    'user_id' =>  '3',
    'fecha' =>  '2012-10-10',
    'tema'    =>  'salud'
    );
    $insert2 = $this->db->insert('post', $data2);

    
		// Post existe, vote no existe (valor like)
		if ($r = $this->vote->ha_votado($data['user_id'], $data['id']))
    {
      $query = FALSE;
    }
    else
    {
      $query = $this->vote->guardar_vote(1, $data['user_id'], $data['id']);
    }  
		$this->unit->run($query, 'is_true', "Post existe, vote no existe (valor like) {$r}");



		// Post existe, vote no existe (valor no_like)
    if ($r = $this->vote->ha_votado($data2['user_id'], $data2['id']))
    {
      $query = FALSE;
    }
    else
    {
      $query = $this->vote->guardar_vote(0,$data2['user_id'], $data2['id']);
		}
		$this->unit->run($query, 'is_true', 'Post existe, vote no existe (valor no_like) <?=$r;?>');

    

		// Post existe, vote existe (valor like)
    if ($r = $this->vote->ha_votado($data['user_id'], $data['id']))
    {
      $query = FALSE;
    }
    else
    {
      $query = $this->vote->guardar_vote(1,$data['user_id'], $data['id']);
    }  
    $this->unit->run($query, 'is_false', 'Post existe, vote existe (valor like) <?=$r;?>');

    // Post existe, vote existe (valor no_like)
    if ($r = $this->vote->ha_votado($data2['user_id'], $data2['id']))
    {
      $query = FALSE;
    }
    else
    {
      $query = $this->vote->guardar_vote(0,$data2['user_id'], $data2['id']);
    }
    $this->unit->run($query, 'is_false', 'Post existe, vote existe (valor no_like) <?=$r;?>');

		$resultados = $this->unit->result();
		$this->db->trans_rollback();
		$this->twiggy->set( 'testing', $resultados)->display('resultados');
	}
}