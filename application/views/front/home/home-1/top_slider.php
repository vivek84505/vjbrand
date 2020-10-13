<section class="page-section pad-tb-5 top_slider">
    <div class="container gallery_slider">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo translate($sliding_news['title']); ?>
            </div>
            <div class="panel-body">
                <div class="featured-products-carousel">
                    <div class="owl-carousel" id="top-slider-carousel">
                        <?php
                            $this->db->limit($sliding_news['count']);
                            $this->db->order_by('serial_4', 'desc');
                            $this->db->order_by('news_id', 'desc');
                            $this->db->where('news_speciality_id', 4);
                            $this->db->where('status', 'published');
                            $top_slider = $this->db->get('news')->result_array();
                            foreach ($top_slider as $row) {
                                echo $this->Html_model->news_box('sqr_xs', '2', $row);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>