{% extends 'include/template.php' %}

{% block main_content %}
  <div class="span12">
    <div class="row">
      {% if (current_user) %}
        <div class="span8" >
        	<div class="row">  
            <div class="offset2 span6" style="margin-left: 200px;">
              
              {# Formulario de Post #}
              <form id="crear_posts" class="form-horizontal" method="POST" action="{{current_url()}}">
            	  <fieldset>
                  <legend>{{ post.id ? "Editar ADD" : "Crear ADD" }}</legend>
                  <div class="control-group">
                    <label class="control-label" for="tag_id">Categoría</label>
                    <div class="controls">
                      <select id="tag_id" name="tag_id">
                        {% for tag in tags %}
                          <option id="tag_id" name="tag_id" value="{{tag.id}}" {{tag.id == post.tag_id ? 'selected = "selected"' : "" }} >{{tag.nombre}}</option>
                        {% endfor %}
                      </select>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label" for="titulo">Titulo</label>
                    <div class="controls">
                      <input type="text" name="titulo" class="input-xlarge" id="titulo" value="{{post.titulo}}">
                    </div>
                  </div>

                	<div class="control-group">
                		<label class="control-label" for="contenido">Mensaje</label>
            				<div class="controls">
             		 			<textarea class="input-xlarge" name="contenido" rows="6" value="{{post.contenido}}">{{post.contenido}}</textarea>
               			</div>
              		</div>

                  <div class="form-actions">
                    {% if (post.id) %}
                      <input  type="hidden" name="id" class="input-xlarge" id="id" value="{{post.id}}">
                      <button type="submit" class="btn btn-primary btn-large">Editar</button>
                    {% else %}
                      <input type="hidden" name="user_id" class="input-xlarge" id="user_id" value="{{current_user_id}}">
                      <button type="submit" class="btn btn-primary btn-large">Publicar</button>
                    {% endif %}
                  </div>
            	  </fieldset>
            	</form>
            
            </div>
          </div>
        </div>
      {% else %}
        <div class="span8">
          <div class="well">
            <p><strong>Inicia sesión y comparte con nosotros tu AAD!</strong></p>
          </div>
        </div>
      {% endif %}
      
      <div class="span4">
        <div class="span4" style="margin-bottom: 10px; margin-left: 33px;">{% include 'include/menuside.php' %}</div>
      </div>
    </div>
  </div>  
{% endblock main_content %}