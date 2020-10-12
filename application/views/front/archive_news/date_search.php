<div class="row" id="datepicker">
	<div class="col-md-4">
    	<input type="date" id="date_start" class="form-control" name="start" value="<?php if($st_date !== '0'){ echo $st_date; } ?>" style="margin-bottom:15px; border-radius: 4px;" placeholder="<?php echo translate('from'); ?>:" />
    </div>
    <div class="col-md-4">
    	<input type="date" id="date_end" class="form-control" name="end" value="<?php if($en_date !== '0'){ echo $en_date; } ?>" style="margin-bottom:15px; border-radius: 4px;" placeholder="<?php echo translate('to'); ?>:"/>
    </div>
    <div class="col-md-4">
        <button type="button" style="margin: 0px;" class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick custom-btn-1-round-s letter-spacing-none custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('search'); ?>">		
            <span id="date_search_btn"><?php echo translate('search'); ?></span>
        </button>
    </div>
</div>
<script>
$('#date_search_btn').on('click',function(e){
	var start_date = $('#start_date').val();
	var end_date = $('#end_date').val();
	setTimeout(function(){ 
		filter_news('0'); 
	}, 500);
});
</script>