<?php
$i=0; 
foreach ($blog_profile as $blog): ?>
    <div class="thumbnail news_box_rect_1 sm hover2 mar-t-10">
        <div class="row">
            <div class="col-md-1 hidden-sm hidden-xs" style="padding-top: 4px; padding-right: 0px;">
                <div class="theme_bg" style="width: 100%; min-height: 50px; color: #fff">
                    <div class="text-center" style="padding: 5px">
                        <?=date("d",$blog['date']);?><br>
                        <?=date("M",$blog['date']);?> 
                    </div>
                </div>
                <div class="theme_bdr" style="width: 100%; min-height: 50px; background-color: #fff !important;">
                    <div class="text-center" style="padding: 5px">
                        <i class="fa fa-eye"></i><br>
                        <?php echo $blog['view_count']; ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-11">
                <div class="row">
                    <div class="col-md-4">
                        <div class="media">
                            <span class="media-link">
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
                                <!-- <img class="img-thumbnail img-responsive image_delay" src="<?=$img_url?>" alt=""> -->
                                <div style="background-image: url(<?=$img_url?>); height: 230px; background-size: cover; background-position: center;"></div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="caption top">
                            <h4 class="caption-title pad-t-5">
                            <a href="<?php echo $this->Crud_model->blog_link($blog['blog_id']);?>">
                                <?=$blog['title']?>
                            </a>
                            </h4>
                            <div class="media-meta sm">
                                <a href="<?=$this->Crud_model->blogger_link($blog['blog_uploader_id']);?>">
                                    <i class="fa fa-user"></i>
                                    <?=$this->Crud_model->get_type_name_by_id('user', $blog['blog_uploader_id'], 'firstname');?>
                                </a>
                                <span class="divider">|</span>
                                    <a href="<?=base_url()?>home/blog_category/<?=$blog['blog_category_id']?>/0"><i class="fa fa-list"></i><?php echo translate('category'); ?>: <?=$this->Crud_model->get_type_name_by_id('blog_category', $blog['blog_category_id']);?> </a>
                                <span class="hidden-md hidden-lg">
                                    <span class="divider">|</span>
                                    <i class="fa fa-clock-o"></i><?=date("F j, Y",$blog['date']);?>
                                </span>
                                <span class="divider">|</span>
                                <a href="<?php echo $this->Crud_model->blog_link($blog['blog_id']);?>"><i class="fa fa-eye"></i> <?php echo $blog['view_count']; ?> Views </a>
                            </div>
                        </div>
                        <div class="">
                            <div class="caption-text">
                                <?=$blog['summary']?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$i++; 
endforeach ?>
<!-- Pagination -->
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links();  ?>
</div>
<!-- /Pagination -->
<script>
    $(document).ready(function(){
        $('#profile_blog_title').html("<?=translate('posted_blogs')?>");
    });
</script>