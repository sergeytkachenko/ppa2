<h4>Id обращения:</h4> {{ data.id }}
<h4>Дата обращения:</h4> {{ data.date }}
{% if data.User is defined %}
<h4>Пользователь:</h4> {{ data.User.login }} ({{ data.User.last_name }} {{ data.User.name }})
{% endif %}
<h4>Адресс страницы:</h4> {{ data.url }}
<h4>Суть обращения:</h4> {{ data.note }}
<p>
	<img src="{{ data.img }}" />
</p>