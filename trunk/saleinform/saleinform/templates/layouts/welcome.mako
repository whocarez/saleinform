#-*-coding: utf-8 -*-
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	${h.h_tags.stylesheet_link('/css/style.css')}
	<link rel="SHORTCUT ICON" href="../img/si.png">
</head>
<body id="mainBody">
	<div class="md" id="" style="">
		<div id="main_cnt">
			<div>
				<%include file="/modules/navigator/maintopnav.mako"/>
			</div>
			<div>
				<%include file="/modules/search/searchbar.mako"/>
			</div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td id="left" style="width: 280px;">
						<%include file="/modules/categories/main.mako"/>
					</td>
					<td class="cTD">
					</td>
					<td class="right" width="240">
					</td>
				</tr>
			</table>
		</div>
		<div>
			<%include file="/modules/navigator/footernav.mako"/>
		</div>
	</div>
</body>
</html>