				<div class="box">
					<div class="b_h">
						<div id="hc_meta" class="b_hc" ><?php echo $filters_area_title?></div>
					</div>
					<div class="b_c">
						<div class="o" id="proj_c" style="background-color: #f5f5f5;background-image: none;">
							<div id="proj_cnt">
								<?php echo form_open($filters_current_form_uri_string, array('name'=>'c_filter', 'id'=>'c_filter'))?>
								<div style="overflow: hidden; width:100%;font-size: 8pt;">
									<script type="text/javascript">
									function createFilterLink()
									{
										var filterElements = c_filter.action+"\n";
									 	for (var n=0; n < c_filter.elements.length; n++)
									 	{
									 		if(c_filter.elements[n].value!="" && c_filter.elements[n].value!='0' && c_filter.elements[n].name!="subm") filterElements += '/' + c_filter.elements[n].name + '/'+ c_filter.elements[n].value;
									 	}
									 	document.c_filter.action = filterElements;
									 	document.c_filter.submit();
									}
									</script>	
									<div style="margin-bottom: 5px; font-size: 100%;">
										<b><?php echo $filters_module_search_field_title;?></b>
										<?php
											$data = array(
              											'name'        => 'ss',
              											'id'          => 'ss',
														'value'		  => ((isset($filters_module_filters_current_vals_arr['ss']))?$filters_module_filters_current_vals_arr['ss']:''),	
              											'maxlength'   => '100',
              											'style'       => 'width: 100%; border: 1px solid #888888;',
            											);										
											echo form_input($data);
										?>
									</div>
									<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
									<div style="margin-bottom: 5px; font-size: 100%;">
										<b><?php echo $filters_module_prrange_field_title;?></b>
										<span style="color: #888888;">(<?php echo $filters_current_maincurr_endword;?>)</span>
										<?php
											$data = array(
              											'name'        => 'pf',
              											'id'          => 'pf',
              											'maxlength'   => '100',
														'value'		  => ((isset($filters_module_filters_current_vals_arr['pf']))?$filters_module_filters_current_vals_arr['pf']:''),	
              											'style'       => 'width: 45%; border: 1px solid #888888;float: left;'
            											);										
											echo form_input($data);
										?>
										<?php
											$data = array(
              											'name'        => 'pt',
              											'id'          => 'pt',
              											'maxlength'   => '100',
														'value'		  => ((isset($filters_module_filters_current_vals_arr['pt']))?$filters_module_filters_current_vals_arr['pt']:''),	
              											'style'       => 'width: 45%; border: 1px solid #888888; float: right;'
            											);										
											echo form_input($data);
										?>
									</div>
									<br>
									<div style="margin-bottom: 5px; font-size: 100%;height:30px;">
										<b><?php echo $filters_module_prrange_field_title;?></b>
										<span style="color: #888888;">(<?php echo $filters_current_addcurr_endword;?>)</span>
										<?php
											$data = array(
              											'name'        => 'pfa',
              											'id'          => 'pfa',
              											'maxlength'   => '100',
														'value'		  => ((isset($filters_module_filters_current_vals_arr['pfa']))?$filters_module_filters_current_vals_arr['pfa']:''),	
              											'style'       => 'width: 45%; border: 1px solid #888888;float: left;'
            											);										
											echo form_input($data);
										?>
										<?php
											$data = array(
              											'name'        => 'pta',
              											'id'          => 'pta',
              											'maxlength'   => '100',
														'value'		  => ((isset($filters_module_filters_current_vals_arr['pta']))?$filters_module_filters_current_vals_arr['pta']:''),	
              											'style'       => 'width: 45%; border: 1px solid #888888; float: right;'
            											);										
											echo form_input($data);
										?>
									</div>
									<div style="width:100%;padding-bottom: 5px;height:20px;">
										<input name="subm" style="float: right;border: 0px;margin-top: 3px; line-height: 17px; text-align: center; width: 80px;" class="btn" onclick="createFilterLink()" value="<?php echo $filters_module_filter_btn_title;?>" type="button">
									</div>
									<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>
									<?php if($filters_module_current_filter_arr) { ?>
									<div style="margin-bottom: 10px; font-size: 100%;">
										<div style="margin-bottom:10px;">
											<b><?php echo $filters_module_current_filter_title;?></b>
										</div>
										<div>
										<?php
											foreach($filters_module_current_filter_arr as $item) {
										?>	
											<strong><?php echo $item['pname'];?></strong>
											<?php foreach($item['links'] as $link) { ?>
											<div class="filter-list-element-minus">
												<?php echo $link['link']; ?><span style="color: #888888;padding-left: 2px;">(<?php echo $link['count']; ?>)</span>
											</div>
											<?php } ?>
										<?php } ?>
										</div>
									</div>
									<div style="padding:0px 0;margin:4px 0;overflow:hidden;border:1px dashed #B1BFC7;border-left:0;border-right:0;border-bottom: 0;"></div>									
									<?php } ?>
									<?php if($filters_module_filters_brands_list){ ?>									
									<div style="margin-bottom: 10px; font-size: 100%;max-height:197px;height:197px;overflow-y:auto;overflow-x:hidden;">
										<div>
											<b><?php echo $filters_module_brands_field_title;?></b>
										</div>
										<div>
										<?php
											foreach($filters_module_filters_brands_list as $brand) {
										?>	
											<div class="filter-list-element">
												<?php echo $brand['link']; ?><span style="color: #888888;padding-left: 2px;">(<?php echo $brand['count']; ?>)</span>
											</div>
										<?php } ?>
										</div>
									</div>
									<?php } ?>
									<?php foreach($filters_module_filters_fields_arr as $key=>$filter) { ?>
									<div style="margin-bottom: 10px; font-size: 100%;">
										<strong><?php echo $filter['fname'];?></strong>
										<?php
											foreach($filter['items'] as $link) {
										?>
											<div class="filter-list-element">
												<?php echo $link['link']; ?><span style="color: #888888;padding-left: 2px;">(<?php echo $link['count']; ?>)</span>
											</div>
										<?php }	?>
									</div>
										
									<?php } ?>
									<?php echo form_close();?>
								</div>
							</div>
						</div>
					</div>
				</div>
