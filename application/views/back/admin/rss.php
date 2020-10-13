<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-1"><?php echo translate('RSS_export'); ?></a>
                    </li>

                </ul>

                <div class="tab-content bg_grey">
                    <!--UPLOAD : general settings ---------->
                    <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
                        <div class="panel">
                            <?php
                            $privacy_policy = $this->db->get_where('general_settings', array('type' => 'rss'))->row()->value;
                            ?>
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate('RSS_export'); ?></h3>
                            </div>
                            <?php
                            echo form_open(base_url() . 'admin/general_settings/rss/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => '',
                                'enctype' => 'multipart/form-data'
                            ));
                            ?>
                                <div class="panel-body">
                                    <?php
                                        $rss = json_decode($this->db->get_where('general_settings', array(
                                                    'type' => 'rss'
                                                ))->row()->value, true);
                                        ?>

                                    <div id="more_additional_fields">

                                        <?php
                                        if(!empty($rss)){
                                            foreach ($rss as $zz) {
                                        ?>
                                        <div class="form-group btm_border">
                                            <div class="perma_row">
                                                <div class="col-sm-3">
                                                    <h5><?php echo translate('categories')?></h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <h5><?php echo translate('limit')?></h5>
                                                </div>
                                                <div class="col-sm-5">
                                                    <h5><?php echo translate('permalink')?></h5>
                                                </div>
                                                <div class="col-sm-3 cat">
                                                    <?php echo $this->Crud_model->select_html('news_category', 'news_category[]', 'name', 'edit', 'demo-chosen-select get_category required', $zz['category_id'], '','', 'get_permalink(this.value, this)') ?>
                                                </div>
                                                <div class="col-sm-2 lim">
                                                    <input type="number" name="limit[]" value = "<?=$zz['limit']?>" placeholder="<?php echo translate('limit'); ?>" class="form-control get_limit required" onchange="get_permalink2(this.value, this)">
                                                </div>
                                                <div class="col-sm-5 perma">
                                                    <input type="text" name="permalink[]" value = "<?=$zz['permalink']?>" placeholder="<?php echo translate('permalink'); ?>" class="form-control make_perma required" readonly>
                                                </div>
                                                <div class="col-sm-2">
                                                    <span class="remove_it_v btn btn-danger" onclick="delete_row(this)"><i class="fa fa-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="form-group btm_border">
                                        <label class="col-sm-4 control-label" for="demo-hor-17"></label>
                                        <div class="col-sm-6">
                                            <div id="more_btn" class="btn btn-success btn-labeled fa fa-plus pull-right">
                                                <?php echo translate('add_more'); ?></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="panel-footer text-right">
                                    <span class="btn btn-info submitter enterer"
                                          data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>' >
                                        <?php echo translate('save'); ?>
                                    </span>
                                </div>
                                <br><br><br><br><br>
                            </form>
                        </div>
                    </div>
                    <span id="genset"></span>
                </div>

            </div>
        </div>
    </div>
</div>


<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'general_settings';
    var list_cont_func = '';
    var dlt_cont_func = '';
    $(document).ready(function () {
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

    $("#more_btn").click(function () {
        $("#more_additional_fields").append(''
                +'<div class="form-group btm_border">'
                +'  <div class="perma_row">'
                +'      <div class="col-sm-3">'
                +'          <h5><?php echo translate('categories')?></h5>'
                +'      </div>'
                +'      <div class="col-sm-4">'
                +'          <h5><?php echo translate('limit')?></h5>'
                +'      </div>'
                +'      <div class="col-sm-5">'
                +'          <h5><?php echo translate('permalink')?></h5>'
                +'      </div>'
                +'      <div class="col-sm-3 cat">'
                +'          <?php echo $this->Crud_model->select_html('news_category', 'news_category[]', 'name', 'add', 'demo-chosen-select get_category required', '', '', '', 'get_permalink(this.value, this)') ?>'
                +'      </div>'
                +'      <div class="col-sm-2 lim">'
                +'          <input type="number" name="limit[]" value="" placeholder="<?php echo translate('limit'); ?>" '
                +'              class="form-control get_limit required"  onchange="get_permalink2(this.value, this)">'
                +'      </div>'
                +'      <div class="col-sm-5 perma">'
                +'          <input type="text" name="permalink[]" value="" placeholder="<?php echo translate('permalink'); ?>" '
                +'              class="form-control make_perma required" readonly>'
                +'      </div>'
                +'      <div class="col-sm-2">'
                +'          <span class="remove_it_v btn btn-danger" onclick="delete_row(this)"><i class="fa fa-trash"></i></span>'
                +'      </div>'
                +'  </div>'
                +'</div>'
                );
        $('.demo-chosen-select').chosen();
    });

    function get_permalink(id, now){
        var cat = id;
        var limit = $(now).parent().next('.lim').find(".get_limit").val();
        if (cat == null || limit == '') {
            $(now).parent().next().next('.perma').find(".make_perma").val('');
        } else {
            $(now).parent().next().next('.perma').find(".make_perma").val('<?=base_url()?>'+'home/rss/'+cat+'/'+limit);
        }
    };

    function get_permalink2(value, now){
        var cat = $(now).parent().prev('.cat').find(".get_category").val();
        var limit = value;
        if (cat == null || limit == '') {
            $(now).parent().next('.perma').find(".make_perma").val('');
        } else {
            $(now).parent().next('.perma').find(".make_perma").val('<?=base_url()?>'+'home/rss/'+cat+'/'+limit);
        }
    }

    function delete_row(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }
    $(document).ready(function () {
        $("form").submit(function (e) {
            return false;
        });
    });

    $(document).ready(function () {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    });

    $(".range-def").on('slide', function () {
        var vals = $("#nowslide").val();
        $(this).closest(".form-group").find(".range-def-val").html(vals);
        $(this).closest(".form-group").find("input").val(vals);
    });

    function sets(now) {
        $(".range-def").each(function () {
            var min = $(this).data('min');
            var max = $(this).data('max');
            var start = $(this).data('start');
            $(this).noUiSlider({
                start: Number(start),
                range: {
                    'min': Number(min),
                    'max': Number(max)
                }
            }, true);
            if (now == 'first') {
                $(this).noUiSlider({
                    start: 500,
                    connect: 'lower',
                    range: {
                        'min': 0,
                        'max': 10
                    }
                }, true).Link('lower').to($("#nowslide"));
                $(this).closest(".form-group").find(".range-def-val").html(start);
                $(this).closest(".form-group").find("input").val(start);
            } else if (now == 'later') {
                var than = $(this).closest(".form-group").find(".range-def-val").html();

                if (than !== 'undefined') {
                    $(this).noUiSlider({
                        start: than,
                        connect: 'lower',
                        range: {
                            'min': min,
                            'max': max
                        }
                    }, true).Link('lower').to($("#nowslide"));
                }
                $(this).closest(".form-group").find(".range-def-val").html(than);
                $(this).closest(".form-group").find("input").val(than);
            }
        });
    }

    $(document).ready(function () {
        sets('later');
        $("form").submit(function (e) {
            return false;
        });

    });

</script>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<script>
    $('.delete-div-wrap .aad').on('click', function () {
        var id = $(this).closest('.delete-div-wrap').find('iframe').data('id');
    });
</script>

<style>
    .img-fixed{
        width: 100px;
    }
    .tr-bg{
        background-image: url(http://www.mikechambers.com/files/html5/canvas/exportWithBackgroundColor/images/transparent_graphic.png)
    }

    .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
        -moz-appearance:none;
        appearance:none;
    }

    .cc-selector input:active +.drinkcard-cc
    {
        opacity: 1;
        border:4px solid #169D4B;
    }
    .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
        border:4px solid black;
    }
    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter:opacity(.5);
        -moz-filter:opacity(.5);
        filter:opacity(.5);
        transition: all .6s ease-in-out;
        border:4px solid transparent;
        border-radius:5px !important;
    }
    .drinkcard-cc:hover{
        -webkit-filter:opacity(1);
        -moz-filter: opacity(1);
        filter:opacity(1);
        transition: all .6s ease-in-out;
        border:4px solid #8400C5;

    }
</style>
