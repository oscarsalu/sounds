<div class="container" style="min-height: 100vh;" >
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    	   <div class="panel panel-default">
    		  <div class="panel-heading">
		    		<h3 class="panel-title">Please Register To Become An Affiliate <small>It's free!</small></h3>
		 			</div>
		 			<div class="panel-body">
		    		<form role="form" action="<?php echo base_url('amper/register_post')?>" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
		    			<div class="row">
                            <?php echo form_error('parent_affiliate'); ?>
		    				<div class="col-xs-6 col-sm-6 col-md-6">
		    					<div class="form-group">
                                  <input type="hidden" name="parent_affiliate" value="<?php echo $affiliateId ?>" />  
		                          <input type="text" required="" name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control input-sm" placeholder="First Name">
		    					  <?php echo form_error('first_name'); ?>
                                </div>
		    				</div>
		    				<div class="col-xs-6 col-sm-6 col-md-6">
		    					<div class="form-group">
		    						 <input type="text" required="" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control input-sm" placeholder="Last Name">
		    					     <?php echo form_error('last_name'); ?>
                                </div>
		    				</div>
		    			</div>

		    			<div class="form-group">
		    				<input type="email" required="" name="email" value="<?php echo set_value('email'); ?>" class="form-control input-sm" placeholder="Email Address">
		    			   <?php echo form_error('email'); ?>
                        </div>

		    			<div class="row">
		    				<div class="col-xs-6 col-sm-6 col-md-6">
		    					<div class="form-group">
		    						<input type="password" required="" name="password" value="<?php echo set_value('password'); ?>" class="form-control input-sm" placeholder="Password">
		    					</div>
		    				</div>
		    				<div class="col-xs-6 col-sm-6 col-md-6">
		    					<div class="form-group">
		    						<input type="password" required="" name="passconf" value="<?php echo set_value('passconf'); ?>" class="form-control input-sm" placeholder="Confirm Password">
		    					</div>
		    				</div><?php echo form_error('password'); ?><?php echo form_error('passconf'); ?>
		    			</div>
		    			<div class="form-group">
		    				<input type="email" required="" name="email_paypal" value="<?php echo set_value('email_paypal'); ?>" class="form-control input-sm" placeholder="Email Paypal">
		    			</div><?php echo form_error('email_paypal'); ?>
                        <div class="form-group">
		    				<input type="input" name="phone" class="form-control input-sm" value="<?php echo set_value('phone'); ?>" placeholder="Phone">
		    			</div><?php echo form_error('phone'); ?>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" required=""> I accept the <a href="#" >terms & conditions</a>
                            </label>
                        </div>
		    			<input type="submit" value="Register" class="btn btn-info btn-block">
		    		    
		    		</form>
		    	</div>
    		</div>
		</div>
	</div>
</div>