<?php
	$total =0;
	foreach($option as $row){
		$total = $total+ $row['count'];
	}
	foreach($option as $row){
		$count = $row['count'];
		if($count !== 0){
			$result = round(($count/$total)*100,2);
		}else{
			$result = 0;
		}
?>
<div class="result_option">
	<label for="result">
		<?php echo $row['title'];?>
	</label>
	<div class="progress" id="result">
		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $result;?>" aria-valuemin="10" aria-valuemax="100" style="width: <?php echo $result+10;?>%;">
			<?php echo $result;?>%
		</div>
	</div>
</div>
<?php }?>
<div class="btns" style="display:flex;">
    <button id="back_to_option" onClick="option_show();" class="button-custom-btn-1 btn-block custom-btn-1-round-s custom-btn-1 letter-spacing-none custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('back_to_options'); ?>">		
        <span><i class="fa fa-arrow-left"></i></span>
    </button>
</div>