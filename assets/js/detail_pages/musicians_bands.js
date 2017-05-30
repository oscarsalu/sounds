  $(document).ready(function() {                                  
                    $('#chooseLayout').on('click','.frame-ld a', function (){
                        
                        $("#chooseLayout .type-landing").each(function() {
                            $(this).find('.frame-ld img').removeClass("secelted");
                            $(this).find('.frame-ld img').addClass("");                            
                        });
                        
                        $(this).find('img').addClass("secelted");
                        
                        var tpl_vl = $(this).find('.hidden-val').val();                      
                        $( "#change_tpl" ).val(tpl_vl);
                    });
                    
                });
                
                 $('#chooseLayout').on('click','.btn-preview', function (){
                    var parent = $(this).parent();
                    var src = parent.find('.hidden-img').val();
                    $("#prev").attr("src",src);
        	    });
                
                $('#change_lay').click(function(){
                    $template_landing = $('#change_tpl').val();    
                                     
                    $.ajax({
                        url: url+"artist/changelayout",
                        type: "post",
                        data: {"template_landing": $template_landing},   
                        dataType: "text", 
                        success:function(response){
                            if(response = 'success'){
                                location.reload();    
                            }                            
                        }
                    });    
                });             