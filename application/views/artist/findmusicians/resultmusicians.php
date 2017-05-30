 <link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/styletai.css" /> 
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
   <div id="mresult">
        <div class="container">
            <div class="name">
                <div class="row">
                    <div class="col-md-4 avatar">                        
                        <img src="<?php echo $this->M_user->get_avata($users[0]->id); ?>" />
                    </div>
                    <div class="col-md-8 inf">
                        <h2><?php echo strtoupper($this->M_user->get_name($users[0]->id)); ?></h2>
                        <h5><?php echo strtoupper($users[0]->city); ?>, <?php if (!empty($country_code[0]['countrycode'])) {
    echo $country_code[0]['countrycode'];
} ?> </h5>
                        <div id="myElement">Loading the player...</div>
                        <div id="mp3"></div>                                                                        
                        <div style="margin: 25px 0;">
                            <span class="glyphicon glyphicon-cd"></span>MUSICIAN | ROCK, DJ, R&B
                        </div>
                        
                        <div style="margin: 25px 0;">
                            <span class="glyphicon glyphicon-screenshot"></span>INSTRUMENT EXPERIENCE:Piano, Ghitar
                        </div>
                       
                        <div class="share">
                            <button class="btn btn-primary" id="contact"><span class="glyphicon glyphicon-envelope"></span>CONTACT</button>
                            <?php $isset = $this->M_find_musician->check_list($loged, $id);
                                if ($isset == null && $loged != $id) {
                                    ?>
                                    <a href="<?php echo base_url().'find-a-musician/music_list/'.$loged.'/'.$home_page; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>MUSIC LIST</a>
                            <?php 
                                } ?>                                                                              
                            <button class="btn btn-primary" data-toggle="modal" data-target="#share"><span class="glyphicon glyphicon-share"></span>SHARE</button>
                        </div>
                    </div>
                </div>
            </div><!-- end name-->
            
            <div class="main">
                <div class="row">
                    <div class="col-md-6">  
                        <div class="info">
                            <h3>INFO</h3>
                            <hr/>
                            <p>We are ALESIA SOUND and on the look out for a serious committed FEMALE vocalist. We rehearse at least 2X a week. You MUST have EXCELLENT communication skills. Reliable transportation a MUST.
                            </p> <p>
                            Studio sessions are currently being scheduled and possible TOUR in the new year. Compensation payable upon completion of EP and additional earnings per live performance.
                            </p>
                        </div>
                        
                        <div class="ins">
                            <h3>INSTRUMENT EXPERIENCE</h3>
                            <hr/>
                            <b>Keyboard:</b><p>Advanced</p>
                            <b>Piano:</b><p>Intermediate</p>
                        </div>
                        
                        <div class="equi">
                            <h3>EQUIPMENT</h3>
                            <hr/>
                            <p>KORG KROSS</p>
                            <p>ALESIS QS6</p>
                        </div>
                        <div>
                            <h3>MUSIC</h3>
                            <hr/>
                        </div>
                    </div>
                    
                    <div class="col-md-5 mu-right">
                        <?php if (!empty($videos)) {
    ?>
                        <div class="videos">
                            <h3>Videos</h3>
                            <hr/>
                            <?php 
                                    foreach ($videos as $video) {
                                        if ($video['type'] == 'file') {
                                            $images_video = base_url('assets/images/img/play_videos.png');
                                            $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
                                        } else {
                                            $parse = parse_url($video['link_video']);
                                            if ($parse['host'] == 'www.youtube.com') {
                                                preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video['link_video'], $matches);
                                                $id_link = $matches[0];
                                            } else {
                                                $id_link = 'MWIO6C4Bcn0';
                                            }
                                            $images_video = 'https://i.ytimg.com/vi/'.$id_link.'/sddefault.jpg';
                                            $link_video = $video['link_video'];
                                        } ?>
                                         <div class="col-md-6" style="margin: 0 auto;margin-bottom: 10px;">
                                            <a href="#videos" onclick="javascript:playvideo(<?php echo "'".$link_video."'"; ?>,$(this))" data-toggle="modal" data-target="#videos">
                                            <img src="<?php echo $images_video; ?>"/>
                                            <div class="play"><span class="button_play"></span></div></a>                                
                                        </div>                        
                            <?php 
                                    } ?>                                                                
                        </div>
                        <?php 
}
                        if (!empty($photos)) {
                            ?>                        
                        <div class="videos col-md-12 pic">
                        <h3>Photos</h3>
                        <hr/>                                              
                        <ul>                        
                            <?php foreach ($photos as $phot) {
    ?>
                                <li><a href="#videos" data-toggle="modal" data-target="#photos" ><img src="<?php echo base_url().'uploads/'.$phot['user_id'].'/photo/'.$phot['filename']; ?>" /></a></li>
                            <?php 
} ?>                                                    
                        </ul>
                        </div>
                        <?php 
                        }
                        if (!empty($music_list)) {
                            ?>                        
                        <div class="list-music col-md-12 pic">
                            <h3>CONNECTIONS</h3>
                            <hr/>
                            <h4>Music List</h4>
                            <ul>
                                <?php foreach ($music_list as $mus) {
    ?>
                                    <li><a href="<?php echo base_url().'find-a-musician/'.$mus['home_page']; ?>"><img src="<?php echo base_url().'uploads/'.$mus['music_user_id'].'/photo/'.$mus['filename']; ?>" /></a></li>
                                <?php 
} ?>
                            </ul>
                        </div>
                        <?php 
                        } ?>
                </div>
            </div><!-- end main-->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">SHARE</h4>
          </div>
          <div class="modal-body">
    
    			Use Twitter or Facebook to share your EPK.
                <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button"></div>
    			<div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
              </div>
              <div>
              <a class="btn btn-block btn-social btn-twitter" href="https://twitter.com/intent/tweet?original_referer="
    				onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;">
    			<i class="fa fa-twitter"></i> Share Twitter</a>
              </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <!--MODAL video-->
    <div class="modal fade" id="videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <!--iframe id="cartoonVideo" width="640" height="480" src="//www.youtube.com/embed/rGedjDnQ9cw" frameborder="0" allowfullscreen></iframe-->
            <div id="video"></div>
            <!--<div id="myElement2" class="img-responsive">Loading the player...</div>
                <script type="text/javascript">
                var playerInstance = jwplayer("myElement2");
                playerInstance.setup({
                    file: "https://www.youtube.com/watch?v=rGedjDnQ9cw",
                    width: 640,
                    height: 480,
                    title: 'Basic Video Embed',
                    description: 'A video with a basic title and description!',
                    mediaid: '123456',
                    autostart: true,
                });
              </script>-->
            <div class="close-pop"><a href="#" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a></div>      
        </div>
    </div>
    
    <div class="modal fade" id="photos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog text-center" role="document">
            <img src="<?php echo base_url(); ?>assets/images/adaptable.jpg" width="500" height="400"/>
        </div> 
    </div>
</div>    
<script type="text/javascript">
    function playvideo(link_video,o){
        $link_vd = link_video;              
        var playerInstance = jwplayer("video");
        jwplayer("video").setup({
        	stretching: 'fill',
        	file: $link_vd,            	
            width: "100%",            
            aspectratio: "16:9"
        });   
        jwplayer("video").play();            
    }     
</script> 