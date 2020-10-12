<style>
    .media-meta {
        font-size: 12px;
    }
    .caption-title {
        font-size: 16px;
    }
</style>
<?php
    $this->db->limit('8');
    $this->db->order_by('blog_id', 'DESC');
    $this->db->where(array('status' => 'published', 'hide_status'=>'false'));
    $blogs = $this->db->get('blog')->result();
?>
<section class="page-section pad-tb-5 gallery_slider">
    <div class="container">
        <a href="<?=base_url()?>home/blog_category/0/0" class="button-custom-btn-1 btn-browse-more custom-btn-1 custom-btn-1-round-s custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="See More">
            <span>See More</span>
        </a>
        <h2 class="block-title">
            <span><?php echo translate('blog_posts')?></span>
        </h2>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="featured-products-carousel">
                    <div class="owl-carousel" id="blog-post">
                        <?php
                        foreach ($blogs as $value) {
                            $imgs = json_decode($value->img_features,true);
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
                        <div class="thumbnail news_box_sqr_2 image_delay" data-src="<?=$img_url?>" style="height: 270px; margin: 0px; background-image: url(<?=$img_url?>);">
                            <div class="caption">
                                <h4 class="caption-title">
                                    <a href="<?php echo $this->Crud_model->blog_link($value->blog_id);?>">
                                        <?=$value->title?>
                                        <!-- <?php echo date("Y-m-d", $value->date);?> -->

                                    </a>
                                </h4>
                                <div class="media-meta">
                                    <?php if($value->blog_uploader_type == 'admin') { ?> <i class="fa fa-user"> </i> <?php echo translate('admin'); } else { ?>

                                        <a href="<?php echo $this->Crud_model->bloggers_link($value->blog_uploader_id);?>">
                                            <i class="fa fa-user"></i>
                                            <?=$this->Crud_model->get_type_name_by_id('user', $value->blog_uploader_id,'firstname');?>
                                        </a>
                                    <?php } ?>
                                    <span class="divider">|</span>
                                    <a href="<?php echo base_url(); ?>home/blog_category/0/0/<?php echo date("Y-m-d", $value->date) ?>"><i class="fa fa-clock-o"></i><?php echo date("F j, Y",$value->date);?></a>
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
    </div>
</section>
<script>
$(document).ready(function() {
    var blog = $("#blog-post");
    blog.owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        mouseDrag: true,
        touchDrag: false,
        margin: 10,
        dots: false,
        nav: true,
        items: 4,
        navText : ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"]
    });
});
</script>
