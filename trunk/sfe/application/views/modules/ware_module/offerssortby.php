<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
<strong><?php echo $ware_offers_header_sortby_title;?></strong>
<font style="color: #888888;font-size: 8pt;">
	<?php echo form_dropdown('o_sortby', $ware_offers_header_sort_options, $ware_offers_header_current_sortby, $ware_offers_header_sort_by_js);?>
</font>
