<link href="<?php echo base_url(); ?>assets/css/blog/blog.css" rel="stylesheet" />
<div class="container_fluid" id="blogs2" style="min-height: 100vh;background: #fff;">
    <div class="container">
        <div class="row ">
            <h1 class="text-center text-success" about="/content_homes1_tittle_new1_21/">
              <span property="content" id= "content_homes1_tittle_new1_21">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_21_s>', '<strong> Blogs 99Sound</strong>');
                ?>
            </span>
            </h1>
            <?php 
            foreach ($listblogs as $blog) {
                ?>
                <div class="post-details text-left" style="padding: 15px 0;color: #aaa;">
                    <span class="post-date">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                       <?=date('M d Y', $blog['time'])?>  </span>
                </div>
                <a href="<?=base_url('blogs/'.strtolower(str_replace(' ', '-', $blog['title'])).'-'.$blog['id'])?>" >
                     <h2><?php echo $blog['title']; ?></h2>
                     <img class="img-responsive" src="<?=base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep'])?>" />
                </a>
                <div class="post_body text-justify" style="padding: 10px;font-size: 1.2em;">
                    <?= $blog['introduction']?>
                </div>
                <a class="btn btn-default" href="<?=base_url('blogs/'.strtolower(str_replace(' ', '-', $blog['title'])).'-'.$blog['id'])?>">Read More</a>
                <hr />
                
                <?php 
            }
            ?>  
            <?php echo $this->pagination->create_links();?>                     
        </div><!-- end -->          
        <div class="row">
            <div class="col-sm-8">
                <h2 class="blogs-featured" about="/content_homes1_tittle_new1_22/">                  
                     <span property="content" id= "content_homes1_tittle_new1_22">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_22_s>', 'FEATURED POST');
                        ?>
                    </span>           
               </h2>
                 <?php foreach ($featured_post as $blog) {
    ?>
                    <div class="row post">
                        <div class="col-sm-4 post1 post1-rs2">
                            <a href="<?=base_url('blogs/'.strtolower(str_replace(' ', '-', $blog['title'])).'-'.$blog['id'])?>">
                                <img class="img-responsive" src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']); ?>" />
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="blogs-title">
                                <h3 class=" blogs-time">
                               <i class="fa fa-clock-o" aria-hidden="true"></i> <?=date('M,d Y', $blog['time'])?></h3>
                                <a href="<?=base_url('blogs/'.strtolower(str_replace(' ', '-', $blog['title'])).'-'.$blog['id'])?>"><h2><?php echo $blog['title']; ?></h2></a>
                             
                            </div>
                        </div>
                </div><!-- end post -->
                <?php 
} ?>

            </div>
            
            <!-- Most popular -->
            <div class="col-sm-4 blogs-most">                
                 <h2 class="blogs-featured" about="/content_homes1_tittle_new1_23/">                  
                     <span property="content" id= "content_homes1_tittle_new1_23">
                        <?php
                            echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_23_s>', 'MOST POPULAR');
                        ?>
                    </span>           
               </h2>
                <?php foreach ($most_popular as $blog) {
    ?>
                    <div class="row post">
                        <div class="col-sm-4 post1 post1-rs3">
                            <a href="<?=base_url('blogs/'.strtolower(str_replace(' ', '-', $blog['title'])).'-'.$blog['id'])?>">
                                <img class="img-responsive" src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']); ?>" />
                            </a>
                        </div>
                        <div class="col-sm-8">
                            <div class="blogs-title">
                                <h3 class=" blogs-time">
                                <i class="fa fa-eye" style="margin-right: 5px;color: #BBB;"></i>
                                <?=$blog['count_read']?></h3>
                                <a href="<?=base_url('blogs/'.strtolower(str_replace(' ', '-', $blog['title'])).'-'.$blog['id'])?>"><h2><?php echo $blog['title']; ?></h2></a>
                                
                            </div>
                        </div>
                    </div><!-- end post -->
                    <?php

}
                ?>
            </div>       
        </div>
    </div>
</div>    