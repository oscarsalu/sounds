<div class="container" style="min-height: 100vh;">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
    	   <div class="panel panel-default" style="margin-top: 48px;">
    		  <div class="panel-heading">
		    		<h3 class="panel-title">Login Affiliate</h3>
		 			</div>
		 			<div class="panel-body">
		    		<form role="form" action="<?php echo base_url('fap/post_login')?>" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
		    			<div class="form-group">
		    				<input type="email" required="" name="email" value="<?php echo set_value('email'); ?>" class="form-control input-sm" placeholder="Email Address">
		    			   <?php echo form_error('email'); ?>
                        </div>
		    			<div class="form-group">
		    				<input type="password" required="" name="password" value="<?php echo set_value('password'); ?>" class="form-control input-sm" placeholder="Password">
		    			</div><?php echo form_error('password'); ?>
                        <?php 
                        if ($this->session->flashdata('message_error')) {
                            ?>
                            <div class="">
                                <h5 class="text-center"><strong>Error!</strong></h5>
                                <p class="error"> <?php echo $this->session->flashdata('message_error')?></p>
                            </div>
                            <?php

                        }
                        ?>
		    			<input type="submit" value="Login" class="btn btn-info btn-block"/>
		    		</form>
		    	</div>
    		</div>
		</div>
	</div>
</div>