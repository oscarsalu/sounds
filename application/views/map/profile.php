<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	   <div class="panel panel-default">
    		  <div class="panel-heading">
		    		<h3 class="panel-title">Edit Profile Affiliate </h3>
		 			</div>
		 			<div class="panel-body">
                    <?php
                    if ($this->session->flashdata('message_msg')) {
                        ?>
                        <div class="">
                            <p class="success"> <?php echo $this->session->flashdata('message_msg')?></p>
                        </div>
                        <?php

                    }
                    ?>
		    		<form role="form" action="<?php echo base_url('map/edit_profile')?>" method="post">
		    			 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="row">
                            <?php echo form_error('parent_affiliate'); ?>
		    				<div class="col-xs-6 col-sm-6 col-md-6">
		    					<div class="form-group"> 
		                          <input type="text" required="" name="first_name" value="<?php echo $U_map['first_name'] ?>" class="form-control input-sm" placeholder="First Name">
		    					  <?php echo form_error('first_name'); ?>
                                </div>
		    				</div>
		    				<div class="col-xs-6 col-sm-6 col-md-6">
		    					<div class="form-group">
		    						 <input type="text" required="" name="last_name" value="<?php echo $U_map['last_name']  ?>" class="form-control input-sm" placeholder="Last Name">
		    					     <?php echo form_error('last_name'); ?>
                                </div>
		    				</div>
		    			</div>
		    			<div class="form-group">
		    				<input type="email" required="" name="email_paypal" value="<?php echo $U_map['paypal'] ?>" class="form-control input-sm" placeholder="Email Paypal">
		    			</div><?php echo form_error('email_paypal'); ?>
                        <div class="form-group">
		    				<input type="input" name="phone" class="form-control input-sm" value="<?php echo $U_map['phone'] ?>" placeholder="Phone">
		    			</div><?php echo form_error('phone'); ?>
                        <div class="form-group">
		    				<input type="input" name="address" class="form-control input-sm" value="<?php echo $U_map['address'] ?>" placeholder="Address">
		    			</div><?php echo form_error('address'); ?>
                        <div class="form-group">
		    				<input type="input" name="city" class="form-control input-sm" value="<?php echo $U_map['city'] ?>" placeholder="City">
		    			</div><?php echo form_error('city'); ?>
                        <div class="form-group">
		    				<input type="input" name="company" class="form-control input-sm" value="<?php echo $U_map['company'] ?>" placeholder="Company">
		    			</div><?php echo form_error('company'); ?>
                        <div class="form-group">
		    				<input type="input" name="web_url" class="form-control input-sm" value="<?php echo $U_map['web_url'] ?>" placeholder="Web Url">
		    			</div><?php echo form_error('web_url'); ?>
                        
		    			<input type="submit" value="Update" class="btn btn-info btn-block">
		    		    
		    		</form>
		    	</div>
    		</div>
		</div>
	</div>
</div>