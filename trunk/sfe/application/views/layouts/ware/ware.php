<?=doctype('html4-strict')?>
<html>
<head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title><?php echo $metatitle_area_obj?></title>
	<meta name="description" content="<?php echo $metadescription_area_obj?>">
	<meta name="keywords" content="<?php echo $keywords_area_obj?>">	
	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style_new.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/navline.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/products.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/common.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/categories.css">
	<script src="<?php echo base_url()?>javascript/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body>
	<?php echo $search_bar_obj;?>

	<table border="0" width="100%">
		<tr>
			<td class="cTD">
				<!-- { Categoeries -->
				<?php echo $ware_area_obj;?>
				<!-- } Categoeries -->
	
				<!-- { Contactstoolbar area -->
				<?php echo $contactstoolbar_area_obj;?>		
				<!-- } Contactstoolbar area -->					
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