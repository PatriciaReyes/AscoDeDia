<?php

/*  MODELO para la tabla comments:
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
 *  Este modelo corresponde a la tabla comments en la BD. Al invocar al constructor crea un objeto 
 *  Comment con todos los atributos qe aparecen en la BD.
 *  Posee las relaciones con otros objetos, las validaciones de los datos y
 *  el constructor del objeto --> $comment = new Comment();
 */   

class Comment extends Datamapper {

  var $has_one = array('user','post');

    var $validation = array(
        'post_id' => array(
            'label' => 'Post_id',
            'rules' => array('required', 'trim', 'numeric', 'min_length' => 1, 'max_length' => 5),
        ), 
        'texto' => array(
            'label' => 'Comentario',
            'rules' => array('required', 'trim', 'min_length' => 10, 'max_length' => 300),
        ) 
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}