<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow" ><?php echo translate('manage_product_package'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div style="border-bottom: 1px solid #ebebeb;padding: 25px 5px 5px 5px;"
                         class="col-md-12" >
                        <button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right mar-rgt" 
                                onclick="ajax_modal('add', '<?php echo translate('add_product_package'); ?>', '<?php echo translate('successfully_added!'); ?>', 'product_type_add', '')">
                                    <?php echo translate('create_product_package'); ?>
                        </button>
                    </div>
                    <br>
                    <div class="tab-pane fade active in" 
                         id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="sw1" style="display:none;"></span>
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'product_type';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';

    function set_switchery() {
        $(".aiz_switchery").each(function () {
            new Switchery($(this).get(0), {color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = $(this).get(0);

            var false_msg = $(this).data('fm');
            var true_msg = $(this).data('tm');

            changeCheckbox.onchange = function () {

                $('#sw1').load(base_url + '' + user_type + '/' + module + '/' + $(this).data('set') + '/' + $(this).data('id') + '/' + changeCheckbox.checked);

                if (changeCheckbox.checked == true) {
                    $.activeitNoty({
                        type: 'success',
                        icon: 'fa fa-check',
                        message: true_msg,
                        container: 'floating',
                        timer: 3000
                    });
                    sound('published');
                } else {
                    $.activeitNoty({
                        type: 'danger',
                        icon: 'fa fa-check',
                        message: false_msg,
                        container: 'floating',
                        timer: 3000
                    });
                    sound('unpublished');
                }
                //alert(changeCheckbox.checked);
            };
        });
    }
    $(document).ready(function () {
        set_switchery();
    });

</script>

