<?=doctype('html4-strict')?>
<html>
<head>
	<title><?=$title?></title>
	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">
<body>
	<!-- { Search form -->
	<?php echo $search_bar_obj;?>
	<!-- { Search form -->

	<table border="0" width="100%">
		<tr>
			<td class="cTD" style="padding: 0px;">
				<?php echo $client_info_obj;?>
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