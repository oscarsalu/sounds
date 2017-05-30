<div class="container_fluid" id="blogs2" style="min-height: 100vh;background: #fff;">
    <div class="container">
    <?php  for ($i = 0;$i <= count($listblogs);++$i) {
     if ($i == 1) {
         break;
     }
                if (!empty($listblogs)) {
                    ?>
        <div class="row post1">
            <div class="col-xs-12">
                <a href="<?php echo base_url('artist/allblogs/'.$listblogs[$i]['user_id'].'/'.$listblogs[$i]['id_blog']); ?>">
                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$listblogs[$i]['user_id'].'/photo/blogs/'.$listblogs[$i]['image_rep']); ?>" />
                    <div class="title-post">
                        <h2 style="font-weight: bolder;">
                        <?php
                            $text = strip_tags($listblogs[$i]['title']);
                    echo $text; ?>
                        </h2>
                        <h3><i class="fa fa-user" style="margin-right: 15px;"></i><?php echo $row['artist_name'] ?></h3>
                    </div>
                </a>
            </div>
        </div><!-- end post1 -->
        <?php 
                }
 } ?>
        
        
        <div class="row post1 post1-rs">
            <?php for ($i = 1;$i <= count($listblogs);++$i) {
    if ($i == 4) {
        break;
    }
                if (!empty($listblogs)) {
                    ?>
            <div class="col-xs-4">
                <a href="<?php echo base_url('artist/allblogs/'.$listblogs[$i]['user_id'].'/'.$listblogs[$i]['id_blog']); ?>" class="blogs-thumb">
                    <img class="img-responsive" src="<?php echo base_url('uploads/'.$listblogs[$i]['user_id'].'/photo/blogs/'.$listblogs[$i]['image_rep']); ?>" />
                    <div class="title-post">
                        <h4><?php echo $listblogs[$i]['title']; ?></h4>
                        <h4><i class="fa fa-user" style="margin-right: 15px;"></i><?php echo $listblogs[$i]['artist_name'] ?></h4>
                    </div>
                </a>
            </div>
            <?php 
                }
} ?>          
        </div><!-- end --> 
        <div class="row">
            <div class="col-sm-8">
                <h2 class="blogs-featured">FEATURED POST</h2>
                 <?php for ($i = 4;$i <= count($listblogs);++$i) {
    if ($i == 10) {
        break;
    }
                    if (!empty($listblogs[$i])) {
                        ?>
                    <div class="row post">
                        <div class="col-sm-4 post1 post1-rs2">
                            <a href="<?php echo base_url('artist/allblogs/'.$listblogs[$i]['user_id'].'/'.$listblogs[$i]['id_blog']); ?>">
                                <img class="img-responsive" src="<?php echo base_url('uploads/'.$listblogs[$i]['user_id'].'/photo/blogs/'.$listblogs[$i]['image_rep']); ?>" />
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="blogs-title">
                                <h3 class=" blogs-time"><i class="fa fa-calendar" style="margin-right: 5px;color: #BBB;"></i>25/11/2015</h3>
                                <a href="<?php echo base_url('artist/allblogs/'.$listblogs[$i]['user_id'].'/'.$listblogs[$i]['id_blog']); ?>"><h2><?php echo $listblogs[$i]['title']; ?></h2></a>
                                <h3 style="float:left"><i class="fa fa-user" style="margin-right: 15px;"></i><?php echo $listblogs[$i]['artist_name'] ?></h3>
                            </div>
                        </div>
                </div><!-- end post -->
                <?php 
                    }
} ?>
                
                <nav>
                  <ul class="pagination">
                    <li>
                      <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <li><a href="#" class="active">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li>
                      <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>

            </div>
            
            <!-- Most popular -->
            <div class="col-sm-4 blogs-most">
                <h2 class="blogs-featured">MOST POPULAR</h2>
                
                <?php for ($i = 0;$i <= 5;++$i) {
    ?>
                <div class="row post">
                    <div class="col-sm-5 post1 post1-rs3">
                        <a href="#">
                            <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/music-HD.jpg" />
                        </a>
                    </div>
                    <div class="col-sm-7">
                        <div class="blogs-title">
                            <a href="#"><h4 class="blogs-tit">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4></a>
                            <h4 style="float:left"><i class="fa fa-user" style="margin-right: 15px;"></i>ARTIST NAME  </h4>
                            
                        </div>
                    </div>
                </div><!-- end  post -->
                
                <?php 
} ?>
                
            </div> 
        </div>
        
    </div>
</div>    