<div class="modal_wrap">
    <div class="row get_into" id="ad_info">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row box_shape2">
                <div class="title">
                    <?php echo translate('confirm_your_post');?>
                </div>
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<center>
                        <p><?php echo translate('are_you_sure_to_be_a_blogger?');?></p>
                        <p class="text-danger"><?php echo translate('after_beeing_a_blogger_you_can_not_undo_this_action.') ?></p>
                    </center>
                </div>
                <hr>
                <div class="col-lg-8 col-md-8 col-md-offset-2 col-sm-8 col-xs-12 text-center">
                    
                    <a href="<?=base_url()?>home/be_blogger/make_blogger" class="btn btn-blue btn-sm">
                        <span><?php echo translate('confirm');?></span>
                    </a>
                       
                </div>
            </div>
        </div>
    </div>
</div>

<style>
	.modal_wrap{
		padding: 20px 0px;
	}
	.get_into hr {
		border: 1px solid #e8e8e8  !important;
		height: 0px !important;
		background-image: none !important;
		margin:10px 0px;
	}
	.box_shape2 {
		padding: 15px;
		border: solid 1px #e9e9e9;
		background-color: #ffffff;
		margin: -25px 20px;
	}
	label ol{
		margin-bottom:0px;
	}
</style>