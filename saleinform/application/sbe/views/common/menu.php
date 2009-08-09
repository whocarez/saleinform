<?
	function menu_build($items){
		foreach($items as $item){
			if($item['childNodes']){
				echo '<li class="accessible">';
				echo anchor($item['item_controller'].'/mrid/'.$item['rid'], $item['item_name'].' »', "title=\"{$item['descr']}\"");
					echo '<ul>';
						menu_build($item['childNodes']);
					echo '</ul>';
				echo '</li>'; 
			} else {
				echo '<li>'.anchor($item['item_controller'].'/mrid/'.$item['rid'], $item['item_name'], "title=\"{$item['descr']}\"").'</li>';
			}
		}
	}
?>
<div class="container">
	<div class="span-24 last">
		<ul class="jd_menu">
				<?menu_build($items)?>
		</ul>
	</div>
</div>