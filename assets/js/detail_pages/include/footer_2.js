$(function () {
    
         BootstrapDialog.show({
            message: function(dialog) {
                var $message = $('<div></div>');
                var pageToLoad = dialog.getData('pageToLoad');
                $message.load(pageToLoad);
                $('#cancel_popup').click( function() {
                    dialog.close();
                });
                return $message;
            },
            data: {
                'pageToLoad': base_url+'subscriptions/popup'
            },
            buttons: [
                {
                    label: 'Close',
                    action: function(dialog) {
                       dialog.close();
                    }
                }
            ]
        });
        
});
    