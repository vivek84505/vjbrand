<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_news'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                        <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right"
                                onclick="ajax_set_full('add', '<?php echo translate('add_news'); ?>', '<?php echo translate('successfully_added!'); ?>', 'news_add', ''); proceed('to_list');"><?php echo translate('create_news'); ?>
                        </button>
                        <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn"
                                style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_news_list'); ?>
                        </button>
                    </div>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var user_type = 'admin';
    var module = 'news';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';
    var archive_func = 'to_archive';

    function proceed(type) {
        if (type == 'to_list') {
            $(".pro_list_btn").show();
            $(".add_pro_btn").hide();
        } else if (type == 'to_add') {
            $(".add_pro_btn").show();
            $(".pro_list_btn").hide();
        }
    }

    function archive_confirm(id, msg) {
        msg = '<div class="modal-title">' + msg + '</div>';
        bootbox.confirm(msg, function (result) {
            if (result) {
                ajax_load(base_url + '' + user_type + '/' + module + '/' + archive_func + '/' + id, 'list', 'delete');
                $.activeitNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: added_to_archive,
                    container: 'floating',
                    timer: 3000
                });
                sound('done');
            } else {
                $.activeitNoty({
                    type: 'danger',
                    icon: 'fa fa-minus',
                    message: cncle,
                    container: 'floating',
                    timer: 3000
                });
                sound('cancelled');
            }
            ;
        });
    }

    function copy_news(post_id) {
        if (post_id != '') {
            $("body").on('click', ".cop_news", function () {
                $.ajax({url: "<?php echo base_url() ?>admin/copy_news/" + post_id + "/", success: function (result) {
                        //ajax_set_list();
                        window.location.replace(base_url + '' + user_type + '/' + module);
                    }});
            });
        }
    }
    $(document).ready(function () {
        copy_news('no');
    });
</script>
