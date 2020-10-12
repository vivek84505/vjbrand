<div class="col-md-12 col-sm-12">
    <div class="panel">
        <?php
        $footer_text = $this->db->get_where('general_settings', array('type' => 'footer_text'))->row()->value;
        $footer_category = $this->db->get_where('general_settings', array('type' => 'footer_category'))->row()->value;
        ?>
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo translate('footer_settings'); ?></h3>
        </div>
        <?php
        echo form_open(base_url() . 'admin/general_settings/footer', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => '',
            'enctype' => 'multipart/form-data'
        ));
        ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                    <?php echo translate('footer_category'); ?>
                </label>
                <div class="col-sm-8">
                    <?php
                    $categories = json_decode($footer_category);
                    $result = array();
                    if ($categories !== NULL) {
                        foreach ($categories as $row) {
                            $result[] = $row;
                        }
                    }
                    $status = '';
                    $value = '';

                    echo $this->Crud_model->select_html('news_category', 'category', 'name', 'edit', 'demo-cs-multiselect', json_encode($result), $status, $value, 'check_cat_len');
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                    <?php echo translate('footer_text'); ?>
                </label>
                <div class="col-sm-8">
                    <div class="col-sm-">
                        <textarea class="summernotes" data-height='400' data-name='footer_text'><?php echo $footer_text; ?></textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer text-right">
            <span class="btn btn-success btn-labeled fa fa-check submitter"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                <?php echo translate('save'); ?>
            </span>
        </div>
        </form>
    </div>
</div>
<script>
    function check_cat_len(id, now) {
        var parent = $(now).closest(".form-group");
        if (parent.find("select option:selected").length > 3) {
            parent.find('.chosen-drop').hide();
        } else {
            parent.find('.chosen-drop').show();
        }
    }
    $(document).ready(function () {
        if ($('.demo-cs-multiselect').closest(".form-group").find("select option:selected").length > 3) {
            setTimeout(function () {
                $('.demo-cs-multiselect').closest(".form-group").find('.chosen-drop').hide();
            }, 500);
        }

        $('.demo-cs-multiselect').chosen({width: '100%'});

        $('.summernotes').each(function () {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            now.closest('div').append('<input type="hidden" class="val" name="' + n + '">');
            now.summernote({
                height: h,
                onChange: function () {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
            now.focus();
        });
    });

</script>