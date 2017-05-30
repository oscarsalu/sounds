<div class="page-title">
    <div class="description">
        <?php if($this->session->flashdata('message_success')){
        ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> <?php echo $this->session->flashdata('message_success')?>
        </div>
        <?php
        }elseif($this->session->flashdata('message_error')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message_error')?>
            </div>
            <?php
        }
        if($this->session->flashdata('status_message')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Well done!</strong> <?php echo $this->session->flashdata('status_message')?>
            </div>
            <?php
        } if($this->session->flashdata('delete_error')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('delete_error')?>
            </div>
            <?php
        }?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Setting Plan Informations</div>                    
                </div>
            </div>
            <div class="card-body"> 
                
                <table class="table">
                    <tr>
                        <th>Plan Code</th>
                        <th>Plan Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Product Id</th>
                        <th>Interval</th>
                        <th>Price</th>
                        <th>Created Time</th>
                         <th>Updated Time</th>
                    </tr>
                    
                        <?php foreach($plan_list->plans as $plan) {   ?>
                    <tr>
                        <td><?php echo $plan->plan_code;?></td>
                        <td><?php echo $plan->name;?></td>
                        <td><?php echo $plan->description;?></td>
                        <td><?php echo $plan->status;?></td>
                        <td><?php echo $plan->product_id;?></td>
                        <td><?php echo $plan->interval_unit;?></td>
                        <td><?php echo "$"." ".$plan->recurring_price;?></td>
                        <td><?php echo $plan->created_time;?></td>
                        <td><?php echo $plan->updated_time;?></td>
                        <td><a href="#" class="btn btn-info btn-group-sm btn-edit-plan" data-toggle="modal" data-target="#myEditPlan" data-plan="<?php echo $plan->plan_code;?>"><i class="fa fa-edit"></i>
                                    </a></td>
                                    <td><a href="<?php echo base_url();?>admin/plan_setting/delete_plan/<?php echo $plan->plan_code;?>" class="btn btn-danger btn-group-sm btn-delete"><i class="fa fa-remove"></i>
                                    </a></td>
                                  
                        </tr>
                        <?php } ?>
                    
                </table>
                <form class="form-horizontal" action="<?php echo base_url('admin/plan_setting/update'); ?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <!--<div class="form-group art">
                        <label for="artist_name" class="col-sm-2 control-label">* Plan Subscriptions Artist</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input required="" type="text" class="form-control" name="artist_basic_fee" value="<?=$settings_global['artist_basic_fee']?>" placeholder="Artist Subscription Fee"/>                            
                                <span class="input-group-addon">/month</span>
                            </div>
                            <span id="have-err"><?php echo form_error('artist_basic_fee','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>  -->  
                 <!--   <div class="form-group art">
                        
                        <label  class="col-sm-2 control-label"> Free Plan Subscriptions Artist Trial</label>
                        
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input  required="" type="number" min="0" class="form-control"  name="time_trial" value="<?=$settings_global['time_trial']?>" placeholder="Artist Basic Subscriiption Fee"/>
                                <span class="input-group-addon">Days</span>
                            </div>
                            <?php echo form_error('time_trial','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div> -->
                    <hr />
                    
                   <!-- <div class="form-group art">
                        <label  class="col-sm-2 control-label"> Addon MDS</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input  required="" type="text" class="form-control"  name="fee_mds" value="<?=$settings_global['fee_mds']?>" placeholder="Artist Basic Subscriiption Fee"/>
                                <span class="input-group-addon">/month</span>
                            </div>
                            <?php echo form_error('fee_mds','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div> -->
                    <!--<div class="form-group art">
                        <label  class="col-sm-2 control-label">Addon Featured/Premium Artist</label>
                        <div class="col-sm-9">
                        <?php 
                        if(isset($settings_global['premium_artists_fee']) && !empty($settings_global['premium_artists_fee'])){
                            $premium = json_decode($settings_global['premium_artists_fee']); 
                        }
                        ?>
                            <div class="form-group art">
                                <div class="col-sm-4">
                                    <label  class="col-sm-3 control-label remove_padding"> 1 week</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="1week" value="<?php if(isset($premium->week1)&& !empty($premium->week1)){ echo $premium->week1;} ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-3 control-label remove_padding"> 2 week</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="2week" value="<?php if(isset($premium->week2)&& !empty($premium->week2)){ echo $premium->week2;} ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label  class="col-sm-3 control-label remove_padding"> 3 week</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="3week" value="<?php if(isset($premium->week3)&& !empty($premium->week3)){ echo $premium->week3;} ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group art">
                                <div class="col-sm-4">
                                    <label  class="col-sm-3 control-label remove_padding"> 1 month</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="1month" value="<?php if(isset($premium->week4)&& !empty($premium->week4)){ echo $premium->week4;} ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label  class="col-sm-3 control-label remove_padding"> 2 month</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="2month" value="<?php if(isset($premium->week8)&& !empty($premium->week8)){ echo $premium->week8;} ?>" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label  class="col-sm-3 control-label remove_padding"> 3 month</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="3month" value="<?php if(isset($premium->week12)&& !empty($premium->week12)){ echo $premium->week12;} ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                    <hr />
                    <div class="form-group art">
                        <label  class="col-sm-2 control-label"> Commissions 99sound</label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="number" min="0" max="100" class="form-control"  name="commissions_99sound" value="<?=$settings_global['commissions_99sound']?>" placeholder="Commissions 99sound"/>
                                <span class="input-group-addon">%</span>
                            </div>
                            <?php echo form_error('commissions_99sound','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div>           
                    <div class="form-group" id="sub">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success add_" name="type_submit" value="add">Update</button>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Plan -->
<div class="modal fade" id="myEditPlan" tabindex="-1" role="dialog" aria-labelledby="myEditPlan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Plan</h4>
      </div>
      <div class="modal-body">
          <img src="<?php echo base_url();?>assets/images/loading.gif" id="ajax-load" style="display:none; position:absolute;margin-left:45%;">
          <form id="plan-setting-form" class="form-horizontal" style="display:none;" action="<?php echo base_url();?>admin/plan_setting/update_plan" method="post">
             <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
              <input type="hidden" value="" id="plan_code" name="plan_code">
              <input type="hidden" value="" id="product_id" name="product_id">
              <label>Plan Name</label>
              <input type="text" class="form-control" value="" id="Plan_name" name="Plan_name">
                   <label>Price</label>
                   <input type="text" class="form-control" value="" id="Plan_price" name="Plan_price">
              
               <label>Interval</label>
               <input type="text" class="form-control" value="" id="interval" name="interval">
              <label>Interval Unit</label>
              <select id="interval_unit" class="form-control" name="interval_unit">
                  <option value="months">Months</option>
                    <option value="weeks">Weeks</option>
                     <option value="years">Years</option>
              </select>
                 
              <label>Status</label>
              
              <select id="status" class="form-control" name="status">
                  <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                     
              </select>
                 
             <div class="input-group">
    
                 <input type="submit" class="btn btn-primary" value="Save changes" style="margin-top:20px;">
              
             </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script>

 $('.btn-edit-plan').click(function (){
    
         $url = "<?php echo base_url(); ?>";
        plan_code = $(this).attr("data-plan");
      
        $.ajax({
            url: $url+"admin/plan_setting/get_plan",
            type: "post",
            data: {
                "plan_code":plan_code, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
           beforeSend: function() {
               $("#plan-setting-form").hide();
              $("#ajax-load").show();
           },
           complete:function(response){  
          
                
                  
   
      var data=JSON.parse(response.responseText);
      $("#product_id").val(data.product_id);
       $("#plan_code").val(data.plan_code);
       $("#Plan_name").val(data.name);
       $("#Plan_price").val(data.recurring_price);
       $("#interval").val(data.interval);
         $("#interval_unit").val(data.interval_unit);
          $("#status").val(data.status);
        $("#ajax-load").hide();
        $("#plan-setting-form").show();
     //$('.type_approve').attr("data-user", this.user_id);
      

       }
        });             
                                     
    });        

</script>
    