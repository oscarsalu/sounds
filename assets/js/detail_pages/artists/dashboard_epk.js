//link: view/artist/RPK.php
    $(document).ready(function() {
        $('#sendmail').on('click','.epk-tpl_box_scroll ul li', function (){
            $( ".epk-tpl_box_scroll ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#tpl_email" ).val(tpl_vl);
        });
        
        $('#sendmail').on('click','.myButton', function (){
            var parent = $(this).parent().parent();
            var messager = $('#msg').val();
            var value_epk = parent.find('.hidden-val').val();
             $.ajax({
             type: "POST",
             url: base_url + 'artist/dashboard_epk/load_tpl_email/'+value_epk ,
             dataType: "text",
             data: {'msg':messager},
             success: function(datatest) {
                    console.log(datatest);
                     $('#template1').html(datatest);
                     $('#template1').show();
                    $('#template2').hide();
                 }
             });
	    });
        
	});
    
    $('.epk-tpl_box_scroll ul li a').click(function(e) {
          $('#preview img').attr('src', $(this).attr('data-img-url'));
        }); 
