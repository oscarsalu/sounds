 <div id="musician">
        <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="join wow bounceInLeft" data-wow-delay="0.8s">                      
                         <h2 about="/content_homes1_tittle_new1_24/">                  
                             <span property="content" id= "content_homes1_tittle_new1_24">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_24_s>', 'JOIN FOR FREE!');
                                ?>
                            </span>           
                        </h2>
                        <p class="opensans2" about="/content_homes1_tittle_new1_241/">
                              <span property="content" id= "content_homes1_tittle_new1_241">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_241_s>', 'Connecting local musicians. Join the thousands of seeking musicians and bands. Musician Classifieds. Sign up free today!');
                                ?>
                            </span>  
                        </p>
                        <a class="myButton" href="<?php echo base_url(); ?>account/signup">SIGN UP</a>
                    </div>
                    <div class="testi wow bounceInLeft" data-wow-delay="1.2s">                    
                         <h2 about="/content_homes1_tittle_new1_25/">                  
                             <span property="content" id= "content_homes1_tittle_new1_25">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_25_s>', 'TESTIMONIALS');
                                ?>
                            </span>           
                        </h2>
                        <div class="carousel">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- class="carousel slide" data-ride="carousel"-->
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                  <img class="first-slide" src="<?php base_url() ?>assets/images/2.jpg" alt="First slide">
                                  <div class="container">
                                    <div class="carousel-caption">
                                        <div class="cap">
                                            <h4>Hola</h4>
                                            <p>Note: Glyphicon buttons on the left and right might not load/display .</p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="item">
                                  <img class="second-slide" src="<?php base_url() ?>assets/images/1.jpg" alt="Second slide">
                                  <div class="container">
                                    <div class="carousel-caption">
                                        <div class="cap">
                                            <h4>Alibaba habana</h4>
                                            <p>Glyphicon buttons on the left and right might not load/display .</p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="item">
                                  <img class="third-slide" src="<?php base_url() ?>assets/images/4.jpg" alt="Third slide">
                                  <div class="container">
                                    <div class="carousel-caption">
                                        <div class="cap">
                                            <h4>BRITISH COMLOMBIA</h4>
                                            <p>Note: Glyphicon buttons on the left and right might not load/display .</p>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                                </div>
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <!--<span class="sr-only">Previous</span>-->
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <!--<span class="sr-only">Next</span>-->
                            </a>
                        </div><!-- /.carousel -->
                    </div><!--end testi-->
                </div></div>
            
                <div class="col-sm-8">
                    <div class="text">
                        <h1 class="wow bounceInDown" data-wow-duration="0.5s" style="text-align: center;" about="/content_homes1_tittle_new1_26/">
                               
                             <span property="content" id= "content_homes1_tittle_new1_26">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_26_s>', 'YOU WANT SEARCH MUSICIAN AND BAND');
                                ?>
                            </span>        
                    
                        </h1>
                        <div class="bottomheader wow zoomIn"  data-wow-delay="1s"></div>
                        <h2 class="wow bounceInDown" data-wow-duration="0.8s" about="/content_homes1_tittle_new1_27/">
                            <span property="content" id= "content_homes1_tittle_new1_27">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_27_s>', ' Search Thousands of Musicians and Bands:');
                                ?>
                            </span>  
                       </h2>
                    </div>
                    <div class="search opensans2 wow bounceInUp"  data-wow-delay="1.2s">
                       <form action="<?=base_url('find-a-musician/search')?>" method="get" >
                            <div class="form-group">
                                <select name="genre" class="defaut_input form-control" >
                                    <option value="0">Any</option>
                                    <?php
                                    if (isset($_GET['genre'])) {
                                        $search_genre = $_GET['genre'];
                                    } else {
                                        $search_genre = 0;
                                    }
                                    if (isset($_GET['city'])) {
                                        $search_city = $_GET['city'];
                                    } else {
                                        $search_city = '';
                                    }
                                    foreach ($genres as $row) {
                                        ?>
                                        <option value="<?=$row->id?>" <?php if ($search_genre == $row->id) {
    echo 'selected';
} ?> ><?=$row->name?></option>
                                        <?php

                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="city" value="<?=$search_city?>" class="defaut_input form-control" placeholder="city or Location" />
                            </div>
                            <button class="myButton">SEARCH</button> 
                       </form>
                    </div>
                </div><!--col-sm-8--> 
            </div><!--end row-->
        </div><!--end container-->
    </div><!--end musician-->
        
     <div class="featured">
        <div class="container">
            <h1 class="header_h1" about="/content_homes1_tittle_new1_29/">
                 <span property="content" id= "content_homes1_tittle_new1_29">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_29_s>', 'FEATURED MUSICIAN AND BAND');
                    ?>
                 </span> 
            </h1>
            <div class="row">
                <?php foreach ($musicians as $musician) {
    ?>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <div class="remix_items grid clearfix four_col">
    						<a class="item" data-gal="photo" href="<?php echo base_url().'find-a-musician/'.$musician['home_page']; ?>" title="" rel="bookmark">
        						<figure class="effect-bubba">
        							<img width="258" height="200" src="<?=$this->M_user->get_avata($musician['id'])?>" class="attachment-type_cover wp-post-image" alt="" />							
                                    <figcaption>
        								<h2><?=$this->M_user->get_name($musician['id'])?></h2>
        								<p><?php echo strtoupper($musician['city']); ?></p>
        							</figcaption>
                                </figure>
    					   </a>
                        </div>
                    </div>
                    <?php 
}
                if (count($musicians) == 0) {
                    ?> <h2 class="text-center">No results were found!</h2><?php

                }
                ?>       
                <?php echo $this->pagination->create_links(); ?>          
            </div><!--end row-->
            
        <div class="state_findamusician">            
            <h1 class="header_h1" about="/content_homes1_tittle_new1_29/">
                 <span property="content" id= "content_homes1_tittle_new1_29">
                    <?php
                        echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_29_s>', 'STATE');
                    ?>
                 </span> 
            </h1>
            <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <ul class="list">
                        <li><a href="#">Alabama</a></li>
                        <li><a href="#" >Alaska</a></li>
                        <li><a href="#">American Samoa</a></li>
                        <li><a href="#">Arizona</a></li>

                    </ul>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <ul class="list">
                        <li><a href="#">Alabama</a></li>
                        <li><a href="#" >Alaska</a></li>
                        <li><a href="#">American Samoa</a></li>
                        <li><a href="#">Arizona</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <ul class="list">
                        <li><a href="#">Alabama</a></li>
                        <li><a href="#" >Alaska</a></li>
                        <li><a href="#">American Samoa</a></li>
                        <li><a href="#">Arizona</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <ul class="list">
                        <li><a href="#">Alabama</a></li>
                        <li><a href="#" >Alaska</a></li>
                        <li><a href="#">American Samoa</a></li>
                        <li><a href="#">Arizona</a></li>
                    </ul>
                </div>
            </div>
        </div>
            
        </div>
     </div><!--end featured-->
</div>