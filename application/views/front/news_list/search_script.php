<?php
	echo form_open(base_url() . 'home/ajax_news_list/', array(
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
function set_intro(cat,subcat){
	$('#intro').load("<?php echo base_url()?>home/set_intro/"+cat+"/"+subcat);
}
function clear_others(){
	$('#search_input').val('');
	$("#order_by option[value='none']").prop('selected', true);
	load_date('none');
}
function load_date(callback){
	var st_date = $('#st_date').val();
	var en_date = $('#en_date').val();
	$('#date_place').load("<?php echo base_url()?>home/load_date/"+st_date+'/'+en_date,function(){
		if(callback == 'filter'){
			filter_news('0');
		}
	});
}
$('.cat_search').on('click',function(e){
	var cat_selected = $(this).data('cat');
	$(this).addClass('activate_cat');
	$('#cur_cat').val(cat_selected);
	$('#cur_subcat').val('0');
	clear_others();
	$('li').removeClass('active');
	$('.cat_search').removeClass('active');
	setTimeout(function(){
		if($('.activate_cat').closest('li').hasClass('parent') == false){
			$('.activate_cat').closest('li').addClass('active');
			$('.activate_cat').removeClass('activate_cat');
		}else{
			$('.activate_cat').addClass('active');
			$('.activate_cat').removeClass('activate_cat');
		}
		set_intro(cat_selected,'0'); 
		filter_news('0'); 
	}, 500);
});
$('.subcat_search').on('click',function(e){
	var cat_selected = $(this).closest('.parent').find('.cat_search').data('cat');
	var subcat_selected = $(this).data('sub');
	$(this).addClass('activate_sub');
	$('#cur_cat').val(cat_selected);
	$('#cur_subcat').val(subcat_selected);
	clear_others();
	$('.cat_search').removeClass('active');
	$('li').removeClass('active');
	setTimeout(function(){
		$('.activate_sub').closest('li').addClass('active');
		$('.activate_sub').removeClass('activate_sub');
		set_intro(cat_selected,subcat_selected); 
		filter_news('0'); 
	}, 500);
});
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

$(document).ready(function() {
	load_date('filter');
	setTimeout(function(){
		$('.cat_search').each(function(){
			var cat = $(this).data('cat');
			var selected_cat = $('#cur_cat').val();
			if(cat == selected_cat){
				if($(this).closest('li').hasClass('parent') == true){
					$(this).closest('.parent').find('span.arrow').click();
					$(this).closest('.parent').find('.subcat_search').each(function(){
						var sub_cat = $(this).data('sub');
						var selected_subcat = $('#cur_subcat').val();
						if(sub_cat == selected_subcat){
							$(this).closest('li').addClass('active');
						}
					});
				}else{
					$(this).closest('li').addClass('active');
				}
			}
		});
		$('#order_by').selectpicker(); 
	},1000);
	var header_search_text = $('#header_search_text').val();
	if(header_search_text !== ""){
		header_search_text = header_search_text.replace(/%20/g,' ');
		$('#search_input').val(header_search_text);
	}
	setTimeout(function(){
		set_intro($('#cur_cat').val(),$('#cur_subcat').val()); 
	}, 500);
});
</script>