<div class="box_shadow">
    <div class="widget shop-categories user_panel_sidebar">
        <div class="user_details">
            <div class="user_img">
                <?php
                    $user_info = $this->db->get_where('user', array('user_id' => $blogger_id))->result_array();
                    foreach ($user_info as $row) {
						if($blogger_id == $this->session->userdata('user_id')){
                ?>
                        <div class="cover form-body pic_changer window_set">
                            <?php
                            echo form_open(base_url() . 'home/registration/change_picture/' . $row['user_id'], array(
                                'class' => '',
                                'method' => 'post',
                                'id' => 'fff',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                            <span id="inppic" class="set_image">
                                <label class="btn btn-theme btn-theme-sm btn-block" for="imgInp">
                                    <span><?php echo translate('change_picture'); ?></span>
                                </label>
                                <input type="file" style="display:none;" id="imgInp" name="img" />
                            </span>
                            <span id="savepic" style="display:none;">
                                <span class="btn btn-theme btn-block btn-theme-sm signup_btn" onclick="abnv('inppic'); change_state('normal');"  data-ing="<?php echo translate('saving'); ?>..." data-success="<?php echo translate('profile_picture_saved_successfully!'); ?>" data-unsuccessful="<?php echo translate('edit_failed!'); ?> <?php echo translate('try_again!'); ?>" data-reload="no" >
                                    <span><?php echo translate('save_changes'); ?></span>
                                </span>
                            </span>
                            </form>
                        </div>
                        <input type="hidden" id="state" value="normal" />
                        <div class="img-box" id="blah"  
                             style="height:300px; background-size: cover; background-image: url('<?php
                             if (file_exists('uploads/user_image/user_' . $row['user_id'] . '.jpg')) {
                                 echo $this->Crud_model->file_view('user', $row['user_id'], '100', '100', 'no', 'src', '', '', '.jpg') . '?t=' . time();
                             } else if (!empty($row['fb_id'])) {
                                 echo "https://graph.facebook.com/" . $row['fb_id'] . "/picture?type=large";
                             } else if (!empty($row['g_id'])) {
                                 echo $row['g_photo'];
                             } else {
                                 echo base_url() . "uploads/user_image/default.jpg";
                             }
                             ?>')">
                        </div>
                <?php
						} else {
				?>
                    <div class="img-box" id="blah"  
                         style="height:300px; background-size: cover; background-image: url('<?php
                         if (file_exists('uploads/user_image/user_' . $row['user_id'] . '.jpg')) {
                             echo $this->Crud_model->file_view('user', $row['user_id'], '100', '100', 'no', 'src', '', '', '.jpg') . '?t=' . time();
                         } else if (!empty($row['fb_id'])) {
                             echo "https://graph.facebook.com/" . $row['fb_id'] . "/picture?type=large";
                         } else if (!empty($row['g_id'])) {
                             echo $row['g_photo'];
                         } else {
                             echo base_url() . "uploads/user_image/default.jpg";
                         }
                         ?>')">
                    </div>
                <?php
						}
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="widget thin-border shop-categories" style="margin-top: 13px">
        <h4 class="widget-title"><?php echo translate('basic_info'); ?></h4>
        <div class="widget-content">
            <div class="row">
                <div class="col-sm-12">
                    <table class="" style="font-size: 12px">
                        <tr>
                            <td width="60"><b><?php echo translate('name');?></b></td>
                            <td><b>:</b> <?php echo $row['firstname'].' '.$row['lastname'];?></td>
                        </tr>
                        <tr>
                            <td width="60"><b><?php echo translate('email');?></b></td>
                            <td><b>:</b> <?php echo $row['email'];?></td>
                        </tr>
                        <tr>
                            <td width="60"><b><?php echo translate('city');?></b></td>
                            <td><b>:</b> <?php echo $row['city'];?></td>
                        </tr>
                        <tr>
                            <td width="60"><b><?php echo translate('state');?></b></td>
                            <td><b>:</b> <?php echo $row['state'];?></td>
                        </tr>
                        <tr>
                            <td width="60"><b><?php echo translate('country');?></b></td>
                            <td><b>:</b> <?php echo $row['country'];?></td>
                        </tr>
                    </table>
                </div> 
            </div>
        </div>
    </div>
    <div class="widget thin-border widget-tag-cloud">
        <h4 class="widget-title" style="font-size: 15px;margin-top: 10px;margin-bottom: 10px;padding-left: 15px;"><?php 
                if($this->session->userdata('user_id') == $row['user_id']){ 
                    echo translate('my_categories'); 
            }else{
                    echo translate('blogger_categories');
                } ?></h4>
        <div class="widget-content" style="padding: 10px 15px;">
            <ul>
                <?php foreach ($my_categories as $my_category): ?>
                    <li><a href="<?=base_url()?>home/blog_category/<?=$my_category->blog_category_id?>/0"><?=$this->Crud_model->get_type_name_by_id('blog_category', $my_category->blog_category_id);?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
    <div class="widget thin-border shop-categories">
        <h4 class="widget-title">
        <?=translate('most_popular_blogs')?>
        </h4>
        <div class="widget-content">
            <div class="widget-pane fade active in">
            	<?php
					$this->db->order_by('view_count','DESC');
					$this->db->limit(5);
                	$recents = $this->db->get_where('blog',array('status'=>'published','hide_status'=>'false'))->result_array();
					foreach($recents as $blog){
				?>
                <div class="news_box_rect_1 thumb hover3">
                    <div class="media">
                        <span class="pull-left media-link">
						<?php
                            $imgs = json_decode($blog['img_features'], true);
                            $img_url = base_url()."uploads/blog_image/default.jpg";
                            if (!empty($imgs)) {
                                $i=0;
                                foreach ($imgs as $roq) {
                                    if($i == 0){
                                        $img = $roq['img'];
                                    }
                                    $i++;
                                }
                                $img_url = base_url()."uploads/blog_image/".$img;
                            }
                        ?>
                        <img class="media-object img-responsive image_delay" src="<?=base_url()?>uploads/news_image/news_84_1_thumb.jpg" data-src="<?=$img_url?>" alt="">
                        </span>
                        <div class="media-body">
                            <h4 class="media-heading">
                            <a href="<?=base_url()?>home/blog_detail/<?=$blog['blog_id']?>/<?=$blog['title']?>">
                            <?=$blog['title']?> </a>
                            </h4>
                        </div>
                    </div>
                </div>
                <?php 
					}
				?>
            </div>
        </div>
    </div>
</div>

<style>
    .widget.shop-categories ul li {
        cursor: pointer;
    }
</style>
<script type="text/javascript">

    function abnv(thiss) {
        $('#savepic').hide();
        $('#inppic').hide();
        $('#' + thiss).show();
        $('.user_img').removeClass('hover');
    }
    function change_state(va) {
        $('#state').val(va);
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').css('backgroundImage', "url('" + e.target.result + "')");
                $('#blah').css('backgroundSize', "cover");
            }
            reader.readAsDataURL(input.files[0]);
            abnv('savepic');
            change_state('saving');
        }
    }

    $("#imgInp").change(function () {
        readURL(this);
        $('.user_img').addClass('hover');
    });

</script>