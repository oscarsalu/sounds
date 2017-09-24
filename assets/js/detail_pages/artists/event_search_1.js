if($(window).width() >600)
        {
            $(document).ready(function(){
              $('.slider6').bxSlider({
                slideWidth: 300,
                minSlides: 5,
                maxSlides: 5,
                startSlide: 4,
                slideMargin: 0,
                adaptiveHeight:true
              });
            });
            }else{
            $(document).ready(function(){
              $('.slider6').bxSlider({
                slideWidth: 300,
                minSlides: 3,
                maxSlides: 4,
                startSlide: 3,
                slideMargin: 0,
                adaptiveHeight:true
              });
            });
        }
        $('#event_start_date').datepicker({
            dateFormat: "yy-mm-dd "+getHora()
        }); 
        $('#event_end_date').datepicker({
            dateFormat: "yy-mm-dd "+getHora()
        }); 
        function getHora() {
            date = new Date();
            return date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
        };     
        function confirmDialog() {
            return confirm("Are you sure you want to delete this record?")
        }      