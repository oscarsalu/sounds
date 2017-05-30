<div class="page-title">
    <span class="title">Manager Users</span>
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
        }?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Setting Global Informations</div>                    
                </div>
            </div>
            <div class="card-body">                
                <form class="form-horizontal" action="<?php echo base_url('admin/setting/update'); ?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                     
                    <div class="form-group art">
                        <label  class="col-sm-2 control-label"> Email Support</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control"  name="email_support" value="<?=$settings_global['email_support']?>" placeholder="99sound Subscriiption Fee">
                            <?php echo form_error('email_support','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div>      
                    <hr />
                    <div class="form-group art">
                        <label  class="col-sm-2 control-label"> Paypal ClientId API</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="paypal_clientId" value="<?=$settings_global['paypal_clientId']?>" placeholder="">
                            <?php echo form_error('paypal_clientId','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div>  
                    <div class="form-group art">
                        <label  class="col-sm-2 control-label">  Paypal Client Secret API</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="paypal_clientSecret" value="<?=$settings_global['paypal_clientSecret']?>" placeholder="">
                            <?php echo form_error('paypal_clientSecret','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div>  
                    <hr />
                    <div class="form-group art">
                        <label  class="col-sm-2 control-label"> ZOHO API - OrganizationId</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="zoho_organization_id" value="<?=$settings_global['zoho_organization_id']?>" placeholder="">
                            <?php echo form_error('zoho_organization_id','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div>  
                    <div class="form-group art">
                        <label  class="col-sm-2 control-label">ZOHO API - Authtoken</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="zoho_authtoken" value="<?=$settings_global['zoho_authtoken']?>" placeholder="">
                            <?php echo form_error('zoho_authtoken','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
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