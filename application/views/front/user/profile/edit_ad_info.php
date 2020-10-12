<div class="information-title">
    <?php echo translate('advertisement_information'); ?>
</div>
<div class="details-wrap">
    <div class="row">
        <div class="col-md-12">
            <?php
                echo form_open(base_url() . 'home/profile/ad_list/update/'.$ad_info->advertisement_id, array(
                    'class' => 'form-horizontal',
                    'method' => 'post',
                    'enctype'=> 'multipart/form-data'
                ));
                $size      = explode('x',$ad_info->size);
                $width     = $size[0];
                $height    = $size[1];
                $post_details = json_decode($ad_info->post_details,true);
                if(!empty($post_details)){
                    foreach($post_details as $post){
                        $img = $post['img'];
                        $url = $post['url'];
                    }
                }else{
                    $default_post = json_decode($ad_info->default_post,true);
                    foreach($default_post as $def_post){
                        $img = $def_post['img'];
                        $url = $def_post['url'];
                    }
                }
            ?>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="demo-for-1">
                        Choose Image                        
                    </label>
                    <div class="col-md-6">
                        <div class="col-md-6" style="margin:2px; padding:2px;">
                            <img id="img_upload" class="img-responsive thumbnail blah image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/default_banner/<?php echo $img;?>">
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6 col-md-offset-4">
                            <span class="pull-left btn btn-primary  margin-top-10" id="btn-file">
                                Select Image                                
                            </span>
                            <input type="file" accept="image/*" name="img" id="fileInput" class="form-control imgInp" style="display: none !important;">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="demo-for-2">
                        Ad Url                        
                    </label>
                    <div class="col-md-6">
                        <input type="text" name="url" class="form-control" placeholder="Redirect Url" value="<?php echo $url;?>">
                    </div>
                </div>
                <div class="outer required">
                    <div class="form-group af-inner">
                        <span class="button-custom-btn-1 custom-btn-1 custom-btn-1-text-upper custom-btn-1-round-s custom-btn-1-text-thick custom-btn-1-size-s signup_btn pull-right" data-unsuccessful='<?php echo translate('update_unsuccessful!'); ?>' data-success='<?php echo translate('updated_successfully!'); ?>' data-text="<?php echo translate('update'); ?>" data-ing='<?php echo translate('updating..'); ?>'>		
                            <span><?php echo translate('update'); ?></span>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var img_wid = "<?php echo $width;?>";
    var img_hgt = "<?php echo $height;?>";

    $("#btn-file").on("click",function(e){
        $("#fileInput").click();
    });
    function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }
            reader.readAsDataURL(input.files[0]);
           // var img = new Image();
           // img.src = parent.find('.blah').attr('src');
           // img.onload = function() {
           //      if(this.width > img_wid || this.height > img_hgt){
           //         notify('Image size exceeds the maximum size.','danger','bottom','right');
           //      }
           //      else{
                    
            //     }
            // }
        }
    }
    $("form").on('change', '.imgInp', function () {
        readURL_all(this);
    });
    $(document).ready(function(e){
        load_iamges();
    })
    
</script>