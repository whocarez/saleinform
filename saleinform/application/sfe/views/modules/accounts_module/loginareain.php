<div class="login-block">
	<div class="login-header">
		<div class="login-right-corner"></div>
	</div>
	<div class="login-content">
		<div style="background-color: #FFFFFF; padding: 0px 7px;">
		<h3><?=lang('ACCOUNTS_MODULE_LOGIN_AREA_TITLE');?></h3>
		<?=$accounts_login_success_note?><br>
		<?=anchor('accounts/chpass', lang('ACCOUNTS_LOGIN_CHPASS_LABEL'), 'title="'.lang('ACCOUNTS_LOGIN_CHPASS_LABEL').'"')?><br>
		<?=anchor('accounts/logout', lang('ACCOUNTS_LOGIN_LOGOUT_LABEL'), 'title="'.lang('ACCOUNTS_LOGIN_LOGOUT_LABEL').'"')?><br>
		</div>
	</div>
	<div class="login-bottom-border">
		<div class="login-footer-bar">
			<div class="login-bottom-right-corner"></div>
		</div>
	</div>	
</div>			
				