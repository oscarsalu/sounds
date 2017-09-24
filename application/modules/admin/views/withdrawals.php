<div class="page-title">
    <span class="title">Manager Withdrawal Requests</span>
    <div class="description">
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Delete user success!
        </div>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="lock_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Blocked user success!
        </div>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="unlock_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Unblocked user success!
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">

                <div class="card-title">
                <div class="title">Table</div>
                </div>
            </div>
            <div class="card-body">
                 <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="parent_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Data Updated!
        </div>
                <table class="set_value datatable table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Paypal Email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Paypal Email</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="view_data">
                        
                        <?php foreach($list_withdrawals as $withdrawals){ ?>
                            <tr class="">                               
                                <td style="padding-top: 23px;"><?php echo $this->M_user->get_name($withdrawals['user_id']); ?></td>
                                <td style="padding-top: 23px;"><?php echo $withdrawals['amount'];?></td>
                                <td style="padding-top: 23px;">
                              <?php echo $withdrawals['paypal_email'];?>
                                </td>
                         
                                <td style="padding-top: 23px;">
                                <?php echo date('d-m-Y',$withdrawals['time']); ?>
                                </td>
                                <td style="padding-top: 23px;" id="status">
                                    <?php if($withdrawals['status']==0) { echo "Pending" ; } else { echo "Completed";}?>
                                </td>
                                <td>
                                    <?php if($withdrawals['status']==0){ ?>
                                    <button data-id="<?php echo $withdrawals['id'];?>" data-user="<?php echo $withdrawals['user_id'];?>" data-withdraw="<?php echo $withdrawals['amount'];?>" class="btn btn-primary btn-process" id="btn-process">Make Completed</button>
                                    <?php } else { ?>
                                    <button data-id="<?php echo $withdrawals['id'];?>" data-user="<?php echo $withdrawals['user_id'];?>" data-withdraw="<?php echo $withdrawals['amount'];?>" class="btn btn-danger btn-pending" id="btn-pending">Make Pending</button>
                                    <?php } ?>
                                </td>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
                <?php echo $this->pagination->create_links();?>           
            </div>
        </div>
    </div>
</div>
<script>
                                         
$(document). on('click','.btn-process',function (){ 
             $url = "<?php echo base_url(); ?>";
        id = $(this).attr("data-id");
        user_id = $(this).attr("data-user");
        withdraw=$(this).attr("data-withdraw");
        $.ajax({
            url: $url+"admin/withdrawals/withdraw_process",
            type: "post",
            data: {
                "id":id, 
                "user_id":user_id,
                "withdraw":withdraw,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            context: this,
           complete:function(response){  
          $(this).removeClass('btn-process').addClass('btn-pending');
     $(this).removeClass('btn-primary').addClass('btn-danger'); 
       $ (this).text('Make Pending');
       $('#status').text("Completed");
                   $('#parent_suc').css('display','block'); 
       
                                        
                                                                               
            }
        });
    });
 
       $(document). on('click','.btn-pending',function (){ 
             $url = "<?php echo base_url(); ?>";
        id = $(this).attr("data-id");
       user_id = $(this).attr("data-user");
       withdraw=$(this).attr("data-withdraw");
        $.ajax({
            url: $url+"admin/withdrawals/withdraw_pending",
            type: "post",
            data: {
                "id":id, 
                "user_id":user_id,
                "withdraw":withdraw,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
             context: this,
           complete:function(response){  
         $(this).removeClass('btn-pending').addClass('btn-process');
     $(this).removeClass('btn-danger').addClass('btn-primary');
    $ (this).text('Make Completed');
    $('#status').text("Pending");
                   $('#parent_suc').css('display','block'); 
       
                                    
                                                                               
            }
        });
    });                              
</script>