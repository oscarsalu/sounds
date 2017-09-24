<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<div style="min-height: 100vh;">
    <?php
          include('inc_side_menu/menu_artist.php')
        ?>  
    <div class="side-body">
        <h2  about="/content_homes1_tittle_new4_442_bio/">
             <span property="content" id= "content_homes1_tittle_new4_442_bio">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_442_bio_s>', 'Bio');
                ?>
            </span> 
         </h2>        
        <hr />
        <div class="breadcrumb flat" style="    width: 100%;">
        	<a href="<?php echo base_url()?>artist/profile">Profile</a>
        	<a class="active" href="#">Bio</a>
        </div>
        <div class="content-basic" style="background:#fff; width: 100%;padding:20px" >
    
           
            
    
            <div class="form-general-info">               
                 <h3  about="/content_homes1_tittle_new4_447_bio/">
                     <span property="content" id= "content_homes1_tittle_new4_447_bio">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_447_bio_s>', 'Artist Bio');
                        ?>
                    </span> 
                 </h3>
                <hr />
                <div>
                    <!--p>Editing this will change the bio on your Reverb Profile Page, your website, Facebook apps and Press Kits.</p-->
                </div>
                <form class="form-horizontal" role="form" action="<?php echo base_url()?>artist/upadate_bio" method="post">
                	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group">
                		<div class="col-sm-12  col-md-12">
                                    <textarea  class="form-control" name="bio" id="bios" rows="7"><?php echo $user_data['bio']?></textarea>
                		</div>
                	</div>
                	<div class="form-group">
                		<div class="col-md-offset-10 col-md-2">
                			<button type="submit" class="btn btn-primary">Save</button>
                		</div>
                	</div>
                </form>
            </div>
        </div>
    </div>
</div>
        
<script>                
    CKEDITOR.replace('bios');
</script>