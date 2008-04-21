<div style="position: relative; z-index: 99999;">
	<span style="width: 70px; position: absolute; top: 70px; left: 300px;" id="rZ_md"> 
	</span>
</div>
<script type="text/javascript">
<!--
	function buildAction()
	{
		var searchStringObj = document.getElementById('searchString');
		var searchActionObj = document.getElementById('formAction');
		var searchFormObj = document.getElementById('searchForm');
		var categoryRidObj = document.getElementById('categoryRid');
		var searchThisCatObj = document.getElementById('search_thiscat');
		if(trim(searchStringObj.value) == '')
		{ 
			alert('<?php echo $search_current_search_string_empty;?>');
			return; 
		}
		else
		{
			if(trim(categoryRidObj.value) != '' && searchThisCatObj.checked == true)
			{  
				searchFormObj.action = searchActionObj.value + 'c/' + trim(categoryRidObj.value) + '/';
			}
			else searchFormObj.action = searchActionObj.value;
			searchFormObj.action = searchFormObj.action + 'ss/' + trim(searchStringObj.value);
		}
	}

	function trim(s)
	{
		return rtrim(ltrim(s));
	}

	function ltrim(s)
	{
		var l=0;
		while(l < s.length && s[l] == ' ')
		{	
			l++; 
		}
		return s.substring(l, s.length);
	}

	function rtrim(s)
	{
		var r=s.length -1;
		while(r > 0 && s[r] == ' ')
		{	
			r-=1;	
		}
		return s.substring(0, r+1);
	}		
//-->
</script>

<div class="zs">
<div id="z" style="margin: 15px 0px 0px;">
<div class="left" style="float: left; text-align: center; width: 260px;">
	<a href="#"> <img style="position: relative; top: 17px;" src="<?php echo base_url();?>/images/logo.png" alt="<?php echo $logo_title; ?>" border="0" height="36" width="250"></a>
</div>
<div style="margin-left: 260px;">
<div style="float: left; padding-right: 25px;" id="zz">
<div><span style="float: right; width: 170px;"> </span>
<div class="rp1">
<?php foreach($header_items as $key=>$item) { ?>
<a class="<?php echo ($search_current_header_item==$key)?'mC':'mCG';?>" href="<?php echo $item[1]?>">
	<div class="mL">
		<div class="mR">
			<div class="p_100s"></div>
			<span id="s-"><?php echo $item[0]?></span>
		</div>
	</div>
</a> 
<?php } ?>
</div>
<div class="fq1">
<?php echo form_open('', array('id'=>"searchForm", 'name'=>"searchForm", 'onSubmit'=>"buildAction()", 'style'=>"padding: 0px; margin-top: 0px;"))?>
	<div class="fq2">
		<div class="fq3">
			<input id="sb" style="height: 25px; width: 120px;" class="y_button" value="<?php echo $search_current_search_btn_value?>" type="submit" >
		</div>
		<div class="MQ">
			<input id="searchString" name="searchString" class="mainQ" value="<?php echo $search_current_search_string?>" type="text">
			<input id="categoryRid" name="categoryRid" value="<?php echo $search_current_category_rid;?>" type="hidden">
			<input id="formAction" name="formAction" value="<?php echo $search_current_search_url;?>" type="hidden">
		</div>
		<span id="rgn_s" class="a" style="z-index: 9999; margin-left: -4px;">
		<?php echo $search_current_in_this_cat;?>
		</span>
	</div>
<?php echo form_close();?>
</div>
</div>
</div>
</div>
<iframe style="display: none;"></iframe></div>
</div>
