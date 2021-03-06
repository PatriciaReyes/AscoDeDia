{% extends 'include/template.php' %}

{% block main_content %}
<div class="span12">
  <div class="row">
		<div class="span8" >
    	<div class="row">  
        <div class="offset2 span6" style="margin-left: 200px;">
          
          {# Formulario de Usuario #}
          <form id="crear_posts" class="form-horizontal" method="POST" action="{{ current_url() }}">
        	  <fieldset>
              <legend>{{ user.id ? "Editar Ususario" : "Registrar user" }}</legend>
							<div class="control-group">
								<label class="control-label" for="first_name">Nombre</label>
								<div class="controls">
								<input type="text" name="first_name" class="input-xlarge" id="first_name" value="{{ user.first_name }}">
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="last_name">Apellido</label>
								<div class="controls">
								<input type="text" name="last_name" class="input-xlarge" id="last_name" value="{{ user.last_name }}">
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="email_address">Email</label>
								<div class="controls">
								<input type="text" name="email_address" class="input-xlarge" id="email_address" value="{{ user.email_address }}">
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="username"><strong>Username</strong></label>
								<div class="controls">
								<input type="text" name="username" class="input-xlarge" id="username" value="{{ user.username }}">
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="password"><strong>Contraseña</strong></label>
								<div class="controls">
								<input type="text" name="password" class="input-xlarge" id="password" value="{{ user.password }}">
								</div>
							</div>

							<div class="form-actions">
								{% if (user.id) %}
									<input type="hidden" name="id" class="input-xlarge" id="id" value="{{ user.id }}">
								  <button type="submit" class="btn btn-primary">Editar</button>
								{% else %}
								  <button type="submit" class="btn btn-primary btn-large">Registrar</button>
								{% endif %}
							</div>
							</fieldset>
						</form>

					</div>
				</div>
			</div>

			<div class="span4">
	      <div class="span4" style="margin-bottom: 10px; margin-left: 33px;">{% include 'include/menuside.php' %}</div>
	    </div>
		</div>
	</div>  
{% endblock main_content %}