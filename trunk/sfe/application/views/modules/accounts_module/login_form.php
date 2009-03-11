<div id="Node_BreadCrumb" class="breadCrumb2-US">
<?=anchor('', lang('ACCOUNTS_HOME'))?>
>
<span class="grey"><?=lang('ACCOUNTS_LOGIN')?></span>
</div>
<div style="clear: both;"></div>

<table class="wd750">
	<tr>
		<td class="hdlpad1">
			<span class="headline"><?=lang('ACCOUNTS_LOGIN')?></span>
		</td>
	</tr>
</table>

<table cellspacing="1" cellpadding="0" class="wd750nopad bg12dark">
	<tr> 
		<td class="loginHD1"><span class="subhdl"><?=lang('ACCOUNTS_NEW_USER')?></span></td>
		<td class="loginHD1"><span class="subhdl"><?=lang('ACCOUNTS_ALREADY_USER')?></span></td>
	</tr>
	<tr>
		<td class="loginCOL1 bg12light">
			<?=lang('ACCOUNTS_NO_USER_DESCR')?><br>
			<?=lang('ACCOUNTS_REG_TIME')?>
			<strong><?=lang('ACCOUNTS_NOP')?></strong>.<br/><br/>
			<b><?=lang('ACCOUNTS_ABOUT_1')?></b> 
			<ul class="loginLIST">
  				<li><?=lang('ACCOUNTS_ABOUT_2')?></li>
  				<li><?=lang('ACCOUNTS_ABOUT_3')?></li>
  				<li><?=lang('ACCOUNTS_ABOUT_4')?></li>
  				<li><?=lang('ACCOUNTS_ABOUT_5')?></li>
			</ul>
			<div class="padT5">
				<?=form_open('accounts/register', array('target'=>'_self'))?>
				<?=form_submit('submit', lang('ACCOUNTS_MODULE_REGISTRATION_TITLE').' >', 'size="40", class="w150"')?>
				<?=form_close()?>
			</div>
		</td>
		<td class="loginCOL2 bgwhite">
			<? if(validation_errors()) { ?>
			<div class="login-errors">
				<?=validation_errors(); ?>
			</div>
			<? } ?>
			<?=form_open('accounts/login', array('target'=>'_self'))?>
			<?=lang('ACCOUNTS_LOGIN_1')?><br><?=lang('ACCOUNTS_LOGIN_2')?><br><br>
			<?=form_hidden('referrer', $refferer)?>
			<?=form_hidden('loginAction', 'todo')?><br>
			<span class="subhdl"><?=lang('ACCOUNTS_MODULE_LOGIN_LABEL')?></span><br>
			<?=form_input('login', '', 'maxlength="255", size="20"')?><br>
			<!-- 
			<span class="subgrey"><?=lang('ACCOUNTS_LOGIN_3')?></span> 
			<a class="small" href="send_password.php"><?=lang('ACCOUNTS_LOGIN_4')?></a>
			<span class="subgrey">?</span>
			 -->
			<br><br>
			
			<span class="subhdl"><?=lang('ACCOUNTS_LOGIN_5')?></span><br>
			<?=form_password('password', "", 'tabindex="2", maxlength="255", size="20"')?><br>
			<span class="subgrey"><?=lang('ACCOUNTS_LOGIN_6')?></span><br>
			<!--
			<span class="subgrey"><?=lang('ACCOUNTS_LOGIN_7')?></span> 
			<a class="small" href="send_password.php"><?=lang('ACCOUNTS_LOGIN_8')?></a><span class="subgrey">?</span><br/>
			-->
			<br/>
			<?=form_submit('submit', lang('ACCOUNTS_LOGIN_9').' >', 'size="40", class="w150"')?>
			<br/>
			<br/>
			<?=form_close()?>
			
		</td>
	</tr>
</table>