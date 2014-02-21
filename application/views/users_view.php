{% extends 'include/template.php' %}

{% block main_content %}
<div class="span12">
	<div class="row">
		
		<!-- Tabla -->
		<div class="span8">
			<div class="row">
        <div class="span8">
        	<div class="alert alert-info">
						<h2>Moderar Usuarios</h2>
						<h6>
							<p><i class="icon-remove"></i> Eliminar </p>
							<p><i class="icon-pencil"></i> Editar </p>
						</h6>
					</div>
				</div>
			</div>		

			<div class="row">
        <div class="span8">
					<table class="table table-striped">
						<thead>
							<tr> 
								<th>ID</th>
								<th>Usuario</th>
								<th>Nombre</th>
								<th>Email</th>
							</tr>
						</thead>
							<tbody>
								{% if (isset(records)) %}
								 	{% for row in records %}
										<div>
											<tr>
												<td>{{ row.id }}</td>
												<td>{{ row.username }}</td>
												<td>{{ row.first_name}} {{row.last_name }}</td>
												<td>{{ row.email_address }}</td>
												<td><a class="btn btn-inverse" href="eliminaru/{{row.id}}"><i class="icon-remove icon-white"></i></a></td>
		                    <td><a class="btn btn-primary" href="user/{{row.id}}"><i class="icon-pencil icon-white"></i></a></td> 			
											</tr>
										</div>
									{% endfor %}
								{% else %}	
									<h6>No hay usuarios registrados.</h6>
								{% endif %}
						</tbody>
					</table>
				</div>
			</div>

			<a class="btn-primary btn-large" href="user">Agregar Usuario</a>
		</div>
		
		<div class="span4">
      <div class="span4" style="margin-bottom: 10px; margin-left: 33px;">
        {% include 'include/menuside.php' %} 
      </div>
    </div>

  </div>
</div>

{% endblock main_content %}