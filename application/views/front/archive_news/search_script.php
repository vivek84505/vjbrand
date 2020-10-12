<?php
	echo form_open(base_url() . 'home/archive_ajax_news_list/', array(
		'class' => 'form-horizontal',
		'method' => 'post',
		'id' => 'filter_form'
	));
?>
	<input type="hidden" name="news_category" id="news_category" />
    <input type="hidden" name="news_sub_category" id="news_sub_category" />
    <input type="hidden" name="search_text" id="search_text" />
    <input type="hidden" name="order_by" id="order_by_value" />
    <input type="hidden" name="start_date" id="start_date" />
    <input type="hidden" name="end_date" id="end_date" />
</form>
    
<script>
function clear_others(){
	$('#search_input').val('');
	$("#order_by option[value='none']").prop('selected', true);
	load_date();
}
function load_date(){
	var st_date = $('#st_date').val();
	var en_date = $('#en_date').val();
	$('#date_place').load("<?php echo base_url()?>home/archive_load_date/"+st_date+'/'+en_date);
}
$('#archive_category').on('change',function(e){
	var cat_selected = $(this).closest('div').find("select option:selected").val();
	$('#cur_cat').val(cat_selected);
	$('#cur_subcat').val('0');
	var subcats = [$(this).find('option:selected').data('sub')];
	$('#archive_subcat_place').load('<?php echo base_url();?>home/get_subcat_archive/'+subcats,function(e){
		$('#archive_sub_category').selectpicker();
	});
	clear_others();
	setTimeout(function(){
		filter_news('0'); 
	}, 500);
});
function subwise_search(now){
	var cat_selected = $('#archive_category').closest('div').find("select option:selected").val();
	var subcat_selected = $(now).closest('div').find("select option:selected").val();
	$('#cur_cat').val(cat_selected);
	$('#cur_subcat').val(subcat_selected);
	clear_others();
	setTimeout(function(){
		filter_news('0'); 
	}, 500);
};
$('#text_search_btn').on('click',function(e){
	var text = $('#search_input').val();
	setTimeout(function(){ 
		filter_news('0'); 
	}, 500);
});
$('#order_by').on('change',function(e){
	var order_by = $(this).closest('.widget').find("select option:selected").val();
	setTimeout(function(){ 
		filter_news('0'); 
	}, 500);
});

function filter_news(page){
	$('#news_category').val($('#cur_cat').val());
	$('#news_sub_category').val($('#cur_subcat').val());
	$('#search_text').val($('#search_input').val());
	$('#order_by_value').val($("#order_by option:selected").val());
	$('#start_date').val($('#date_start').val());
	$('#end_date').val($('#date_end').val());
	
	var form = $('#filter_form');
	var place = $('#result');
	var formdata = false;
	if (window.FormData){
		formdata = new FormData(form[0]);
	}
	$.ajax({
		url: form.attr('action')+page+'/', // form action url
		type: 'POST', // form submit method get/post
		dataType: 'html', // request type html/json/xml
		data: formdata ? formdata : form.serialize(), // serialize form data 
		cache       : false,
		contentType : false,
		processData : false,
		beforeSend: function() {
			place.fadeOut();
			place.html('loading...').fadeIn(); // change submit button text
		},
		success: function(data) {
			setTimeout(function(){
				place.html(data); // fade in response data
			}, 20);
			setTimeout(function(){
				place.fadeIn(); // fade in response data
			}, 30);
		},
		error: function(e) {
			console.log(e)
		}
	});
	
}
function set_select(){
	$('.selectpicker').selectpicker();
}
$(document).ready(function() {
	load_date();
	if($('#cur_subcat').val() !== 0){
		var subcats = [$('#archive_category').find('option:selected').data('sub')];
		var cur_subcat = $('#cur_subcat').val();
		$('#archive_subcat_place').load('<?php echo base_url();?>home/get_subcat_archive/'+subcats+'/'+cur_subcat,function(e){
			$('#archive_sub_category').selectpicker();
		});
	}
	var header_search_text = $('#header_search_text').val();
	if(header_search_text !== ""){
		header_search_text = header_search_text.replace(/%20/g,' ');
		$('#search_input').val(header_search_text);
	}
	setTimeout(function(){ 
		set_select();
		filter_news('0'); 
	}, 500);
});
</script>