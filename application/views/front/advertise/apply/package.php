<?php
     $a = $ad_info->package;
    //$a = '[{"index":1,"name":"Weekly Package","price":"400","seal":"seal_3_1.jpg""activation":""},{"index":2,"name":"","price":"","seal":"""activation":""},{"index":3,"name":"","price":"","seal":"""activation":""},{"index":4,"name":"","price":"","seal":"""activation":""}]';
    $packages = json_decode($a,true);
    //var_dump($packages);
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
                <div class="package-list <?php if($package_id == $package['index']){echo 'package-selected';} ?>">
                    <div class="package-head text-center">
                        <h4 class="text-center"><?php echo translate($package['name']);?></h4>
                    </div>

                    <div class="package-body">
                        <div class="package-price">
                            <span>
                                <?php if($package['seal'] != ''){?>
                                <img class="img-responsive img-thumbnail img-circle" style="width: 80px; height: 80px;"  src="<?php echo base_url();?>uploads/default_banner/<?php echo $package['seal'];?>"/>
                                <?php }else{?>
                                <img class="img-responsive img-thumbnail img-circle" style="width: 80px; height: 80px;"  src="<?php echo base_url();?>uploads/default_banner/default_seal.png"/>
                                <?php } ?>
                            </span>
                        </div>
                        <div class="package-details">
                            <ul class="text-center">
                                <li><b><?php echo translate('position') ?>: </b> <?php echo translate($ad_info->position);?></li>
                                <li><b><?php echo translate('size') ?>: </b> <?php echo translate($ad_info->size);?></li>
                                <li><b><?php echo translate('time') ?>: </b> <?php echo translate($time);?></li>
                                <li><b><?php echo translate('price') ?>: </b> <?php echo currency($package['price']);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="package-footer">
                        <label for="package-<?php echo $package['index'];?>" id="select-<?php echo $package['index'];?>" class="btn btn-block btn-package package_check" onclick="package_check('package-<?php echo $package["index"];?>',$(this))">
                            <?php echo translate('select');?>
                        </label>
                        <input type="radio" name="package" <?php if($package_id == $package['index']){echo 'checked';} ?> value="<?php echo $package['index'];?>" data-amount="<?php echo $package['price'];?>" id="package-<?php echo $package['index'];?>" style="display:none;" />
                    </div>
                </div>
            </div>
        <?php
        }
    }
?>
<input type="hidden" name="advertisement_id" value="<?php echo $ad_info->advertisement_id;?>"/>

<script>
    $(".package_check:first").click();

    function package_check(id,now){
        for(var i=1; i<5; i++){
            $("#package-"+i).prop("checked", false );
            $("#package-"+i).parent().parent().removeClass("package-selected");
            $("#select-"+i).html("Select");
        }
        now.html('Selected');
        $("#"+id).prop("checked", true);
        $("#"+id).parent().parent().addClass("package-selected");
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
