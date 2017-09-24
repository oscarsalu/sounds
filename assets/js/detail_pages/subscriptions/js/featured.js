 $(".pack_fre").change(function(){
        $(".text_pack").html($(".pack_fre option:selected").text());
        $(".price_pack").html($(this).val());
        showday();
    });
function addDays( days) {
    var theDate = new Date();
    var myNewDate = new Date(theDate);
    myNewDate.setDate(myNewDate.getDate() + days);
    return myNewDate;
}

function showday(){
    var str = $(".pack_fre option:selected").text();
    str_replace1 = str.replace("weeks", "");
    str_replace = parseInt(str_replace1.replace("week", ""));
    $(".pack").val(str_replace);
    var formattedDate = new Date();
    var d = formattedDate.getDate();
    var m =  formattedDate.getMonth();
    m += 1;  // JavaScript months are 0-11
    var y = formattedDate.getFullYear();
    $(".start_date").html(m+ "/" + d + "/" + y);
    var newDate = addDays(str_replace*7);
    $(".end_date").html((newDate.getMonth()+1) + "/" + newDate.getDate() + "/" + newDate.getFullYear());
}
showday();