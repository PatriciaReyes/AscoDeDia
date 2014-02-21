<?php

/*  MODELO para la tabla users:
 *  
 *  El nombre del modelo debe ser en singular ( De igual manera cuando se utiliza para 
 *  CRUD en los controladores), mientras que el nombre en la tabla en la BD debe ser plural.
 *  El modelo debe especificar las relaciones y las validaciones necesarias de los datos. 
 *  También puede tener funciones de manejo de datos de la BD. Si la query no es muy compleja 
 *  se puede hacer directamente en el controlador, de los contrario es mejor hacer una función 
 *  en el modelo que realice la consulta.
 *  Al invocar al constructor, se crea un Objeto con todos los atributos de la tabla en la 
 *  BD correspondiente al modelo.
 *  
 *  Este modelo corresponde a la tabla users en la BD. Al invocar al constructor crea un objeto 
 *  User con todos los atributos qe aparecen en la BD.
 *  Posee las relaciones con otros objetos, las validaciones de los datos, algunas funciones y
 *  el constructor del objeto --> $user = new User();
 */

class User extends Datamapper {

	var $has_many = array('post','comment','vote');

    var $validation = array(
        'first_name' => array(
            'label' => 'Nombre',
            'rules' => array('required', 'trim', 'min_length' => 2, 'max_length' => 30),
        ),
        'last_name' => array(
            'label' => 'Apellido',
            'rules' => array('required', 'trim', 'min_length' => 2, 'max_length' => 30),
        ),
        'email_address' => array(
            'label' => 'Email',
            'rules' => array('required', 'trim', 'valid_email')
        ),
        'username' => array(
            'label' => 'Username',
            'rules' => array('required', 'trim', 'unique', 'alpha_dash', 'min_length' => 4, 'max_length' => 20),
        ),
        'password' => array(
            'label' => 'Contraseña',
            'rules' => array('required', 'min_length' => 4, 'encrypt'),
        )
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    // Validation prepping function to encrypt passwords
    function _encrypt($field)
    {
        // Don't encrypt an empty string
        if (!empty($this->{$field}))
        {
            $this->{$field} = sha1($this->{$field});
        }
    }

  	// Función de validacón para autenticación de usuario.
    function validar()
    {
        // Create a temporary user object
        $u = new User();
        $this->password = sha1($this->password);
        $u->where('username', $this->username)->where('password', $this->password)->get();
        
        if ($u->exists())
        {
            return $u;

        }
        else
        {
            // Login failed, so set a custom error message
            $this->error_message('login', 'Username or password invalid');
            return FALSE;
        }
    }
}