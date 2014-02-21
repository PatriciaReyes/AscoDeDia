<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*  CONTROLADOR TESTER:
 *
 *  Este controlador se desplegar el tester ( Utilizando Datamapper)
 *	para las pruebas unitarias sobre el sistema, así como ejecutar las mismas. 
 *	No está terminado.
 */ 

class Tester extends CI_Controller{

	public function __construct() {
    parent::__construct();
    $this->output->enable_profiler(TRUE);

    $this->twiggy->theme('test');
    $this->twiggy->display();
  }

	function resultados()
	{
		$opciones = $this->input->post(NULL, TRUE);
		//$this->load('unit_test');
		if (isset($opciones) && $opciones != array() )
		{	
			foreach ($opciones as $opcion)
			{
				if ($opcion == 0)
				{
					echo 'Todos: ';
				}
				elseif ($opcion == 1)
				{
					$crear = $this->test_crear_user();
				}
				elseif ($opcion == 2)
				{
					$editar = $this->test_editar_user();
				}
				elseif ($opcion == 3)
				{
					$c = $this->test_comentarios();
					echo $c;
				}
				elseif ($opcion == 4)
				{
					$v = $this->test_votos();
					echo $v;
				}
				elseif ($opcion == 5)
				{
					$t = $this->test_tags();
					echo $t;
				}
				else
				{
					echo 'ninguna';
				}
			}
			$c = array_merge( $crear,$editar );

			$this->twiggy->set( 'testing', $c )->display('resultados');
		}
		else
		{
			echo 'No se seleccionó ninguna opción';
		}
	}

	// FUNCIONES A PROBAR
	function crear_user( $data ) 
	{
		$user = new User();
		$user->from_array($data);
		if ($user->save())
    {
      return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function editaru( $data, $id )
	{
		$data['password'] = sha1($data['password']);
		$user = new User();
		$user->from_array($data);
		if ($user->where('id', $id)->update($data))
		{
      return TRUE;
    }
    else
    {
      return FALSE;
    }
	}
	
	function test_crear_user()
	{
		$tester = new CI_Unit_test();
		// ** TEST: crear_user ** //
		$this->db->trans_start();
		
		//Usuario valido
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
		$tester->run($crear,'is_true', 'USER-> Crear usuario válido');

    //Nombre muy corto
    $data = array('first_name' => 'p', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Nombre muy corto');

    //Nombre muy largo
    $data = array('first_name' => 'paco paco paco paco paco paco paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $$crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Nombre muy largo');

    //No nombre
    $data = array('first_name' => '', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: No Nombre');

		//Apellido muy corto
    $data = array('first_name' => 'paco', 'last_name' => 'p', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Apellido muy corto');

    //Apellido muy largo
    $data = array('first_name' => 'paco', 'last_name' => 'paco paco paco paco paco paco paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Apellido muy largo');

    //No apellido
    $data = array('first_name' => 'paco', 'last_name' => '', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: No Apellido'); 

    //Email no válido
    $data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Email no válido');

    //No email
    $data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => '', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: No Email'); 

    //Username muy corto
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'p', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Username muy corto');   

    //Username muy largo
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'pacopacopacopacopacopaco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Username muy largo'); 

    //Username repetido
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'admin', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Username repetido'); 

    //Username con caracteres inválidos
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'p# &$t7', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Username con caracteres inválidos'); 

    //No Username
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => ' ', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: No Username'); 

    //Password muy corto
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'pa');
   	$crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: Password muy corto');   

    //No Password
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => '');
    $crear = $this->crear_user($data);
    $tester->run($crear,'is_false', 'USER-> Crear usuario no válido: No Password'); 

		//echo $this->unit->report();
		$this->db->trans_rollback();
		$resultados['testingA'] = $tester->result();
		return $resultados;
		//$this->view->display('test/resultados.php', $resultados);
	}

	function test_editar_user()
	{
		// ** TEST: editaru ** //
		$tester = new CI_Unit_test();
		$this->db->trans_start();
		//Creamos un usuario para la prueba
		$data = array('id' => '200', 'first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = new User();
    $user->from_array($data);
    $user->save();
		$id = $data['id'];

    //Modificación válida
		$data = array('first_name' => 'pacoo', 'last_name' => 'pacoo', 'username' => 'pacoo', 'email_address' => 'pacoo@gmail.com', 'password' => 'pacoo');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_true', 'USER-> Modificar usuario válido');

    //Nombre muy corto
    $data = array('first_name' => 'p', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Nombre muy corto');

    //Nombre muy largo
    $data = array('first_name' => 'paco paco paco paco paco paco paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Nombre muy largo');

    //No nombre
    $data = array('first_name' => '', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: No Nombre');

		//Apellido muy corto
    $data = array('first_name' => 'paco', 'last_name' => 'p', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Apellido muy corto');

    //Apellido muy largo
    $data = array('first_name' => 'paco', 'last_name' => 'paco paco paco paco paco paco paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Apellido muy largo');

    //No apellido
    $data = array('first_name' => 'paco', 'last_name' => '', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: No Apellido'); 

    //Email no válido
    $data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Email no válido');

    //No email
    $data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => '', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: No Email'); 

    //Username muy corto
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'p', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Username muy corto');   

    //Username muy largo
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'pacopacopacopacopacopaco', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Username muy largo'); 

    //Username repetido
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'admin', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Username repetido'); 

    //Username con caracteres inválidos
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'p# &$t7', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Username con caracteres inválidos'); 

    //No Username
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => '', 'email_address' => 'paco@gmail.com', 'password' => 'paco');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: No Username'); 

    //Password muy corto
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => 'pa');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: Password muy corto');   

    //No Password
		$data = array('first_name' => 'paco', 'last_name' => 'paco', 'username' => 'paco', 'email_address' => 'paco@gmail.com', 'password' => '');
    $user = $this->editaru($data, $id); 
    $tester->run($user,'is_false', 'USER-> Modificar usuario No válido: No Password'); 

		
		//echo $this->unit->report();		
		$this->db->trans_rollback();
		$resultados['testingB'] = $tester->result();
		return $resultados;
	}

	function test_posts()
	{
		return '<br/>- posts!';
	}

	function test_comentarios()
	{
		return '<br/>- comentarios!';
	}

	function test_votos()
	{
		return '<br/>- votos!';
	}

	function test_tags()
	{
		return '<br/>- tags!';
	}
}	