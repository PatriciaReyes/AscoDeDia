{% extends 'include/template.php' %}

{% block main_content %}
  <div class="span12">
    <div class="row">
      <div class="span8">
        <div class="post">
          
          <div class="row">
            <div class="span5"><h1><a href="">{{ post.titulo }}</a></h1></div>
            
            <div class="span3">
              <p class="pull-right" style="padding-top:15px;"><strong>{{ post.user_username }}</strong> el día {{ post.fecha }} / <a href="temas/{{post.tag_nombre}}">{{ post.tag_nombre }}</a></p>
            </div>
          </div>
          
          <div class="row">
            <div class="span8"><p>{{ post.contenido }}</p></div>
          </div>  

          <div class="row">
            <div class="span8"><h2>Comments</h2></div>
          </div>

          {% if ( post.comment_count > 0 ) %}
            {% for comment in comments %}
              <div class="row">  
                <div class="span8">
                  <div class="well">
                    <p><strong>{{ 'Autor:' }} {{ comment.user_username }}</strong></p>
                    <p>{{ comment.texto }}</p>
                  </div>
                </div>
              </div>
            {% endfor %}
          {% else %}
            <div class="row"> 
              <div class="span8">
                <div class="well">
                  <p>No hay comentarios para este ADD. Se el primero en cometarlo!</p>
                </div> 
              </div>  
            </div>
          {% endif %}
          
          <div class="row"> 
            {% if (current_user) %}
              <div class="span8">
                <p><strong>Deja tu comentario!</strong></p>
                <form class="form-vertical well" method="POST" action="{{current_url()}}">
                  <input type="hidden" name="user_id" class="input-xlarge" id="user_id" value="{{ current_user_id }}">
                  <input type="hidden" name="post_id" class="input-xlarge" id="post_id" value="{{ post.id }}">
                  <textarea class="span7 input-xlarge" rows="10" name="texto"></textarea>
                  <input type="submit" class="btn btn-primary btn-large" value="Comentar"/>
                </form>
              </div>
            {% else %}
              <div class="span8">
                <div class="well" style="color:#0088CC;">
                  <p><strong>Debes haber iniciado sesión para poder comentar!</strong></p>
                </div>
              </div>
            {% endif %}
          </div>  
        </div>
      </div> 
      
      <div class="span4">
        <div style="margin-bottom: 10px; margin-left: 33px;">{% include 'include/menuside.php' %}</div>
      </div>
    </div>
  </div>
{% endblock main_content %}