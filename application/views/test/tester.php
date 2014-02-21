<!--        Script by hscripts.com          -->
<!--        copyright of HIOX INDIA         -->
<!-- Free javascripts @ http://www.hscripts.com -->
<script type="text/javascript">
checked = false;
function checkedAll (opciones) {
	var aa = document.getElementById('opciones');
	if (checked == false)
  {
  	checked = true
  }
	else
  {
  	checked = false
  }
	for (var i = 0; i < aa.elements.length; i++) 
	{
		aa.elements[i].checked = checked;
	}
}

function noCheckedAll (opciones) {
	var aa = document.getElementById('opciones');
	if (aa.elements[0].checked == true)
  {
  	aa.elements[0].checked = false
  }
}
</script>
<!-- Script by hscripts.com -->

<!DOCTYPE html>
<html>
  <head>
  	{% block head %}
	    <title>Tester - Asco de día 1.0</title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <!-- Le styles -->
	    <link rel="stylesheet" href="{{base_url()}}css/bootstrap.css" type="text/css" media="screen" />
	    <link href="{{base_url()}}css/bootstrap-responsive.css" rel="stylesheet">
	    <link href="{{base_url()}}css/docs.css" rel="stylesheet">
	    <link href="{{base_url()}}js/google-code-prettify/prettify.css" rel="stylesheet">
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
	    <div class="navbar navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <div class="row">
	            <div class="span11">
	              <div class="nav-collapse">
                    <ul class="nav">
                      <li class=""><a href="tester_home">Inicio</a></li>
                    </ul>
                </div>
	            </div> 
	          </div> 
	        </div>  
	      </div> 
	    </div>         

	    <div class="container">
	      <div class="row">
	        <div class="span12">
	        	<div class="hero-unit">
	              <h1 class="small" style="color:#0088CC;">Tester - Asco de Día 1.0</h1>
	            </div>   
	          </div>
	          {% block main_content %}
		          {% block checkboxes %}

		          <div class="row">
		          	<div class="span4"><p></p></div>
		          	<div class="span2">
			          		<form id="opciones" class="well" id="form_checkbox" class="form-horizontal" method="POST" action="resultados">
										  <label><h4>Selecciona Modelos</h4></label>
										  <label class="checkbox">
										  	<input type='checkbox' name='todos' onclick='checkedAll(opciones);' value="0"><strong>Todos</strong>
											</label>
											<label class="checkbox">
										    <input type="checkbox" name="usuarios" onclick='noCheckedAll(opciones);' value="1"> User
										  </label>
										  <label class="checkbox">
										    <input type="checkbox" name="posts" onclick='noCheckedAll(opciones);' value="2"> Post
										  </label>
										  <label class="checkbox">
										    <input type="checkbox" name="comentarios" onclick='noCheckedAll(opciones);' value="3"> Comment
										  </label>
										  <label class="checkbox">
										    <input type="checkbox" name="votos" onclick='noCheckedAll(opciones);' value="4"> Vote
										  </label>
										  <label class="checkbox">
										    <input type="checkbox" name="tags" onclick='noCheckedAll(opciones);' value="5"> Tag
										  </label>
										  <button type="submit" class="btn btn-info btn-large">Probar</button>
										</form>
			          </div>
			          <div class="span6"><p></p></div>
		          </div>
		          {% endblock checkboxes %}
							
							{% block resultados %}{% endblock resultados %}
	          {% endblock main_content %}	
	        </div>
	      </div> 
	    </div>
    {% endblock body %}   
  </body>
</html>
