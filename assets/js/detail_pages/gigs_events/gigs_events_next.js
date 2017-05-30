$(document).ready(function() {  
        $('#view_all').on('click','#view_event', function (){ 
                  var title = $(this).find('.event_title').val(); 
                  var location = $(this).find('.event_location').val();   
                  var start_date = $(this).find('.event_start').val();
                  var end_date = $(this).find('.event_end').val(); 
                  var banner = $(this).find('.event_banner').val(); 
                  var html ='';
                  html +='<div class="panel-heading">'+title+'</div>';    
                  html +='<div class="panel-body"><img src="'+banner+'" class="img-responsive" style="width:100%" alt="Image"></div>'; 
                  html += '<div class="panel-footer row"><b>Location:'+location+'</b></div>';
                  //html += '<div class="panel-footer row"><b>Genres:</b></div>';
                  html +='<div class="panel-footer row"><p>Start Date: '+start_date+'</p>End Date: '+end_date+'</div>';
                 $("#info_event_show").html(html);
 });  
});