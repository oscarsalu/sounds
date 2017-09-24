<!-- include script Stast -->
<script src="<?=base_url()?>assets/js/raphael-min.js"></script>
<script src="<?=base_url()?>assets/js/morris-0.4.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#sel1').change(function(){
      value =$(this).val();
      if(value==1){
        //this week
        start = '<?=strtotime( 'monday this week')?>';
        end = '<?=strtotime( 'monday next week')?>';
      }
      if(value==2){
        //pre week
        start = '<?=strtotime( 'monday this week',strtotime('-1 week'))?>';
        end = '<?=strtotime( 'monday next week',strtotime('-1 week'))?>';
      }  
      if(value==3){
        //this month
        start = '<?=strtotime('first day of this month', time());?>';
        end = '<?=strtotime('first day of next month');?>';
      }  
      if(value==4){
        //pre month
        start = '<?=strtotime('first day of this month', strtotime('-1 month'));?>';
        end = '<?=strtotime('first day of this month',time());?>';
      } 
      call_stats(start,end);
    });
    function call_stats(time_start,time_end){
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>admin/dashboard/call_stats',
            dataType: "JSON",
            data: {
                'time_start': time_start,
                'time_end': time_end,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', 
            },
            success: function(data_respone) {
                $('#line-example').empty();
                Morris.Line({
        			element: 'line-example',
        			data: data_respone,
        			xkey: 'd',
        			ykeys: ['a'],
        			lineColors:['#CC0000'],
                    labels: ['Total amount']
        		});
             }
        });
    }
    call_stats('<?=strtotime( 'monday this week')?>','<?=strtotime( 'monday next week')?>');
});
</script>
<div class="row">
    <div  class="col-md-12">
        <h1 class="tt text_caplock">Summary Sales</h1>
        <hr />
        <div class="media text-center">
            
            <span class="liner"></span>
            <div class=" col-sm-4">
                <div class="media-body text-success ">
                    TOTAL SALES
                    <h4 class="media-heading"><?=$Total_balance?> $</h4>
                </div>
            </div>
            <div class=" col-sm-4">
                <div class="media-body ">
                    This week sales
                    <h4 class="media-heading"><?=$week_balance?> $</h4>
                </div>
            </div>
            <div class=" col-sm-4">
                <div class="media-body">
                    This month sales
                    <h4 class="media-heading"><?= $month_balance?> $</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 stats_sales">
        <h1> AMP sales  </h1>
        <hr />
        <div class="col-md-2 col-xs-6 col-sm-4">
            <div class="form-group ">
              <label for="sel1">Period time</label>
              <select class="form-control" id="sel1">
                <option selected="" value="1">This Week</option>
                <option value="2">Previous Week</option>
                <option value="3">This Month</option>
                <option value="4">Previous Month</option>
              </select>
            </div>
        </div>
        <div class="col-md-12">
             <div id="line-example"></div>
        </div>
    </div>
    
</div>