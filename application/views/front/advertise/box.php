<?php
    $i = 0;
    $count = count($ad_element);
    foreach($ad_element as $ad){
?>
    <div class="col-md-6 pad-lr-5 thumbnail photo_box_1">
        <div class="media" style="width:100%">
            <img class="media-object img-responsive image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/banner_demo/<?php echo $ad['type']?>.jpg">
        </div>
        <div class="col-md-12 pad-lr-0">
            <span>
                <p class="text-center" style="padding:10px 0px;border-bottom: 1px solid #cccccc; margin: 0px auto;">
                    <?php echo translate($ad['position']);?>
                </p>
            </span>
        </div>
        <div class="col-md-12 pad-lr-0" style="padding: 5px 0px;">
            <?php
	            $packages = json_decode($ad['package'],true);
	            $num_packages = 0;
	            if (!empty($packages)) {
	            	foreach ($packages as $rowr) {
		                if($rowr['activation'] == 'ok'){
		                    $num_packages++;
		                }
		            }
	            }
                    if($num_packages == 0){
            ?>
	            <div class="col-md-6 pad-lr-5">
	                <a class="btn btn-block btn-readmore" onclick="preview_ad_modal('<?php echo $ad['advertisement_id']?>')">
	                    <?php echo translate('spot_detail')?>
	                </a>
	            </div>
	            <div class="col-md-6 pad-lr-5">
	                <a class="btn btn-block btn-readmore disabled" href="#">
	                    <?php echo translate('no_packages!')?>
	                </a>
	            </div>
	    <?php } else { ?>
	            <div class="col-md-4 pad-lr-5">
	                <a class="btn btn-block btn-readmore" onclick="preview_ad_modal('<?php echo $ad['advertisement_id']?>')">
	                    <?php echo translate('spot_detail')?>
	                </a>
	            </div>
	            <div class="col-md-4 pad-lr-5">
	                <a class="btn btn-block btn-readmore" onclick="preview_package('<?php echo $ad['advertisement_id']?>')">
	                    <?php echo translate('packages')?>
	                </a>
	            </div>
	            <div class="col-md-4 pad-lr-5">
		            <?php if($ad['availability'] == 'available'){?>
		            <a class="btn btn-block btn-readmore" href="<?php echo base_url();?>home/marketing/apply/<?php echo $ad['advertisement_id'];?>">
		                <?php echo translate('apply')?>
		            </a>
		            <?php } else { ?>
		            <a class="btn btn-block btn-readmore disabled" href="#">
		                <?php echo translate('booked!')?>
		            </a>
		            <?php } ?>
	            </div>
	     <?php } ?>
        </div>
    </div>
<?php
    }
?>
<script>
$(document).ready(function(){
    load_iamges();
});
</script>
