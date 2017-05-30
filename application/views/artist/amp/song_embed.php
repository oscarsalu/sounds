<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Website Design By: www.happyworm.com -->
        <title>Song player</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="<?=base_url()?>assets/amp/css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/jquery.min.js"> </script>
        <script>var base_url="<?php echo base_url();?>";</script> 
        
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/setting.songs.js"> </script> 
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/jquery.jplayer.js"> </script>
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/jplayer.playlist.js"> </script> 
                      
        <script type="text/javascript">AMP_Load_data('<?=$id_affiliate?>','<?=$song_id;?>');</script>
        
    </head>
    <body style="overflow: hidden;margin: 0;">
        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">	</div>
    </body>
</html>
