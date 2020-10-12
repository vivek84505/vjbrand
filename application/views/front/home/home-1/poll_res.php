<?php
	$total =0;
	foreach($option as $row){
		$total = $total+ $row['count'];
	}
	foreach($option as $row){
		$count = $row['count'];
		$result = round(($count/$total)*100,2);
?>
<div>
	<label for="result">
		<?php echo $row['title'];?>
	</label>
	<div class="progress" id="result">
		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $result;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $result;?>%;">
			<?php echo $result;?>%
		</div>
	</div>
</div>
<?php }?>