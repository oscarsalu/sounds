<style>
    .press-quote{
            background: #f1f6f8;
    margin: 0;
    padding: 30px 50px 30px 40px;
    border-left-color: #267ae9;
    }
</style>
<style type="text/css">
    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}
</style>
<div class="container-fluid profile_detail" id="allpress" style="min-height: 100vh; ">

    <div class="row">
        <div class="col-md-12">
            <div class="cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($info_id)?>);">
                <div class="img-avarar">
                    <img src="<?php echo $this->M_user->get_avata($info_id)?>" class="thumbnail" height="150" width="150" />
                
                    <div class="decsript searchform">
                        <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($info_id)?></h3>
                        <h4 class="text_shara">Genre: <?= $this->M_user->get_name_genre($info_id)?></h4>
                        <!-- TODO: <a class="btn btn-default bt-sx ">Share</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
     <nav class="navbar navbar-default">
        <div class="container align-center">
            <ul class="nav navbar-nav">
                <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
                <li ><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
                <li ><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
                <li class='active'><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
                <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
                <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
    <!-- <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
               <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
               <li class='active'><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
               <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
               <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </div> -->
  <div class="container  ">
        <div class="row">
             <h3 class="oswaldregularh3 text-center" style="color: #000;">ALL PRESS</h3> <hr />
        </div>
    <div class="row videos">
        <div class="col-md-12">
            <!-- <div class="container"> -->
                <div class="allpress">
                    <?php
                    foreach ($listpress as $row) {
                        ?>
                        <blockquote class="press-quote">
                          
                            <div class="page_object_press_item">
                              <p>“<?php echo $row['quote']?>”</p>
                              <div class="press_item_author pull-right">
                                <?php
                                if (empty($row['link'])) {
                                    ?>
                                    <?php echo $row['author']?> -<?php echo $row['name']?>
                                    <?php

                                } else {
                                    ?>
                                     <a href="http://dfdf"><?php echo $row['author']?> -<?php echo $row['name']?></a>
                                    <?php

                                } ?><span><i>(<?php echo date('M d Y', strtotime($row['date_on'])) ?>)</i></span>
                              </div>
                            </div>        
                        </blockquote>
                        
                        
                        <?php
                        if (end($listpress) != $row) {
                            echo '<hr/>';
                        }
                    }
                    ?>
                </div>
            <!-- </div> -->
            
        </div>
    </div>
</div>
