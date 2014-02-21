<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*  CONTROLADOR HOME:
 *
 *  Este controlador se encarga de los elementos que se encuentran en la home del sitio.
 *  Obtiene el listado de POST, y sus comentarios asociados utilizando los modelos correspondientes
 *  y por último invoca a las vistas.
 *  En config/routes.php se designa como el controlador por defecto.
 */    

class Home extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
    $this->output->enable_profiler( TRUE );
  }

  function index()
  {
    // Obtenemos la lista de posts
    $post = new Post();

    // Obtenemos todos los POST y sus Ratings a través del modemo de Datamapper.
    $post
      -> select( "posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE )
      ->include_related( 'vote', array('post_id') )    // NOTA: Es mejor  ->include_related('vote'), pues con Datamapper siempre se crea el objeto completo aunque se desee un solo valor.
      ->include_related( 'user', array('username') )
      ->include_related( 'tag')
      ->include_related_count( 'comment' )
      ->where( 'mostrar', 1 )
      ->group_by( 'id' )
      ->get_iterated();   // NOTA: Es mejor utilizar get_iterated() cuando se van a obtener muchos resultados.
    
    if( $post->exists() ) 
    {  
      //$data['records'] = $post;
      $this->twiggy->set( 'records', $post );
    }

    // Se puede pasar la data como un arreglo, o una por una.
    //$data['current_user'] = $this->session->userdata( 'user' );
    //$data['current_user_id'] = $this->session->userdata( 'user_id' );
    //$this->twiggy->set( $data )->display( 'home');
    $this->twiggy-> set( 'current_user', $this->session->userdata( 'user' ) )
                  ->set( 'current_user_id', $this->session->userdata( 'user_id' ) )
                  ->display( 'home');
  }

  // Muestra los detalles del post seleccionado.
  function post( $id = 0 )  // Si no se llama con ningun ID, se le asigna valor por defcto.
  {
    // Obtenemos todos los datos relacionados con el Post seleccinado.
    $post = new Post();
    $post->include_related( 'user', array('username') )
      ->include_related( 'tag' )
      ->include_related_count( 'comment' )
      ->get_by_id( $id );
    
    // Obtenemos todos los comentarios relacionados con el Post seleccionado.
    $comment = new Comment();
    $comment->include_related('user', array('username'))
            ->get_by_post_id($id);

    $this->twiggy->set( 'post', $post )
                  ->set( 'comments', $comment )
                  ->set( 'current_user', $this->session->userdata('user') )
                  ->set( 'current_user_id', $this->session->userdata('user_id') )
                  ->display( 'post_comments') ;
  }

  // Guarda nuevo comentario relacionado con un POST.
  public function post_comment( $post_id )
  {
    // Devuelve todos los datos pasados por POST.
    $data = $this->input->post( NULL, TRUE ); // returns all POST items with XSS filter 

    $comment = new Comment();
    $comment->from_array( $data );
    
    if ( $comment->save() ) {  redirect("ver_post/$post_id");  }
    else{  redirect("/");  }
  }

  /**********
  * Botones *    
  ***********/
  function ultimos() 
  {
    $post = new Post();
    $post
      -> select( "posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE )
      ->include_related( 'vote', array('post_id') )    // NOTA: Es mejor  ->include_related('vote'), pues con Datamapper siempre se crea el objeto completo aunque se desee un solo valor.
      ->include_related( 'user', array('username') )
      ->include_related( 'tag')
      ->include_related_count( 'comment' )
      ->where( 'mostrar', 1 )
      ->group_by( 'id' )
      ->get_iterated();

    if( $post->exists() ) { $this->twiggy->set( 'records', $post ); }
    
    $this->twiggy-> set( 'current_user', $this->session->userdata( 'user' ) )
                  ->display( 'home');
  }

  // No está implementada.
  function mejores() 
  {
    $post = new Post();
    $post
      -> select( "posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE )
      ->include_related( 'vote', array('post_id') )    // NOTA: Es mejor  ->include_related('vote'), pues con Datamapper siempre se crea el objeto completo aunque se desee un solo valor.
      ->include_related( 'user', array('username') )
      ->include_related( 'tag')
      ->include_related_count( 'comment' )
      ->where( 'mostrar', 1 )
      ->group_by( 'id' )
      ->get_iterated();

    if( $post->exists() ) { $this->twiggy->set( 'records', $post ); }
    
    $this->twiggy-> set( 'current_user', $this->session->userdata( 'user' ) )
                  ->display( 'home');
  }

  function aleatorios() 
  {
    $post = new Post();
    $post
      -> select( "posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE )
      ->include_related( 'vote', array('post_id') )    // NOTA: Es mejor  ->include_related('vote'), pues con Datamapper siempre se crea el objeto completo aunque se desee un solo valor.
      ->include_related( 'user', array('username') )
      ->include_related( 'tag')
      ->include_related_count( 'comment' )
      ->where( 'mostrar', 1 )
      ->group_by( 'id' )
      ->order_by( 'RAND()' )
      ->get_iterated();

    if( $post->exists() ) { $this->twiggy->set( 'records', $post ); }
    
    $this->twiggy-> set( 'current_user', $this->session->userdata( 'user' ) )
                  ->display( 'home');
  }

  function temas( $tema ) 
  {
    $post = new Post();
    $post
      -> select( "posts.*, SUM(IF(valor = '1', 1, 0)) AS gusta, SUM(IF(valor = '0', 1, 0)) AS no_gusta", FALSE )
      ->include_related( 'vote', array('post_id') )    // NOTA: Es mejor  ->include_related('vote'), pues con Datamapper siempre se crea el objeto completo aunque se desee un solo valor.
      ->include_related( 'user', array('username') )
      ->include_related( 'tag')
      ->include_related_count( 'comment' )
      ->where_related( 'tag', 'nombre', $tema )
      ->where( 'mostrar', 1 )
      ->group_by( 'id' )
      ->get_iterated();

    if( $post->exists() ) { $this->twiggy->set( 'records', $post ); }
    
    $this->twiggy-> set( 'current_user', $this->session->userdata( 'user' ) )
                  ->display( 'home');
  }
}  