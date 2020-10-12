        <!-- for tagsinput -->
        <script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <!-- for dataTables -->
        <script src="<?php echo base_url(); ?>template/front/assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>template/front/assets/js/dataTables.bootstrap.min.js"></script>
		<!-- for switchery -->
		<script src="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.js"></script>
        <!-- include summernote -->
        
        <script type="text/javascript" src="<?php echo base_url(); ?>template/front/assets/plugins/summernote/summernote.js"></script>
        
        <script type="text/javascript">
			function set_summernote() {
			  $('.summernote').summernote({
				height: 200
			  });
			
			  $('form').on('submit', function (e) {
				e.preventDefault();
				//alert($('.summernote').summernote('code'));
				//alert($('.summernote').val());
			  });
			};
		</script>