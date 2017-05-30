<div class="container-fluid profile_detail" style="min-height: 100vh;" >
    <div class="row">
        <div class="col-md-12">
            <div class="cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($user_current->id)?>);">
                <div class="img-avarar">
                    
                    <a href="<?=base_url('amp/'.$homepage)?>"> <img src="<?php echo $this->M_user->get_avata($user_current->id)?>" class="thumbnail" height="150" width="150" /></a>
                    <div class="decsript">
                        <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($user_current->id)?></h3>
                        <h4 class="text_shara">City: <?= $this->M_user->get_city($user_current->id)?></h4>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li class='active'><a href='<?php echo base_url('amper/allblogs').'/'.$homepage?>'>Blogs</a></li>
               <li ><a href='<?php echo base_url('amper/allcomment').'/'.$homepage?>'>Comments</a></li> 
            </ul>
        </div>
    </div>
    <h2 class="oswaldregularh2 text-center" style="color: #000;margin-top:50px;"> All Blogs</h3>
    <hr />
    <div class="container">
        <div class="row">
        	<div class="allblogs col-sm-12">   
        		<?php
                    foreach ($listblogs as $row) {
                        ?>
                        <div class="allblogs-container">
                        <div class="col-xs-6 col-sm-3 img-allblogs">                        
                            <a href="#">
                                <img class="blog-img img-responsive img-thumbnail" width="250" src="<?php echo base_url('uploads/'.$row->user_id.'/photo/blogs/'.$row->image_rep) ?>" />
                            </a>
                        </div>
                    <div class="col-xs-6 col-sm-3 ctn-blogs">
                		<div class="title-blogs">
                			<div class="left-blog" >
                				<h2><a href="<?php echo base_url('amp/'.$homepage.'/detailsblogs?id_blog='.$row->id)?>"><?php echo $row->title?></a></h2>
                				<span><i><?php echo date('l, M d Y H:i:s', $row->time)?></i></span>
                			</div>
                		</div>
                		<div class="content-blogs" >
                            <p class="text-justify">
                                <?php
                                    $text = strip_tags($row->introduction);
                        $desLength = strlen($text);
                                    //var_dump($desLength);exit;            
                                    $stringMaxLength = 315;
                        if ($desLength > $stringMaxLength) {
                            $des = substr($text, 0, $stringMaxLength);
                            $text = $des.'...'."<a href='".base_url('amp/'.$homepage.'/detailsblogs?id_blog='.$row->id)."'>Read more</a>";
                            echo $text;
                        } else {
                            echo $text."<a href='".base_url('amp/'.$homepage.'/detailsblogs?id_blog='.$row->id)."'>Read more</a>";
                        } ?>
                            </p>
                			
                		</div>
                    </div>      
                        </div>
                    <?php

                    }
                ?>
                <div class="text-center">
                    <?php echo $this->pagination->create_links(); ?>
                </div>     
        	</div>
        </div>
    
    </div>
    
</div>