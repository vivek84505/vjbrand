<div class="modal_wrap">
    <div class="row get_into" id="ad_info">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row box_shape2">
                <div class="title">
                    <?php echo translate('package_details');?>
                </div>
                <hr>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p style="word-wrap: break-word;"><?=$this->db->get_where('subscription_payment', array('subscription_payment_id' => $payment_id))->row()->payment_details?></p>
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