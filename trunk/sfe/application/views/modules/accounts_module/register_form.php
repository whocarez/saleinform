<script src="<?=base_url()?>javascript/jquery-1.3.1.min.js" type="text/javascript"></script>
<div id="Node_BreadCrumb" class="breadCrumb2-US">
<?=anchor('', lang('ACCOUNTS_HOME'))?> 
>
<span class="grey"><?=lang('ACCOUNTS_REGISTER')?> </span>
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
			  url: "<?=base_url().index_page()?>/accounts/reloadcaptcha",
			  data: "",
			  success: function(img){
			    $('#i_captcha').attr('src', img);
			  }
			});
	}
	//-->
	</script>
	<div class="headerBar">
		<div class="RightCorner"></div>
		<div class="RightControlArea"></div>
		<h3 class="ModuleTitle"><?=lang('ACCOUNTS_REG_NEW_USER')?></h3>
	</div>
	<?=form_open('/accounts/register')?>
	<div class="registerBody">
		<?if(validation_errors()) { ?>
		<div style="padding: 5px;">
		<div class="register-errors">
			<?=validation_errors()?>
		</div>
		</div>
		<? } ?>
		<div class="registerLine1">
			<label for="login"><?=lang('ACCOUNTS_LOGIN_T')?></label>
			<?=form_input('login', set_value('login'), 'id="login"')?>
			
			<a href="javascript: void(0);" onClick="InfoProcessing('login');" title="Помощь">
				<?=img(array('src'=>'images/info.png', 'alt'=>lang('ACCOUNTS_HELP'), 'border'=>"0", 'class'=>"infoIcon"))?>
			</a>
			<div class="registerInfo subgrey" id="info_login" style="display: none;">
				<?=lang('ACCOUNTS_HELP_INFO')?>
			</div>
		</div>
		
		<div class="registerLine2">
			<label for="email">Ваш E-mail</label>
			<?=form_input('email', set_value('email'), 'id="email"')?>
			
		</div>

		<div class="registerLine1">
			<label for="password">Пароль</label>
			<?=form_password('password', "", 'id="password"')?>
			
			<div class="passwordInfo subgrey" id="info_password">
				Пароль должен содержать не менее 4-х символов. Допускаются латинские буквы, цифры и знаки подчеркивания<br>
			</div>
		</div>

		<div class="registerLine2">
			<label for="confirm_password">Подтверждение пароля</label>
			<?=form_password('confirm_password', "", 'id="confirm_password"')?>
			
		</div>

		<div class="registerLine1">
			<div class="leftSide">
				<label for="captcha">Пожалуйста, введите слово, изображенное на картинке</label>
				<?=img(array('src'=>$captcha,  'border'=>"0", 'id'=>"i_captcha"))?>
				<?=form_input('captcha', "", 'id="captcha" class="registerCaptcha"')?>
				
			</div>
			<div class="captchaExplainText">
				<span class="subgrey">Плохо различимо изображение?</span>
				<a href='javascript: void(0);' onClick="ReloadCaptcha();">Перегенерировать изображение</a> 
			</div>
			<div style="clear: both;"></div>
		</div>
		
		<div>
			<?=form_submit('signup', 'Отправить', 'id="signup_btn"')?>
		</div>
	</div>
	<?=form_close()?>
	<div class="LowerModuleBorder">
		<div class="FooterBar">
			<div class="RightCorner"></div>
		</div>
	</div>	
</div>
