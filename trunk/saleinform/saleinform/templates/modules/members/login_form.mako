#-*-coding:utf-8-*-
<%doc>
	форма логирования
</%doc>
<div id="logPageUs"></div>
<div id="Node_BreadCrumb" class="breadCrumb2-US">
<a href="/">${_(u'Домашняя')}</a>
>
<span class="grey">${_(u'Войти на сайт')}</span>
</div>
<div style="clear: both;"/>

<table class="wd750">
	<tr>
		<td class="hdlpad1">
			<span class="headline">${_(u'Войти на сайт')}</span>
		</td>
	</tr>
</table>

<table cellspacing="1" cellpadding="0" class="wd750nopad bg12dark">
	<tr> 
		<td class="loginHD1"><span class="subhdl">${_(u'Новый пользователь?')}</span></td>
		<td class="loginHD1"><span class="subhdl">${_(u'Уже зарегистрированы на сайте?')}</span></td>
	</tr>
	<form target="_self" action="register.php" method="post"/>
	<tr>
		<td class="loginCOL1 bg12light">
			${_(u'Если у Вас еще нет учетной записи на нашем сайте, пожалуйста, сперва зарегистрируйтесь.')}<br/><br/>
			${_(u'Регистрация займет всего несколько секунд')}<br/>
			<strong>${_(u'и ни к чему Вас не обязывает')}</strong>.<br/><br/>
			<b>${_(u'Имея учетную запись на нашем сайте, Вы можете:')}</b> 
			<ul class="loginLIST">
  				<li>${_(u'Оставлять отзывы на товары')}</li>
  				<li>${_(u'Оценивать товары и магазины')}</li>
  				<li>${_(u'Формировать заказы')}</li>
  				<li>${_(u'и многое другое...')}</li>
			</ul>
			<div class="padT5">
				<input type="submit" value="${_(u'Регистрация')} >" name="Submit" class="w150"/>
			</div>
			<form target="_self" action="login_check.php" method="post">
			</form>
		</td>
		<td class="loginCOL2 bgwhite">
			${_(u'Пожалуйста, введите Ваши логин')} <br/>${_(u'и пароль.')}<br/><br/>
			<span class="subhdl">${_(u'Логин')}</span><br/>
			<input type="text" value="" tabindex="1" maxlength="255" size="40" name="LoginName"/><br/>
			<span class="subgrey">${_(u'Забыли Ваш')}</span> 
			<a class="small" href="send_password.php">${_(u'логин')}</a>
			<span class="subgrey">?</span><br/><br/>
			<span class="subhdl">${_(u'Пароль')}</span><br/>
			<input type="password" value="" tabindex="2" maxlength="255" size="40" name="Password"/>
			
			<br/>
			<span class="subgrey">Important: Your Ciao name and password are case sensitive</span><br/>
			<span class="subgrey">Forgotten your</span> <a class="small" href="send_password.php">password</a><span class="subgrey">?</span><br/>
			<br/>
			<input type="hidden" value="/login.php" name="referrer"/>
			<input type="hidden" value="addNewUser" name="todo"/>
			<input type="submit" value="Login >" tabindex="3" name="Submit" class="w150"/>
			<br/>
			<br/>
			<div class="floatchkbx1">
				<input type="checkbox" name="autologin"/>
			</div>
			<span class="subgrey">Keep me signed in on this computer </span>
		</td>
	</tr>
</table>