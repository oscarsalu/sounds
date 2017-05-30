(function($){
		$(window).load(function(){
			var amount=Math.max.apply(Math,$("#content-1 li").map(function(){return $(this).outerWidth(true);}).get());
            var per_page=1;
			$("#content-1").mCustomScrollbar({
				axis:"x",
				//theme:"inset",
				advanced:{
					autoExpandHorizontalScroll:true
				},
				scrollButtons:{
					enable:false,
					scrollType:"stepped"
				},
                callbacks:{
                    onTotalScroll:function(){
                      $.post( load_list_artist,
                            {   
                                'page': per_page +1, 
                                'csrf_test_name':get_csrf_hash,
                            },
                            function(response){
                                $.each(response , function (index, value){
                                    if(index%2==0){
                                        print(value,1);
                                    }else{
                                        print(value,2);
                                    }
                                });  
                                per_page++;                                          
                            },
                            'json'
                        );  
                    },
                },
				keyboard:{scrollType:"stepped"},
				snapAmount:amount,
				mouseWheel:{scrollAmount:amount}
			});
		});
        
	})(jQuery);
function print(data,tag_ul){
    var res;
    $.post( call_print,
        {   
            'data': data, 
            'csrf_test_name':get_csrf_hash 
        },
        function(response){
            if(tag_ul==1){
                $(".tag_ul_1").append(response);
            }else{
                $(".tag_ul_2").append(response);
            }
        }
    );
}
var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    } 
$("[data-slider]")
    .each(function () {
      var input = $(this);
      $("<span>")
        .addClass("output")
        .insertAfter($(this));
    })
    .bind("slider:ready slider:changed", function (event, data) {
      $(this)
        .nextAll(".output:first")
          .html(data.value.toFixed()+'%');
    });
    $(document).ready(function() {
        $('.fan-capture').on('click','.btn_view_shortcode', function (){
            var parent = $(this).parent().parent();
            var shortcode = parent.find('.hide_shortcode').val();
            var affiliate_id = parent.find('.hide_affiliate_id').val();
            var artist_name = parent.find('.hide_name_artist').val();
            $('#viewshortcode .shortcode-view').text(shortcode); 
            $('#viewshortcode .artist_name').text(artist_name); 
            $('#iframe_amp').attr('src',base_url+'/amp/embed/'+affiliate_id);
        });
        $('#viewshortcode').on('hidden.bs.modal', function (e) {
           $('#iframe_amp').attr('src','');
        });
    });
    function copy_txt()
    {
        copyTextToClipboard($('#shortcode-view').val());
      //  alert($('#shortcode-view').val());
    }
    function copyToClipboard(element) 
    {
     var copyTextarea = document.querySelector(element);
      copyTextarea.select();
    
      try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
      } catch (err) {
        console.log('Oops, unable to copy');
      }
    }
$(document).ready(function(){
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        //$('#search').removeClass('in').addClass('collapse').slideUp(200);
    
        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
        
    });
    $(".horizontal-images .wp_fan_slide").hover(function(){
        $(this).find(".content_pan_cp").slideUp();
        //$(this).find(".content_pan_cp_hover").fadeIn();
        $(this).find(".content_pan_cp_hover").slideDown();
    },function(){
        $(this).find(".content_pan_cp_hover").slideUp();
        //$(this).find(".content_pan_cp_hover").fadeIn();
        $(this).find(".content_pan_cp").slideDown();
    })
    $(".become_affiliate").click(function(e){
        e.preventDefault();
        var Id = $(this).attr("data-affiliateId");
        window.location.replace(become_affiliate+"/"+Id);
    })
})	