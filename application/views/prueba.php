{% extends 'include/template.php' %}

{% block main_content %}
	
	{% if (current_user) %}
		<h2>Welcome Back, {{ current_user }}!</h2>
		<p>This section represents the area that only logged in users can access.</p>
		<a class="btn-primary btn-large" href='logout'>Logout</a>
	{% else %}
		<p> Hola mundo </p>
	{% endif %}

{% endblock main_content %}