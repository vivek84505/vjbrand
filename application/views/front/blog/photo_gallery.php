<?php
    $this->db->limit($blog_photo_gal_data['count']);
    $this->db->order_by('blog_photo_id', 'desc');
    $this->db->where(array('status' => 'published', 'hide_status'=>'false'));
    $blog_gallery_photos = $this->db->get('blog_photo')->result_array();
?>
<section class="page-section pad-tb-5 gallery_slider">
    <div class="">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo translate('blog_photo_gallery') ?>
                <a href="<?php echo base_url(); ?>home/blog_photo_gallery" class="btn_seeMore">
                    <?php echo translate('see_more'); ?>
                </a>
            </div>
            <div class="panel-body">
                <div class="featured-products-carousel">
                    <div class="owl-carousel" id="gallery-slider-carousel">
                        <?php
                            foreach ($blog_gallery_photos as $row) {
                                echo $this->Html_model->photo_box('blog', $row);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
