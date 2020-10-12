
<div>
    <?php
    echo form_open(base_url() . 'admin/page/do_serial/' . $page_id, array(
        'class' => 'form-horizontal',
        'method' => 'post',
        'id' => 'page_serial',
        'enctype' => 'multipart/form-data'
    ));
    ?>
    <div class="panel-body">
        <textarea style="display:none;" name="serial" id="nestable-output"></textarea>
        <div class="cf nestable-lists">
            <div class="dd" id="nestable">
                <ol class="dd-list">
                    <?php
                    $already = array();
                    foreach ($widget as $row) {
                        if ($this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title')) {
                            $already[] = $row['id'];
                            $show = 'ok';
                            if ($page_id == 2 && $row['id'] == 1) {
                                $show = 'no';
                            }
                            if ($page_id == 2 && $row['id'] == 2) {
                                $show = 'no';
                            }
                            if ($show == 'ok') {
                                ?>
                                <li class="dd-item " data-id="<?php echo $row['id']; ?>">
                                    <div class="dd-handle dd3-handle">Drag</div>
                                    <div class="dd3-content">
                                        <div class="col-md-8">
                                            <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                        </div>
                                        <div class="col-md-4 pull-right">
                                            <input id="test_<?php echo $row['id']; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                    <?php
                    foreach ($all_widget as $row) {
                        if (!in_array($row['widget_id'], $already)) {
                            $show = 'ok';
                            if ($page_id == 2 && $row['widget_id'] == 1) {
                                $show = 'no';
                            }
                            if ($page_id == 2 && $row['widget_id'] == 2) {
                                $show = 'no';
                            }
                            if ($show == 'ok') {
                                ?>
                                <li class="dd-item row" data-id="<?php echo $row['widget_id']; ?>">
                                    <div class="dd-handle dd3-handle">Drag</div>
                                    <div class="dd3-content ">
                                        <div class="col-md-8">
                                            <?php echo $row['title'] ?> 
                                        </div>
                                        <div class="col-md-4 pull-right">
                                            <input id="test_<?php echo $row['widget_id']; ?>" name="status[<?php echo $row['widget_id']; ?>]"  class='sw99' value="ok" type="checkbox"  />
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ol>
            </div>
        </div>

    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-11">
                <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                      onclick="ajax_set_full('serial', '<?php echo translate('page_serial'); ?>', '<?php echo translate('successfully_serialized!'); ?>', 'page_serial', '<?php echo $page_id; ?>');
                      "><?php echo translate('reset'); ?>
                </span>
            </div>

            <div class="col-md-1">
                <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
            </div>

        </div>
    </div>
</form>
</div>
<script>
    $(document).ready(function () {


        $(".sw99").each(function () {
            new Switchery(document.getElementById('test_' + $(this).data('id')), {color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
        });

        var updateOutput = function (e)
        {
            var list = e.length ? e : $(e.target),
                    output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };


        // activate Nestable for list

        $('#nestable').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));

    });
</script>

