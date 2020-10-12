<div class="widget_box archive_search">

    <?php
        echo form_open(base_url() . 'home/widget_archive_search/', array(
            'method' => 'post',
            'id' => 'widget_archive_search_form'
        ));
    ?>
        <h4 class="widget-title" style="margin-bottom:10px; margin-left: 5px;">
            <?php echo translate('archive_search'); ?>
        </h4>
        <div class="form-group selectpicker-wrapper">
            <select class="selectpicker" name="category" data-live-search="true" data-width="100%" id="archive_category">
                <option disabled="" selected="" value="0"><?php echo translate('categories'); ?>....</option>
                <?php
                    $cat = $this->db->get('news_category')->result_array();
                    foreach ($cat as $row) {
                        $subcat = $this->db->get_where('news_sub_category', array('parent_category_id' => $row['news_category_id']))->result_array();
                        $subcat_ids = array();
                        foreach ($subcat as $row1) {
                            $subcat_ids[] = $row1['news_sub_category_id'];
                        }
                        ?>
                        <option value="<?php echo $row['news_category_id']; ?>" 
                                data-sub="<?php
                                if (count($subcat) !== 0) {
                                    echo implode("::", $subcat_ids);
                                } else {
                                    echo 0;
                                }
                                ?>"><?php echo $row['name']; ?></option>
                                <?php
                            }
                        ?>
            </select>
        </div>
        <div class="form-group selectpicker-wrapper" id="archive_subcat_place">
            <select class="selectpicker" name="sub_category" data-live-search="true" data-width="100%" id="archive_sub_category">
                <option disabled="" selected="" value="0"><?php echo translate('sub-categories'); ?>....</option>
            </select>
        </div>
        <div class="widget">
            <div class="widget-search">
                <input class="form-control" name="text_search" id="archive_text_search" type="text" placeholder="<?php echo translate('search'); ?>">
            </div>
        </div>
        <div class="date_portion">
            <div class="input-group" id="datepicker" style="width:100%;">
                <input type="date" class="form-control" name="start_date" id="archive_start_date" style="border-radius: 4px;" placeholder="<?php echo translate('from'); ?>:" />
                <input type="date" class="form-control" name="end_date" id="archive_end_date" style="border-radius: 4px;" placeholder="<?php echo translate('to'); ?>:" />
                <button class="button-custom-btn-1 btn-block custom-btn-1 custom-btn-1-round-s letter-spacing-none custom-btn-1-text-thick custom-btn-1-text-upper custom-btn-1-size-s" data-text="<?php echo translate('search'); ?>">		
                    <span id="archive_date_search_btn"><?php echo translate('search'); ?></span>
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function (e) {
        $('.selectpicker').selectpicker();
    });
    $('#archive_category').on('change', function (e) {
        var cat = $(this).find('option:selected').val();
        var subcats = [$(this).find('option:selected').data('sub')];
        $('#archive_subcat_place').load('<?php echo base_url(); ?>home/get_subcat_archive/' + subcats, function (e) {
            $('#archive_sub_category').selectpicker();
        });
    });
    function subwise_search(now) {
    }
    ;
    $('#archive_date_search_btn').on('click', function (e) {
        var category = $('#archive_category').find('option:selected').val();
        var sub_category = $('#archive_sub_category').find('option:selected').val();
        var text_search = $('#archive_text_search').val();
        var start_date = $('#archive_start_date').val();
        var end_date = $('#archive_end_date').val();
        if (sub_category == null) {
            sub_category = '0';
        }
        if (start_date.length == '') {
            start_date = '0';
        }
        if (end_date == '') {
            end_date = '0';
        }
        $('#widget_archive_search_form').submit();
        setTimeout(function () {
            //location.replace('<?php echo base_url(); ?>home/archive_news/' + category + '/' + sub_category + '/' + start_date + '/' + end_date + '/' + text_search);
        }, 500);
    });
</script>