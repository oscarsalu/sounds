<div class="panel-body">
	<h3 class="text-center">
		Join 99 Sound For Free
	</h3>
    
	<form class="form form-signup" role="form" action="<?php echo base_url().'auth/login'?>" method="post">
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
        		<div class="form-group">
        			<a class="btn btn-block btn-social btn-facebook">
        			<i class="fa fa-facebook"></i> Join with Facebook
        			</a>
        		</div>
        		<div class="form-group">
        			<a class="btn btn-block btn-social btn-google">
        			<i class="fa fa-google"></i> Join with Google
        			</a>
        		</div>
                <?php 
                    if (isset($login_false)) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Error!</strong> <?php echo $login_false ?>
                        </div>
                        <?php

                    }
                ?>
        		<div class="strike-heading"><span>or use your email address</span></div>
        		<div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
        				</span>
        				<input type="text" class="form-control" placeholder="Email Address"  name="email"/>
        			</div>
        		</div>
        		<div class="form-group">
        			<div class="input-group">
        				<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
        				<input type="password" class="form-control" placeholder="Password" name="password" />
        			</div>
        		</div>
        		<input type="submit" class="btn btn-lg btn-primary btn-block" name="join" value="Join">
                <a class="btn btn-lg btn-default btn-block" href="<?php echo base_url().'register'?>">Sign Up</a>
            </div>        
        </div>            
	</form>
</div>