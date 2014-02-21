<p><!--a class="btn-primary btn-large" href=<?= base_url();?>ultimos>asco de dia 1.0</a-->
<a class="btn-primary btn-large" href="ultimos">Ultimos AAD publicados</a>
<a class="btn-primary btn-large" href="mejores">Los Mejores AAD</a>
<a class="btn-primary btn-large" href="aleatorios">AAD Aleatorios</a>
<a class="btn-inverse btn-large" href="post">Comparte tu ADD</a>
{% if (current_user) %} <a class="btn-info btn-large" href="logout"> Logout de ADD</a></p>
{% else %} <a class="btn-info btn-large" href="user">Registrate ADD</a></p>
{% endif %}
