<div class="login_modal" style="display:none;">
	<span class="openactiveModal-6 manualLabel" id="login_modal" data-ajax=""></span>
</div>
<div id="popup-1" class="activeModal" style="z-index: 999990;">
    <div class="window window1">
        <div class="window_set row" >
        
        </div>
    </div>
</div>

<div class="image_modal" style="display:none;">
	<span class="openactiveModal-7 manualLabel" id="image_modal" data-ajax=""></span>
</div>
<div id="popup-2" class="activeModal" style="z-index: 999990;">
    <div class="window window1 image_modal_window" style="max-height: 100vh; overflow-y:auto;">
        <div class="window_set row">
        
        </div>
    </div>
</div>

<div class="preview_ad_modal" >
	<span class="openactiveModal-8 manualLabel" id="preview_ad_modal" data-ajax=""></span>
</div>
<div id="popup-3" class="activeModal" style="z-index: 999990;">
    <div class="window window1">
        <div class="window_set row">
        
        </div>
    </div>
</div>

<div class="preview_package_modal" style="display:none;">
	<span class="openactiveModal-9 manualLabel" id="preview_package_modal" data-ajax=""></span>
</div>
<div id="popup-4" class="activeModal" style="z-index: 999990;">
    <div class="window window1">
        <div class="window_set row">
        
        </div>
    </div>
</div>

<div class="be_blogger_modal" style="display:none;">
	<span class="openactiveModal-10 manualLabel" id="be_blogger_modal" data-ajax=""></span>
</div>
<div id="popup-5" class="activeModal" style="z-index: 999990;">
    <div class="window window1">
        <div class="window_set row">
        
        </div>
    </div>
</div>

<div class="purchased_packages_modal" style="display:none;">
	<span class="openactiveModal-11 manualLabel" id="purchased_packages_modal" data-ajax=""></span>
</div>
<div id="popup-6" class="activeModal" style="z-index: 999990;">
    <div class="window window1">
        <div class="window_set row">
        
        </div>
    </div>
</div>
<style type="text/css">
	.img-bg {
		height: 100%;
		width: 100%;
		z-index: -1;
		background-position: 50% 50%;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		background-size: cover;
		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		transition: all .5s;
		-webkit-transform: scale(1);
		-moz-transform: scale(1);
		transform: scale(1);
	}
</style>
<script>
	var base_url = '<?php echo base_url(); ?>'; 
	var readlater_added = '<?php echo translate('news_added_to_readlater_list'); ?>';
	var readlater_already = '<?php echo translate('news_already_in_readlater_list'); ?>';
	var readlater_remove = '<?php echo translate('news_removed_from_readlater_list'); ?>';
	var working = '<?php echo translate('working..'); ?>';
	var subscribe_already = '<?php echo translate('you_already_subscribed'); ?>';
	var subscribe_success = '<?php echo translate('you_subscribed_successfully'); ?>';
	var subscribe_sess = '<?php echo translate('you_already_subscribed_thrice_from_this_browser'); ?>';
	var logging = '<?php echo translate('logging_in..'); ?>';
	var login_success = '<?php echo translate('you_logged_in_successfully'); ?>';
	var login_fail = '<?php echo translate('login_failed!_try_again!'); ?>';
	var logup_success = '<?php echo translate('you_have_registered_successfully'); ?>';
	var logup_fail = '<?php echo translate('registration_failed!_try_again!'); ?>';
	var logging = '<?php echo translate('logging_in..'); ?>';
	var submitting = '<?php echo translate('submitting..'); ?>';
	var email_sent = '<?php echo translate('email_sent_successfully'); ?>';
	var email_noex = '<?php echo translate('email_does_not_exist!'); ?>';
	var email_fail = '<?php echo translate('email_sending_failed!'); ?>';
	var logging = '<?php echo translate('logging_in'); ?>';	
	var required = '<?php echo translate('the_field_is_required'); ?>';
	var mbn = '<?php echo translate('must_be_a_number'); ?>';
	var mbe = '<?php echo translate('must_be_a_valid_email_address'); ?>';
	var valid_email = '<?php echo translate('enter_a_valid_email_address'); ?>';
	var applying = "<?php echo translate('applying..'); ?>";
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('body').on('click','.pfp_submit',function(){
	    	$('.closeModal').click();
			$('#pfp_submit').click();
	    });

	    $('body').on('click','.pfp_image_submit',function(){
	    	$('.closeModal').click();
			$('#pfp_image_submit').click();
	    });

	    $('body').on('click','.pfp_video_submit',function(){
	    	$('.closeModal').click();
			$('#pfp_video_submit').click();
	    });

		$('.top-bar-right').load('<?php echo base_url(); ?>home/load_log_info');
		$('.signup').load('<?php echo base_url(); ?>home/load_log_info_1');
		window.addEventListener("keydown", checkKeyPressed, false);
		function checkKeyPressed(e) {
			if (e.keyCode == "13") {
				$(":focus").each(function() {
					event.preventDefault();
					$(this).closest('form').find('.enterer').click();
				});
			}
		}
		
		$('body').on('click','.logup_btn', function(){
			var here = $(this); // alert div for show alert message
			var form = here.closest('form');
			var can = '';
			var ing = here.data('ing');
			var msg = here.data('msg');
			var prv = here.html();
			
			//var form = $(this);
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
			
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					here.html(ing); // change submit button text
				},
				success: function(data) {					
					here.fadeIn();
					here.html(prv);
					if(data == 'done'){
						notify(logup_success,'success','bottom','right'); 
						setTimeout(
							function() {
								location.replace("<?php echo base_url(); ?>home/login_set/login");
							}, 2000
						);
						//sound('successful_logup');  		
					}else if(data == 'done_and_sent'){
						notify(logup_success+'<br>'+email_sent,'success','bottom','right');
						setTimeout(
							function() {
								location.replace("<?php echo base_url(); ?>home/login_set/login");
							}, 2000
						);
					}else if(data == 'done_but_not_sent'){
						notify(email_fail,'warning','bottom','right');
						notify(logup_success,'success','bottom','right');
						setTimeout(
							function() {
								location.replace("<?php echo base_url(); ?>home/login_set/login");
							}, 2000
						);
					} else {
						//here.closest('.modal-content').find('#close_logup_modal').click();
						notify('Signup failed'+'<br>'+data,'warning','bottom','right');
						//sound('unsuccessful_logup');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		});
			
		$("body").on('click','.login_btn',function(){
			var here = $(this); // alert div for show alert message
			var text = here.html(); // alert div for show alert message
			var form = here.closest('form');
			var logging = here.data('ing');
			//var form = $(this);
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					here.addClass('disabled');
					here.html(logging); // change submit button text
				},
				success: function(data) {
					here.fadeIn();
					here.html(text);
					here.removeClass('disabled');
					if(data == 'done'){
						$('.closeModal').click();
						notify('<?php echo translate('successful_login'); ?>','success','bottom','right');
						setTimeout(function(){reload_page()}, 2000);
						//sound('successful_login');
					} else if(data == 'failed'){
						notify('<?php echo translate('login_failed'); ?>','warning','bottom','right');
						//sound('unsuccessful_login');
					} else {
						notify(data,'warning','bottom','right');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		});
		
		$("body").on('click','.forget_btn',function(){
			var here = $(this); // alert div for show alert message
			var text = here.html(); // alert div for show alert message
			var form = here.closest('form');
			var submitting = here.data('ing');
			//var form = $(this);
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					here.addClass('disabled');
					here.html(submitting); // change submit button text
				},
				success: function(data) {
					here.fadeIn();
					here.html(text);
					here.removeClass('disabled');
					if(data == 'email_sent'){
						notify(email_sent,'info','bottom','right');
						$(".closeModal").click();
					} else if(data == 'email_nay'){
						$(".closeModal").click();
						notify(email_noex,'info','bottom','right');
					} else if(data == 'email_not_sent'){
						$(".closeModal").click();
						notify(email_fail,'info','bottom','right');
					} else {
						notify(data,'warning','bottom','right');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		});
	});
	function reload_page(){
		var loc = location.href;
		location.replace(loc);
	}
	function check_login_stat(thing){
		return $.ajax({
			url: '<?php echo base_url(); ?>home/check_login/'+thing
		});
	}
	function signin(carry){
		$('#login_modal').data('ajax','<?php echo base_url(); ?>home/login_set/login/modal/'+carry);
		$('#login_modal').click();
	}
	function image_modal(image_link){
		image_link = image_link.split('<?php echo base_url(); ?>');
		var path   = image_link[1];
		path 	   = path.split('/');
		var folder = path[1];
		var name   = path[2];
		$('#image_modal').data('ajax','<?php echo base_url(); ?>home/image_modal/'+folder+'/'+name);
		$('#image_modal').click();
	}
	function preview_ad_modal(id){
		$('#preview_ad_modal').data('ajax','<?php echo base_url(); ?>home/marketing/preview/'+id);
		$('#preview_ad_modal').click();
	}
	function preview_remainings(id){
		$('#preview_ad_modal').data('ajax','<?php echo base_url(); ?>home/preview_package_remainings/'+id+'/blog');
		$('#preview_ad_modal').click();
	}

	function preview_image_remainings(id){
		$('#preview_ad_modal').data('ajax','<?php echo base_url(); ?>home/preview_package_remainings/'+id+'/image');
		$('#preview_ad_modal').click();
	}

	function preview_video_remainings(id){
		$('#preview_ad_modal').data('ajax','<?php echo base_url(); ?>home/preview_package_remainings/'+id+'/video');
		$('#preview_ad_modal').click();
	}

	function preview_package(id){
		$('#preview_package_modal').data('ajax','<?php echo base_url(); ?>home/marketing/preview_package/'+id);
		$('#preview_package_modal').click();
	}
	function be_blogger(){
		$('#be_blogger_modal').data('ajax','<?php echo base_url(); ?>home/be_blogger');
		$('#be_blogger_modal').click();
	}
	function package_details(id){
		$('#purchased_packages_modal').data('ajax','<?php echo base_url(); ?>home/purchased_packages/'+id);
		$('#purchased_packages_modal').click();
	}
	function notify(message,type,from,align){		
		$.notify({
			// options
			message: message 
		},{
			// settings
			type: type,
			placement: {
				from: from,
				align: align
			}
		});
	}
	$("body").on('click','.news_post',function(){
		var here = $(this); 
		var form = here.closest('form');
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		$.ajax({
			url: form.attr('action'), // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			success: function() {
				get_news('list');
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
	$('body').on('click','.signup_btn',function(event){
		event.preventDefault();
		var now = $(this);
		var btntxt = now.html();
		var form = now.closest('form');  
		var ing = now.data('ing');
		var success = now.data('success');
		var unsuccessful = now.data('unsuccessful');
		var rld = now.data('reload');
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}

		$.ajax({
			url: form.attr('action'), // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				now.html(ing);
			},
			success: function(data) {
				if(data == 'done'){
					notify(success,'success','bottom','right');
					if(rld == 'ok'){
						setTimeout(function(){reload_page()}, 2000);
					} else if (rld == 'blog_list'){
						get_blog_list();
					}
					$(".closeModal").click();
				} else {
					var text = '<div>'+unsuccessful+'</div>'+data;
					notify(text,'warning','bottom','right');
				}
				now.html(btntxt);
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
		
	function form_submit(form_id){
		var form = $('#'+form_id);
		var button = form.find('.submit_button');
		var prv = button.html();
		var ing = button.data('ing');
		var success = button.data('success');
		var unsuccessful = button.data('unsuccessful');
		var redirect_click = button.data('redirectclick');
		form.find('.summernotes').each(function() {
			var now = $(this);
			now.closest('div').find('.val').val(now.code());
		});
		
		//var form = $(this);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		
	
		$.ajax({
			url: form.attr('action'), // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				button.html(ing); // change submit button text
			},
			success: function(data) {
				var alls = data.split('#-#-#');
				var part1 = alls[0];
				var part2 = alls[1];
				if(part1 == 'success'){
					notify(success,'success','bottom','right');
					if(part2 == ''){
						$(redirect_click).click();
					} else {
						location.replace(part2);
					}
					form.find('input').val('');
					form.find('textarea').val('');
					form.find('textarea').html('');
				} else {
					var text = '<div>'+unsuccessful+'</div>'+part2;
					notify(text,'warning','bottom','right');
				}
				button.html(prv);
				
			},
			error: function(e) {
				console.log(e)
			}
		});		
	}
	
	function to_readlater(id,e){	
		e = e || window.event;
		e = e.target || e.srcElement;
		var state 		= check_login_stat('state');
		var news 		= id;
		var button 		= $(e);
		var alread 		= button.html();
		if(button.is("i")){
			var alread_classes = button.attr('class');	
		}		
		if(button.is("i")){
			button.attr('class','fa fa-spinner fa-spin fa-fw');	
		} else {
			button.find('i').attr('class','fa fa-spinner fa-spin fa-fw');	
		}	
		state.success(function (data) {
			if(data == 'hypass'){
				$.ajax({
					url: base_url+'home/readlater/add/'+news,
					beforeSend: function() {
						if(button.is("i")){
							button.attr('class','fa fa-spinner fa-spin fa-fw');	
						} else {
							button.find('i').attr('class','fa fa-spinner fa-spin fa-fw');	
						}	
					},
					success: function(data) {
						if(data == 'added'){
							notify(readlater_added,'info','bottom','right');
						}else if(data == 'already') {
							notify(readlater_already,'warning','bottom','right');
						}
						if(button.is("i")){
							button.attr('class',alread_classes);	
						} else {
							button.html(alread);	
						}
					},
					error: function(e) {
						console.log(e)
					}
				});
			} else {
				if(button.is("i")){
					button.attr('class',alread_classes);	
				} else {
					button.html(alread);	
				}
				signin('quick');
			}
		});
	}
	function set_modal(){
		$("#popup-1").activeModals({
			// Functionality
			popupType: "delayed",
			delayTime: 1000,
			exitTopDistance: 40,
			scrollTopDistance: 400,
			setCookie: false,
			cookieDays: 0,
			cookieTriggerClass: "setCookie-1",
			cookieName: "activeModal-1",
	
			// Overlay options
			overlayBg: true,
			overlayBgColor: "rgba(255, 255, 255, 0.721569)",
			overlayTransition: "ease",
			overlayTransitionSpeed: "0.4",
	
			// Background effects
			bgEffect: "scaled",
			blurBgRadius: "2px",
			scaleBgValue: "1",
	
			// Window options
			windowWidth: "530px",
			windowHeight: "580px",
			windowLocation: "center",
			windowTransition: "fadeIn",
			windowTransitionSpeed: "0.4",
			windowTransitionEffect: "fadeIn",
			windowShadowOffsetX: "0",
			windowShadowOffsetY: "0",
			windowShadowBlurRadius: "20px",
			windowShadowSpreadRadius: "0",
			windowShadowColor: "none",
			windowBackground: "none",
			windowRadius: "0px",
			windowMargin: "10px",
			windowPadding: "10px",
	
			// Close and reopen button
			closeButton: "icon",
			reopenClass: "openactiveModal-6",
		});
		
		$("#popup-2").activeModals({
			// Functionality
			popupType: "delayed",
			delayTime: 1000,
			exitTopDistance: 40,
			scrollTopDistance: 0,
			setCookie: false,
			cookieDays: 0,
			cookieTriggerClass: "setCookie-1",
			cookieName: "activeModal-1",
	
			// Overlay options
			overlayBg: false,
			overlayBgColor: "rgba(255, 255, 255, 0.72)",
			overlayTransition: "ease",
			overlayTransitionSpeed: "0.4",
	
			// Background effects
			bgEffect: "scaled",
			blurBgRadius: "2px",
			scaleBgValue: "1",
	
			// Window options
			windowWidth: "auto",
			windowHeight: "auto",
			windowLocation: "center",
			windowTransition: "ease",
			windowTransitionSpeed: "0.4",
			windowTransitionEffect: "fadeIn",
			windowShadowOffsetX: "0",
			windowShadowOffsetY: "0",
			windowShadowBlurRadius: "20px",
			windowShadowSpreadRadius: "0",
			windowShadowColor: "rgba(0,0,0,.8)",
			windowBackground: "rgba(0, 0, 0, 0.8)",
			windowRadius: "0px",
			windowMargin: "10px",
			windowPadding: "30px",
	
			// Close and reopen button
			closeButton: "icon no2",
			reopenClass: "openactiveModal-7",
		});
		$("#popup-3").activeModals({
			// Functionality
			popupType: "delayed",
			delayTime: 1000,
			exitTopDistance: 40,
			scrollTopDistance: 400,
			setCookie: false,
			cookieDays: 0,
			cookieTriggerClass: "setCookie-1",
			cookieName: "activeModal-1",
	
			// Overlay options
			overlayBg: true,
			overlayBgColor: "rgba(255, 255, 255, 0.721569)",
			overlayTransition: "ease",
			overlayTransitionSpeed: "0.4",
	
			// Background effects
			bgEffect: "scaled",
			blurBgRadius: "2px",
			scaleBgValue: "1",
	
			// Window options
			windowWidth: "530px",
			windowHeight: "580px",
			windowLocation: "center",
			windowTransition: "fadeIn",
			windowTransitionSpeed: "0.4",
			windowTransitionEffect: "fadeIn",
			windowShadowOffsetX: "0",
			windowShadowOffsetY: "0",
			windowShadowBlurRadius: "20px",
			windowShadowSpreadRadius: "0",
			windowShadowColor: "none",
			windowBackground: "none",
			windowRadius: "0px",
			windowMargin: "10px",
			windowPadding: "10px",
	
			// Close and reopen button
			closeButton: "icon no3",
			reopenClass: "openactiveModal-8",
		});
		$("#popup-4").activeModals({
			// Functionality
			popupType: "delayed",
			delayTime: 1000,
			exitTopDistance: 40,
			scrollTopDistance: 400,
			setCookie: false,
			cookieDays: 0,
			cookieTriggerClass: "setCookie-1",
			cookieName: "activeModal-1",
	
			// Overlay options
			overlayBg: true,
			overlayBgColor: "rgba(255, 255, 255, 0.721569)",
			overlayTransition: "ease",
			overlayTransitionSpeed: "0.4",
	
			// Background effects
			bgEffect: "scaled",
			blurBgRadius: "2px",
			scaleBgValue: "1",
	
			// Window options
			windowWidth: "80%",
			windowHeight: "580px",
			windowLocation: "center",
			windowTransition: "fadeIn",
			windowTransitionSpeed: "0.4",
			windowTransitionEffect: "fadeIn",
			windowShadowOffsetX: "0",
			windowShadowOffsetY: "0",
			windowShadowBlurRadius: "20px",
			windowShadowSpreadRadius: "0",
			windowShadowColor: "none",
			windowBackground: "none",
			windowRadius: "0px",
			windowMargin: "10px auto",
			windowPadding: "10px",
	
			// Close and reopen button
			closeButton: "icon no3",
			reopenClass: "openactiveModal-9",
		});
		$("#popup-5").activeModals({
			// Functionality
			popupType: "delayed",
			delayTime: 1000,
			exitTopDistance: 40,
			scrollTopDistance: 400,
			setCookie: false,
			cookieDays: 0,
			cookieTriggerClass: "setCookie-1",
			cookieName: "activeModal-1",
	
			// Overlay options
			overlayBg: true,
			overlayBgColor: "rgba(255, 255, 255, 0.721569)",
			overlayTransition: "ease",
			overlayTransitionSpeed: "0.4",
	
			// Background effects
			bgEffect: "scaled",
			blurBgRadius: "2px",
			scaleBgValue: "1",
	
			// Window options
			windowWidth: "530px",
			windowHeight: "580px",
			windowLocation: "center",
			windowTransition: "fadeIn",
			windowTransitionSpeed: "0.4",
			windowTransitionEffect: "fadeIn",
			windowShadowOffsetX: "0",
			windowShadowOffsetY: "0",
			windowShadowBlurRadius: "20px",
			windowShadowSpreadRadius: "0",
			windowShadowColor: "none",
			windowBackground: "none",
			windowRadius: "0px",
			windowMargin: "10px",
			windowPadding: "10px",
	
			// Close and reopen button
			closeButton: "icon no3",
			reopenClass: "openactiveModal-10",
		});
		$("#popup-6").activeModals({
			// Functionality
			popupType: "delayed",
			delayTime: 1000,
			exitTopDistance: 40,
			scrollTopDistance: 400,
			setCookie: false,
			cookieDays: 0,
			cookieTriggerClass: "setCookie-1",
			cookieName: "activeModal-1",
	
			// Overlay options
			overlayBg: true,
			overlayBgColor: "rgba(255, 255, 255, 0.721569)",
			overlayTransition: "ease",
			overlayTransitionSpeed: "0.4",
	
			// Background effects
			bgEffect: "scaled",
			blurBgRadius: "2px",
			scaleBgValue: "1",
	
			// Window options
			windowWidth: "530px",
			windowHeight: "580px",
			windowLocation: "center",
			windowTransition: "fadeIn",
			windowTransitionSpeed: "0.4",
			windowTransitionEffect: "fadeIn",
			windowShadowOffsetX: "0",
			windowShadowOffsetY: "0",
			windowShadowBlurRadius: "20px",
			windowShadowSpreadRadius: "0",
			windowShadowColor: "none",
			windowBackground: "none",
			windowRadius: "0px",
			windowMargin: "10px",
			windowPadding: "10px",
	
			// Close and reopen button
			closeButton: "icon no3",
			reopenClass: "openactiveModal-11",
		});
	}
	$(document).ready(function () {
		set_modal();	
		$('.window_set').on('click','.author_contact_submitter',function(event){
			event.preventDefault();
			var now = $(this);
			var btntxt = now.html();
			var form = now.closest('form');  
			var success = now.data('success');
			var unsuccessful = now.data('unsuccessful');
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
	
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					now.html('<span>submitting...</span>');
				},
				success: function(data) {
					if(data == 'success'){
						notify(success,'success','bottom','right');
						$(".closeModal").click();
					} else {
						var text = '<div>'+unsuccessful+'</div>'+data;
						notify(text,'warning','bottom','right');
					}
					now.html(btntxt);
				},
				error: function(e) {
					console.log(e)
				}
			});
		});
	});

	
	function load_iamges(){
		$('body').find('.image_delay').each(function(){
			var src = $(this).data('src');
			if($(this).is('img')){
				$(this).attr('src',src);			
			} else {
				$(this).css('background-image',"url('"+src+"')");			
			}
		});	
	}
	
</script>