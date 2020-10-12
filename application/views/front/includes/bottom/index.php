<script>
	var base_url = '<?php echo base_url();?>';
</script>
<script>
$(document).ready(function(e) {
    $('#tabs a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	})
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<!-- JS Global -->
<script src="<?php echo base_url(); ?>template/front/assets/js/bootstrap-notify.min.js"></script>
<script src="<?php echo base_url(); ?>template/front/assets/js/ajax_method.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/superfish/js/superfish.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery.sticky.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery.smoothscroll.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery.sticky.min.js"></script>
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>template/front/assets/modal/js/jquery.active-modals.js"></script>

<!-- JS Page Level -->
<script src="<?php echo base_url();?>template/front/assets/js/theme.js"></script>

<?php include $asset_page.'.php'; ?>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="<?php echo base_url();?>template/front/assets/plugins/jquery.cookie.js"></script>
<script src="<?php echo base_url();?>template/front/assets/js/theme-config.js"></script>
<!--<![endif]-->