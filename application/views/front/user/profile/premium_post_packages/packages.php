<?php
$i=1;
foreach ($all_subscriptions as $value)
{
?>
<div class="col-md-4 col-lg-4 col-sm-6 col-sx-12" style="padding-top: 15px">
    <div class="package-list ">
        <div class="package-head text-center">
            <h4 class="text-center"><?=$value->name?></h4>
        </div>
        <div class="package-body">
            <div class="package-price">
                <span>
                    <?php
                        $image = $value->image;
                        $images = json_decode($image, true);
                        if (file_exists('uploads/subscription_image/'.$images[0]['thumb'])) {
                     ?>
                    <img class="img-responsive img-thumbnail img-circle" style="width: 80px; height: 80px;" src="<?=base_url()?>uploads/subscription_image/<?=$images[0]['thumb']?>">
                     <?php
                        }
                        else {
                    ?>
                    <img class="img-responsive img-thumbnail img-circle" style="width: 80px; height: 80px;" src="<?=base_url()?>uploads/subscription_image/default_image.png">
                    <?php
                        }
                    ?>
                </span>
            </div>
            <div class="package-details">
                <ul class="text-center">
                    <li><b><?php echo translate('amount_of_posts'); ?>:</b> <?=$value->post_amount?></li>
                    <li><b><?php echo translate('amount_of_videos'); ?>:</b> <?=$value->video_amount?></li>
                    <li><b><?php echo translate('amount_of_images'); ?>:</b> <?=$value->photo_amount?></li>
                    <li><b><?php echo translate('price'); ?>:</b> <?php echo currency($value->amount)?></li>
                </ul>
            </div>
        </div>
        <div class="package-footer">
            <label for="package-<?=$i?>" class="btn btn-block btn-package" <?php if($value->subscription_id != 1) { ?> id="select-<?=$i?>" onclick="package_check('package-<?=$i?>',$(this))" <?php } else { echo "disabled"; }?>>
                <?php echo translate('select'); ?>
            </label>
            <input type="radio" name="package" value="<?=$value->subscription_id?>" data-amount="<?=$value->amount?>" id="package-<?=$i?>" style="display:none;">
        </div>
    </div>
</div>
<?php
$i++;
}
?>
<script>
    function package_check(id,now){
        for(var i=1; i<7; i++){
            $("#package-"+i).prop("checked", false );
            $("#package-"+i).parent().parent().removeClass("package-selected");
            $("#select-"+i).html("Select");
        }
        now.html('Selected');
        $("#"+id).prop("checked", true);
        $("#"+id).parent().parent().addClass("package-selected");
        $('#next1').show();
        $('#btn_submit').show();
    }

</script>
<style>
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
        border-bottom: 1px solid #dadada;
        padding: 0px 10px;
    }
    .package-head h4{
        display: inline-block;
    }
    .package-selected{
        box-shadow: 0 16px 38px -12px rgba(0,0,0,.56), 0 4px 25px 0 rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
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
