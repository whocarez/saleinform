<?=doctype('html4-strict')?>
<body>
	<!-- { Search form -->
	<?php echo $search_bar_obj;?>
	<!-- { Search form -->

	<table border="0" width="100%">
		<tr>
			<td class="cTD" style="padding-left: 0px;">
				<!-- { Categoeries -->
				<?php echo $clients_list_obj;?>
				<!-- } Categoeries -->
				<!-- { Contactstoolbar area -->
				<?php echo $contactstoolbar_area_obj;?>		
				<!-- } Contactstoolbar area -->		
			</td>
	
				<!-- { Settings area -->
				<?=$settings_area_obj;?>
				<!-- } Settings area -->

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