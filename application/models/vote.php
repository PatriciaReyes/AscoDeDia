<?

/*  MODELO para la tabla votes:
 *  
 *  El nombre del modelo debe ser en singular ( De igual manera cuando se utiliza para 
 *  CRUD en los controladores), mientras que el nombre en la tabla en la BD debe ser plural.
 *  El modelo debe especificar las relaciones y las validaciones necesarias de los datos. 
 *  También puede tener funciones de manejo de datos de la BD. Si la query no es muy compleja 
 *  se puede hacer directamente en el controlador, de los contrario es mejor hacer una función 
 *  en el modelo que realice la consulta.
 *	Al invocar al constructor, se crea un Objeto con todos los atributos de la tabla en la 
 *  BD correspondiente al modelo.
 *  
 *  Este modelo corresponde a la tabla users en la BD. Al invocar al constructor crea un objeto 
 *  Vote con todos los atributos qe aparecen en la BD.
 *  Posee las relaciones con otros objetos, las validaciones de los datos, alguna función y
 *  el constructor del objeto --> $vote = new Vote();
 */

class Vote extends Datamapper {

	var $has_one = array('user','post');

    var $validation = array(
        'valor' => array(
            'label' => 'Valor',
            'rules' => array('required', 'trim', 'numeric', 'exact_length' => 1),
        )
    );

    function __construct($id = NULL)
    {
        parent::__construct($id);
    }
	
	// Esta función obtiene los votos de un porst específico.
	function mostrar_votes()
	{	
		$v = new Vote();
		$v->select("post_id, SUM(IF(valor = '1', 1, 0)) AS 'like', SUM(IF(valor = '0', 1, 0)) AS 'no_like', COUNT(valor) as 'total'", FALSE)->group_by('post_id')->get();

		return $v;
	}

	
// Estas son funciones del modelo antiguo. Cuando no se utilizaba Datamapper
// se trabajaba directamente sobre la BD (utilizand Codeigniter 2.0).
// En correspondencia con el Modelo-Vista-Controlador, para poder 
// interactuar con la BD, había que hacerlo desde aquí. Ahora con el ORM, como
// no se interactua directamente con la BD, no es necesario.
/*
	function ha_votado($user_id, $post_id){
		$resultado =  $this->db->select('id')
			->where('user_id',$user_id)
			->where('post_id',$post_id)
			->get('votes')
			->row();
		return $resultado ? $resultado->id : FALSE;	
	}	

	function guardar_vote($valor,$user,$post)
	{
		$attr= array(
			'valor' => $valor,
			'user_id' => $user,
			'post_id' => $post,
			);
		return $this->db->insert('votes', $attr);
	}

	function eliminar_vote_user($user_id) 
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('votes');
		return $this->db->affected_rows();
	}

	function eliminar_vote_post($post) 
	{
		$this->db->where('post_id', $post);
		$this->db->delete('votes');
		return $this->db->affected_rows();
	}
*/	
}
