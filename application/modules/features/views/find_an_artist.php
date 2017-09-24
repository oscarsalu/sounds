<div id="find-artist">
    <div style="padding: 30px 0;"></div>
    <div class="container">
        <div class="search text-center">
            <form name="search-fan" action="<?php echo base_url(); ?>features/find_an_artist/artist_search" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="text" id="searchname" name="search_text" placeholder="Name artist or genres" />
                <button type="submit" class="btn btn-primary" ><i class="fa fa-search"></i></button>
                
                <?php
                    echo "<div class='text-center'>";
                    if(isset($error_msg))
                    {
                        echo $error_msg;
                    }
                    echo "</div>";
                ?>
                
            </form>
        </div>
        
        <div class="result-find">
            <div class="row" class="load_result">
                <div class="col-sm-6 col-md-9">
                
                    <?php
                        
                        if(isset($result_display))
                        {
                            if($result_display == "No found!"){
                           	    echo "<h1 class='text-center'>";
                                echo $result_display;
                                echo "</h1>";
                            }else{
                                echo "<h1 style='border-left: 4px solid #ED145B;padding-left:15px'>RESULT</h1>";
                                foreach ($result_display as $value) 
                                {
                                ?>
                                <div class="col-xs-6 col-sm-4">
                    				<div class="newtrend remix_items grid" >
                                        <a href="<?php echo  base_url() ?><?php echo $value->home_page; ?>">
                                		<figure class="effect-bubba">
                                            <img class="first-slide img-responsive" src="<?php echo  $this->M_user->get_avata($value->usid); ?>" />
                                			<figcaption>
                                				<h2><?php $this->M_user->get_name($value->usid); ?></h2>
                                                <p>MUSICIAN | <?php echo $value->genre_name ?></p>
                                			</figcaption>
                                		</figure>
                                        </a>
                                    </div>
                    			</div>
                                <?php
                                }
                            }
                       }else{
                            if(isset($showall) and !empty($showall)){
                                ?>                               
                                   <h1 class="text-center" about="/content_homes1_tittle_new2_21/">
                                        <span property= "content" id= "content_homes1_tittle_new2_21">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new2_21_s>','Top Artist');
                                            ?>
                                        </span>
                                	</h1>
                    
                                    <?php   foreach($showall as $show){ ?>
                                    <div class="col-xs-6 col-sm-4 ">
                        				<div class="newtrend remix_items grid" >
                                            <a href="<?php echo  base_url() ?><?php echo $show->home_page; ?>">
                                    		<figure class="effect-bubba">
                                                <img class="first-slide img-responsive" src="<?php echo  $this->M_user->get_avata($show->usid); ?>" />
                                    			<figcaption>
                                    				<h2><?php echo $this->M_user->get_name($show->usid); ?></h2>
                                                    <p>MUSICIAN | <?php echo $show->genre_name ?></p>
                                    			</figcaption>
                                    		</figure>
                                            </a>
                                        </div>
                        			</div>
                                <?php
                                }
                            }
                        }
                       
                    ?>
                </div>
                
                <div class="col-sm-6 col-md-3">
                    <div class="finda-topsong">
                        <header>                     
                         <h2 style="padding-left:15px" about="/content_homes1_tittle_new2_21/">
                                 <span>
                                        <span property= "content" id= "content_homes1_tittle_new2_21">
                                            <?php
                                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new2_21_s>',"TOP SONGS");
                                            ?>
                                        </span>
                                   </span>     
                       	</h2>
                        </header>
                        <ul>
                            <?php $x = 1;
                            if(isset($top_hot_artist) and !empty($top_hot_artist)){    foreach($top_hot_artist as $row){
                                    ?>
                                    <li>
                                        <div class="num"><?php echo $x ?></div> 
                                        <div style="display: inline-block;">
                                            <div><a href="<?=base_url($this->M_user->get_home_page($row->id))?>"><h3 class="name"><?=$this->M_user->get_name($row->id)?></h3></a></div>
                                            <div><a href="<?=base_url($this->M_user->get_home_page($row->id))?>"><h3 class="ar-name"><?=$this->M_user->get_genre_name($row->genre)?></h3></a></div>
                                        </div>
                                    </li>
                                    <?php
                                    $x++;
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        
        
    </div>
</div>