<style>
    .strike-heading span .error{
        color: red;
    }
</style>
<div class="panel-body" style="padding: 50px 0px;">
	<h3 class="text-center">
		Sign Up Sound For Free
	</h3>
    
	<form class="form form-signup" role="form" action="<?php echo base_url().'auth/register'?>" method="post">
	   <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
       <div class="row col-md-12">
            <div class="col-md-4 col-md-offset-4">
            	<div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
        				</span>
        				<input type="text" class="form-control" placeholder="First Name"  name="firstname" value="<?php echo set_value('firstname'); ?>"/>
        			</div>
                    <?php echo form_error('firstname', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		</div>
                <div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
        				</span>
        				<input type="text" class="form-control" placeholder="Last Name"  name="lastname" value="<?php echo set_value('lastname'); ?>"/>
        			</div>
                    <?php echo form_error('lastname', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		</div>
        		<div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
        				</span>
        				<input type="email" class="form-control" placeholder="Email Address"  name="email"value="<?php echo set_value('email'); ?>"/>
        			</div>
        		</div>
                <div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="fa fa-music"></span>
        				</span>
                        <select class="form-control" name="role" >
                            <option >Chooses Account Type</option>
                            <option value="1">Artis</option>
                            <option value="2">Fan</option>
                            <option value="3">Venue</option>
                            <option value="4">Lable</option>
                            <option value="5">Management</option>
                        </select>
        			</div>
        		</div>
        		<div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        				<input type="password" class="form-control" placeholder="Password" name="password" />
        			</div>
                    <?php echo form_error('password', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		</div>
                <div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        				<input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" />
        			</div>
                    <?php echo form_error('confirm_password', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		</div>
        		<input type="submit" class="btn btn-lg btn-primary btn-block" name="signup" value="Sign Up">
                <a class="btn btn-lg btn-default btn-block" href="<?php echo base_url().'account/login'?>">Join</a>
            </div>
        </div>
	</form>
</div>