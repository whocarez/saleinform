<div class="silogin-block">
	<div class="silogin-header">
		<div class="silogin-right-corner"></div>
	</div>
	<div class="silogin-content">
		<h3><?=lang('SICLUB_MODULE_LOGINAREA_TITLE');?></h3>
		<div style="background-color: #FFFFFF; padding: 0px 7px;">
		
		<?php echo form_open('siclub/login')?>
			<?=form_label(lang('LAST_MODULE_LOGIN', 'login'))?><br>
			<?=form_input('login', '')?><br><br>
			<?=form_label(lang('LAST_MODULE_PASSWORD', 'password'))?><br>
			<?=form_password('password', '')?><br>
			<?=anchor('accounts/clients/r', lang('SICLUB_MODULE_REGISTRATION_TITLE'), 'title="'.lang('SICLUB_MODULE_REGISTRATION_TITLE').'"')?><br>
			<?=form_submit('submit', lang('ACCOUNTS_MODULE_LOGIN_TITLE'), 'class="silogin_btn"')?>
		<?php echo form_close()?> 
		<br>
		</div>
	</div>
	<div class="silogin-bottom-border">
		<div class="silogin-footer-bar">
			<div class="silogin-bottom-right-corner"></div>
		</div>
	</div>	
</div>			
	