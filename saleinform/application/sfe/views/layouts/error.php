<?=doctype('html4-strict')?><html><head>	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	<title><?php echo $metatitle_area_obj?></title>	<meta name="description" content="<?php echo $metadescription_area_obj?>">	<meta name="keywords" content="<?php echo $keywords_area_obj?>">	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style_new.css">	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script></head><body>
	<!-- { Search form -->
	<?php echo $search_bar_obj;?>
	<!-- { Search form -->

	<table border="0" width="100%">
		<tr>			<td class="cTD">
				<!-- { error content -->
				<?php echo $error_area_obj;?>
				<!-- } error content -->
			</td>		</tr>
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