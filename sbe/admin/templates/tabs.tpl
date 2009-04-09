<div class="block_tabs block_tabs">
    <ul class="tabs" name="{$tabs_Name}">
    {foreach item=tab from=$tabs name=tabloop}
        {if $tab.current == 1}
        <li name="{$tab.name}" onclick="{$tab.event}" class="ActiveTab"><a href="{$tab.url}"><h2 class="listado">{$tab.caption}</h2></a></li>
        {else}
        {if $smarty.foreach.tabloop.index == 0 }
        {else}
        {/if}
        <li name="{$tab.name}" onclick="{$tab.event}" class="InactiveTab"><a href="{$tab.url}"><h2 class="listado">{$tab.caption}</h2></a></li>
        {/if}
    {/foreach}
		<li>&nbsp;&nbsp;<a href="javascript:setLanguage('en');"><img src="../images/languages/lang_en.gif" border="0" alt="English"></a>&nbsp;&nbsp;<a href="javascript:setLanguage('es');"><img src="../images/languages/lang_es.gif" border="0" alt="Spanish"></a></li>
	</ul>	
    <div class="clear"></div>
</div>
