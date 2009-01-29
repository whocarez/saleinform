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
	${h.h_tags.stylesheet_link('/css/navigator.css')}
	${h.h_tags.stylesheet_link('/css/categories.css')}
	${h.h_tags.stylesheet_link('/css/search.css')}
	${h.h_tags.stylesheet_link('/css/stores.css')}
	<link rel="SHORTCUT ICON" href="../img/si.png">
</head>
<body id="mainBody">
	<div class="md" id="" style="">
		<div id="main_cnt">
			<div>
				<%include file="/modules/navigator/topnav.mako"/>
			</div>
			<div>
				<%include file="/modules/categories/topmenu.mako"/>
				<%include file="/modules/search/narrowbar.mako"/>
			</div>
			<div>
				<%include file="/modules/stores/list.mako"/>
			</div>
		</div>
		<div>
			<%include file="/modules/navigator/footernav.mako"/>
		</div>
	</div>
</body>
</html>