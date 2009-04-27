<?=doctype('html4-strict')?>
<html>
<head>
	<?=meta($meta);?>
	<title><?=$title?></title>
	<link rel="SHORTCUT ICON" href="<?=base_url()?>images/si.png">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style_new.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/settings.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/info.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/categories.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/accounts.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/quickmenu.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/linkschanges.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/mostpopular.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/last.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/siclub.css">
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body>
	<!-- { Search form -->
	<?=$search_bar_obj;?>
	<!-- { Search form -->
		
	<table border="0" width="100%">
		<tr>
			<td class="left">
				<!-- { Main categories area -->
				<?=$categories_main_obj;?>
				<!-- } Main categories area -->
				
				<!--  { Advertising -->
				<a href="http://www.vipgift.com.ua"  target="_blank" title="Подарки" >
			        <?=img(array('src'=>'images/adv/vipgift.jpg', 'alt'=>'Подарки', 'border'=>"0"));?>
				</a>
				<!--  { Advertising -->

				<!-- { Quickmenu area -->
				<?#=$quickmenu_area_obj;?>				
				<!-- } Quickmenu area -->
				
				<!--  { Linkchanges -->
				<!-- 
				<?=$linkchanges_area_obj;?>
				 -->
				<!--  { Linkchanges -->

				<!--  { Advertising -->
				<a href="http://security.saleinform.com"  target="_blank" title="Системы видеонаблюдения и пожарной сигнализации" >

				<?=img(array('src'=>'images/adv/videonablyudenie.gif', 'alt'=>'Системы видеонаблюдения и пожарной сигнализации', 'border'=>"0"));?>
				</a>
				<!--  { Advertising -->
				
			</td>
			<td class="cTD">
				<!-- { What Is It info -->
				<?=$whatisit_area_obj;?>		
				<!-- } What Is It info -->		

				<!-- { Categoeries -->
				<?#=$categories_table_obj;?>
				<!-- } Categoeries -->

				<!-- { Rated products -->
				<?=$mostpopular_categories_carousel_obj;?>
				<!-- } Rated products -->

				<!-- { Last updates -->
				<?=$last_area_obj;?>
				<!-- } Last updates -->

				<!-- { Contactstoolbar area -->
				<?=$contactstoolbar_area_obj;?>
				<!-- } Contactstoolbar area -->		
	
			</td>
			<td class="right">
				<!-- { Login area -->
				<?=$login_area_obj;?>				
				<!-- } Login area -->
	
				<!-- { Settings area -->
				<?=$settings_area_obj;?>
				<!-- } Settings area -->

				<!-- { Mostpopular area -->
				<?=$mostpopular_area_obj;?>
				<!-- } Mostpopular area -->

				<!-- { Mostpopular searches -->
				<?=$mostpopular_searches_obj;?>
				<!-- { Mostpopular searches -->

			</td>
		</tr>
	</table>

	<div class="footer">
		<div class="footer-left"></div>
		<div class="footer-right"></div>
		<!-- { Footer menu -->
		<div>
			<?=$footermenu_area_obj;?>
		</div>
		<!-- { Footer menu -->
	</div>

	<br>
	<div style="color:#D2D2D2;">
		<center>
			Generation Time <?=$this->benchmark->elapsed_time(); ?> s. Memory Usage <?= $this->benchmark->memory_usage();?>
		</center>
	</div>


	<script type="text/javascript">_uacct = "UA-2175735-1";urchinTracker();</script> 
</body>
</html>