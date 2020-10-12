
<link href="<?php echo base_url(); ?>template/back/plugins/nestable2/nestable.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>template/back/plugins/nestable/nestable.js"></script>

<div class="tab-base">
    <div class="panel">
        <div class="tab-base tab-stacked-left">
            <ul class="nav nav-tabs">
                <li class="active" >
                    <a data-toggle="tab" href="#page-1"><?php echo translate('home'); ?></a>
                </li>

                <li class="" >
                    <a data-toggle="tab" href="#page-2"><?php echo translate('categories'); ?></a>
                </li>
                <li class="" >
                    <a data-toggle="tab" href="#page-3"><?php echo translate('featured'); ?></a>
                </li>
                <li class="" >
                    <a data-toggle="tab" href="#page-4"><?php echo translate('latest'); ?></a>
                </li>
                <li class="" >
                    <a data-toggle="tab" href="#page-5"><?php echo translate('contact'); ?></a>
                </li>
                <li class="" >
                    <a data-toggle="tab" href="#page-6"><?php echo translate('product_view'); ?></a>
                </li>

            </ul>

            <div class="tab-content bg_grey">

                <div id="page-1" class="tab-pane fade active in">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('home'); ?></h3>
                        </div>
                        <?php
                        $page_id = 1;
                        echo form_open(base_url() . 'admin/widget/do_serial/1', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'page_serial1',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <div class="panel-body">
                            <textarea style="display:none;" name="serial" id="nestable-output1"></textarea>
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable1">
                                    <ol class="dd-list">
                                        <?php
                                        $widget = json_decode($this->db->get_where('page', array(
                                                    'page_id' => 1
                                                ))->row()->parts, true);
                                        $already = array();
                                        foreach ($widget as $row) {
                                            if ($this->db->get_where('widget', array('widget_id' => $row['id']))->num_rows() > 0) {
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
                                                    <li class="dd-item" data-id="<?php echo $row['id']; ?>">
                                                        <div class="dd-handle dd3-handle">Drag</div>
                                                        <div class="dd3-content">
                                                            <div class="col-md-8">
                                                                <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                                            </div>
                                                            <div class="col-md-4 pull-right">
                                                                <input id="test_<?php echo $row['id'] . '_' . $page_id; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
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
                                                    <li class="dd-item" data-id="<?php echo $row['widget_id']; ?>">
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
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial1', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div id="page-2" class="tab-pane fade">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('categories'); ?></h3>
                        </div>
                        <?php
                        $page_id = 2;
                        echo form_open(base_url() . 'admin/widget/do_serial/2', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'page_serial2',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <div class="panel-body">
                            <textarea style="display:none;" name="serial" id="nestable-output2"></textarea>
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable2">
                                    <ol class="dd-list">
                                        <?php
                                        $widget = json_decode($this->db->get_where('page', array(
                                                    'page_id' => 2
                                                ))->row()->parts, true);
                                        $already = array();
                                        foreach ($widget as $row) {
                                            if ($this->db->get_where('widget', array('widget_id' => $row['id']))->num_rows() > 0) {
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
                                                    <li class="dd-item" data-id="<?php echo $row['id']; ?>">
                                                        <div class="dd-handle dd3-handle">Drag</div>
                                                        <div class="dd3-content">
                                                            <div class="col-md-8">
                                                                <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                                            </div>
                                                            <div class="col-md-4 pull-right">
                                                                <input id="test_<?php echo $row['id'] . '_' . $page_id; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
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
                                                    <li class="dd-item" data-id="<?php echo $row['widget_id']; ?>">
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
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial2', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div id="page-3" class="tab-pane fade">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('featured'); ?></h3>
                        </div>
                        <?php
                        $page_id = 3;
                        echo form_open(base_url() . 'admin/widget/do_serial/3', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'page_serial3',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <div class="panel-body">
                            <textarea style="display:none;" name="serial" id="nestable-output3"></textarea>
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable3">
                                    <ol class="dd-list">
                                        <?php
                                        $widget = json_decode($this->db->get_where('page', array(
                                                    'page_id' => 3
                                                ))->row()->parts, true);
                                        $already = array();
                                        foreach ($widget as $row) {
                                            if ($this->db->get_where('widget', array('widget_id' => $row['id']))->num_rows() > 0) {
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
                                                    <li class="dd-item" data-id="<?php echo $row['id']; ?>">
                                                        <div class="dd-handle dd3-handle">Drag</div>
                                                        <div class="dd3-content">
                                                            <div class="col-md-8">
                                                                <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                                            </div>
                                                            <div class="col-md-4 pull-right">
                                                                <input id="test_<?php echo $row['id'] . '_' . $page_id; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
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
                                                    <li class="dd-item" data-id="<?php echo $row['widget_id']; ?>">
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
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial3', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div id="page-4" class="tab-pane fade">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('latest'); ?></h3>
                        </div>
                        <?php
                        $page_id = 4;
                        echo form_open(base_url() . 'admin/widget/do_serial/4', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'page_serial4',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <div class="panel-body">
                            <textarea style="display:none;" name="serial" id="nestable-output4"></textarea>
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable4">
                                    <ol class="dd-list">
                                        <?php
                                        $widget = json_decode($this->db->get_where('page', array(
                                                    'page_id' => 4
                                                ))->row()->parts, true);
                                        $already = array();
                                        foreach ($widget as $row) {
                                            if ($this->db->get_where('widget', array('widget_id' => $row['id']))->num_rows() > 0) {
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
                                                    <li class="dd-item" data-id="<?php echo $row['id']; ?>">
                                                        <div class="dd-handle dd3-handle">Drag</div>
                                                        <div class="dd3-content">
                                                            <div class="col-md-8">
                                                                <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                                            </div>
                                                            <div class="col-md-4 pull-right">
                                                                <input id="test_<?php echo $row['id'] . '_' . $page_id; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
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
                                                    <li class="dd-item" data-id="<?php echo $row['widget_id']; ?>">
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
                                          onclick="ajax_set_full('serial', '<?php echo translate('page_serial'); ?>', '<?php echo translate('successfully_serialized!'); ?>', 'page_serial', '<?php echo $page_id; ?>');"><?php echo translate('reset'); ?>
                                    </span>
                                </div>

                                <div class="col-md-1">
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial4', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div id="page-5" class="tab-pane fade">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('contact'); ?></h3>
                        </div>
                        <?php
                        $page_id = 1;
                        echo form_open(base_url() . 'admin/widget/do_serial/5', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'page_serial5',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <div class="panel-body">
                            <textarea style="display:none;" name="serial" id="nestable-output5"></textarea>
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable5">
                                    <ol class="dd-list">
                                        <?php
                                        $widget = json_decode($this->db->get_where('page', array(
                                                    'page_id' => 5
                                                ))->row()->parts, true);
                                        $already = array();
                                        foreach ($widget as $row) {
                                            if ($this->db->get_where('widget', array('widget_id' => $row['id']))->num_rows() > 0) {
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
                                                    <li class="dd-item" data-id="<?php echo $row['id']; ?>">
                                                        <div class="dd-handle dd3-handle">Drag</div>
                                                        <div class="dd3-content">
                                                            <div class="col-md-8">
                                                                <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                                            </div>
                                                            <div class="col-md-4 pull-right">
                                                                <input id="test_<?php echo $row['id'] . '_' . $page_id; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
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
                                                    <li class="dd-item" data-id="<?php echo $row['widget_id']; ?>">
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
                                          onclick="ajax_set_full('serial', '<?php echo translate('page_serial'); ?>', '<?php echo translate('successfully_serialized!'); ?>', 'page_serial', '<?php echo $page_id; ?>');"><?php echo translate('reset'); ?>
                                    </span>
                                </div>

                                <div class="col-md-1">
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial5', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div id="page-6" class="tab-pane fade">
                    <div class="panel">

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('product_view'); ?></h3>
                        </div>
                        <?php
                        $page_id = 12;
                        echo form_open(base_url() . 'admin/widget/do_serial/12', array(
                            'class' => 'form-horizontal',
                            'method' => 'post',
                            'id' => 'page_serial6',
                            'enctype' => 'multipart/form-data'
                        ));
                        ?>
                        <div class="panel-body">
                            <textarea style="display:none;" name="serial" id="nestable-output6"></textarea>
                            <div class="cf nestable-lists">
                                <div class="dd" id="nestable6">
                                    <ol class="dd-list">
                                        <?php
                                        $widget = json_decode($this->db->get_where('page', array(
                                                    'page_id' => 12
                                                ))->row()->parts, true);
                                        $already = array();
                                        foreach ($widget as $row) {
                                            if ($this->db->get_where('widget', array('widget_id' => $row['id']))->num_rows() > 0) {
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
                                                    <li class="dd-item" data-id="<?php echo $row['id']; ?>">
                                                        <div class="dd-handle dd3-handle">Drag</div>
                                                        <div class="dd3-content">
                                                            <div class="col-md-8">
                                                                <?php echo $this->Crud_model->get_type_name_by_id('widget', $row['id'], 'title'); ?> 
                                                            </div>
                                                            <div class="col-md-4 pull-right">
                                                                <input id="test_<?php echo $row['id'] . '_' . $page_id; ?>" class='sw99' value="ok"  name="status[<?php echo $row['id']; ?>]" type="checkbox" data-id="<?php echo $row['id']; ?>"  <?php if ($row['status'] == 'ok') { ?>checked<?php } ?> />
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
                                                    <li class="dd-item" data-id="<?php echo $row['widget_id']; ?>">
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
                                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_serial6', '<?php echo translate('page_widget_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                </div>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {


        $(".sw99").each(function () {
            new Switchery($(this).get(0), {color: 'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
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

        $('#nestable1').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable1').data('output', $('#nestable-output1')));

        // activate Nestable for list

        $('#nestable2').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable2').data('output', $('#nestable-output2')));

        // activate Nestable for list

        $('#nestable3').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable3').data('output', $('#nestable-output3')));

        // activate Nestable for list

        $('#nestable4').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable4').data('output', $('#nestable-output4')));

        // activate Nestable for list

        $('#nestable5').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable5').data('output', $('#nestable-output5')));

        // activate Nestable for list

        $('#nestable6').nestable({

            group: 1

        })

                .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable6').data('output', $('#nestable-output6')));

    });
</script>

