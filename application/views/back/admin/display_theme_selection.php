<input type="hidden" name="tab_name" value="<?php echo $tab_name; ?>" id="tab_name"/>
<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_theme_selection'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs" style="display:none;">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1" id="theme"><?php echo translate('choose_theme'); ?></a>
                    </li>
                </ul>

                <div class="tab-content bg_grey">
                    <span id="genset"></span>
                    <div id="tab-1" class="tab-pane fade active in">
                        <div id="choose_theme">
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade">
                        <div id="choose_color">
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
    var module = 'display_theme_selection';
    var list_cont_func = '';
    var dlt_cont_func = '';

    $('#theme').on('click', function () {
        $("#choose_theme").load("<?php echo base_url() ?>admin/theme_part/");
    });

    $(document).ready(function () {
        var tab_name = $('#tab_name').val();
        if (tab_name == "theme") {
            $('#theme').click();
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

