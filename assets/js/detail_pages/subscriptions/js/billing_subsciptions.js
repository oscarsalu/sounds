 // **************************************//
    // file billing_subsciptions
   // **************************************//
   	$(function () {
	    $('.navbar-toggle').click(function () {
	        $('.navbar-nav').toggleClass('slide-in');
	        $('.side-body').toggleClass('body-slide-in');
	    });
        $('.btn-cancel_sub').click(function (){
           var id_sub = $(this).attr('data-ember-action') ;
           BootstrapDialog.show({
                title: 'Cancel Subscription',
                message: function(dialog) {
                    var $content = $('#modal-cancel').html();
                    $('.btn-cancel-next').click(function(event) {
                        alert('ddsfdsf');
                    });
                    return $content;
                    
                },
                type : BootstrapDialog.TYPE_INFO,
                buttons: [{
                    id: 'btn-1',
                    label: 'Close',
                    action: function(dialog) {
                        dialog.close();(false);
                    }
                }]
            });

        });
        $("#card_form").submit(function(e){
            var uri = $(this).attr('action');
            $.ajax({
                type: "PUT",
                url: uri,
                dataType: "json",
                data: {
                    'ccinput1': $("#ccinput1").val(),
                    'ccinput2': $("#ccinput2").val(),
                    'ccinput3': $("#ccinput3").val(),
                    'ccinput4': $("#ccinput4").val(),
                    'ccinput7': $("#ccinput7").val(),
                    'ccinput8': $("#ccinput8").val(),
                    'ccinput9': $("#ccinput9").val(),
                    'ccinput10': $("#ccinput10").val(),
                    'ccinput11': $("#ccinput11").val()
                },
                success: function(response) {
                    console.log(response);
                    if(response.code==0){
                      location.reload();
                    }else{
                        $("#card_error").html(response.message);
                        $("#card_error").show();
                    }
                    
                     
                 }
            });    
        });
        
	});
    
    function modal_cancel(type){
         BootstrapDialog.show({
                title: 'Warning Cancel Subscription!!!',
                message: $("#modal-warning-cancel").html(),
                type : BootstrapDialog.TYPE_WARNING,
                buttons: [
                    {
                        id: 'btn-1',
                        label: 'Close',
                        action: function(dialog) {
                            dialog.close();(false);
                        }
                    }, {
                        label: 'OK',
                        cssClass: 'btn-primary',
                        action: function(){
                            $("#type_cancel").val(type);
                            $('#form_warning').submit();
                        }
                    }
                ]
        });
    }
    
    