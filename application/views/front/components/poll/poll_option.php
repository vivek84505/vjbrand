<div class="widget widget_box poll_box">
<?php
	$this->db->limit('1'); 
	$this->db->order_by('poll_id', 'desc');
	$this->db->where('status','published');
	$poll = $this->db->get('poll')->result_array();
	foreach($poll as $rows){
		$option = json_decode($rows['options'],true);
?>	
	<input type="hidden" value="<?php echo $rows['poll_id'];?>" id="poll_id"/>
	<div class="thumbnail box" id="poll_form">
    	<div class="caption">
            <h3 class="caption-title">
                <?php echo translate($rows['question']);?>
            </h3>
        </div>
		<div class="inner_div" id="poll_vote">
			<?php 
				$i= 0;
				foreach($option as $row){
					$i++;
			?>
                <div class="radio">
                    <input type="radio" name="answer" value="<?php echo $row['index'];?>" id="poll<?php echo $i; ?>"/>
                    <label for="poll<?php echo $i; ?>"><?php echo translate($row['title']);?></label>
                </div>
			<?php }?>
			<div class="btns" style="display: flex;">
				<button class="btn btn-info col-md-6" type="submit" id="vote_poll" onClick="vote_poll()"><?php echo translate('vote'); ?></button>
				<button class="btn btn-primary col-md-6" id="poll_res_btn" onClick="result_show()"><?php echo translate('result'); ?></button>
			</div>
		</div>
		<div class="inner_div" id="poll_res" style="display:none;">
			
	   </div>
	</div>
<?php }?>
</div>
<script>
function vote_poll(){
	var poll_id = $("#poll_id").val();
	var index=$('input[name="answer"]:checked').val();
	$.ajax({
		url: '<?php echo base_url();?>home/poll/vote/'+poll_id+'/'+index
	});
	if(typeof(index) !== "undefined"){
		if (typeof(Storage) !== "undefined") {
			var poll_list=localStorage.getItem("poll_storage");
			if(poll_list == null){
			var set=['0'];
				localStorage.setItem("poll_storage",JSON.stringify(set));
				poll_list=localStorage.getItem("poll_storage");
			}
			var poll= JSON.parse(poll_list);
			if(jQuery.inArray(poll_id, poll) == -1)
			{
				poll.push(poll_id);
			}
			localStorage.setItem("poll_storage",JSON.stringify(poll));
		}
		setTimeout(function() {
			result_show();
			setTimeout(function() {
				$('#back_to_option').hide();
			},300);
		},500);
	}
}
function result_show(){
	$('#poll_vote').hide();
	$('#poll_res').show();
	var poll_id = $("#poll_id").val();
	$('#poll_res').load('<?php echo base_url();?>home/poll/res/'+poll_id);
}
function option_show(){
	$('#poll_res').hide();
	$('#poll_vote').show();
}
function display(){
	var poll_list=localStorage.getItem("poll_storage");
	if(poll_list == null){
		var set=['0'];
		localStorage.setItem("poll_storage",JSON.stringify(set));
		poll_list=localStorage.getItem("poll_storage");
	}
	var poll_id = $("#poll_id").val();
	var polls= JSON.parse(poll_list);
	if(jQuery.inArray(poll_id, polls) !== -1){
		var user_ext= "true";
	}
	else{
		var user_ext= "false";
	}
	if(user_ext=="true"){
		$('#poll_vote').hide();
		result_show();
		setTimeout(function() {
			$('#back_to_option').hide();
		},1000);
		
	}
	else if(user_ext=="false"){
		$('#poll_res').hide();
		$('#poll_vote').show();
	}
}
$(document).ready(function() {
	display();
});
</script>