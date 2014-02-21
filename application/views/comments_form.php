{% extends 'include/template.php' %}

{% block main_content %}
<div class="span12">
  <div class="row">
    {% if (current_user) %}
      <div class="span8">
        <div class="row">  
          <div class="offset2 span6" style="margin-left: 200px;">
            
            {# Formulario de Comentario #}
            <form id="crear_comment" class="form-horizontal" method="POST" action="{{current_url()}}">
              <fieldset>
                <legend>{{ comment.id ? "Editar Comentario" : "Agregar Comentario" }}</legend>
                <div class="control-group">
                  <label class="control-label" for="post_id">ID Post</label>
                  <div class="controls">
                    <input name="post_id" class="input-xlarge" id="post_id" value="{{ comment.post_id }}" {% if (comment.id) %}disabled{% endif %}>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="texto">Comentario</label>
                  <div class="controls">
                  <textarea class="input-xlarge" name="texto" rows="6" value="{{ comment.texto }}">{{ comment.texto }}</textarea>
                </div>
              </div>

              <div class="form-actions">
                {% if ( comment.id ) %}
                  <input type="hidden" name="id" class="input-xlarge" id="id" value="{{ comment.id }}">
                  <input type="hidden" name="user_id" class="input-xlarge" id="user_id" value="{{ comment.user_id }}">
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
          <p><strong>Debes haber iniciado sesión para poder comentar!</strong></p>
        </div>
      </div>
    {% endif %}
    
    <div class="span4">
      <div class="span4" style="margin-bottom: 10px; margin-left: 33px;">{% include 'include/menuside.php' %}</div>
    </div>
  </div>
</div>  
 
{% endblock main_content %}         