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