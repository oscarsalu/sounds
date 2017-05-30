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
            $('#iframe_amp').attr('src',base_url+'amp/embed/'+affiliate_id);
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
    