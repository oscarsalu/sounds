    
 $(document).ready(function() {
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
    // $('.search-chat').on('click','.invitecontact', function (){

    //     var parent = $(this).parent();
    //     console.log(parent);
    //     var id = parent.find('#id').val();
    //     console.log(id);
    //     var name = parent.find('#name_invite').val();
    //     console.log(name);
    //     $('#user_id2').val(id);
    //     $('.name_contact').html(name);
    // });

    $('.tab-content').on('click','.load_iframe', function (){
        var chirent = $(this).find('input[name=link_iframe]');
        console.log(chirent.val());
        $("#frame").attr('src',chirent.val());
    });
    $('#invite_contacts').on('click','.btn_accept', function (){
        var parent = $(this).parent().parent();
        var id = parent.find("input[name=invite]").val();
        $('#id_invite').val(id);
        $('#contact_form_accept').submit();
     });
    $('#invite_contacts').on('click','.btn_delete', function (){
        var parent = $(this).parent().parent();
        var id = parent.find("input[name=invite]").val();
        $('#contact_form_delete .id_invite').val(id);
        $('#contact_form_delete').submit();
    });
    $('#groups').on('click','.btn-edit', function (){
        var parent = $(this).parent().parent();
        var id = parent.find('#id_gr').val();
        var name = parent.find('#name_gr').val();
        var member = parent.find('#member_gr').val();
        var dataarray=member.split(",");
        $('#edit_group').val(id);
        $('#edit_name').val(name);
        $.each(member.split(","), function(i,e){
            $("#edit_member option[value='" + e + "']").attr("selected", 1);
        });
        $('select').trigger("chosen:updated");
    });
    $('#groups').on('click','.btn-del', function (){
        if(confirm("Are you sure you want to delete this group?")){
            var parent = $(this).parent().parent();
            var id = parent.find('#id_gr').val();
            $('#delete_id').val(id); 
            $('#form_delete').submit();
            
        }
    });
    $('.list_recent_chat').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var page = parseInt($(this).find(".level_page").val());
            var current = $(this);
           
            $.ajax({             
                url: link+'chat/load_recent_chat',
                type: "post",
                data: { 
                    'page' : page,
                    'csrf_test_name':get_csrf_hash
                },
                dataType: "json",               
                success:function(response){
                    $.each(response , function (index, value){
                       current.append(value);
                    });       
                    current.find(".level_page").val(page+1);                                                                                        
                }
            }); 
        }
    });
}); 

 var searchRequest1 = null;
$(function () {
    var minlength = 5;
    console.log("function");
    $("input#text-input-field").keypress(function (e) {
        var that = this,
        value = $("input#text-input-field").val();
        if (e.keyCode === 0 || e.keyCode === 32) {
            var word = value.split(" ").pop();
            if (searchRequest1 != null) 
                searchRequest1.abort();
            searchRequest1 = $.ajax({
                type: "GET",
                url: link + "chat/spam_word/" + word,
                dataType: "json",
                success: function(msg){
                    console.log(msg);
                     if (msg !== "success") {
                            alert(msg);
                            var avoid = word;
                            var lastIndex = value.lastIndexOf(" ");
                            // var abc=value.replace(avoid, '');
                            value = value.substring(0, lastIndex);
                            $("input#text-input-field").val(value);
                        }
                    //we need to check if the value is the same
                    if (value==$(that).val()) {
                    //Receiving the result of search here
                    }
                }
            });
            
        }
    });
});