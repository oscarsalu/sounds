 $( document ).ready(function() {
        
        var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
        var page = 1;
        $(window).bind(mousewheelevt, function(e){
            var evt = window.event || e //equalize event object     
            evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible               
            var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
        
            if(delta < 0){
                var aTop = $('html').height();
                if($(this).scrollTop() >= (aTop - 730)){
                    page = page + 1;
                    $("#load_image").css("display","block");
                    $.post( '"'+base_url+'fan/fan_load_more"', {page: (page-1) },
                    function(data){
                        if(data == ""){
                            $("#load_image").remove();
                        }
                        $("#load_result").append(data);
                        $("#load_image").css("display","none");
                    });
                    
                    
                }
            }   
        });
    });