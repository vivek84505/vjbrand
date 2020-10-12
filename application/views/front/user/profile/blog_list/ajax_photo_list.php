<div class="row">

<div  id="result6">
</div>
    <!-- /Products grid -->
    <?php
        echo form_open(base_url() . 'home/profile_ajax_photo_list/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'filter_form6'
        ));
    ?>

    </form>
</div>
    
<script>        
    function filter_news(page){
        var form = $('#filter_form6');
        var alert = $('#result6');
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
    
    $(document).ready(function(e) {
        filter_news('0');
    }); 
</script>