{% extends "partials/body.twig.php" %}

{% block title %} {{PG_NOT_FOUND_TITLE}} {% endblock %}

{% block body %}
<div class="card border-danger mb-3" style="max-width: 20rem;">
  <div class="card-header">Ops!</div>
  <div class="card-body">
    <h4 class="card-title">{{title}}</h4>
    <p class="card-text">{{message}}</p>
  </div>
</div>
{% endblock %}

