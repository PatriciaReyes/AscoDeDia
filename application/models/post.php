<?php

/*  MODELO para la tabla posts:
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
 *  Este modelo corresponde a la tabla posts en la BD. Al invocar al constructor crea un objeto 
 *  Post con todos los atributos qe aparecen en la BD.
 *  Posee las relaciones con otros objetos, las validaciones de los datos, alguna función y
 *  el constructor del objeto --> $post = new Post();
 */

class Post extends Datamapper {

	var $has_many = array('vote','comment');
	var $has_one = array('user','tag');
  	
    var $validation = array(
        'titulo' => array(
            'label' => 'Titulo',
            'rules' => array('required', 'trim', 'min_length' => 3, 'max_length' => 50),
        ),
        'contenido' => array(
            'label' => 'Contenido',
            'rules' => array('required', 'trim', 'min_length' => 10, 'max_length' => 300),
        )
    );

    var $gusta;

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    // Esta función obtiene todos los post y sus valiraciones.
    function get_posts()
    {
        $post = new Post();

        $post
        -> select("posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE)
        ->include_related('vote',array('post_id'))
        ->include_related('user', array('username'))
        ->include_related('tag')
        ->include_related_count('comment')
        ->where('mostrar',1)
        ->group_by('id')
        ->get();

        if ($post->exists())
        {
            return $post;    
        }
        else
        {
            return FALSE;
        }                 
    }
}