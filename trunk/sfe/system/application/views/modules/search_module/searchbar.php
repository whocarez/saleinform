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
	<div>
		<ul id="vsearchtabs">
		<?php $theFirst = true; $currNum = 0; foreach($header_items as $key=>$item) { $currNum++;?>
			<li <?php if($theFirst) {$theFirst = False;?>class="first on"<?php } ?>>
				<a href="<?php echo $item[1]?>">
					<?php echo ($search_current_header_item==$key)?('<strong>'.$item[0].'</strong>'):$item[0];?>
				</a>
			</li>	
		<?php } ?>
			<li class="last ignore">
				<dl id="vsearchm">
					<script type="text/javascript">
						function ShowMore(){
							if($('vsearchmore').hasClassName('on')) {
								$('vsearchmore').removeClassName('on');
								$('vslist').hide();
							}
							else {
								$('vsearchmore').addClassName('on');
								$('vslist').show();
							}
						}
					</script>
					<dt>
						<a href="#" id="vsearchmore" onclick="ShowMore();">More</a>
					</dt>
					<dd id="vslist" style="display: none;">
						<div>
							<ul>
								<li class="first">
									<a class="vs_answers" href="r/av/*http://answers.yahoo.com/search/search_result">Answers</a>
								</li>
								<li>
									<a class="vs_audio" href="r/aw/*-http://audio.search.yahoo.com/search/audio">Audio</a>
								</li>
								<li>
									<a class="vs_directory" href="r/b0/*-http://search.yahoo.com/search/dir">Directory</a>
								</li>
								<li>
									<a class="vs_jobs" href="r/b4/*-http://hotjobs.yahoo.com/job-search">Jobs</a>
								</li>
								<li>
									<a class="vs_news" href="r/b1/*-http://news.search.yahoo.com/search/news">News</a>
								</li>
								<li class="last">
									<a href="r/cq">All Search Services</a>
								</li>
							</ul>
						</div>
					</dd>
				</dl>
			</li>		
		</ul>
	</div>
	<div class="left" style="float: left; text-align: center; width: 260px;">
		<a href="<?php echo site_url(); ?>"> 
			<img style="position: relative;background-color: transparent;" src="<?php echo base_url();?>/images/logo.png" alt="<?php echo $logo_title; ?>" border="0" height="36" width="250">
		</a>
	</div>
	<div style="margin: 0px 20px 0px 265px;">

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

