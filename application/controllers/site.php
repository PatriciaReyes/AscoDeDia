<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*  CONTROLADOR SITE:
 *
 *   Este controlador se encarga del login y logout del sitio Web.
 */ 

class Site extends CI_Controller {

  function login()
  {
    $data = $this->input->post( NULL, TRUE );

		$u = new User();
		$u->from_array( $data );

    $u_aux = new User();
    if ( $u_aux = $u->validar() )
    {
        $this->session->set_userdata('user', $u->username);
        $this->session->set_userdata('user_id', $u_aux->id);
        redirect('home');
    }
    else {  redirect('site/login_error');  }
  }

	function logout()
  {
    $this->session->sess_destroy();
    redirect('/');
  }

  function login_error()
  {
    redirect('/');
  }
}