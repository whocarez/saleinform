#-*-coding:utf-8-*-
<%doc>
	регистрация завершена
</%doc>
<div id="logPageUs"></div>

<div class="registerContainer">
	<div class="headerBar">
		<div class="RightCorner"></div>
		<div class="RightControlArea"></div>
		<h3 class="ModuleTitle">${_(u'Спасибо за регистрацию')}</h3>
	</div>


	<div class="registerComplete">
		<div class="registerIntro">
			<p>
			Извините, но во время выполнения операции произошла ошибка. Попробуйте повторить процесс регистрации немного позже. 
			Если проблема повторяется, пожалуйста напишите нам.
			<br/>
			${h.h_tags.image('/img/register_mailicon_small.gif', _(u'Email'))}
			<strong>${h.h_tools.mail_to('support@saleinform.com', u'support@saleinform.com', encode='hex')}</strong><br/>
		</div>
	</div>
	<div class="LowerModuleBorder">
		<div class="FooterBar">
			<div class="RightCorner"></div>
		</div>
	</div>	
	
</div>

