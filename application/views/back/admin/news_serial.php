<link href="<?php echo base_url(); ?>template/back/plugins/nestable2/nestable.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>template/back/plugins/nestable/nestable.js"></script>
<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_news_serial'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs">
                    <li class="active" >
                        <a data-toggle="tab" href="#section-break"><?php echo translate('breaking_news'); ?></a>
                    </li>
                    <?php 
                        $all_news_specialities = $this->db->get('news_speciality')->result_array();
                        foreach ($all_news_specialities as $row) {
                    ?>
                    <li>
                        <a data-toggle="tab" href="#section-<?php echo $row['news_speciality_id']; ?>"><?php echo $row['name']; ?></a>
                    </li>
                    <?php 
                        }
                    ?>
                </ul>

                <div class="tab-content bg_grey">


                    <div id="section-break" class="tab-pane fade active in">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('breaking_news'); ?></h3>
                            </div>
                            <?php
                                echo form_open(base_url() . 'admin/news_serial/do_update/breaking', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => 'news_serial_breaking',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                            <div class="panel-body">
                                <textarea style="display:none;" name="serial" id="nestable-output-breaking"></textarea>
                                <div class="cf nestable-lists">
                                    <div class="dd" id="nestable-breaking">
                                        <ol class="dd-list">
                                            <?php
                                                $this->db->order_by('serial_breaking','desc');
                                                $this->db->order_by('news_id','desc');
                                                $this->db->where('breaking_news','ok');
                                                $this->db->where('status','published');
                                                $breaking_news = $this->db->get('news')->result_array();
                                                foreach($breaking_news as $br_news){
                                            ?>
                                            <li class="dd-item" data-id="<?php echo $br_news['news_id'];?>">
                                                <div class="dd-handle dd3-handle">Drag</div>
                                                <div class="dd3-content">
                                                    <div class="col-md-12">
                                                        <?php echo $br_news['title'];?> 
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
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
                                              onclick="ajax_set_full('serial', '<?php echo translate('page_serial'); ?>', '<?php echo translate('successfully_serialized!'); ?>', 'page_serial', '<?php //echo $page_id;  ?>');"
                                              >
                                                  <?php echo translate('reset'); ?>
                                        </span>
                                    </div>

                                    <div class="col-md-1">
                                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('news_serial_breaking', '<?php echo translate('breaking_news_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                    </div>

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <?php 
                        $all_news_specialities = $this->db->get('news_speciality')->result_array();
                        foreach ($all_news_specialities as $row) {
                    ?>
                        <div id="section-<?php echo $row['news_speciality_id']; ?>" class="tab-pane fade">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $row['name']; ?></h3>
                                </div>
                                <?php
                                    echo form_open(base_url() . 'admin/news_serial/do_update/'.$row['news_speciality_id'], array(
                                        'class' => 'form-horizontal',
                                        'method' => 'post',
                                        'id' => 'news_serial_'.$row['news_speciality_id'],
                                        'enctype' => 'multipart/form-data'
                                    ));
                                ?>
                                <div class="panel-body">
                                    <textarea style="display:none;" name="serial" id="nestable-output-<?php echo $row['news_speciality_id']; ?>"></textarea>
                                    <div class="cf nestable-lists">
                                        <div class="dd" id="nestable-<?php echo $row['news_speciality_id']; ?>">
                                            <ol class="dd-list">
                                                <?php
                                                    $this->db->order_by('serial_'.$row['news_speciality_id'],'desc');
                                                    $this->db->order_by('news_id','desc');
                                                    $this->db->where('news_speciality_id',$row['news_speciality_id']);
                                                    $this->db->where('status','published');
                                                    $breaking_news = $this->db->get('news')->result_array();
                                                    foreach($breaking_news as $br_news){
                                                ?>
                                                <li class="dd-item" data-id="<?php echo $br_news['news_id'];?>">
                                                    <div class="dd-handle dd3-handle">Drag</div>
                                                    <div class="dd3-content">
                                                        <div class="col-md-12">
                                                            <?php echo $br_news['title'];?> 
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
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
                                                  onclick="ajax_set_full('serial', '<?php echo translate('page_serial'); ?>', '<?php echo translate('successfully_serialized!'); ?>', 'page_serial', '<?php //echo $page_id;  ?>');"
                                                  >
                                                      <?php echo translate('reset'); ?>
                                            </span>
                                        </div>

                                        <div class="col-md-1">
                                            <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('news_serial_<?php echo $row['news_speciality_id']; ?>', '<?php echo translate($row['name'].'_serial_saved!'); ?>');" ><?php echo translate('save'); ?></span>
                                        </div>

                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>                    
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var user_type = 'admin';
    var module    = 'news_serial';
    var list_cont_func = '';
    var delete_cont_func = '';
    $(document).ready(function () {

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

        $('#nestable-breaking').nestable({
            group: 1
        }).on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable-breaking').data('output', $('#nestable-output-breaking')));

        <?php 
            $all_news_specialities = $this->db->get('news_speciality')->result_array();
            foreach ($all_news_specialities as $row) {
        ?>
        // activate Nestable for list

        $('#nestable-<?php echo $row['news_speciality_id'] ?>').nestable({
            group: 1
        }).on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable-<?php echo $row['news_speciality_id'] ?>').data('output', $('#nestable-output-<?php echo $row['news_speciality_id'] ?>')));
        <?php 
            }
        ?>

    });
</script>

