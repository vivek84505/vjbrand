<input type="hidden" name="tab_name" value="<?php echo $tab_name; ?>" id="tab_name"/>
<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_theme_settings'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs" style="display:none;">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1" id="header"><?php echo translate('header'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-2" id="page_elements"><?php echo translate('page_elements'); ?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-3" id="footer"><?php echo translate('footer'); ?></a>
                    </li>
                </ul>
                <div class="tab-content bg_grey">
                    <span id="genset"></span>
                    <div id="tab-1" class="tab-pane fade active in">
                        <div id="header_set">
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade">
                        <div id="page_elements_set">
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade">
                        <div id="footer_set">
                        </div>
                    </div>
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
    var module = 'display_theme_settings';
    var list_cont_func = '';
    var dlt_cont_func = '';

    $('#header').on('click', function () {
        $("#header_set").load("<?php echo base_url() ?>admin/header_part/");
    });
    $('#page_elements').on('click', function () {
        $("#page_elements_set").load("<?php echo base_url() ?>admin/page_elements/");
    });
    $('#footer').on('click', function () {
        $("#footer_set").load("<?php echo base_url() ?>admin/footer_part/");
    });

    $(document).ready(function () {
        var tab_name = $('#tab_name').val();
        if (tab_name == "header") {
            $('#header').click();
        } else if (tab_name == "page_elements") {
            $('#page_elements').click();
        } else if (tab_name == "footer") {
            $('#footer').click();
        }
        $("form").submit(function (e) {
            return false;
        });
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
        -webkit-transition: all .6s ease-in-out;
        -moz-transition: all .6s ease-in-out;
        transition: all .6s ease-in-out;
        -webkit-filter:opacity(1);
        -moz-filter:opacity(1);
        filter:opacity(1);
        border:4px solid transparent;
        border-radius:5px !important;
    }
    .drinkcard-cc:hover{
        -webkit-filter:opacity(1);
        -moz-filter: opacity(1);
        filter:opacity(1);
        border:4px solid #8400C5;

    }

</style>

