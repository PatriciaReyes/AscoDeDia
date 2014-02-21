{% extends 'include/template.php' %}

{% block main_content %}
  <div class="span12">
    <div class="row">
      
      {# Tabla de Comentarios #}
      <div class="span8">
        <div class="row">
          <div class="span8">
            <div class="alert alert-info">
              <h2>Moderar Comentarios</h2>
              <h6><p><i class="icon-remove"></i> Eliminar</p>
              <p><i class="icon-pencil"></i> Editar</p></h6>
            </div>
          </div>
        </div>  
        
        <div class="row"> 
          <div class="span8">   
            <table class="table table-striped">
              <thead>
                <tr> 
                  <th>ID Comentario</th>
                  <th>ID Post</th>
                  <th>ID Usuario</th>
                  <th>Comentario</th>
                </tr>
              </thead>
                <tbody>
                  {% if (isset(records)) %}
                    {% for row in records %}
                      <div>
                        <tr>
                          <td>{{ row.id }}</td>
                          <td>{{ row.post_id }}</td>
                          <td>{{ row.user_id }}</td>
                          <td>{{ row.texto }}</td>
                          <td><a class="btn btn-inverse" href="eliminarc/{{row.id}}"><i class="icon-remove icon-white"></i></a></td>
                          <td><a class="btn btn-primary" href="comment/{{row.id}}"><i class="icon-pencil icon-white"></i></a></td>       
                        </tr>
                      </div>
                    {% endfor %}
                  {% else %}
                  <h6>No hay comentarios publicados.</h6>
                  {% endif %}
                </tr>
              </tbody>
            </table>
          </div>
        </div>      
        
        <a class="btn-primary btn-large" href="comment">Agregar comentario</a>
      </div>
      
      <div class="span4">
        <div class="span4" style="margin-bottom: 10px; margin-left: 33px;">{% include 'include/menuside.php' %}</div>
      </div>
    </div>
  </div>  
{% endblock main_content %}