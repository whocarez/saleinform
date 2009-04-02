<?=doctype('html4-strict')?><html><head>	<?=meta($meta)?>	<title><?=$title?></title>	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style_new.css">	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/settings.css">	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/categories.css">	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/mostpopular.css">	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/common.css">		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/boxes1.css">	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/blocks2.css">	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script></head>
<body>
	<!-- { Search form -->
	<?php echo $search_bar_obj;?>
	<!-- { Search form -->

	<table border="0" width="100%">
		<tr>			<td class="cTD">
				<!-- { Categoeries -->
				<?php echo $categories_area_obj;?>
				<!-- } Categoeries -->
	
				<!-- { Contactstoolbar area -->
				<?php echo $contactstoolbar_area_obj;?>		
				<!-- } Contactstoolbar area -->		
			</td>
			<td class="right">
				<!-- { Settings area -->
				<?php echo $settings_area_obj;?>
				<!-- } Settings area -->
				<!-- { Mostpopular searches -->
				<?php echo $mostpopular_searches_obj;?>
				<!-- { Mostpopular searches -->			</td>
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