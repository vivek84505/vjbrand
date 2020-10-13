<?php
    $this->db->limit($photo_gal_data['count']);
    $this->db->order_by('photo_id', 'desc');
    $this->db->where('status', 'published');
    $gallery_photos = $this->db->get('photo')->result_array();
?>
<section class="page-section pad-tb-5 gallery_slider">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo translate($photo_gal_data['title']); ?>
                <a href="<?php echo base_url(); ?>home/photo_gallery" class="btn_seeMore">
                    <?php echo translate('see_more'); ?>
                </a>
            </div>
            <div class="panel-body">
                <div class="featured-products-carousel">
                    <div class="owl-carousel" id="gallery-slider-carousel">
                        <?php
                            foreach ($gallery_photos as $row) {
                                echo $this->Html_model->photo_box('2', $row);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>