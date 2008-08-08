<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title><?php echo $metatitle_area_obj?></title>
	<meta name="description" content="<?php echo $metadescription_area_obj?>">
	<meta name="keywords" content="<?php echo $keywords_area_obj?>">	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="SHORTCUT ICON" href="<?php echo base_url()?>images/si.png">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/boxes1.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/blocks2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/carousel.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/catcarousel.css">
	<script type="text/javascript" src="<?php echo base_url()?>javascript/prototype.js"></script> 
	<script type="text/javascript" src="<?php echo base_url()?>javascript/scriptaculous.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>javascript/carousel.js"></script>  	
	<script type="text/javascript" src="<?php echo base_url()?>javascript/catcarousel.js"></script>  	
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
</head>
<body id="mainBody" style="text-align: center;">
<center>
	<div class="md" id="" style="">
		<!-- { Top header area  -->
		<div class="topMN">
			<div style="float: left;">
				<span id="aset">
				</span>
			</div>
			<div style="margin-left: 60%; text-align: right;">
			</div>
		</div>
		<!-- } Top header area  -->
		<div id="main_cnt">
			<table style="margin: 0pt; padding: 0pt; width: 100%; font-size: 100%;" border="0">
				<tbody>
					<tr>
						<td>
							<?php echo $search_bar_obj;?>
						</td>
					</tr>
				</tbody>
			</table>

<table style="margin: -3px 0pt 0pt; padding: 0pt; width: 100%; font-size: 100%;" border="0">
	<tbody>
		<tr>
			<td id="left" style="width: 170px; min-width: 170px; max-width:170px;">
			
				<!-- { Login area -->
				<?php echo $login_area_obj;?>				
				<!-- } Login area -->
				
				<!-- { Advertizing area -->
				<?php 
					$imgSTR = "<img src=\"".base_url()."/images/adv/free_price.gif\" border=0>";
					echo '<a href="'.index_page().'/advertize'.'">'.$imgSTR.'</a>'; 
				?>
				<!-- } Advertizing area -->
				
				<!-- { Quickmenu area -->
				<?php echo $quickmenu_area_obj;?>				
				<!-- } Quickmenu area -->
				
				<!--  { Linkchanges -->
				<?php echo $linkchanges_area_obj;?>
				<!--  { Linkchanges -->
				
				<!-- { Advertising -->
				<?php echo $googleads_left_obj;?>
				<!-- { Advertising -->
			</td>
<td class="cTD">
	<!-- { Categoeries -->
	<?php echo $categories_table_obj;?>
	<!-- } Categoeries -->

	<!-- { Rated products -->
	<?php echo $mostpopular_categories_carousel_obj;?>
	<!-- } Rated products -->

	<!-- { Advertising -->
	<?php echo $advertise_center_obj;?>		
	<!-- } Advertising -->		

	<!-- { What Is It info -->
	<?php echo $whatisit_area_obj;?>		
	<!-- } What Is It info -->		

	<!-- { Last updates -->
	<?php echo $last_area_obj;?>
	<!-- } Last updates -->

	<!-- { How It Works info -->
	<?php echo $howitworks_area_obj;?>		
	<!-- } How It Works info -->		

	<!-- { Contactstoolbar area -->
	<?php echo $contactstoolbar_area_obj;?>
	<!-- } Contactstoolbar area -->		
	
</td>
<td class="right" width="240">
	
	<!-- { Settings area -->
	<?php echo $settings_area_obj;?>
	<!-- } Settings area -->

	<!-- { Rating recomend area -->
	<?php echo $rating_recomend_obj;?>
	<!-- } Rating recomend area -->

	<!-- { Mostpopular area -->
	<?php echo $mostpopular_area_obj;?>
	<!-- } Mostpopular area -->

	<!-- { Advertising -->
	<?php echo $advertise_right_obj;?>
	<!-- { Advertising -->

	<!-- { Mostpopular searches -->
	<?php echo $mostpopular_searches_obj;?>
	<!-- { Mostpopular searches -->

	<!-- { Advertising -->
	<?php echo $googleads_right_obj;?>
	<!-- { Advertising -->

	<!-- { Siclub login area  -->
	<?php echo $siclub_loginarea_obj;?>
	<!-- { Siclub login area -->

</td>
</tr></tbody></table>



</div>
<div style="width: 100%; clear: both; text-align: center;">
	
<div class="topMenu" style="text-align: right; padding-right: 10px;">

	<!-- { Footer menu -->
	<?php echo $footermenu_area_obj;?>
	<!-- { Footer menu -->

<span id="footer_end" style="white-space: nowrap; height: 20px; line-height: 20px; font-size: 8pt;">
Copyright © 2006-2008 <a href="<?php echo base_url().index_page() ?>" class="c69" style="font-size: 100%;">Saleinform</a>&nbsp;&nbsp;All rights reserved
</span>
</div>
<div style="display:none;">
<!-- { Bigmir stats -->	

<!--bigmir)net TOP 100-->
<script type="text/javascript" language="javascript"><!--
function BM_Draw(oBM_STAT){
document.write('<table cellpadding="0" cellspacing="0" border="0" style="display:inline;margin-right:4px;"><tr><td><div style="margin:0px;padding:0px;font-size:1px;width:88px;"><div style="background:url(\'http://i.bigmir.net/cnt/samples/diagonal/b60_top.gif\') no-repeat bottom;">&nbsp;</div><div style="font:10px Tahoma;background:url(\'http://i.bigmir.net/cnt/samples/diagonal/b60_center.gif\');"><div style="text-align:center;"><a href="http://www.bigmir.net/" target="_blank" style="color:#0000ab;text-decoration:none;font:10px Tahoma;">bigmir<span style="color:#ff0000;">)</span>net</a></div><div style="margin-top:3px;padding: 0px 6px 0px 6px;color:#426ed2;"><div style="float:left;font:10px Tahoma;">'+oBM_STAT.hosts+'</div><div style="float:right;font:10px Tahoma;">'+oBM_STAT.hits+'</div></div><br clear="all"/></div><div style="background:url(\'http://i.bigmir.net/cnt/samples/diagonal/b60_bottom.gif\') no-repeat top;">&nbsp;</div></div></td></tr></table>');
}
//-->
</script>
<script type="text/javascript" language="javascript"><!--
bmN=navigator,bmD=document,bmD.cookie='b=b',i=0,bs=[],bm={o:1,v:171117,s:171117,t:0,c:bmD.cookie?1:0,n:Math.round((Math.random()* 1000000)),w:0};
for(var f=self;f!=f.parent;f=f.parent)bm.w++;
try{if(bmN.plugins&&bmN.mimeTypes.length&&(x=bmN.plugins['Shockwave Flash']))bm.m=parseInt(x.description.replace(/([a-zA-Z]|s)+/,''));
else for(var f=3;f<20;f++)if(eval('new ActiveXObject("ShockwaveFlash.ShockwaveFlash.'+f+'")'))bm.m=f}catch(e){;}
try{bm.y=bmN.javaEnabled()?1:0}catch(e){;}
try{bmS=screen;bm.v^=bm.d=bmS.colorDepth||bmS.pixelDepth;bm.v^=bm.r=bmS.width}catch(e){;}
r=bmD.referrer.slice(7);if(r&&r.split('/')[0]!=window.location.host){bm.f=escape(r);bm.v^=r.length}
bm.v^=window.location.href.length;for(var x in bm)if(x==='o'||x=='v'||x=='s'||x=='t'||x=='c'||x=='n'||x=='w'||x=='m'||x=='y'||x=='d'||x=='r'||x=='f')bs[i++]=x+bm[x];
bmD.write('<sc'+'ript type="text/javascript" language="javascript" src="http://c.bigmir.net/?'+bs.join('&')+'"></sc'+'ript>');
//-->
</script>
<!--bigmir)net TOP 100-->
</div>
<!-- { Bigmir stats -->	
<div style="margin-right:5px;">
<!--begin of Rambler's Top100 code -->
<a href="http://top100.rambler.ru/top100/">
<img src="http://counter.rambler.ru/top100.cnt?1200866" alt="" width=1 height=1 border=0></a>
<!--end of Top100 code-->
<!--begin of Top100 logo-->
<a href="http://top100.rambler.ru/top100/">
<img src="http://top100-images.rambler.ru/top100/banner-88x31-rambler-gray2.gif" alt="Rambler's Top100" width=88 height=31 border=0></a>
<!--end of Top100 logo -->
</div>
</div>
</div>
</center>
<div>
<center>
<div style="font-size: 80%;color:#D2D2D2;">
	Generation Time <?php echo $this->benchmark->elapsed_time(); ?> s. Memory Usage <? echo $this->benchmark->memory_usage();?>
</div>
</center>
</div>
<script type="text/javascript">_uacct = "UA-2175735-1";urchinTracker();</script> 
</body>
</html>