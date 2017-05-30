function update_select(){
    var selected=new Array();
    i = 0;
    $(".input_select").each(function (i) {
        if($(this).is(':checked')){
            selected[i] = this.value;
            i++;
        }
    });
    selected = selected.join(',');
    $("#result_select").val(selected);
    if(selected==""){
        $('#confirm_finish').attr("disabled",true);
    }else{
        $('#confirm_finish').removeAttr("disabled"); 
    }
}
$(document).ready(function() {
    update_select();
})