#-*-coding:utf-8-*-
<%doc>
	форма регистрации
</%doc>
<div id="logPageUs"></div>
<div id="Node_BreadCrumb" class="breadCrumb2-US">
<a href="/">${_(u'Домашняя')}</a>
>
<span class="grey">${_(u'Регистрация')}</span>
</div>
<div style="clear: both;">
</div>
<div class="registerContainer">
	<script type="text/javascript">
	<!--
	function InfoProcessing(blockName){
		if($('#info_'+blockName).css('display')=='block') $('#info_'+blockName).hide('slow');
		else $('#info_'+blockName).show('slow');
	}

	function ReloadCaptcha(){
		$.ajax({
			  type: "POST",
			  url: "gencaptcha",
			  data: "",
			  success: function(img){
				$('#i_captcha').attr('src', '/img/ajax-loader.gif');
			    $('#i_captcha').attr('src', img);
			  }
			});
	}
	//-->
	</script>
	<div class="headerBar">
		<div class="RightCorner"></div>
		<div class="RightControlArea"></div>
		<h3 class="ModuleTitle">${_(u'Регистрация нового пользователя')}</h3>
	</div>
	${h.h_tags.form('/members/signup', target='_self', method="post")}
	<div class="registerBody">
		<div class="registerLine1">
			<label for="login">${_(u'Логин')}</label>
			${h.h_tags.text('login', value="", id="login")}<a href="javascript: void(0);" onClick="InfoProcessing('login');" title="${_(u'Помощь')}">${h.h_tags.image('/img/info.png', _(u'Помощь'), border="0", class_="infoIcon")}</a>
			<div class="registerInfo subgrey" id="info_login" style="display: none;">
				<strong>${_(u'Например:')}</strong> superstar123<br>
				${_(u'Все Ваши отзывы и комментарии будут подписаны этим именем.')}<br>
				<strong>${_(u'Важно:')}</strong>
				${_(u'пожалуйста, не используйте в качестве логина Ваш адрес электронной почты.')}
			</div>
		</div>
		
		<div class="registerLine2">
			<label for="email">${_(u'Ваш E-mail')}</label>
			${h.h_tags.text('email', value="", id="email")}
		</div>

		<div class="registerLine1">
			<label for="password">${_(u'Пароль')}</label>
			${h.h_tags.password('password', value="", id="password")}
			<div class="passwordInfo subgrey" id="info_password">
				${_(u'Пароль должен содержать не менее 4-х символов')}<br>
			</div>
		</div>

		<div class="registerLine2">
			<label for="confirm_password">${_(u'Подтверждение пароля')}</label>
			${h.h_tags.password('confirm_password', value="", id="confirm_password")}
		</div>

		<div class="registerLine1">
			<label for="gender">${_(u'Ваш пол')}</label>
			${h.h_tags.radio('gender', value="M", checked=True, class_='registerRadio')}<span class="registerRadio">${_(u'Мужской')}</span>
			${h.h_tags.radio('gender', value="F", class_='registerRadio')}<span class="registerRadio">${_(u'Женский')}</span>
		</div>

		<div class="registerLine2">
			<div class="leftSide">
				<label for="captcha">${_(u'Пожалуйста, введите слово, изображенное на картинке')}</label>
				${h.h_tags.image(c.captcha, _(u'Введите символы, изображенные на картинке'), border="0", id="i_captcha")}
				${h.h_tags.text('captcha', value="", id="confirm_password", class_="registerCaptcha")}
			</div>
			<div class="captchaExplainText">
				<span class="subgrey">${_(u'Плохо различимо изображение?')}</span>
				${h.h_tags.link_to(_(u'Перегенерировать изображение'), url='javascript:void(0);', onClick="ReloadCaptcha();")}
			</div>
			<div style="clear: both;"></div>
		</div>
		
		<div>
			${h.h_tags.submit('signup', _(u'Отправить'), id="signup_btn")}
		</div>
	</div>
	${h.h_tags.end_form()}
	<div class="LowerModuleBorder">
		<div class="FooterBar">
			<div class="RightCorner"></div>
		</div>
	</div>	
</div>

