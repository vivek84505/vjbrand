<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo translate('manage_home_page_sections'); ?></h3>
    </div>
    <div class="row">
        <div class="col-md-9">
            <!--Panel heading-->
            <div class="tab-base horizontal-tab">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tabb-1"><?php echo translate('scrolling_news'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-2"><?php echo translate('top_news'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-3"><?php echo translate('top_sliding_news'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-4"><?php echo translate('detail_news'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-5"><?php echo translate('photo_gallery'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-6"><?php echo translate('special_category_with_sidebar'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-7"><?php echo translate('video_gallery'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tabb-8" style="padding-bottom:12px;"><?php echo translate('category_wise_news'); ?></a>
                    </li>
                </ul>
                <!--Tabs Content-->                    
                <div class="tab-content">
                    <div id="tabb-1" class="tab-pane fade active in">
                        <?php
                        $scrolling_news = json_decode($this->Crud_model->get_settings_value('ui_settings', 'scrolling_news', 'value'), true);
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo form_open(base_url() . 'admin/ui_home/scrolling_news_data/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_scrolling_news" class='sw' data-set='set_scrolling_news' data-success='<?php echo translate('scrolling_news_enabled'); ?>' data-unsuccess='<?php echo translate('scrolling_news_disabled'); ?>' type="checkbox" <?php if ($scrolling_news['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="scrolling_news_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('title'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="title" value="<?php echo $scrolling_news['title']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('number_of_news'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="number" name="count" max="20" min="0" value="<?php echo $scrolling_news['count']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('scrolling_news_updated!'); ?>'>
                                            <?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-2" class="tab-pane fade">
                        <?php
                        $top_news = json_decode($this->Crud_model->get_settings_value('ui_settings', 'top_news', 'value'), true);
                        ?>
                        <div class="row">
                            <div class="col-md-12 form-horizontal">
                                <?php
                                echo form_open(base_url() . 'admin/ui_home/top_news_data/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_top_news" class='sw' data-set='set_top_news' data-success='<?php echo translate('top_news_enabled'); ?>' data-unsuccess='<?php echo translate('top_news_disabled'); ?>' type="checkbox" <?php if ($top_news['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="top_news_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="margin-top:15px;" ><?php echo translate('choose_style'); ?></label>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <?php
                                                $top_news_style = $top_news['style'];
                                                $style = array(1, 2);
                                                foreach ($style as $value) {
                                                    ?>
                                                    <div class="cc-selector col-sm-6">
                                                        <input type="radio" id="top_news_<?php echo $value; ?>" value="<?php echo $value; ?>" name="style" <?php
                                                        if ($top_news_style == $value) {
                                                            echo 'checked';
                                                        }
                                                        ?> >
                                                        <label class="drinkcard-cc" style="margin-bottom:0px; width:100%;" for="top_news_<?php echo $value; ?>">
                                                            <img src="<?php echo base_url() ?>uploads/styles/<?php echo 'top_news_' . $value . '.jpg' ?>" width="100%" height="100%" alt="<?php echo 'top_news_style_' . $value; ?>" />


                                                        </label>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('top_news_updated!'); ?>'>
<?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-3" class="tab-pane fade">
                        <?php
                        $sliding_news = json_decode($this->Crud_model->get_settings_value('ui_settings', 'sliding_news', 'value'), true);
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo form_open(base_url() . 'admin/ui_home/sliding_news_data/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_sliding_news" class='sw' data-set='set_sliding_news' data-success='<?php echo translate('sliding_news_enabled'); ?>' data-unsuccess='<?php echo translate('sliding_news_disabled'); ?>' type="checkbox" <?php if ($sliding_news['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="sliding_news_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('title'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="title" value="<?php echo $sliding_news['title']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('number_of_news'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="number" name="count" max="20" min="0" value="<?php echo $sliding_news['count']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('sliding_news_updated!'); ?>'>
<?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-4" class="tab-pane fade">
                        <?php
                        $detail_news = json_decode($this->Crud_model->get_settings_value('ui_settings', 'detail_news', 'value'), true);
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo form_open(base_url() . 'admin/ui_home/detail_news_data/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                                ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_detail_news" class='sw' data-set='set_detail_news' data-success='<?php echo translate('detail_news_enabled'); ?>' data-unsuccess='<?php echo translate('detail_news_disabled'); ?>' type="checkbox" <?php if ($detail_news['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="detail_news_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('number_of_news'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="number" name="count" max="9" min="1" value="<?php echo $detail_news['count']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('sidebar_position'); ?></label>
                                        <div class="col-sm-6">
                                            <select class="demo-chosen-select" name="sidebar">
                                                <option value="left" <?php
                                                            if ($detail_news['sidebar'] == 'left') {
                                                                echo 'selected';
                                                            }
                                                            ?>>
                                                        <?php echo translate('left'); ?>
                                                </option>
                                                <option value="right" <?php
                                                        if ($detail_news['sidebar'] == 'right') {
                                                            echo 'selected';
                                                        }
                                                        ?>>
<?php echo translate('right'); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('choose_widgets'); ?></label>
                                        <div class="col-sm-6">
                                            <select class="demo-cs-multiselect" multiple name="widgets[]" >
                                                <?php
                                                $widget_all = array("category_1" => "news_categories",
                                                    "search_1" => "advance_search",
                                                    "archive_search_1" => "archive_search",
                                                    "sp_news_tab_2" => "recent_&_popular_news_(10)",
                                                    "sp_news_tab_1" => "recent_&_popular_news_(5)",
                                                    "poll_1" => "poll"
                                                );
                                                foreach ($widget_all as $i => $row) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>" <?php
                                                    if (in_array($i, $detail_news['widgets'])) {
                                                        echo 'selected';
                                                    }
                                                    ?>>
    <?php echo translate($row); ?>
                                                    </option>
                                                <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('detail_news_updated!'); ?>'>
                        <?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-5" class="tab-pane fade">
                                <?php
                                $photo_gal = json_decode($this->Crud_model->get_settings_value('ui_settings', 'photo_gal', 'value'), true);
                                ?>
                        <div class="row">
                            <div class="col-md-12">
<?php
echo form_open(base_url() . 'admin/ui_home/photo_gal_data/', array(
    'class' => 'form-horizontal',
    'method' => 'post',
    'id' => '',
    'enctype' => 'multipart/form-data'
));
?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_photo_gal" class='sw' data-set='set_photo_gal' data-success='<?php echo translate('photo_gallery_enabled'); ?>' data-unsuccess='<?php echo translate('photo_gallery_disabled'); ?>' type="checkbox" <?php if ($photo_gal['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="photo_gal_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('title'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="title" value="<?php echo $photo_gal['title']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('number_of_photos'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="number" name="count" max="15" min="0" value="<?php echo $photo_gal['count']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('photo_gallery_updated!'); ?>'>
                        <?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-6" class="tab-pane fade">
                                <?php
                                $special_category = json_decode($this->Crud_model->get_settings_value('ui_settings', 'special_category', 'value'), true);
                                ?>
                        <div class="row">
                            <div class="col-md-12">
<?php
echo form_open(base_url() . 'admin/ui_home/special_category_data/', array(
    'class' => 'form-horizontal',
    'method' => 'post',
    'id' => '',
    'enctype' => 'multipart/form-data'
));
?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_special_category" class='sw' data-set='set_special_category' data-success='<?php echo translate('special_category_enabled'); ?>' data-unsuccess='<?php echo translate('special_category_disabled'); ?>' type="checkbox" <?php if ($special_category['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="special_category_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">
<?php echo translate('choose_category') . '( ' . translate('left') . ' )'; ?>
                                        </label>
                                        <div class="col-sm-6">
<?php
echo $this->Crud_model->select_html('news_category', 'cat1', 'name', 'edit', 'demo-chosen-select', $special_category['cat1']);
?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-inputemail">
<?php echo translate('choose_category') . '( ' . translate('right') . ' )'; ?>
                                        </label>
                                        <div class="col-sm-6">
<?php
echo $this->Crud_model->select_html('news_category', 'cat2', 'name', 'edit', 'demo-chosen-select', $special_category['cat2']);
?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('number_of_news'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="number" name="count" max="9" min="1" value="<?php echo $special_category['count']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('sidebar_position'); ?></label>
                                        <div class="col-sm-6">
                                            <select class="demo-chosen-select" name="sidebar">
                                                <option value="left" <?php
                                                if ($special_category['sidebar'] == 'left') {
                                                    echo 'selected';
                                                }
?>>
<?php echo translate('left'); ?>
                                                </option>
                                                <option value="right" <?php
if ($special_category['sidebar'] == 'right') {
    echo 'selected';
}
?>>
                                                <?php echo translate('right'); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('choose_widgets'); ?></label>
                                        <div class="col-sm-6">
                                            <select class="demo-cs-multiselect" multiple name="widgets[]" >
                                                        <?php
                                                            $widget_all = array("category_1" => "news_categories",
                                                                "search_1" => "advance_search",
                                                                "archive_search_1" => "archive_search",
                                                                "sp_news_tab_2" => "recent_&_popular_news_(10)",
                                                                "sp_news_tab_1" => "recent_&_popular_news_(5)",
                                                                "poll_1" => "poll"
                                                            );
                                                            foreach ($widget_all as $i => $row) {
                                                                ?>
                                                    <option value="<?php echo $i; ?>" <?php
                                                if (in_array($i, $special_category['widgets'])) {
                                                    echo 'selected';
                                                }
                                                ?>>
    <?php echo translate($row); ?>
                                                    </option>
    <?php
}
?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('special_category_updated!'); ?>'>
                                <?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-7" class="tab-pane fade">
<?php
$video_gal = json_decode($this->Crud_model->get_settings_value('ui_settings', 'video_gal', 'value'), true);
?>
                        <div class="row">
                            <div class="col-md-12 form-horizontal">
<?php
echo form_open(base_url() . 'admin/ui_home/video_gal_data/', array(
    'class' => 'form-horizontal',
    'method' => 'post',
    'id' => '',
    'enctype' => 'multipart/form-data'
));
?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_video_gal" class='sw' data-set='set_video_gal' data-success='<?php echo translate('video_gallery_enabled'); ?>' data-unsuccess='<?php echo translate('video_gallery_disabled'); ?>' type="checkbox" <?php if ($video_gal['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="video_gal_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('title'); ?></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="title" value="<?php echo $video_gal['title']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="margin-top:15px;" ><?php echo translate('choose_style'); ?></label>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <?php
                                                $video_gal_style = $video_gal['style'];
                                                $style = array(1, 2);
                                                foreach ($style as $value) {
                                                    ?>
                                                    <div class="cc-selector col-sm-6">
                                                        <input type="radio" id="video_gal_<?php echo $value; ?>" value="<?php echo $value; ?>" name="style" <?php
                                                    if ($video_gal_style == $value) {
                                                        echo 'checked';
                                                    }
                                                    ?> >
                                                        <label class="drinkcard-cc" style="margin-bottom:0px; width:100%;" for="video_gal_<?php echo $value; ?>">
                                                            <img src="<?php echo base_url() ?>uploads/styles/<?php echo 'video_gal_' . $value . '.jpg' ?>" width="100%" height="100%" alt="<?php echo 'video_gal_style_' . $value; ?>" />


                                                        </label>
                                                    </div>
                            <?php
                        }
                        ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('video_gallery_updated!'); ?>'>
                                <?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="tabb-8" class="tab-pane fade">
<?php
$home_cat = json_decode($this->Crud_model->get_settings_value('ui_settings', 'home_cat', 'value'), true);
?>
                        <div class="row">
                            <div class="col-md-12 form-horizontal">
<?php
echo form_open(base_url() . 'admin/ui_home/home_cat_data/', array(
    'class' => 'form-horizontal',
    'method' => 'post',
    'id' => '',
    'enctype' => 'multipart/form-data'
));
?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('display_status'); ?></label>
                                    <div class="col-sm-6">
                                        <input id="set_home_cat" class='sw' data-set='set_home_cat' data-success='<?php echo translate('home_category_enabled'); ?>' data-unsuccess='<?php echo translate('home_category_disabled'); ?>' type="checkbox" <?php if ($home_cat['status'] == 'ok') { ?>checked<?php } ?> />
                                    </div>
                                </div>
                                <div id="home_cat_data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo translate('choose_outlook'); ?></label>
                                        <div class="col-sm-6">
                                            <select class="demo-chosen-select" name="outlook" id="outlook">
                                                <option value="single" <?php
                                                            if ($home_cat['outlook'] == 'single') {
                                                                echo 'selected';
                                                            }
?>>
                                                <?php echo translate('single_style'); ?>
                                                </option>
                                                <option value="multi" <?php
                                                if ($home_cat['outlook'] == 'multi') {
                                                    echo 'selected';
                                                }
                                                ?>>
                                                    <?php echo translate('multiple_style'); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="single">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                                                               <?php echo translate('choose_categories'); ?>
                                            </label>
                                            <div class="col-sm-6">
<?php
echo $this->Crud_model->select_html('news_category', 'categories', 'name', 'edit', 'demo-cs-multiselect', json_encode($home_cat['categories']), '', '', '');
?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" style="margin-top:15px;" ><?php echo translate('choose_style'); ?></label>
                                            <div class="col-sm-6">
                                                <div class="row">
<?php
$home_cat_style = $home_cat['style'];
$style = array(1, 2, 3, 4, 5);
foreach ($style as $value) {
    ?>
                                                        <div class="cc-selector col-sm-6">
                                                            <input type="radio" id="home_cat_<?php echo $value; ?>" value="<?php echo $value; ?>" name="style" <?php
                                            if ($home_cat_style == $value) {
                                                echo 'checked';
                                            }
                                            ?> >
                                                            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%;" for="home_cat_<?php echo $value; ?>">
                                                                <img src="<?php echo base_url() ?>uploads/styles/<?php echo 'home_cat_' . $value . '.jpg' ?>" width="100%" height="100%" alt="<?php echo 'home_cat_style_' . $value; ?>" />


                                                            </label>
                                                        </div>
    <?php
}
?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('home_categories_updated!'); ?>'>
<?php echo translate('update'); ?>
                                        </span>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url() ?>uploads/others/home_page_1.png" width="100%" style=" text-align-last:center;" alt="<?php echo translate('home_page'); ?>" />
        </div>
    </div>     
</div>
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'ui_home';
    var list_cont_func = '';
    var dlt_cont_func = '';

    $(document).ready(function (e) {
        check_status_sw('scrolling_news');
        check_status_sw('top_news');
        check_status_sw('sliding_news');
        check_status_sw('detail_news');
        check_status_sw('photo_gal');
        check_status_sw('special_category');
        check_status_sw('video_gal');
        check_status_sw('home_cat');

        check_cat_outlook();
        set_select();
        $(".sw").each(function () {
            var h = $(this);
            var id = h.attr('id');
            var set = h.data('set');
            var success = h.data('success');
            var unsuccess = h.data('unsuccess');
            new Switchery(document.getElementById(id), {color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = document.querySelector('#' + id);
            changeCheckbox.onchange = function () {
                ajax_load(base_url + '' + user_type + '/' + module + '/' + set + '/' + changeCheckbox.checked, '', '');
                if (changeCheckbox.checked == true) {
                    $.activeitNoty({
                        type: 'success',
                        icon: 'fa fa-check',
                        message: success,
                        container: 'floating',
                        timer: 3000

                    });
                    sound('published');
                } else {
                    $.activeitNoty({
                        type: 'danger',
                        icon: 'fa fa-check',
                        message: unsuccess,
                        container: 'floating',
                        timer: 3000

                    });
                    sound('unpublished');
                }
            };
        });
    });
    function check_status_sw(type) {
        if ($('#set_' + type).is(':checked')) {
            $('#' + type + '_data').show('slow');
        } else {
            $('#' + type + '_data').hide('slow');
        }
    }
    $('#set_scrolling_news').on('change', function () {
        check_status_sw('scrolling_news');
    });
    $('#set_top_news').on('change', function () {
        check_status_sw('top_news');
    });
    $('#set_sliding_news').on('change', function () {
        check_status_sw('sliding_news');
    });
    $('#set_detail_news').on('change', function () {
        check_status_sw('detail_news');
    });
    $('#set_photo_gal').on('change', function () {
        check_status_sw('photo_gal');
    });
    $('#set_special_category').on('change', function () {
        check_status_sw('special_category');
    });
    $('#set_video_gal').on('change', function () {
        check_status_sw('video_gal');
    });
    $('#set_home_cat').on('change', function () {
        check_status_sw('home_cat');
    });
    function set_select() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    }
    function check_cat_outlook() {
        if ($('#outlook option:selected').val() == 'single') {
            $('#multi').hide('slow');
            $('#single').show('slow');
        } else {
            $('#single').hide('slow');
            $('#multi').show('slow');
        }
    }
    $('#outlook').on('change', function () {
        check_cat_outlook();
    });
</script>
<style>
    .tab-pane{
        margin-bottom: 200px;
    }
    .horizontal-tab{
        margin:15px;
    }
    .horizontal-tab .nav-tabs{
        border: 0;
        display:block !important;
        width:100%;
    }
    .horizontal-tab .nav-tabs li{
        float:left;
    }
    .horizontal-tab .nav-tabs li:hover{
        border-bottom:2px solid #dadada;
    }
    .horizontal-tab .nav-tabs li.active{
        border-bottom:2px solid #489eed;
    }
    .horizontal-tab .nav-tabs li.active a{
        background:#FFF;
    }
    .horizontal-tab .nav-tabs>li:not(.active) a:hover {
        border-color:#fff !important;
    }
    .horizontal-tab .tab-content{
        display:block !important;
    }
    .img_show{
        position:relative;
        height:400px;
        overflow:auto;
    }
    .img_show::-webkit-scrollbar{
        width: 3px;
        background: #737373;
    }
    .img_show::-webkit-scrollbar-thumb{
        background: #fff;
    }
    .img_show::-webkit-scrollbar{
        width: 3px;
        background: #737373;
    }
    .img_show::-webkit-scrollbar-thumb{
        background: #fff;
    }
    .home_title{
        display: block;
        text-align: center;
    }
    .home_title span i{
        opacity: 0;
    }
    .home_title.active span i{
        opacity: 1;
        color:#096;
    }
</style>
