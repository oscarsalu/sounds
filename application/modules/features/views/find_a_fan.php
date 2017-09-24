<div id="findafan" style="margin-top:50px;">
    <div class="search text-center">
        <form name="search-fan" action="<?php echo base_url(); ?>features/find_a_fan/fan_search" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="text" id="searchname" name="search_text" placeholder="Name fan or genres" />
            <button type="submit" class="btn btn-primary" >SEARCH</button>
            <?php
            echo "<div class='error_msg' style='color:#FFF'>";
            if (isset($id_error_message)) {
                echo $id_error_message;
            }
            echo "</div>";
            ?>
        </form>

    </div>


    <div class="result-find">
        <div class="container">
            <div class="row" class="load_result">
            <?php
                if (isset($result_display)) {
                	if ($result_display == 'No found !') {
                		echo "<h1 class='text-center' style='color:#FFF'>";
                        echo $result_display;
                        echo "</h1>";
            		} else {
            			echo "<h1 style='color:#FFF'>Result</h1>";
                        foreach ($result_display as $value) {
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-3">
            				<div class="newtrend remix_items grid" >
                                <a href="<?php echo  base_url() ?>amp/<?php echo $value->home_page; ?>">
                                <!--<a href="<?php echo  base_url() ?><?php echo $value->home_page; ?>">-->
                                
                        		<figure class="effect-bubba">
                                    <!--
                                    <img class="first-slide img-responsive" src="<?php echo  base_url() ?>uploads/<?php echo $value->usid; ?>/photo/<?php echo $value->avata; ?>" />
                        			-->
                                    <?php if($value->avata != null){ 

                                        ?>
                                        <img class="first-slide img-responsive" src="<?php echo  base_url() ?>uploads/<?php echo $value->usid; ?>/photo/<?php echo $value->flp_avata; ?>" alt="<?php echo $value->fan_name; ?>" />
                                        <?php }else{?>
                                        <img class="first-slide img-responsive" src="<?php echo  base_url() ?>assets/images/user_default.gif" alt="<?php echo $value->fan_name; ?>" />
                                    <?php } ?>	
                                    
                                    <figcaption>
                        				<h2><?php echo $value->fan_name ?></h2>
                                        <p>FAN | <?php //echo $value->genre_name ?></p>
                        			</figcaption>
                        		</figure>
                                </a>
                            </div>
            			</div>
                        <?php
                        }
                    }
               }else{
               if(isset($show)&& !empty($show)){
                    foreach($show as $s){ 
                        ?>
                    <div class="col-xs-6 col-sm-4 col-md-3">
        				<div class="newtrend remix_items grid" >
                            <a href="<?php echo  base_url() ?>amp/<?php echo $s->home_page; ?>">
                    		<figure class="effect-bubba">
                                <!--
                                <img class="first-slide img-responsive" src="<?php echo  base_url() ?>uploads/<?php echo $s->usid; ?>/photo/<?php echo $s->avata; ?>" />
                    			-->
                                <?php if($s->avata_flp != null){?>
                                        <img class="first-slide img-responsive" src="<?php echo  base_url() ?>uploads/<?php echo $s->usid; ?>/photo/<?php echo $s->avata_flp; ?>" alt="<?php echo $s->fan_name; ?>" />
                                        <?php }else{?>
                                        <img class="first-slide img-responsive" src="<?php echo  base_url() ?>assets/images/user_default.gif" alt="<?php echo $s->fan_name; ?>" />
                                    <?php } ?>	
                                <figcaption>
                    				<h2><?php echo $s->fan_name ?></h2>
                                    <p>FAN | <?php //echo $s->genre_name ?></p>
                    			</figcaption>
                    		</figure>
                            </a>
                        </div>
        			</div>
                <?php }}} ?>
            </div>
        </div>
        <div id="load_image"><img src="<?php echo base_url().'assets/img/loader.gif'; ?>" /></div>
    </div>
</div>

<script type="text/javascript">
var find_a_fan_more = "<?php echo base_url('features/find_a_fan_more') ?>";
var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php base_url() ?>assets/js/detail_pages/feature/find_a_fan.js"></script>