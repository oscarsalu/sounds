

function addcaculate(type,expense_type) {
    var location = $(".selectcalculatelocation option:selected").text();
    $(".edit_text_model").html("Add new "+type+" to reach "+location);
    $(".type_data_add").val(type);
    $(".expense_type_add").val(expense_type);
    $("#add-caculate-modal").modal('show');
    return false;
}
function addtaxmodal(type,type_data,id,name,price){
    $("#add-tax-modal").modal('show');
    if(type == 'create'){
        $(".type_data").val('create');
        $(".change_name_tax").val('');
        $(".change_price_tax").val(0);
        $(".tax_id").val(0);
        $(".type_tax").val(type_data);
    }else{
        $(".type_data").val('edit');
        $(".change_name_tax").val(name);
        $(".tax_id").val(id);
        $(".change_price_tax").val(price);
        $(".type_tax").val(type_data);
        
    }
    
    return false;
}


function add_tax(){
    var post_data = $('#add-tax-form').serialize();
    $("#add-tax-modal").modal('hide');
    
    url = domain+'add_tax_calculate';
    $.ajax({
      url:'More_ttt/add_tax_calculate',
      data: post_data,
      type:'POST',
      dataType:'json',
      success: function(data){
        console.log(data);
            if(data['status'])
            {
                alertify.success(data['msg']);
                get_manager_calculate_view($('#tours').val());
               
            }else{
              alertify.error(data['msg']);
            }
      
      }
    });
}

function delete_tax(o,tax_id, tour_id, location_id)
{
    if(conf_del('Are you sure to deleteAre you sure you want to delete this item? ')){
          $.ajax({
          url:'More_ttt/delete_tax',
          data: { tax_id: tax_id ,"csrf_test_name":records_per_page},
          type:'POST',
          dataType:'json',
          success: function(data){
                o.parent().parent().remove();
                // get_manager_calculate_view($('#tours').val());
            }
        });
      }
}
function show_edit_data(o,type){
	var receiptImg = domain + "uploads/"+o.parent().find(".userId").val()+"/photo/banner_events/"+o.parent().find(".receipt").val();
	var expense_type = o.parent().find(".expense_type").val();
    var name = o.parent().find(".save_name").val();
    var price = o.parent().find(".save_price").val();
    var amount = o.parent().find(".expense_amount").val();
    var date = o.parent().find(".expense_date").val();
    $(".change_amount_edit").val(amount);
    $(".change_date_edit").val(date);
    $(".edit_text").html("Edit " + name);
    $(".expense_type_edit").val(expense_type);
    $(".change_name").val(name);
    $(".change_price").val(price);
    $(".receiptImg").attr('src',receiptImg);
    var id_member = o.parent().find(".save_id").val();
    $(".price_id_data").val(id_member);
    $(".type_data").val(type);
    $("#edit-member-modal").modal('show');
    return false;
}
function delete_price(o,name,type){
    var id = o.parent().find(".save_id").val();
    if(id && conf_del('Are you sure to delete '+ name)){
          $.ajax({
          url:delete_price_url,
          data: { price_id: id,type: type,"csrf_test_name":records_per_page},
          type:'POST',
          dataType:'json',
          success: function(data){
           if(data['status']){
                alertify.success(data['msg']);
                o.parent().parent().remove();
            }else{
              alertify.error(data['msg']);
            }
          }
        });
      }
}
function conf_del(msg){ 
    if(confirm(msg))
        return true;  
    else
        return false;
}
function get_calculate_view_tourid_location_id(tour_id, location_id)
{
    $.ajax({
        url:base_url+'the_total_tour/caculate/'+tour_id+'/'+location_id,
        success: function(data){
            $('div #manager_calculate').empty();
            $('div #manager_calculate').html(data);
            }
        });
}
function get_calculate_view_tourid_locationid_memberid(tour_id, location_id, member_id, div_id)
{
    $.ajax({
        url:base_url+'the_total_tour/caculate/'+tour_id+'/'+location_id+'/'+member_id,
        success: function(data){
                $('div #manager_calculate').empty();
                $('div #manager_calculate').html(data);
                $('.nav-tabs a[href="' + div_id + '"]').tab('show');
            }
        });
}
$("#manager_calculate").load(function($) {
var Controls = {
    init: function () {
        var imgLink = document.getElementById('thumb');
        
        imgLink.addEventListener('mouseover', Controls.mouseOverListener, false );
        imgLink.addEventListener('mouseout', Controls.mouseOutListener, false );
        
    },
    
    mouseOverListener: function ( event ) {
        Controls.displayTooltip ( this );
    },
    
    mouseOutListener: function ( event ) {
        Controls.hideTooltip ( this );
    },
    
    displayTooltip: function ( imgLink ) {
        var tooltip = document.createElement ( "div" );
        var fullImg = document.createElement ( "img" );
        
        fullImg.src = imgLink.src;
        tooltip.appendChild ( fullImg );
        tooltip.className = "imgTooltip";
        
        tooltip.style.top =  "60px";
        
        imgLink._tooltip = tooltip;
        Controls._tooltip = tooltip;
        imgLink.parentNode.appendChild ( tooltip );
        
        imgLink.addEventListener ( "mousemove", Controls.followMouse, false);
    },
    
    hideTooltip : function ( imgLink ) {
        imgLink.parentNode.removeChild ( imgLink._tooltip );
        imgLink._tooltip = null;
        Controls._tooltip = null;
    },
    
    mouseX: function ( event ) {
        if ( !event ) event = window.event;
        if ( event.pageX ) return event.pageX;
        else if ( event.clientX ) 
            return event.clientX + (document.documentElement.scrollLeft ?
                                    document.documentElement.scrollLeft :                 
                                    document.body.scrollLeft); 
        else return 0;
    },
    
    mouseY: function ( event ) {
        if (!event) event = window.event; 
        if (event.pageY) return event.pageY; 
        else if (event.clientY) 
            return event.clientY + (document.documentElement.scrollTop ?     
                                    document.documentElement.scrollTop : 
                                    document.body.scrollTop); 
        else return 0;
    },
    
    followMouse: function ( event ) {
        var tooltip = Controls._tooltip.style;
        var offX = 15, offY = 15;
        
        tooltip.left = (parseInt(Controls.mouseX(event))+offX) + 'px';
        tooltip.top = (parseInt(Controls.mouseY(event))+offY) + 'px';
    }       
};

Controls.init();

});
function add_expense(tour_id, location_id)
{
    $("#add-caculate-modal").modal('hide');
    var post_data = $('#addexpense').serialize();
    var formData = new FormData( $("#addexpense")[0] );
    $.ajax({
        url: base_url+'members/addcaculate',
        type:'POST',
        data: formData,
        dataType:'json',
        async : false,
        cache : false,
        contentType : false,
        processData : false,
        success: function(data){
            get_calculate_view_tourid_location_id(tour_id, location_id);
        },
        error: function(error){

        }
        
    });
}
    
function update_price()
{
    $("#edit-member-modal").modal('hide');
    var post_data = $('#edit_price').serialize();
    
    $.ajax({
        url: base_url+'members/update_price',
        type:'POST',
        data:post_data,
        dataType:'json',
        success: function(data){
            get_calculate_view_tourid_location_id(tour_id, location_id);
        },
        error: function(error){

        }
        
    });
}   


$(document).on('change', '.selectcalculatelocation', function()
{
    location_id = $(this).val();
    get_calculate_view_tourid_location_id(tour_id, location_id);
});