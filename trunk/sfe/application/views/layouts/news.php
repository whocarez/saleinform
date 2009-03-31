<?=doctype('html4-strict')?>
<html>
<head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title><?php echo $metatitle_area_obj?></title>
	<meta name="description" content="<?php echo $metadescription_area_obj?>">
	<meta name="keywords" content="<?php echo $keywords_area_obj?>">	
	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style_new.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/news.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/mostpopular.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/accounts.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/quickmenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/settings.css">
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body>
	<!-- { Search form -->
	<?php echo $search_bar_obj;?>
	<!-- { Search form -->

	<table border="0" width="100%">
		<tr>
			<td class="left">
				<!-- { Login area -->
				<?php echo $login_area_obj;?>				
				<!-- } Login area -->

				<!-- { Quickmenu area -->
				<?php echo $quickmenu_area_obj;?>				
				<!-- } Quickmenu area -->
				
				<!--  { Linkchanges -->
				<?php echo $linkchanges_area_obj;?>
				<!--  { Linkchanges -->
				
			</td>
			<td class="cTD">
				<?php echo $newscats_area_obj ?>
				<?php echo $news_area_obj;?>

				<!-- { Contactstoolbar area -->
				<?php echo $contactstoolbar_area_obj;?>		
				<!-- } Contactstoolbar area -->		
			
			</td>
			<td class="right">
				<!-- { Settings area -->
				<?php echo $settings_area_obj;?>
				<!-- } Settings area -->

				<!-- { Mostpopular area -->
				<?php echo $mostpopular_searches_obj;?>
				<!-- } Mostpopular area -->

			</td>
		</tr>
	</table>


	<div class="footer">
		<div class="footer-left"></div>
		<div class="footer-right"></div>
		<!-- { Footer menu -->
		<div>
			<?php echo $footermenu_area_obj;?>
		</div>
		<!-- { Footer menu -->
	</div>

	<br>
	<div style="color:#D2D2D2;">
		<center>
			Generation Time <?php echo $this->benchmark->elapsed_time(); ?> s. Memory Usage <? echo $this->benchmark->memory_usage();?>
		</center>
	</div>


	<script type="text/javascript">_uacct = "UA-2175735-1";urchinTracker();</script> 

</body>
</html>