<div class="information-title">
    <?php echo translate('purchased_packages'); ?>
</div>
<div class="details-wrap">
    <div id = "result">
        
    </div>
    <?php
        echo form_open(base_url() . 'home/ajax_package_list/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'filter_form'
        ));
    ?>
    </form>
</div>
<script>
    function filter_package(page){
        var form = $('#filter_form');
        var alert = $('#result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        $.ajax({
            url: form.attr('action')+page+'/', // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: formdata ? formdata : form.serialize(), // serialize form data 
            cache       : false,
            contentType : false,
            processData : false,
            beforeSend: function() {
                alert.fadeOut();
                alert.html('loading...').fadeIn(); // change submit button text
            },
            success: function(data) {
                setTimeout(function(){
                    alert.html(data); // fade in response data
                }, 20);
                setTimeout(function(){
                    alert.fadeIn(); // fade in response data
                }, 30);
            },
            error: function(e) {
                console.log(e)
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        filter_package('0');
    });
</script>
<style>
    select.input-sm, select.form-group-sm .form-control {
        height: 40px !important;
        line-height: 15px !important;
    }
    .as{
        margin-top:0px !important;
    }
    td .sm{
        height:50px;
    }
</style>