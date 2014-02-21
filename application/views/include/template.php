<!DOCTYPE html>
<html>
  
  <head>
  	{% block head %}
	    <title>Asco de día 1.0</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <!-- Le styles -->
	    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
	    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	    <link href="css/docs.css" rel="stylesheet">
	    <link href="js/google-code-prettify/prettify.css" rel="stylesheet">
	    <style type="text/css">
	    body {
	      padding-top: 60px;
	    }
	    .big-text {
	      font-size: 1.4em;
	    }
	    thead {
	      font-weight: bold;
	      font-size: 1.2em;
	    }
	    </style>
    {% endblock head%}
  </head>
  
  <body>
  	{% block body %}
	    {# Navigation Bar de BOOTSTRAP #}
	    <div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          
	          <div class="row">
	            <div class="span12">
	              {% if (current_user == 'admin') %}
	                <div class="nav-collapse">
	                    <ul class="nav">
	                      <li class=""><a href="/">Home</a></li>
	                      <li class=""><a href="users">Usuarios</a></li>
	                      <li class=""><a href="posts">Posts</a></li>
	                      <li class=""><a href="comments">Comentarios</a></li>
	                    </ul>
	                </div>
	              {% elseif (current_user) %}
	                <div class="nav-collapse">
	                    <ul class="nav">
	                      <li class=""><a href="/">Home</a></li>
	                    </ul>
	                </div>
	              {% else %}
	                <div class="nav-collapse">
	                    <ul class="nav">
	                      <li class=""><a href="/">Home</a></li>
	                    </ul>
	                </div>
	                
	                <div class="pull-right">
	                  <form class="navbar-form form-inline pull-right" method="POST" action="login">
	                    <input type="text" name="username" class="input-small" id="username" placeholder="Username">
	                    <input type="password" name="password" class="input-small" id="password" placeholder="Contraseña">
	                    <button type="submit" class="btn btn-small btn-primary">Entrar</button>
	                  </form>
	                </div>
	              {% endif %}
	            </div> 
	          </div> 
	        
	        </div> 
	      </div> 
	    </div>         

	    {# Inicio del contenio de la página #}
	    <div class="container">
	      <div class="row">
	        <div class="span12">
	        
		        {# Título y descripción #}
		        <div class="row">
		          <div class="span4">
		            <div class="hero-unit">
		              <h1 class="small"><a href="/">asco de día 1.0</a></h1>
		            </div>   
		          </div>
		          <div class="span7" style="margin-top: 90px;" >   
	              <p><strong> Asco de día 1.0 </strong> recoge anécdotas que han arruinado el día de muchos. 
	              ¿Por qué guardártelo para ti cuando puedes sacar una sonrisa a miles de personas?
	              <strong>Tu desgracia puede ser nuestra gracia.</strong><p></p>
	              <h5 style="color: #0088CC; font-size: 20px; font-style:italic;"> 
	              ¡Cuéntanos tu ADD, comenta y vota por los de los demás!</h5></p>
	              <p><h4>Solo tienes que registrarte. Es fácil, rápido y gratis! </h4></p>
	            </div>  
		        </div>
	        </div>

	        {# Menú #}
	        <div class="span12" style="margin-bottom: 10px; margin-left: 33px;">
	          {% include 'include/menutop.php' %} 
	        </div>
	        
	        {# Contenido principal #}
	        {% block main_content %}{% endblock main_content%}
	      
	      </div> 
	    </div>
    {% endblock body %}   
  </body>
</html>
