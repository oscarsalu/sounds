<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- Website Design By: www.happyworm.com -->
        <title>Artist Muisic players</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="<?=base_url()?>assets/amp/css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/jquery.min.js"> </script>
        <script>var base_url="<?php echo base_url();?>";</script> 
        
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/setting.playlist.js"> </script> 
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/jquery.jplayer.js"> </script>
        <script type="text/javascript" src="<?=base_url()?>assets/amp/js/jplayer.playlist.js"> </script> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">            
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">AMP_Load_data('<?=$id_affiliate?>');</script>
        
    </head>
    <body style="">
        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">	</div>
    </body>
</html>
