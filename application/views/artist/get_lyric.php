<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<div style="min-height: 100vh;">
    <?php
          include('inc_side_menu/menu_artist.php')
        ?>  
    <div class="side-body">
        <h2  about="/content_homes1_tittle_new4_442_lyric/">
             <span property="content" id= "content_homes1_tittle_new4_442_lyric">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new4_442_lyric_s>', 'Lyric Manager');
                ?>
            </span> 
         </h2>        
        <hr />
        <div class="breadcrumb flat" style="    width: 100%;">
        	<a href="<?php echo base_url()?>artist/managersong">Playlist->Song Manager</a>
        	<a class="active" href="#">Lyrics</a>
        </div>
        <div class="content-basic" style="background:#fff; width: 100%;padding:20px" >
            <?php   if(!empty($playlist)){ } else {
                                echo "<div class='alert alert-danger'>You Must First Create a Playlist then Upload Songs then Upload Lyrics</div>";
                            } ?>

						
				<section class="tile" style="padding: 0px;">
                                    <div class="tile-header dvd dvd-btm">
                    <h3 class="custom-font"><strong>Lyric</strong> Editor</h3>
                                    
                </div>
                                    <div class="tile-body">
					<div class="list-item full-width list-item-canhan col-md-9">
                                           
                            
                            <?php
                            foreach ($playlist as $row) {
                                
                                ?>
                               <div class="col-md-3">
                        			<div class="e-item">
                        				                                             
                                            <img width="90" height="90" src="<?php echo $this->M_audio_song->get_cover_playlist($row['id'])?>" alt="<?php echo $row['name']?>" />
                                                                            
                        				<h3 class="title-item"> 
                                            <?php echo $row['name']?>
                                        </h3>
                                                    <a href="<?php echo base_url('artist/lyriclist').'/'.$row['id']?>" class="btn btn-primary">Upload Lyrics</a>
                        				<p class="title-sd-item">
                                            <span class="txt-info"></span>
                                        </p>
                                        <p class="title-sd-item">
                                            <span class="txt-info"></span>
                                        </p>
                        			</div>
                        			<!-- END .e-item -->                                     
                        			<div class="item-tool"> 
                                        <input type="hidden" class ="id" value="<?php echo $row['id']?>"/>
										<input type="hidden" class ="user_id" value="<?php echo $row['user_id']?>"/>
										<input type="hidden" class ="name" value="<?php echo $row['name']?>"/>
                                        <input type="hidden" class ="desc" value="<?php echo $row['decs']?>"/>
                                        <input type="hidden" class ="genre" value="<?php echo $row['genre']?>"/>
                                        <input type="hidden" class ="image" value="<?php echo $row['image_file']?>"/>
                                        
                                    </div>
                               </div>
                                <?php

                            }
                            
                             
                             
                           
                            ?>
                                            
                    		 
                    <!-- END .list-item -->
                    </div>
                                    </div>
                                    <div class="col-md-3 col-md-offset-3">
                   <?php echo $this->pagination->create_links(); ?>
                                    </div>
				</section>
        </div>
    </div>
</div>
        
        
<script>                
    CKEDITOR.replace('bios');
</script>