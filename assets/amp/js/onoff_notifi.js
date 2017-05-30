$(document).ready(function() {    
    $("#myonoffswitch").change(function(){
        var  check= $('#myonoffswitch').attr('checked');
        if(check){
            $('#myonoffswitch').attr('checked',false); 
            current_check = false;
        }else{
            $('#myonoffswitch').attr('checked',true); 
            current_check = true;
        }
        $.post(
            onoff_notifi,
            {
                'checked': current_check,
                'type' : 'sales',
                'get_csrf_token_name':get_csrf_hash
            }
        );
    });
    $("#myonoffswitch2").change(function(){
        var  check= $('#myonoffswitch2').attr('checked');
        if(check){
            $('#myonoffswitch2').attr('checked',false); 
            current_check = false;
        }else{
            $('#myonoffswitch2').attr('checked',true); 
            current_check = true;
        }
        $.post(
            onoff_notifi,
            {
                'checked': current_check,
                'type' : 'request',
                'get_csrf_token_name':get_csrf_hash
            }
        );
    });
});