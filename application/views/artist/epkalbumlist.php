 
<style type="text/css">
    #tree_playlist{
    height: auto;
    /*overflow-y: scroll;*/
    /*overflow-x: auto;*/
    width: 100%;
    float: left;
    margin:  0 1% ;  
    background: #eee; 
    /*list-style-type: none; */
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
  <script src="<?=base_url()?>assets/js/jstree/jstree.min.js"></script>
<script>
$(document).ready(function() {
    //$(" .modal-body").mCustomScrollbar();
   
    $('#frmt').jstree({
        'core' : {
            'data' : [
                <?php
                    $my_songs = $this->M_audio_song->get_my_song_epk($playlist_id);
                   
                    $list_albums = $this->M_audio_song->get_data_playlist($user_id);
                    if (!empty($user_id)) {
                        ?>
                        
                            <?php
                            foreach ($list_albums as $albums) {
                                
                                $songs = $this->M_audio_song->get_data_songs_epk($albums['id']); ?>
                                {

                                    "text" : "<?=$albums['name']?>",
                                    "state" : { "opened" : true },
                                    "children" : [
                                    <?php
                                    foreach ($songs as $song) {
                                        if (in_array($song['id'], $my_songs)) {
                                            $select_b = 'true';
                                        } else {
                                            $select_b = 'false';
                                        }
                                        if ($song['listened'] == 0) {
                                            $rating = 0;
                                        } else {
                                            $rating = $song['sales'] * 100 / $song['listened'];
                                        } ?>
                                        {
                                            "text" : "<?=$song['song_name'].'- Rating ('.$rating.'%)'?>",
                                            "state" : { "selected" : false },
                                            "icon" : "jstree-file",
                                            "id": "<?=$song['id']?>",
                                            "state" : { "selected" : <?=$select_b?> },

                                        },
                                        <?php

                                    } ?>
                                    ],
                                    "id":  "<?=$albums['id']?>",
                                },  
                                <?php

                            } ?> 
                            ,
                        <?php 
                    }
               
                ?>
            ]
        },
        "plugins" : [ "wholerow", "checkbox","search" ]
    });
     
    $('#frmt').on('changed.jstree', function (e, data) {
        var i, j, r = [];
        if(data.node) {
            if(data.node.parent !== "#")
            {
                get_song_select(data.node.parent);
            }
            else
            {
                get_song_select(data.node.id);
            }
        }
        
        for(i = 0, j = data.selected.length; i < j; i++) {
            r.push(data.instance.get_node(data.selected[i]).id);
        }
           
    });
    
});
</script>
<div class="form-group">
    <ul id="tree_playlist" class="droptree" >
       <div id="frmt" class="demo"></div>
    </ul>
</div>
<!-- <?php foreach($playlist as $play){ ?>
<div class="col-md-3 card card-3 rmvsong ripplelink" id="song<?php echo $play->id;?>"  onClick="get_song_select(<?php echo $play->id;?>)">
    <center style="margin-top:80px; text-transform:capitalize;"><?php echo $play->name;?></center>

</div><?php } ?> -->

