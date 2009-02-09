#-*-coding: utf-8 -*-
<html>
  <head>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
    <p>${_(u'Добро пожаловать, на Saleinform')}</p>
       ${_(u'Процесс регистрации почти завершен. Для активации Вашей учнтной записис, пожалуйста, кликните на ссылку или же скопируйте и вставьте её в Ваш браузер.')}
       <br>
       ${_(u'Ссылка для активации')}
       ${h.h_tags.link_to('/members/activate?code='+c.code)}
       <br>
       <br>
		${_(u'Команда Saleinform')}
		<br>
		<strong>${_(u'Важно:')}</strong>
		${_(u'ссылка действительна в течении 7 дней, после чего будет удалена. Если Вы не активировали свой аккаунт на протяжении этого времени, Вам необходимо повторить процесс регистрации')}
  </body>
</html>
