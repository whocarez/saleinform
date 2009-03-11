<div class="edit-review-header">
	<span class="header-text">
		<?=lang('CLIENTS_MY_REVIEW')?>
	</span>
</div>
<table width="100%">
<tr>
<td>
<div class="review-client-header">
	<?=anchor('client/'.$client->rid.'-'.$client->slug, $client->name, 'title="'.$client->name.'"')?>
</div>
<div class="review-content">
<?=form_open('clients/editreview/'.$client->rid.'-'.$client->slug, $client->name)?>
	<div class="review-content-header">
		<?=lang('CLIENTS_WRITE_REVIEW')?>
	</div>
	<div class="review-descr">
		<?=lang('CLIENTS_REVIEW_DESCR')?>
	</div>	
	<?if(!$user) { ?>
	<div class="review-nolog">
		<?=sprintf(lang('CLIENTS_REVIEW_NOLOG'), anchor('accounts', lang('CLIENTS_REVIEW_TOAUTH'), 'target="_blank"'), anchor('accounts/register', lang('CLIENTS_REVIEW_TOREG'), 'target="_blank"'))?>
	</div>
	<? } ?>
	<?if(validation_errors()) { ?>
	<div class="review-error">
		<div class="review-error-header"></div>
		<div class="review-error-content">
		<?=validation_errors()?>
		</div>
	</div>
	<? } ?>
	<div class="content">
		<script src="<?php echo base_url()?>javascript/jquery.sexy-vote.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){
		    $('#rating').sexyVote({passiveImageSrc : '<?=base_url()?>images/ratings/reviewemptystar.gif',
		    	  activeImageSrc : '<?=base_url()?>images/ratings/reviewstar.gif',
		    	  messages:['',
		  		    	  '<?=lang('CLIENTS_MARK_1')?>', 
		  		    	  '<?=lang('CLIENTS_MARK_2')?>', 
		  		    	  '<?=lang('CLIENTS_MARK_3')?>', 
		  		    	  '<?=lang('CLIENTS_MARK_4')?>', 
		  		    	  '<?=lang('CLIENTS_MARK_5')?>'],
		  		  fn: function(e, score) {
		  		    	    $("input[name='mark']").val(score);
		  		  }		  		 
			});
		});			
		</script>
		<span class="rate-title">
			<?=lang('CLIENTS_MY_MARK')?>
		</span>
		<div id="rating"></div><br>
		<?=form_hidden('mark', set_value('mark'))?>
		<div class="review-title">
			<p><?=form_label(lang('CLIENTS_REVIEW_TITLE'), 'title')?></p>
			<img class="quote-left" width="20" height="15" alt="Quote-start" src="http://images.us.ciao.com/ius/images/icons/space.gif"/>
			<?=form_input('title', set_value('title'), 'id="title"')?>
			<img class="quote-right" width="20" height="15" alt="Quote-end" src="http://images.us.ciao.com/ius/images/icons/space.gif"/>
		</div>
		
		<div class="review-review">
			<p><?=form_label(lang('CLIENTS_REVIEW_REVIEW'), 'review')?></p>
			<?=form_textarea('review', set_value('review'), 'id="review"')?>
		</div>
		
		<div class="review-pos">
			<p><?=form_label(lang('CLIENTS_REVIEW_POS'), 'positive')?></p>
			<?=form_input('positive', set_value('positive'), 'id="positive"')?>
		</div>
	
		<div class="review-neg">
			<p><?=form_label(lang('CLIENTS_REVIEW_NEG'), 'negative')?></p>
			<?=form_input('negative', set_value('negative'), 'id="negative"')?>
		</div>
		
		<?=form_submit('save', lang('CLIENTS_SAVE'), 'class="save-button"')?>
	</div>
	<?=form_close()?>
</div>
</td>
<td width="300">
</td>
</tr>
</table>