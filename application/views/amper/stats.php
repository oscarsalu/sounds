<!-- include script Stast -->
<script src="<?=base_url()?>assets/js/raphael-min.js"></script>
<script src="<?=base_url()?>assets/js/morris-0.4.1.min.js"></script>
<script>
$(document).ready(function() {
    
    $("#myonoffswitch").change(function(){
        var  check= $('#myonoffswitch').attr('checked');
        if(check){
            $('#myonoffswitch').attr('checked',false); 
            current_check = false;
        }else{
            $('#myonoffswitch').attr('checked',true); 
            current_check = true;
        }
        $.post(
            "<?php echo base_url('amper/stats/onoffswitch') ?>",
            {
                'checked': current_check,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            }
        );
    });
    $("form.profile").submit(function(e){
		e.preventDefault();
        var uri = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: uri,
            data: {
                'first_name':   $('input[name="first_name"]').val(),
                'last_name':    $('input[name="last_name"]').val(),
                'email_paypal': $('input[name="email_paypal"]').val(),
                'phone':        $('input[name="phone"]').val(),
                'address':      $('input[name="address"]').val(),
                'city':         $('input[name="city"]').val(),
                'web_url':      $('input[name="web_url"]').val(),
                'company':      $('input[name="company"]').val(),
                '<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash(); ?>'   
            },
            dataType: "text",
            success: function(response) {
                 $('.alert_panel').html(response);
                 
             }
        });    
        
    });
    $('#sel1').change(function(){
      value =$(this).val();
      if(value==1){
        //this week
        start = '<?=strtotime('monday this week')?>';
        end = '<?=strtotime('monday next week')?>';
      }
      if(value==2){
        //pre week
        start = '<?=strtotime('monday this week', strtotime('-1 week'))?>';
        end = '<?=strtotime('monday next week', strtotime('-1 week'))?>';
      }  
      if(value==3){
        //this month
        start = '<?=strtotime('first day of this month', time());?>';
        end = '<?=strtotime('first day of next month');?>';
      }  
      if(value==4){
        //pre month
        start = '<?=strtotime('first day of this month', strtotime('-1 month'));?>';
        end = '<?=strtotime('first day of this month', time());?>';
      } 
      var type = $("#sel2").val();
      call_stats(start,end,type);
    });
    $('#sel2').change(function(){
      value = $('#sel1').val();
      if(value==1){
        //this week
        start = '<?=strtotime('monday this week')?>';
        end = '<?=strtotime('monday next week')?>';
      }
      if(value==2){
        //pre week
        start = '<?=strtotime('monday this week', strtotime('-1 week'))?>';
        end = '<?=strtotime('monday next week', strtotime('-1 week'))?>';
      }  
      if(value==3){
        //this month
        start = '<?=strtotime('first day of this month', time());?>';
        end = '<?=strtotime('first day of next month');?>';
      }  
      if(value==4){
        //pre month
        start = '<?=strtotime('first day of this month', strtotime('-1 month'));?>';
        end = '<?=strtotime('first day of this month', time());?>';
      } 
      var type = $("#sel2").val();
      call_stats(start,end,type);
    });
    
});
function call_stats(time_start,time_end,type_filter){
    $.ajax({
        type: "POST",
        url: '<?=base_url()?>amper/call_stats',
        dataType: "JSON",
        data: {
            'time_start': time_start,
            'time_end': time_end,
            'type': type_filter,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',    
            
        },
        success: function(data_respone) {
            console.log(data_respone);
            $('#line-example').empty();$('#line-example4').empty();
            if(type_filter=='1'){
                var my_lineColors = '#16a085';
            }else{
                var my_lineColors = '#CC0000';
            }
            Morris.Line({
    			element: 'line-example',
    			data: data_respone['my_user'],
    			xkey: 'd',
    			ykeys: ['a'],
    			lineColors:[my_lineColors],
                labels: ['my_account']
    		});
            Morris.Line({
    			element: 'line-example4',
    			data: data_respone['sub_affiliate'],
    			xkey: 'd',
    			ykeys: ['a1','a2','a3','a4'],
    			lineColors:['#1647a0', '#7a0a81','#81670a','#0b5a06'],
                labels: ['level 1', 'level 2', 'level 3', 'level 4']
    		});
         }
    });
}
call_stats('<?=strtotime('monday this week')?>','<?=strtotime('monday next week')?>','1');
</script>

<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<div class="container-fluid">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;overflow: hidden;">
        
        <div class="row col-md-12 col-sm-12">
            <div class="alert_panel">
            </div>
            <?php  ?>
            <div class="total-sumary "  style="color: green;font-size: 2em; ">
                <?php if ($Total_balance <= 0 or $this->M_transaction->get_transactions_by_user($user_data['id'])==1) {
    ?><button class="btn btn-primary disabled" > Withdraw Money</button><?php

} else {
    ?><button class="btn btn-primary"  data-toggle="modal" data-target="#confirm_paypal"> Withdraw Money</button><?php

}?>
                
            </div>
            
            <div id="sidebarCharts" class="panel-collapse collapse in" role="tabpanel">
                <div class="panel-body text-center">
                    <div class="media row ">
                        <h4 class="tt text_caplock">STATS-SUMMARY</h4>
                        <span class="liner"></span>
                        <div class=" col-sm-4">
                            <div class="media-body text-success ">
                                TOTAL BALANCE
                                <h4 class="media-heading"><?=$Total_balance?> $</h4>
                            </div>
                        </div>
                        <div class=" col-sm-4">
                            <div class="media-body ">
                                This week sales
                                <h4 class="media-heading"><?=$num_items_week?> Item(s)</h4>
                            </div>
                        </div>
                        <div class=" col-sm-4">
                            <div class="media-body">
                                This week balance
                                <h4 class="media-heading">$ <?= $money_week?> </h4>
                            </div>
                        </div>
                    </div>
                    <div class="media row">
                        <div class=" col-sm-4">
                            <div class="media-body">
                                Fan Landing Page visited 
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" 
                                    <?php if ($this->M_affiliate->get_switch_stats($U_map['user_id'])) {
    echo 'checked';
} ?>/>
                                    <label class="onoffswitch-label" for="myonoffswitch">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                                <h4 class="media-heading"><?php if (isset($stats_counter)) {
    echo $stats_counter->flp;
} else {
    echo '0';
}?> </h4>
                            </div>
                        </div>
                        <div class=" col-sm-4">
                            <div class="media-body">
                                AMP Samples
                                <h4 class="media-heading">
                                <?= $amp_samples?> 
                                </h4>
                            </div>
                        </div>
                        <div class=" col-sm-4">
                            <div class="media-body">
                                AMP Sales 
                                <h4 class="media-heading"><?= $amp_sales?> </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter_type">
                <div class="col-md-2 col-xs-6 col-sm-4">
                    <div class="form-group ">
                      <label for="sel1">Time Period</label>
                      <select class="form-control" id="sel1">
                        <option selected="" value="1">This Week</option>
                        <option value="2">Previous Week</option>
                        <option value="3">This Month</option>
                        <option value="4">Previous Month</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-2 col-xs-6 col-sm-4">
                    <div class="form-group ">
                      <label for="sel2">Type</label>
                      <select class="form-control" id="sel2" >
                        <option selected="" value="1">Samples</option>
                        <option value="2">Sales</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="tt text_caplock">My Stats</h4>
                    <span class="liner"></span>
                    
                    <div class="clearfix"></div>
                    <div id="line-example"></div>
                </div>
                <div class="col-md-6" >
                    <h4 class="tt text_caplock">Sub affilate Stats</h4>
                    <span class="liner"></span>
                    <div class="clearfix"></div>
                    <div id="line-example4"></div>
                </div>
            </div>
            <div class="row">
                <h4 class="tt text_caplock">List most popular songs</h4>
                <span class="liner"></span>
                <ol class="text-capitalize">
                    <?php
                    foreach ($top_popular as $song) {
                        ?>
                        <li>
                            <?=$song['name']?> - Artist <span><?=$this->M_user->get_name($song['user_id'])?></span><br />
                            <small>playback: <?=$song['counter']?></small>
                        </li>
                        <?php
                        if (end($top_popular) != $song) {
                            echo '<hr/>';
                        }
                    }
                    ?>
                </ol>
            </div>
            <h4 class="tt text_caplock">Transaction history</h4>
            <span class="liner"></span>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Informations</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($transactions as $row) {
                        ?>
                        <tr>
                            <td><?=date('d M Y', $row->time)?></td>
                            
                            <?php
                            if ($row->type == 'withdraw') {
                                ?>
                                <td>Withdraw amount</td>
                                <td style="color: red;"><?= $row->amount?> <?=$row->currency?></td> 
                                <?php

                            } elseif ($row->type == 'amp') {
                                if ($row->level_sale == null) {
                                    ?>
                                    <td>Sell song - 
                                        <strong><?=$this->M_audio_song->get_name_song($row->item_id)?></strong> - 
                                        Artist <?=$this->M_user->get_name($this->M_audio_song->get_artist_id($row->item_id))?>
                                    </td>
                                    <td style="color: green;"><?= $row->amount?> <?=$row->currency?></td>
                                    <?php 
                                } else {
                                    ?>
                                    <td>Commission - 
                                        <strong><?=$this->M_audio_song->get_name_song($row->item_id)?></strong> - 
                                        Level Sell (<?=$row->level_sale?>)
                                    </td>
                                    <td style="color: green;"><?= $row->amount?> <?=$row->currency?></td>
                                    <?php 
                                }
                            } ?>
                            
                        </tr>
                        <?php

                    }
                    if (count($transactions) == 0) {
                        ?>
                        <tr>
                            <td colspan="3"> No Data Transactions</td>
                        </tr>
                        <?php

                    }
                    ?>
                    
                </tbody>
            
            </table>
            <?php echo $this->pagination->create_links();?>  
        </div>
        <!-- END SLIDER -->
    </section>
</div>

<div class="modal fade" id="confirm_paypal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Withdraw Money</h4>
      </div>
      <form class="form-horizontal" action="<?=base_url('account/payout')?>" method="post">
          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
          <div class="modal-body">
            <p>Please enter the email address registered at PayPal that should receive 99Sound Credit Account withdrawals.</p>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email Paypal</label>
                    <div class="col-sm-10">
                        <input required="" type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email Paypal"/ value="<?=$U_map['paypal']?>">
                    </div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Confirm Email Paypal</label>
                    <div class="col-sm-10">
                        <input required="" type="email" class="form-control" name="email_confirm"  placeholder="Confirm Email Paypal"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Amount </label>
                    <div class="col-sm-10">
                        <input type="number" min="0.00" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" name="amount"  value="<?=$Total_balance?>"max="<?=$Total_balance?>"/>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Withdraw</button>
          </div>
      </form>
    </div>
  </div>
</div>

