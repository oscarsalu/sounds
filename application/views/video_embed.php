
<html>
    <head>
    <script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
    </head>
    <body style="padding: 0px;margin: 0;">
    <?php
    if (!empty($video)) 
    {
        if(($video['type'] == 'file') ||  ($video['type'] == 'link'))
        {
            ?>
            <div id="video"></div>
            <?php

        if ($video['type'] == 'file') 
        {
            $link_video = base_url().'uploads/'.$video['user_id'].'/video/'.$video['name_file'];
            $link_image = base_url().'uploads/'.$video['user_id'].'/video/'.$video['cover_image'];
            ?>
            <script>
        var playerInstance = jwplayer("video");
        jwplayer("video").setup({
            stretching: 'fill',
            file: "<?=$link_video?>",
            image:"<?=$link_image?>",
            skin: "stormtrooper",
            width: "100%",
            height: "100%"
        });
        </script>
            <?php
        } 
        else 
        {
            $link_video = $video['link_video'];
            ?>
            <script>
        var playerInstance = jwplayer("video");
        jwplayer("video").setup({
            stretching: 'fill',
            file: "<?=$link_video?>",
            skin: "stormtrooper",
            width: "100%",
            height: "100%"
        });
        </script>
            <?php
        } 
        ?>
        

    <?php
        }
        else{
            $video_vimeo=basename($video['link_video']);
            $get_link='http://vimeo.com/api/v2/video/'.$video_vimeo.'.php';
             
            $hash = unserialize(file_get_contents($get_link));
            $url_id=$hash[0]['id'];
            $link_video = 'https://player.vimeo.com/video/'.$url_id.'?title=0&byline=0&portrait=0'; 
            ?>
            <iframe id="vimeo_video" src="<?=$link_video?>" width="100%" height="380" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <?php
        }
    }
    ?>    
    </body>
</html>

