<div class="modal_wrap">
    <div class="get_into" id="ad_info">
		<div class="box_shape2">
                <div class="title">
                    <?php echo translate('adverisement_packages');?>
                </div>
                <hr>
                <div class="row">
                    <?php
                        $packages = json_decode($ad_info->package,true);
                        foreach($packages as $package){
                            if($package['activation'] == 'ok'){
                                if($package['index'] == 1){
                                    $time = "1 week";
                                }else if($package['index'] == 2){
                                    $time = "1 Month";
                                }
                                else if($package['index'] == 3){
                                    $time = "6 Months";
                                }
                                else if($package['index'] == 4){
                                    $time = "12 Months";
                                }
                    ?>
                        <div class="col-md-3 col-lg-3 col-sm-6 col-sx-12">
                            <div class="package-list">
                                <div class="package-head text-center">
                                    <h4 class="text-center"><?php echo $package['name'];?></h4>
                                </div>

                                <div class="package-body">
                                    <div class="package-price">
                                        <span>
                                            <?php if($package['seal'] != ''){?>
                                            <img class="img-responsive img-thumbnail img-circle image_delay" style="width: 64px; height: 64px;"  src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/default_banner/<?php echo $package['seal'];?>"/>
                                            <?php }else{?>
                                            <img class="img-responsive img-thumbnail img-circle image_delay" style="width: 64px; height: 64px;"  src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/default_banner/default_seal.png"/>
                                            <?php } ?>
                                        </span>
                                    </div>
                                    <div class="package-details">
                                        <ul class="text-center">
                                            <li><b><?php echo translate('position');?>:</b> <?php echo translate($ad_info->position);?></li>
                                            <li><b><?php echo translate('size');?>:</b> <?php echo translate($ad_info->size);?></li>
                                            <li><b><?php echo translate('time');?>:</b> <?php echo translate($time);?></li>
                                            <li><b><?php echo translate('price');?>:</b><?php echo currency($package['price']);?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="package-footer">
                                    <?php if($ad_info->availability == 'available'){?>
                                        <a class="btn btn-block btn-package" href="<?php echo base_url();?>home/marketing/apply/<?php echo $ad_info->advertisement_id;?>/<?php echo $package['index']; ?>">
                                            <?php echo translate('apply');?>
                                        </a>
                                    <?php }else{ ?>
                                        <a class="btn btn-block btn-readmore disabled" href="#">
                                            <?php echo translate('booked!')?>
                                        </a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php
                            }
                        }
                    ?>
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
    .package-list{
        background-color: #fff;
        border:1px solid #e8e8e8;
        transition: 0.8s ease;
        border-top-left-radius:5px;
        border-top-right-radius:5px;
    }
    .package-list .package-head{
        width:100%;
        display: inline-block;
        border-bottom: 2px solid #000;
        padding: 0px 10px;
    }
    .package-head h4{
        display: inline-block;
    }
    .package-selected{
        box-shadow: 0px 0px 10px 1px rgb(144, 144, 144);
        transition: 0.8s ease;
        -webkit-transition: 0.8s ease;
    }
    .package-list:hover{
        box-shadow: 0 16px 38px -12px rgba(0,0,0,.56), 0 4px 25px 0 rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
        transition: 0.8s ease;
        -webkit-transition: 0.8s ease;
    }
    .package-price{
        margin: 10px auto;
        font-size: 20px;
        font-weight: bold;
        color: white;
        padding: 0px 10px;
    }
    .package-price span{
        margin-left:auto;
        margin-right:auto;
        display: block;
        text-align: center;
    }.package-details{
        margin:10px auto;
        padding: 0px 20px;
    }
    .package-details ul li{
        border-bottom:1px solid #dadada;
        padding:10px 0px;
    }
</style>
