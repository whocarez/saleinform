<?=doctype('html4-strict')?>
<html>
<head>
<body id="mainBody">
	<div class="md">
		<div id="main_cnt">
			<div>
				<?=$nav_top_obj?>
			</div>
			<div>
				<?=$topmenu_obj;?>
				<?=$search_bar_obj;?>
			</div>
			
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
                    <td style="padding: 10px 0px 0px 0px;" valign="top">
					<!-- { Clients register -->
					<?=$clients_form_obj?>
					<!-- { Clients register -->
					</td>
                </tr>
            </table>
		</div>
	<!-- { Footer menu -->
	<?php echo $footer_area_obj;?>
	<!-- { Footer menu -->
	</div>
	<!-- 
	<script type="text/javascript">_uacct = "UA-2175735-1";urchinTracker();</script>
	 --> 
</body>
</html>