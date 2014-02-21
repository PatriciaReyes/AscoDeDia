<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*  CONTROLADOR CRUD:
 *
 *  Este controlador se encarga de Crear, Leer, Actualizar y Borrar elementos 
 *	de la BD utilizando el ORM Datamapper. Invoca algunas peticiones a los modelos 
 *	de cada tabla de la BD. Por último, invoca las vistas de listados y formularios.
 */    

class Crud extends CI_Controller{

	public function __construct() {
      parent::__construct();
      $this->output->enable_profiler(TRUE);
    }

  /** Página de inicio **/
	public function index()
	{	
  	redirect('home');
	}


  // FUNCION DE PRUEBA para Twig
  function twig()
	{
		// Obtenemos la lista de posts
    $post = new Post();
		$post = $post->get_posts();

    if( $post->exists() ) { $this->twiggy->set( 'records', $post ); }
    
    $this->twiggy-> set( 'current_user', $this->session->userdata( 'user' ) )
                  ->set( 'current_user_id', $this->session->userdata( 'user_id' ) )
                  -> set( 'paco', array('francisco', 'curro','hola') )
                  ->display();
	}

	/********
  * Posts *   
  *********/  	
	function posts( $page = 0 )
	{
		// Obtenemos la lista de posts
		$post = new Post();
		$post
    	-> select( "posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE )
    	->include_related( 'vote',array('post_id') )
    	->include_related( 'user', array('username') )
      ->include_related( 'tag' )
      ->include_related_count( 'comment' )
      ->where( 'mostrar', 1 )
      ->group_by( 'id' )
      ->get_iterated();

		if( $post->exists() ) { $this->twiggy->set( 'records', $post ); }
    
		/*		
				if($query = $this->post->get_posts(5,$page)) {
					$data['records'] = $query;
				}
				init_pagination(base_url().'posts',$this->post->num_posts());

		*/		

		// Cargamos la vista
		$data['current_user'] = $this->session->userdata( 'user' );
		if ( $data['current_user'] == 'admin' ) 
		{	
			$this->twiggy->set( 'current_user', $data['current_user'] )
                  	->display( 'posts_view') ;
		}
		else{	 redirect( 'home' );	}
	}

	function post( $id = 0 )
	{
		$post = new Post();
		$post->include_related( 'user', array( 'username' ) )
			->include_related( 'tag' )
			->include_related_count( 'comment' )
			->get_by_id( $id );

		$t = new Tag();
		$t->get();

		$this->twiggy->set( 'post', $post )
									->set( 'tags', $t )
									->set( 'current_user', $this->session->userdata('user') )
									->set( 'current_user_id', $this->session->userdata('user_id') )
                  ->display( 'posts_form') ;
	}

	function crear_post() 
	{
		$data = $this->input->post( NULL, TRUE );

		$post = new Post();
		$post->from_array($data);

		if ( $post->save() )
		{
			$post->update( 'fecha', 'NOW()', FALSE );
			$post->update( 'mostrar', 1 );
			redirect( "posts" );
		}
		else {	redirect("post");	 }	
	}

	function editarp( $id )
	{
		$data = $this->input->post( NULL, TRUE );
    $data['id'] = $id;

		$p = new Post();
		$p->from_array( $data );
		if ( $p->where( 'id', $id )->update( $data ) ){	 redirect("posts/{$id}");	 } // Es mejor SIEMPRE utilizar save en lugar de update.
	  else{	 redirect("post");	}    	  	
	}

	function eliminarp() 
	{
		$id = $this->uri->segment(2);

		// Get post
		$p = new Post();
		if ( $p->where( 'id', $id )->update( 'mostrar',0 ) )	{	 redirect("posts");	 }	
		else
		{
			echo 'no';
			return;
		}
	}

  /********
  * Users *    
  *********/ 
  function users( $page = 0 )
	{
		// Obtenemos la lista de usuarios
		$user = new User();
		if( $user->get_iterated() ) {	 $this->twiggy->set( 'records', $user );	}

		$data['current_user'] = $this->session->userdata('user');
		if ( $data['current_user'] == 'admin') {	$this->twiggy->set( 'current_user', $this->session->userdata('user') )->display( 'users_view') ;	}
		else {	redirect('home');	 }
	}

	function user( $id = 0 )
	{
		$user = new User();
		$user->get_by_id( $id );

		$this->twiggy->set( 'user', $user )
									->set( 'current_user', $this->session->userdata('user') )
									->display( 'users_form') ;
	}

	function crear_user( $id = 0 ) 
	{
		$data = $this->input->post( NULL, TRUE ); 

		$user = new User();
		$user->from_array($data);

		if ( $user->save() ) {	redirect( "users" );	}
		else {	redirect( "user" );	 }
	}

	function editaru( $id )
	{
		$data = $this->input->post( NULL, TRUE );
    $data['id'] = $id;
		$data['password'] = sha1( $data['password'] );

		$user = new User();
		$user->from_array( $data );
		if ( $user->where( 'id', $id )->update( $data ) ) {	 redirect("users/{$id}");	 }
	  else {	redirect("user");	 }
	}

	function eliminaru() 
	{
		$user_id = $this->uri->segment(2);

		// Delete comments
		$c = new Comment();
		$c->where( 'user_id', $user_id )->get();
		$c->delete();

		// Delete votes
		$v = new Vote();
		$v->where( 'user_id', $user_id )->get();
		$v->delete();

		// Delete votes
		$p = new Post();
		$p->where( 'user_id', $user_id )->get();
		$p->delete();

		// Delete user
		$u = new User();
		$u->where( 'id', $user_id )->get();
		$u->delete();

		redirect( 'users' );
	}

	/**************
  * Comentarios *    
  ***************/ 
  function comments( $page = 0 )
	{
		// Obtenemos la lista de usuarios
		$comment = new Comment();
		if( $comment->get_iterated() ) {	 $this->twiggy->set( 'records', $comment );	}

		$data['current_user'] = $this->session->userdata('user');
		if ( $data['current_user'] == 'admin') {	$this->twiggy->set( 'current_user', $this->session->userdata('user') )->display( 'comments_view') ;	 }
		else {	redirect('home');	 }
	}

	function comment( $id = 0 )
	{
		$comment = new Comment();
		$comment->get_by_id( $id );

		$this->twiggy->set( 'comment', $comment )
									->set( 'current_user', $this->session->userdata('user') )
									->set( 'current_user_id', $this->session->userdata('user_id') )
									->display( 'comments_form' ) ;
	}

	public function crear_comment( $id = 0 )
	{
		$data = $this->input->post( NULL, TRUE );

		$comment = new Comment();
		$comment->from_array( $data );
		$comment->save();

		if ( $comment->save() )	{	 redirect("comments/{$id}");	}
		else
		{
			// If validation fails, we can show the error for each property
      echo $comment->error->post_id;
      echo $comment->error->texto;
    }	
	}

	function editarc( $id )
	{
		$data = $this->input->post( NULL, TRUE );
    $data['id'] = $id;

		$comment = new Comment();
		$comment->from_array( $data );
		if ( $comment->where( 'id', $id )->update( $data ) ) {	redirect("comments/{$id}");	 }
	  else {	redirect("comment");	}
	}

	public function eliminarc()
	{
		$comment_id = $this->uri->segment(2);

		// Delete comments
		$c = new Comment();
		$c->where( 'id', $comment_id )->get();
		$c->delete();

		redirect('comments');
	}	

	/********
  * Votos *   
  *********/ 
  function guardarv()
	{
		$valor = $this->uri->segment(2); // Valor del vote (1 o 0)
		$post_id = $this->uri->segment(3); // id del post

		// ID del usuario actual
		$user = new User();
		$user->where( 'username', $this->session->userdata( 'user' ) )->get();
		$user_id = $user->id;

		$v_aux = new Vote();
		$v_aux->get_where( array( 'user_id' => $user_id, 'post_id' => $post_id ) );

		if ( $v_aux->exists() ) {	 redirect('home');	}
		else
		{
			$v = new Vote();

			$v->valor = $valor;
			$v->user_id = $user_id;
			$v->post_id = $post_id;

			// Save new vote
			$v->save();
			redirect( 'home' );
		}		
	}
}