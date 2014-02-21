{% extends 'include/template.php' %}

{% block main_content %}
  <div class="span12">
    <div class="row">
      <div class="span8">
        {# Lista de comentarios #}
        {% if (isset(records)) %}
          {% for row in records %}
            <div class="post" style="padding-right: 0px; background:#181818; margin-bottom: 15px;  -webkit-border-radius: 4px; color: white;">
              <div class="row">
                <div class="span4"><h2><a href="ver_post/{{row.id}}">{{row.titulo}}</a> </h2></div>   

                <div class="span4">
                  <p class="pull-right" style="font-size: 11px;"s>
                    <i class="icon-user icon-white"></i> 
                    <strong>{{row.user_username}}</strong> el día {{row.fecha}} / <a href="temas/{{row.tag_nombre}}">{{row.tag_nombre}}</a>
                  </p>
                </div>
              </div>  
              
              <div class="row">  
                <div class="span8"><p>{{row.contenido}}</p></div>
              </div>

              <div class="row">  
                <div class="span4">
                  <p class="pull-left" style="font-size: 11px;">
                    {% if (current_user) %}
                      Votos: 
                      <a href="guardarv/1/{{row.id}}"><i class="icon-plus icon-white"></i></a> ({{ row.gusta }}) 
                      <a href="guardarv/0/{{row.id}}"><i class="icon-minus icon-white"></i></a> ({{ row.no_gusta }})
                    {% else %}
                      Votos: <i class="icon-plus icon-white"> </i> ({{ row.gusta }})
                      <i class="icon-minus icon-white"></i> ({{ row.no_gusta }})
                    {% endif %}
                  </p>  
                </div>

                <div class="span4"><p class="pull-right"><a href="ver_post/{{row.id}}">{{row.comment_count}} Comments</a> </p></div>
              </div>  

            </div>
          {% endfor %}
        {% else %}
          <div class="row">  
            <div class="span8">
              <div class="well">
                <p><strong>Todavía no hay ningún ADD publicado! Inicia sesión y Comparte tu ADD con nosotros!</strong></p>
              </div>
            </div>
          </div>    
        {% endif %} 
      </div>
      
      <div class="span4">
        <div class="span4" style="margin-bottom: 10px; margin-left: 33px;"> {% include 'include/menuside.php' %} </div>
      </div>
    </div>
  </div>
{% endblock main_content %}