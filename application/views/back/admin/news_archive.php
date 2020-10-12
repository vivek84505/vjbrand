<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_archive_news'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
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
    var module = 'news_archive';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';
    var archive_func = 'from_archive';

    function archive_confirm(id, msg) {
        msg = '<div class="modal-title">' + msg + '</div>';
        bootbox.confirm(msg, function (result) {
            if (result) {
                ajax_load(base_url + '' + user_type + '/' + module + '/' + archive_func + '/' + id, 'list', 'delete');
                $.activeitNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: added_to_list,
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
</script>

