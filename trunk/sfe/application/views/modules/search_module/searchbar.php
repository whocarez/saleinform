<div class="zs">
        <div class="home-top-left">
        </div>
        <div class="home-top-right">
        </div>
        <div class="home-slogan">
        </div>
        <div class="fq2">
        <h4><?=lang('SEARCH_TITLE')?></h4>
        <?=form_open('', array('id'=>"searchForm", 'name'=>"searchForm"))?>
        	<?=form_input(array('id'=>"searchString", 'name'=>"searchString", 'class'=>"mainQ", 'value'=>""))?>
        	<?=form_button(array('name'=>"searchBtn", 'class'=>"searchSubmit", 'value'=>lang('SEARCH_GO_1'), 'content'=>lang('SEARCH_GO_1')))?>
        <?=form_close();?>
        </div>
</div>


