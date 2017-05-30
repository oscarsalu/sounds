//begin star
 $( document ).ready(function() {
        $('#input-2ba').on('rating.change', function (event, value, caption) {
            var rate_id = $(this).prop('id');
             //console.log(rate_id);
            var pure_id = rate_id.substring(6);
            var id_ok = $(this).find('#input-2ba').val();                
            $('#star_oke').val(value); 
            alert("You have voted - "+value+' -star');
            console.log(pure_id);
        });
    });

function changeRating()
{
	alert("rating changed");
}
    jQuery(document).ready(function () {      
            
        
        $('#input-2ba').rating({'showCaption':false, 'stars':'5', 'min':'0', 'max':'5', 'step':'0.5', 'size':'xs'});
        //$('.rb-rating').rating({'showCaption':false, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
       
    });

//end star

    $('.submit_star').click(function(){        
        //$id_unlock = $(this).find('input').val();
        var user = $("input#user").val();       
        var star_oke = $("input#star_oke").val();
        var rate = $("input#rate").val();
        var event_star = $("#event_star").val();
        var location_star = $("#location_star").val();
        var tour_star = $("#tour_star").val();  
        $.ajax({
            url: $url+"artist/showgigs/star",
            type: "post",
            data: {
                "user":user,"event_star":event_star,"location_star":location_star,"tour_star":tour_star,"star_oke":star_oke,"rate":rate,
                "csrf_test_name":$records_per_page
            },
            dataType: "json",               
            success:function(data){
                if(data['status'] == true){                          
                        $("#add_stats").hide();
                        $(".modal-backdrop").hide(); 
                        $(".oke").show();
                        $(".add_stats").hide();
                        $(".add_stats_not").show();
                        window.location.reload();   
                }else{
                        $("#add_stats").hide();
                        $(".modal-backdrop").hide();
                        $(".not_oke").show();
                        $(".add_stats").hide();
                        $(".add_stats_not").show();
                       
                        window.location.reload();  
                }                                                                              
            }
        });    
    });    
    
    
    
    
    
    
    
    