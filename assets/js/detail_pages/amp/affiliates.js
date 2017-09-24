$(document).ready(function() {
    
     $('.list_affilaite').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var level = $(this).find(".level_data").val();
            var page = parseInt($(this).find(".level_page").val());
            var current = $(this);            
            $.ajax({             
                url: link,
                type: "post",
                data: { 
                    'page' : page,
                    'level':level,
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
    $('.list_affilaite_new').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            var level = $(this).find(".level_data").val();
            var page = parseInt($(this).find(".level_page").val());
            var current = $(this);
           
            $.ajax({             
                url: link1,
                type: "post",
                data: { 
                    'page' : page,
                    'level':level,
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
    $(".easypiechart").easyPieChart({
        barColor: $(this).attr("data-bar-color")
    });
    var data_99sound = [
        { label: '99sound Take', data: 5 },
        { label: 'Affiliates', data: 95 }
    ];
    // Initialize Donut Chart
   

    var options = {
        series: {
            pie: {
                show: true,
                innerRadius: 0.5,
                stroke: {
                    width: 0
                },
                label: {
                    show: true,
                    threshold: 0.05
                }
            }
        },
        colors: ['#428bca','#5cb85c','#f0ad4e','#d9534f','#5bc0de','#616f77'],
        grid: {
            hoverable: true,
            clickable: true,
            borderWidth: 0,
        },
        tooltip: false,
    };

    var plot = $.plot($("#donut-chart"), data, options);
    var plot_99sound = $.plot($("#total-chart"), data_99sound, options);
    var plot_99sound2 = $.plot($("#total-chart2"), data_99sound, options);
    $(window).resize(function() {
        // redraw the graph in the correctly sized div
        plot.resize();
        plot.setupGrid();
        plot.draw();
        plot_99sound.resize();
        plot_99sound.setupGrid();
        plot_99sound.draw();
        plot_99sound2.resize();
        plot_99sound2.setupGrid();
        plot_99sound2.draw();
    });
    
    // * Initialize Donut Chart
    // Initialize Pie Chart
   

    var options6 = {
        series: {
            pie: {
                show: true,
                innerRadius: 0,
                stroke: {
                    width: 0
                },
                label: {
                    show: true,
                    threshold: 0.05
                }
            }
        },
        colors: ['#428bca','#5cb85c','#f0ad4e','#d9534f','#5bc0de','#616f77'],
        grid: {
            hoverable: true,
            clickable: true,
            borderWidth: 0,
            color: '#ccc'
        }
    };

    var plot6 = $.plot($("#pie-chart"), data6, options6);

    $(window).resize(function() {
        // redraw the graph in the correctly sized div
        plot6.resize();
        plot6.setupGrid();
        plot6.draw();
    });
    // * Initialize Pie Chart
    $(".input_commission").change(function() {
       var level1 = parseInt($('input[name="aff1"]').val()); 
       var level2 = parseInt($('input[name="aff2"]').val()); 
       var level3 = parseInt($('input[name="aff3"]').val()); 
       var level4 = parseInt($('input[name="aff4"]').val());
       var total = level1 + level2 + level3 + level4;
       if(total>=100){
            $("#submit_form").attr("disabled",true);
            $("#msg-error").show();
       }else{
            $("#submit_form-form").removeAttr("disabled");
            $("#msg-error").hide();
            var re_data = [
                { label: 'Level 1', data: level1},
                { label: 'Level 2', data: level2},
                { label: 'Level 3', data: level3},
                { label: 'Level 4', data: level4},
                { label: 'Artist', data: 100-total}
            ];
            var plot6 = $.plot($("#pie-chart"), re_data, options6);
       }
    });
})