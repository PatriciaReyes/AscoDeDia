{% extends 'include/template.php' %}

{% block main_content %}
<div class="span12">
	<div class="row">
		
		{# Tabla de Posts #}
		<div class="span8">
			<div class="row">
        <div class="span8">
        	<div class="alert alert-info">
						<h2>Moderar Posts</h2>
						<h6>
							<p><i class="icon-remove"></i> Eliminar</p>
							<p><i class="icon-pencil"></i> Editar</p>
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
								<th>Fecha</th>
								<th>Autor</th>
								<th>Tema</th>
								<th>Titulo</th>
								<th>Mensaje</th>
								<th><i class="icon-plus"></th>
								<th><i class="icon-minus"></th>  
							</tr>
						</thead>
							<tbody>
								{% if (isset(records)) %}
								 	{% for row in records %}
										<div>
											<tr>
												<td>{{ row.id }}</td>
												<td>{{ row.fecha }}</td>
												<td>{{ row.user_username}}</td>
												<td>{{ row.tag_nombre }}</td>
												<td>{{ row.titulo }}</td>
												<td>{{ row.contenido }}</td>
												<td>{{ row.gusta }}</td>
												<td>{{ row.no_gusta }}</td>
												<td><a class="btn btn-inverse" href="eliminarp/{{row.id}}"><i class="icon-remove icon-white"></i></a></td>
				                    <td><a class="btn btn-primary" href="post/{{row.id}}"><i class="icon-pencil icon-white"></i></a></td> 
											</tr>
										</div>
									{% endfor %}
								{% else %} 
									<h6>No hay ningun Post publicado.</h6>
								{% endif %}
							</tbody>
						</table>
					</div>
				</div>		
				
				<a class="btn-primary btn-large" href="post">Agregar post</a>
			</div>

			<div class="span4">
	      <div class="span4" style="margin-bottom: 10px; margin-left: 33px;">{% include 'include/menuside.php' %}</div>
	    </div>
  	</div>
	</div>
{% endblock main_content %}
