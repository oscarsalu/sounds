
<div style="min-height: 100vh;">
    <?php
          include('inc_side_menu/menu_artist.php')
        ?>  
    <div class="side-body">
        <h2  about="/content_homes1_tittle_new4_442/">
             <span property="content" id= "content_homes1_tittle_new4_442">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_442_s>', ' Profile Info');
                ?>
            </span> 
         </h2>        
        <hr />
        <div class="breadcrumb flat" style="    width: 100%;">
        	<a href="<?php echo base_url()?>artist/profile">Profile</a>
        	<a class="active" href="#">Profile Info</a>
        </div>
        <div class="content-basic" style="background:#fff; width: 100%;padding:20px" >
            <div class="form-general-info">                
                <h3  about="/content_homes1_tittle_new4_445/">
                     <span property="content" id= "content_homes1_tittle_new4_445">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_445_s>', 'General Info');
                        ?>
                    </span> 
                 </h3>  
                <hr />
                <form class="form-horizontal" role="form" action="<?php echo base_url()?>artist/upadate_general" method="post">
                  
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group">
                		<label for="inputEmail3" class="col-sm-2 control-label">* Artist Name</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" class="form-control" name="artist_name" value="<?php echo $user_data['artist_name']?>"/>
           		            <?php echo form_error('artist_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		  
                        </div>
                	</div>
                	<div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Home Page</label>
                		<div class="col-sm-10 col-md-8">
                			<p class="form-control-static"><?php echo base_url()?><input type="text" name="home_page" value="<?php echo $user_data['home_page']?>"></p>
                            <?php echo form_error('home_page', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		        </div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">*Primary Genre</label>
                		<div class="col-sm-10 col-md-8">
                            <select name="genre" class="form-control">
                                <?php 
                                foreach ($genres as $key) {
                                    ?><option value="<?php echo $key['id'] ?>" <?php if ($user_data['genre'] == $key['id']) {
    echo 'selected';
} ?> >
                                    <?php echo $key['name']?></option><?php 
                                }
                                ?>
                            </select>
                            <?php echo form_error('genre', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		  
                		</div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Active Since</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="date" name="active_since" class="form-control" value="<?php if ($user_data['active_since'] != 0) {
    echo date('Y-m-d', $user_data['active_since']);
}?>">
                		    <?php echo form_error('active_since', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		        </div>
                	</div>
                	<div class="form-group">
                		<div class="col-sm-offset-10 col-sm-2">
                			<button type="submit" class="btn btn-primary">Save</button>
                		</div>
                	</div>
                </form>
            </div>
            <div class="form-contact-info">
                <h3  about="/content_homes1_tittle_new4_443/">
                     <span property="content" id= "content_homes1_tittle_new4_443">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_443_s>', 'Contact Info');
                        ?>
                    </span> 
                 </h3><hr />
                <div class="panel radius p1 smaller">
                  <!--p>Your profile address is currently linked to your FanReach account. Changing your information here will change the physical mailing address used for your FanReach emails. If you want to prevent this from happening, then update your FanReach settings.</p-->
                </div>
                <form class="form-horizontal" role="form" action="<?php echo base_url()?>artist/upadate_contact" method="post">
                	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                	<div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Address</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" name="address" class="form-control" value="<?php echo $user_data['address']?>"/><br />
                            <?php echo form_error('address', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
            		       <input type="text" name="address2" class="form-control" value="<?php echo $user_data['address2']?>"/>
                    		<?php echo form_error('address2', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		       </div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label"><strong>* City</strong></label>
                		<div class="col-sm-10 col-md-8">
                            <input type="text" name="city" class="form-control" value="<?php echo $user_data['city']?>"/>
                            <?php echo form_error('city', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        		        </div>
                	</div>
                    <div class="form-group">
                		<label for="birthday" class="col-sm-2 control-label"><strong>* Birthday</strong></label>
                		<div class="col-sm-10 col-md-8">
                            <input type="date" name="birthday" class="form-control" value="<?php if ($user_data['birthday'] != 0) {
    echo date('Y-m-d', $user_data['birthday']);
}?>"/>
        		        </div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">ZIP/Post Code</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" name="zipcode" class="form-control" value="<?php echo $user_data['zipcode']?>">
                            <?php echo form_error('zipcode', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">State / Province</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" name="state" class="form-control" value="<?php echo $user_data['state']?>">
                            <?php echo form_error('state', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                    
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Phone Number</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" name="phone" class="form-control" value="<?php echo $user_data['phone']?>" >
                		    <?php echo form_error('phone', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Artist Email</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" name="artist_email" class="form-control" value="<?php echo $user_data['artist_email']?>">
                		      <?php echo form_error('artist_email', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                	<div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Booking Info Email</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="email" name="booking_info_email" class="form-control" value="<?php echo $user_data['booking_info_email']?>">
                		    <?php echo form_error('booking_info_email', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		
                        </div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Management Email</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="email" name="management_email" class="form-control" value="<?php echo $user_data['management_email']?>" >
                		    <?php echo form_error('management_email', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		
                        </div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Manager</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="text" name="manager" class="form-control" value="<?php echo $user_data['manager']?>" />
                	   	    <?php echo form_error('manager', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                    
                	<div class="form-group">
                		<div class=" col-sm-offset-10 col-sm-2">
                			<button type="submit" class="btn btn-primary">Save</button>
                		</div>
                	</div>
                </form>
            </div>
            <!--Social Urls-->
			<div class="form-contact-info">
				<h3  about="/content_homes1_tittle_new4_443/"><span property="content" id= "content_homes1_tittle_new4_443">
                        <?php
						echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_443_s>', 'Social Urls');
						?>
                    </span></h3>
				<hr />
				<div class="panel radius p1 smaller">
					<!--p>Your profile address is currently linked to your FanReach account. Changing your information here will change the physical mailing address used for your FanReach emails. If you want to prevent this from happening, then update your FanReach settings.</p-->
				</div>
				<form class="form-horizontal" role="form" action="<?php echo base_url()?>artist/update_social" method="post">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
					<div class="form-group">
						<label for="home_page" class="col-sm-2 control-label">Facebook Url</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="facebook" class="form-control" value="<?php echo $user_data['facebook_username']?>"/><br />
							<?php echo form_error('facebook', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="home_page" class="col-sm-2 control-label">Twitter Url</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="twitter" class="form-control" value="<?php echo $user_data['twitter_username']?>"/><br />
							<?php echo form_error('twitter', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="home_page" class="col-sm-2 control-label">Instagram Url</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="instagram" class="form-control" value="<?php echo $user_data['instagram_username']?>"/><br />
							<?php echo form_error('instagram', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="home_page" class="col-sm-2 control-label">Youtube Url</label>
						<div class="col-sm-10 col-md-8">
							<input type="text" name="youtube" class="form-control" value="<?php echo $user_data['youtube_username']?>"/><br />
							<?php echo form_error('youtube', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class=" col-sm-offset-10 col-sm-2">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div>
			<!--end Social Urls-->
            <div class="form-general-info">               
                <h3  about="/content_homes1_tittle_new4_446/">
                     <span property="content" id= "content_homes1_tittle_new4_446">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_446_s>', 'Change Password');
                        ?>
                    </span> 
                 </h3>
                <hr />
                <form class="form-horizontal" role="form" action="<?php echo base_url()?>artist/change_password" method="post">
                	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Current Password</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="password" name="pass_current" class="form-control"/>
                            <input type="hidden" name="redirect" class="form-control" value="artist/basic_info"/>
                	   	    <?php echo form_error('pass_current', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                    <hr />
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">New Password</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="password" name="pass_new" class="form-control" />
                	   	    <?php echo form_error('pass_new', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                    <div class="form-group">
                		<label for="home_page" class="col-sm-2 control-label">Confirm Password</label>
                		<div class="col-sm-10 col-md-8">
                			<input type="password" name="confirm_password" class="form-control" />
                	   	    <?php echo form_error('confirm_password', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                		</div>
                	</div>
                	<div class="form-group">
                		<div class="col-sm-offset-10 col-sm-2">
                			<button type="submit" class="btn btn-primary">Change</button>
                		</div>
                	</div>
                </form>
            </div>

        </div>
    </div>
</div>
        
