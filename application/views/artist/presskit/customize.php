<div class="main_customize">
    <div class="container" style="min-height: 100vh;">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb_page">
                  <li><a href="<?php echo base_url()?>artist/managerrpk">Dashboard EPK</a></li>
                  <li class="active">Customize</li>
                </ol>
            </div>
        
        <form id="form_edit" class="form-horizontal" action="<?php echo base_url()?>artist/presskit/postcustomize" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="col-md-8">
                <!-- tile -->
                <section class="tile tile-simple header_new_style wow fadeInLeft animated">               
                    <h4 class="tt" about="/content_homes1_tittle_new6_12/">
                        <span property= "content" id= "content_homes1_tittle_new6_12">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_12_s>', 'Preview EPK page');
                            ?>
                        </span>
       	            </h4> 
                    <span class="liner"></span>
                    <!-- /tile widget -->
                    <!-- tile body -->
                    <div class="tile-body text-center">
                        
                        <ul class="list-inline tbox m-0 text-left">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>                             
                                <p about="/content_homes1_tittle_new6_17/">
                                    <span property= "content" id= "content_homes1_tittle_new6_17">
                                        <?php
                                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_17_s>', 'Your Content
                                Manage the contents of your press kit here. You can do things like:');
                                        ?>
                                    </span>
                   	            </p> 
                                <pre>- Set your primary photo and song<br /></pre>
                                <pre>- Add new assets or edit existing ones<br /></pre>
                                <pre>- Re-order your assets with drag-and-drop<br /></pre>
                                Choose which content you will show and hide
                            </li>
                        </ul>
                        <div class="row">
                            <div class="checkbox col-xs-4 wow fadeIn animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="photo"<?php if ($data_customize->photo == 'on') {
    echo 'checked';
}?>/> Photos
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeIn animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="video"<?php if ($data_customize->video == 'on') {
    echo 'checked';
}?>/> Videos
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeIn animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="stats"<?php if ($data_customize->stats == 'on') {
    echo 'checked';
}?>/> Stats
                                </label>
                             </div>   
                             <div class="checkbox col-xs-4 wow fadeIn animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="song"<?php if ($data_customize->song == 'on') {
    echo 'checked';
}?>/> Songs &nbsp;
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeIn animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="show"<?php if ($data_customize->show == 'on') {
    echo 'checked';
}?>/> Shows
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeIn animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="press"<?php if ($data_customize->press == 'on') {
    echo 'checked';
}?>/> Press
                                </label>
                             </div>
                         </div>
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <div class="col-md-4">
                <!-- tile -->
                <section class="tile tile-simple header_new_style wow fadeInRight animated">
                    <!-- tile widget -->            
                     <h4 class="tt" about="/content_homes1_tittle_new6_13/">
                        <span property= "content" id= "content_homes1_tittle_new6_13">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_13_s>', 'DOWNLOAD ASSETS');
                            ?>
                        </span>
       	            </h4> 
                    <span class="liner"></span>
                    
                    <!-- /tile widget -->
                    <!-- tile body -->
                    <div class="tile-body text-center">
                        
                        <ul class="list-inline tbox m-0 text-left">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>
                                <p about="/content_homes1_tittle_new6_18/">
                                    <span property= "content" id= "content_homes1_tittle_new6_18">
                                        <?php
                                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_18_s>', "Download Assets<br />
                                Sometimes people want a hardcopy. Select which assets you'd like to make available for download here.");
                                        ?>
                                    </span>
                   	            </p>                                
                            </li>
                        </ul>
                        <div class="row">
                            <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="dw_photo" <?php if ($data_customize->dw_photo == 'on') {
    echo 'checked';
}?>/> Photos
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="dw_bios" <?php if ($data_customize->dw_bios == 'on') {
    echo 'checked';
}?>/> Bios
                                </label>
                             </div>
                            <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="dw_song" <?php if ($data_customize->dw_song == 'on') {
    echo 'checked';
}?>/> Songs
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="dw_video" <?php if ($data_customize->dw_video == 'on') {
    echo 'checked';
}?>/> Videos
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.2s">
                                <label>
                                  <input type="checkbox" name="dw_pdf" <?php if ($data_customize->dw_pdf == 'on') {
    echo 'checked';
}?>/> .pdf
                                </label>
                             </div>
                        </div>
                            
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <div class="col-md-8">
                <!-- tile -->
                <section class="tile tile-simple header_new_style wow fadeInLeft animated" data-wow-delay="1.2s">
                    <!-- tile widget -->                   
                     <h4 class="tt" about="/content_homes1_tittle_new6_14/">
                        <span property= "content" id= "content_homes1_tittle_new6_14">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_14_s>', 'CONTACT FOR REPLY');
                            ?>
                        </span>
       	            </h4> 
                    <span class="liner"></span>
                    
                    <!-- /tile widget -->
                    <!-- tile body -->
                    <div class="tile-body text-center">
                        
                        <ul class="list-inline tbox m-0">
                            <li class="b-r tcol">
                                <h2 class="m-0"></h2>
                                 <p  about="/content_homes1_tittle_new6_16/">
                                        <span property= "content" id= "content_homes1_tittle_new6_16">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_16_s>', "Contacts For Reply
                                Decide where messages are sent when someone clicks 'Contact' in your Press Kit. 
                                You can set and select from your Artist, Booking, and/or Management email addresses.");
                                            ?>
                                        </span>
                   	            </p>                               
                            </li>
                        </ul>
                        <a class="btn myButton wow fadeIn animated" data-wow-delay="1.0s" href="#" data-toggle="modal" data-target="#editemail">Artist Email Addresses</a>
                        <div class="row">
                            <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.0s">
                                <label>
                                  <input type="checkbox" name="email_artist" <?php if ($data_customize->email_artist == 'on') {
    echo 'checked';
} if (empty($email_contact['email_artist'])) {
    echo 'disabled';
}?>/> Artist email 
                                </label>
                             </div>
                             <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.0s">
                                <label>
                                  <input type="checkbox" name="email_booking" <?php if ($data_customize->email_booking == 'on') {
    echo 'checked';
} if (empty($email_contact['email_booking'])) {
    echo 'disabled';
}?>/> Booking email
                                </label>
                             </div>
                            <div class="checkbox col-xs-4 wow fadeInRight animated" data-wow-delay="1.0s">
                                <label>
                                  <input type="checkbox" name="manager_email" <?php if ($data_customize->email_manager == 'on') {
    echo 'checked';
} if (empty($email_contact['email_manager'])) {
    echo 'disabled';
}?>/> Management email 
                                </label>
                             </div>
                        </div>
                            
                    </div>
                    <!-- /tile body -->
                </section>
                <!-- /tile -->
            </div>
            <div class="col-md-4 wow fadeInRight animated" data-wow-delay="1.2s">
                <a href="#" class="link-effect-button" id="publish_save">
                    <span data-hover="Publish Changes">Publish Changes</span>
                </a>
            </div>
        </div>
        </form>  
        <script>
        $(document).ready(function() {
    	    $('#form_edit').on('click','#publish_save', function (){
    	        $('#form_edit').submit();
    	    });
    	});
        </script>
    </div>
</div>
<!-- Modal preview -->
<div class="modal fade new_modal_style" id="editemail" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              
                <h4 class="tt" about="/content_homes1_tittle_new6_15/">
                        <span property= "content" id= "content_homes1_tittle_new6_15">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new6_15_s>', 'Artist Email Addresses');
                            ?>
                        </span>
   	            </h4> 
                <span class="liner"></span>
                
            </div>  
            <form class="form form-signup searchform" id="update_pt" role="form" action="<?php echo base_url()?>artist/presskit/email_contact" method="post">          
               <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                
    				<div class="modal-body">
    					<div class="form-group">
    						<label class="form-input col-md-5">Artist Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email"class="form-control" name="artist_email" value="<?php echo $email_contact['email_artist']?>"/>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="form-input col-md-5">Booking Info Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email"class="form-control" name="booking_email" value="<?php echo $email_contact['email_booking']?>"/>
    						</div>
    					</div>
    					<div class="form-group">
    						<label class="form-input col-md-5">Management Email:</label>
    						<div class="input-group col-md-7">
    							<input type="email"class="form-control" name="manager_email" value="<?php echo $email_contact['email_manager']?>"/>
    						</div>
    					</div>
    				</div>
                </div> 
    			<div class="modal-footer">
    				<button type="submit" class="btn btn-primary " >Save</button>    
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
    			</div>   
            </div>
        </form>
    </div>
</div>