<div id="Node_BreadCrumb" class="breadCrumb2-US">
	<?=anchor(index_page(), lang('CLIENTS_HOME'), 'title="'.lang('CLIENTS_HOME').'"')?>
	<span class="grey">></span>
	<?=anchor('clients', lang('CLIENTS_STORES_BREADCRUMB'), 'title="'.lang('CLIENTS_STORES_BREADCRUMB').'"')?>
	<span class="grey">></span>
	<?=anchor('clients/rules', lang('CLIENTS_ADD'), 'title="'.lang('CLIENTS_ADD').'"')?>
	<span class="grey">></span>
	<span class="greyb">
		<?=lang('CLIENTS_ADD_REGISTER')?>
	</span>
</div>
<div class="add-client-box">
	<h3><?=lang('CLIENTS_REGISTER_TITLE')?></h3>
	<strong><?=lang('CLIENTS_MODULE_CLIENTS_GLOBAL_TITLE')?></strong>
	<table>
		<tr>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_URFORM_LABEL'), '_urforms_rid')?><br><?$l = array(); foreach($urformsList as $row) $l[$row->rid] = $row->little_name; echo form_dropdown('_urforms_rid', $l, '', 'id="_urforms_rid"')?><br>
			</td>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_NAME_LABEL'), 'name')?><br><?=form_input('name', '', 'id="name"')?><br>
			</td>
			<td>			
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_CLTYPES_LABEL'), '_cltypes_rid')?><br><?$l = array(); foreach($cltypesList as $row) $l[$row->rid] = $row->name; echo form_dropdown('_cltypes_rid', $l, '', 'id="_cltypes_rid"')?><br>
			</td>
		</tr>
		<tr>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_COUNTRIES_LABEL'), '_countries_rid')?><br><?$l = array(); foreach($countriesList as $row) $l[$row->rid] = $row->name; echo form_dropdown('_countries_rid', $l,'', 'id="_countries_rid"')?><br>
			</td>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_REGIONS_LABEL'), '_regions_rid')?><br><?=form_input('_regions_rid', '', 'id="_regions_rid"')?><br>
			</td>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_CITIES_LABEL'), '_cities_rid')?><br><?=form_input('_cities_rid', '', 'id="_cities_rid"')?><br>
			</td>
		</tr>
		<tr>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_ZIP_LABEL'), 'zip')?><br><?=form_input('zip', '', 'id="zip"')?><br>
			</td>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_STREET_LABEL'), 'street')?><br><?=form_input('street', '', 'id="street"')?><br>
			</td>
			<td>
			<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_BUILD_LABEL'), 'build')?><br><?=form_input('build', '', 'id="build"')?><br>
			</td>
		</tr>
	</table>
	
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_PHONES_LABEL'), 'wphones')?><br><?=form_input('wphones', '', 'id="wphones"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_SKYPE_LABEL'), 'skype')?><br><?=form_input('skype', '', 'id="skype"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_ICQ_LABEL'), 'icq')?><br><?=form_input('icq', '', 'id="icq"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_MSN_LABEL'), 'msn')?><br><?=form_input('msn', '', 'id="msn"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_WWW_LABEL'), 'url')?><br><?=form_input('url', '', 'id="url"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_DESCR_LABEL'), 'descr')?><br><?=form_input('descr', '', 'id="descr"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_CREDIT_LABEL'), 'creadit_info')?><br><?=form_input('creadit_info', '', 'id="creadit_info"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_DELIVERY_LABEL'), 'delivery_info')?><br><?=form_input('delivery_info', '', 'id="delivery_info"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_WTIME_LABEL'), 'worktime_info')?><br><?=form_input('worktime_info', '', 'id="worktime_info"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_CPHONES_LABEL'), 'contact_phones')?><br><?=form_input('contact_phones', '', 'id="contact_phones"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_CMAIL_LABEL'), 'contact_email')?><br><?=form_input('contact_email', '', 'id="contact_email"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_CPERSON_LABEL'), 'contact_person')?><br><?=form_input('contact_person', '', 'id="contact_person"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_LOGIN_LABEL'), 'login')?><br><?=form_input('login', '', 'id="login"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_PASSWD_LABEL'), 'passwd')?><br><?=form_input('passwd', '', 'id="passwd"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_СPASSWD_LABEL'), 'cpasswd')?><br><?=form_input('cpasswd', '', 'id="cpasswd"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_UEMAIL_LABEL'), 'email')?><br><?=form_input('email', '', 'id="email"')?><br>
	<?=form_label(lang('CLIENTS_MODULE_CLIENTS_ADD_DNAME_LABEL'), 'displayname')?><br><?=form_input('displayname', '', 'id="displayname"')?><br>
	
</div>
