{% extends 'test/tester.php' %}

{% block checkboxes %}{% endblock checkboxes %}
{% block resultados %}
	{% for test in testing %}
		<div class="span12">
			<div class="row">
				<div class="span12">
					<h2>RESULTADOS: </h2>
					{% set passed = 0 %}{% set failed = 0 %}
					<table class="table table-striped table-bordered">
				    <thead >
				      <tr style="background-color:#3a87ad; color:white "> 
				        <th style="text-align:center;">Test Name</th>
				        <th style="text-align:center;">Line</th>
				        <th style="text-align:center;">Notes</th>
				        <th style="text-align:center;">Result</th>
				      </tr>
				    </thead>
				    <tbody>
				    	{% if (isset(test)) %}
				    		{% for row in test %}
				    			<div>
						        <tr style="background-color:#d9edf7; text-align:center;">
						          <td>{{ row['Test Name'] }}</td>
						          <td style="text-align:center;">{{ row['Line Number'] }}</td>
						          <td>{{ row['Notes'] }}</td>
						          {% if (row['Result'] == 'Passed') %}
						          	<td style="text-align:center;">{% set passed=passed+1 %}<i class="icon-ok"></i></td>
						        	{% else %}
						        		<td style="text-align:center;">{% set failed=failed+1 %}<i class="icon-remove"></i></td>
						      		{% endif %}
						      	</tr>
						      </div>
							  {% endfor %}
						  {% else %}    
				      	<p> NO </p>
				    	{% endif %}
				    </tbody>
				  </table>
				</div>
			</div>
			<!-- RESUMEN -->
			<div class="row">
				<div class="span12">
					{% if (passed == passed+failed) %}
						<div class="alert alert-success">
					{% else %}
						<div class="alert alert-error">
					{% endif %}
						<div class="row">
							<strong>
								<div class="span10" style="font-size:20px;">Summary</div>
								<div class="pull-right span1">Total {{passed}}/{{passed+failed}}</div>
							</strong>
						</div>	
					</div>
				</div>	
			</div>
		</div>
		&nbsp;
		&nbsp;
	{% endfor %}

{% endblock resultados %}
