<div class="products list">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($all_news[0])) {
                        echo $this->Html_model->news_box('sqr_md', '1', $all_news[0]);
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mar-t-5">
                    <?php
                    if (isset($all_news[3])) {
                        echo $this->Html_model->news_box('sqr_sm', '1', $all_news[3]);
                    }
                    ?>
                </div>
                <div class="col-md-6 mar-t-5">
                    <?php
                    if (isset($all_news[4])) {
                        echo $this->Html_model->news_box('sqr_sm', '1', $all_news[4]);
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mar-t-5">
                    <?php
                    if (isset($all_news[6])) {
                        echo $this->Html_model->news_box('sqr_sm', '1', $all_news[6]);
                    }
                    ?>
                </div>
                <div class="col-md-6 mar-t-5">
                    <?php
                    if (isset($all_news[7])) {
                        echo $this->Html_model->news_box('sqr_sm', '1', $all_news[7]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($all_news[1])) {
                        echo $this->Html_model->news_box('rect_sm', '1', $all_news[1]);
                    }
                    ?>
                </div>
                <div class="col-md-12 mar-t-5">
                    <?php
                    if (isset($all_news[2])) {
                        echo $this->Html_model->news_box('rect_sm', '1', $all_news[2]);
                    }
                    ?>
                </div>
                <div class="col-md-12 mar-t-5">
                    <?php
                    if (isset($all_news[5])) {
                        echo $this->Html_model->news_box('rect_sm', '1', $all_news[5]);
                    }
                    ?>
                </div>
                <div class="col-md-12 mar-t-5">
                    <?php
                    if (isset($all_news[8])) {
                        echo $this->Html_model->news_box('rect_sm', '1', $all_news[8]);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>