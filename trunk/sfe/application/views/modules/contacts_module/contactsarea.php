<div class="info-block">
	<div class="info-header">
		<div class="info-right-corner"></div>
	</div>
	<div class="info-content">
	<?=form_open('contacts')?>
		<?=img(array('src'=>'images/icons/0566_32x32.png', 'border'=>'0', 'align'=>'left'))?>
		<h3><?=lang('CONTACTS_MODULE_CONTACTS_TITLE');?></h3> 
		<?=lang('CONTACTS_MODULE_CONTACTS_DESCR');?>
		<br><br>
		<?=lang('CONTACTS_MODULE_CONTACTS_ICQ_TITLE')?>: <strong>298864875</strong>
		<br>
		<?=lang('CONTACTS_MODULE_CONTACTS_GIZMO_TITLE')?>: <strong>Mazvv</strong>
		<br>
		<?=lang('CONTACTS_MODULE_CONTACTS_PHONE_TITLE')?>: <strong>+38 068 198 38 69</strong>
		<br> 
		<br>
		<?if($saveOk) { ?>
			<div class="save-ok">
				<?=img(array('src'=>'images/save_ok.png', 'alt'=>lang('SETTINGS_SAVE_OK'), 'align'=>'left', 'border'=>'0',  'style'=>'margin-top:0px;'))?>
				&nbsp;&nbsp;&nbsp;<?=lang('CONTACTS_MODULE_WRITE_SUCCESS_DESCR')?>
			</div>	
		<? } ?>
		
		<?if(validation_errors()) { ?>
		<div style="padding: 5px;">
		<div class="register-errors">
			<?=validation_errors()?>
		</div>
		</div>
		<? } ?>
		
		<?=lang('CONTACTS_MODULE_NAME_SENDER_TITLE')?><br>
		<?=form_input('name', set_value('name', ''))?><br>
		
		<?=lang('CONTACTS_MODULE_EMAIL_SENDER_TITLE')?><br>
		<?=form_input('email', set_value('email', ''))?><br>
		
		<?=lang('CONTACTS_MODULE_WRITE_COMMENT')?><br>
		<?=form_textarea(array('name'=>'comment', 'value'=>set_value('comment', ''), 'rows'=>"5", 'cols'=>"45"))?>
		<br>
		<?=form_submit('submit', lang('CONTACTS_MODULE_WRITE_SEND'))?>
	<?=form_close() ?>
	</div>
	<div class="info-bottom-border">
		<div class="info-footer-bar">
			<div class="info-bottom-right-corner"></div>
		</div>
	</div>	
</div>					