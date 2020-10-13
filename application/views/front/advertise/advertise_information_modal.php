<div class="modal_wrap">
    <div class="row get_into" id="ad_info">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="box_shape2">
                <div class="title">
                    <?php echo translate('adverisement_information');?>
                </div>
                <hr>
                <div class="">
                        <div class="form-group row">
                            <label class="col-xs-5 control-label text-right"><?php echo translate('page_name');?></label>
                            <label class="col-xs-2 control-label text-center">:</label>
                            <label class="col-xs-5 control-label text-left"><?php echo $this->db->get_where('ad_page',array('ad_page_id' => $ad_info->page_id))->row()->name;?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-5 control-label text-right"><?php echo translate('position');?></label>
                            <label class="col-xs-2 control-label text-center">:</label>
                            <label class="col-xs-5 control-label text-left"><?php echo $ad_info->position;?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-5 control-label text-right"><?php echo translate('size');?></label>
                            <label class="col-xs-2 control-label text-center">:</label>
                            <label class="col-xs-5 control-label text-left"><?php echo $ad_info->size;?></label>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-5 control-label text-right"><?php echo translate('format');?></label>
                            <label class="col-xs-2 control-label text-center">:</label>
                            <label class="col-xs-5 control-label text-left"><?php echo $ad_info->format;?></label>
                        </div>
                        <div class="form-group row">
                        	<label class="col-xs-5 control-label text-right"><?php echo translate('payment_getway');?></label>
                            <label class="col-xs-2 control-label text-center">:</label>
                            <label class="col-xs-5 control-label text-left">
                            	<img class="thumbnail image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/others/paypal_icon.png" style="display: -webkit-inline-box;">
                                <img class="thumbnail image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/others/stripe_icon.png" style="display: -webkit-inline-box;">
                            </label>
                        </div>
                </div>
                <hr>
                <div class="text-center clearfix">
                    <?php if($ad_info->availability == 'available'){?>
                    <button  class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-text-thick custom-btn-1-round-s custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('apply_for_advertisement');?>"
                    onClick="apply_ad('<?php echo $ad_info->advertisement_id;?>')">
                        <span><?php echo translate('apply_for_advertisement');?></span>
                    </button>
                    <?php } else { ?>
                    <button class="btn btn-block btn-readmore disabled" href="#">
                        <?php echo translate('booked!')?>
                    </button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        load_iamges();
    })
</script>
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
