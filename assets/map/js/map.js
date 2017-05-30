  "use strict";
        $(function() {
          // Code for docs demos
          function createColorpickers() {
            
            $(function(){
                $('.colorpicker').colorpicker();
                
            });
          }
          createColorpickers();
        });
        $('.colorpicker').on('hidePicker', function(event){
            setTimeout(function(){
                finish_change();
            }, 0);
        });