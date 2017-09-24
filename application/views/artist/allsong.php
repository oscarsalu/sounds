<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/customscrollbar/jquery.mCustomScrollbar.css" />

<style type="text/css">
    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}
</style>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<link href="<?php echo base_url(); ?>assets/playermusic/css/jplayer.blue.monday.min.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/jplayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/playermusic/dist/add-on/jplayer.playlist.min.js"></script>
<script type="text/javascript">
        $(".effect_slide").click(function(){
            $(this).parent().parent().find("img").click();
        })
              
</script>
<div class="row">
    <div class="col-md-12 cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($info_id)?>);">
        <div class="img-avarar">
            <img src="<?php echo $this->M_user->get_avata($info_id)?>" class="thumbnail" height="150" width="150" />
            <div class="decsript searchform">
                <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($info_id)?></h3>
                <h4 class="text_shara">Genre: <?= $this->M_user->get_name_genre($info_id)?></h4>
                <!-- TODO: <a class="btn btn-default bt-sx ">Share</a> -->
            </div>
        </div>
        
    </div>
   <!--  <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
               <li class='active'><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
               <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
               <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
               <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
               <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </div>
     -->
     <nav class="navbar navbar-default">
        <div class="container align-center">
            <ul class="nav navbar-nav">
                <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
                <li class='active'><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
                <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
                <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
                <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
                <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
<div class="container  ">
        <div class="row">
            <h3 class="oswaldregularh3 text-center" style="color:#000">All Songs, Samples Only</h3><hr />
        </div>
    <div class="col-md-12 pm-album" style="padding: 20px 0;">
        <div class="" style="margin: 0 auto;width:700px;"><!--col-md-7-->
             <div class="row col-md-12 part_session photos_session header_new_style">
                <div class="remove_part"></div>
                <span class="liner_landing"></span>
                <div class="col-md-12 remove_padding">
                    <div class="panel-group" id="accordion">
                        <?php
                        $i = 1;
                        foreach ($album_songs as $album_song) {
                            if($album_song['attribute']=="1"){
                            ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>">
                                    Album <?php echo $album_song['name']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse <?php if ($i == 1) {
    echo 'in';
} ?>">
                                <div class="panel-body remove_padding">
                                <?php $video_by_albums = $this->M_audio_song->get_songs_by_album($album_song['id']); ?>
                            
                                    <script type="text/javascript">
                                    $(document).ready(function(){
                                    
                                    	new jPlayerPlaylist({
                                    		jPlayer: "#jquery_jplayer_<?php echo $album_song['id']; ?>",
                                    		cssSelectorAncestor: "#jp_container_<?php echo $album_song['id']; ?>"
                                    	}, [
                                            <?php
                                            foreach ($video_by_albums as $video_by_album) {
                                                ?>
                                    		   {
                                                    title:"<?php echo $video_by_album['song_name'] ?>",
                                                    artist:"Price: <?php echo $video_by_album['price'] ?> <?php echo $video_by_album['currency'] ?>",
                                                    mp3:"<?php echo 'https://d1oc632jh12ao7.cloudfront.net/uploads/'.$info_id.'/audio/'.$video_by_album['filename'] ?>",
                                                    //oga:"http://www.jplayer.org/audio/ogg/TSP-01-Cro_magnon_man.ogg",
                                                    poster: "<?php echo base_url().'uploads/'.$info_id.'/img_playlist/'.$album_song['image_file']; ?>"
                                                },
                                    		<?php 
                                            } ?>
                                    	], {
                                    		swfPath: "<?php echo base_url('') ?>assets",
                                            swfPath: "<?php echo base_url('') ?>assets/playermusic/dist/jplayer",
                                    		supplied: "webmv, ogv, m4v, oga, mp3",
                                    		useStateClassSkin: true,
                                    		autoBlur: false,
                                    		smoothPlayBar: true,
                                    		keyEnabled: true,
                                    		audioFullScreen: true
                                    	});
                                    });
                                    </script>
                                        
                                        
                                        <div id="jp_container_<?php echo $album_song['id']; ?>" class="jp-video jp-video-270p" role="application" aria-label="media player" style="margin: 0 auto;">
                                        	<div class="jp-type-playlist">
                                        		<div id="jquery_jplayer_<?php echo $album_song['id']; ?>" class="jp-jplayer"></div>
                                        		<div class="jp-gui">
                                        			<div class="jp-video-play">
                                        				<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
                                        			</div>
                                        			<div class="jp-interface">
                                        				<div class="jp-progress">
                                        					<div class="jp-seek-bar">
                                        						<div class="jp-play-bar"></div>
                                        					</div>
                                        				</div>
                                        				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                        				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                        				<div class="jp-controls-holder">
                                        					<div class="jp-controls">
                                        						<button class="jp-previous" role="button" tabindex="0">previous</button>
                                        						<button class="jp-play" role="button" tabindex="0">play</button>
                                        						<button class="jp-next" role="button" tabindex="0">next</button>
                                        						<button class="jp-stop" role="button" tabindex="0">stop</button>
                                        					</div>
                                        					<div class="jp-volume-controls">
                                        						<button class="jp-mute" role="button" tabindex="0">mute</button>
                                        						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                        						<div class="jp-volume-bar">
                                        							<div class="jp-volume-bar-value"></div>
                                        						</div>
                                        					</div>
                                        					<div class="jp-toggles">
                                        						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                        						<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
                                        						<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
                                        					</div>
                                        				</div>
                                        				<div class="jp-details">
                                        					<div class="jp-title" aria-label="title">&nbsp;</div>
                                        				</div>
                                        			</div>
                                        		</div>
                                        		<div class="jp-playlist">
                                        			<ul>
                                        				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
                                        				<li>&nbsp;</li>
                                        			</ul>
                                        		</div>
                                        		<div class="jp-no-solution">
                                        			<span>Update Required</span>
                                        			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                        		</div>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        ++$i;
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div><!--end player music -->
        
        <!--
        <div class="col-md-5 playlist-allsong">
            <h3 class="text-center">Album</h3>
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="image_album" style="background-image: url(<?php echo base_url()?>assets/images/digital.jpg);"></div>
                    <div class="caption-album text-center">  <a href="#"> Album 1</a></div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="image_album" style="background-image: url(<?php echo base_url()?>assets/images/4.jpg);"></div>
                    <div class="caption-album text-center">  <a href="#"> Album 2</a></div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="image_album" style="background-image: url(<?php echo base_url()?>assets/images/1.jpg);"></div>
                    <div class="caption-album text-center">  <a href="#"> Album 3</a></div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="image_album" style="background-image: url(<?php echo base_url()?>assets/images/2.jpg);"></div>
                    <div class="caption-album text-center">  <a href="#"> Album 4</a></div>
                </div>
            </div>
        </div>
        -->
    </div>
</div>

 </div>



<!-- view lyrics modal -->
<div class="modal fade bs-example-modal-sm" id="viewlyrics" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalbg">Lyrics: <span class="song_name"></span></h4>
        </div>
        <div class="modal-body">
            <h3>Lyrics for <span class="song_name"></span> by <strong><?php echo $user_data['artist_name']?></strong>.</h3>
            <p class="lyrics-view text-center">
            
            </p>
        </div>   
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>




