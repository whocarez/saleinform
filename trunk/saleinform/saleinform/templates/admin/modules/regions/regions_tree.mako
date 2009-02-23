<script type="text/javascript">
<!--
var simpleTreeCollection;
$(document).ready(function(){
	simpleTreeCollection = $('.simpleTree').simpleTree({
		autoclose: true,
		afterClick:function(node){
			//alert("text-"+$('span:first',node).text());
		},
		afterDblClick:function(node){
			//alert("text-"+$('span:first',node).text());
		},
		afterMove:function(destination, source, pos){
			//alert("destination-"+destination.attr('id')+" source-"+source.attr('id')+" pos-"+pos);
		},
		afterAjax:function()
		{
			//alert('Loaded');
		},
		animate:true
		//,docToFolderConvert:true
	});
});
//-->
</script>
<br>
<h3>${_(u'Регионы и города')}</h3>
<ul class="simpleTree">
<li class="root"><span>${_(u'Страны, регионы и города')}</span>
	<ul>
% for country in c.a_countries:
		<li id='country${country.rid}'><span>${country.name}(${country.code})</span>
			${h.h_tags.link_to(h.h_tags.image('/img/icons/add.png', alt=_(u'Добавить регион'), border="0"), '/admin/regions/rp?_countries_rid=%s'%country.rid, title=_(u'Добавить регион'))}
			<ul class="ajax">
				<li>{url:/admin/regions/get?country=${country.rid}}</li>
			</ul>
		</li>
% endfor
	</ul>
</li>
</ul>
