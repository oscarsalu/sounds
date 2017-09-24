<link href="<?php echo base_url(); ?>assets/js/detail_pages/subscriptions/css/upgrade.css" rel="stylesheet" />
<script>
$(document).ready(function() {
    $('#plan-upgrade .package').hover(function () {
        $(this).toggleClass('brilliant');
    
    });
})
</script>
<section class="digital-music " id="plan-upgrade" style="opacity: inherit;padding-top: 90px;min-height: 100vh;" >
	<div class="container marketing2" >
        <?php
        if ($user_data['role'] == 1) {
            ?>
    		<div class="row ">
                <h1 class="text-primary" about="/content_digital_plans/"><span property="content" id="content_digital_plans"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plans_s>', 'Plans'); ?></span></h1>
                <hr />
                <div class="col-md-12">
                    <div class='package '>
                        <!--<div class='name'>Basic Artist</div>-->
                        <h3 class='name' about="/content_digital/"><span property="content" id="content_digital"><?php echo $this->M_text->getdatavalue('<_scontent_digital_s>', 'Basic Artist'); ?></span></h3>
                        <!--
                        <div class='price'>$<?=$setting_global->artist_basic_fee?> </div>-->
                        <div class="price">
                        <span  about="/content_price/"><span property="content" id="content_price"><?php echo $this->M_text->getdatavalue('<_scontent_price_s>', '$4.50 '); ?></span></span>
                        </div>
                        <!--
                        <div class='trial'>$<?=$setting_global->artist_basic_fee?> per Month.</div>-->
                        <div class='trial'>
                            <span  about="/content_price2/"><span property="content" id="content_price2"><?php echo $this->M_text->getdatavalue('<_scontent_price2_s>', '$4.50 per Month.'); ?></span></span>
                        </div>
                        <hr>
                        <ul class="col-sm-6">
                            <li>
                                <span about="/content_digital_plan_1/"><span property="content" id="content_digital_plan_1"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_1_s>', 'Landing Page–Website Creation Within SHP'); ?></span></span>
                            </li>
                            <li>
                                <span about="/content_digital_plan_2/"><span property="content" id="content_digital_plan_2"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_2_s>', 'Upload Unlimited Songs, Max Size 100MB'); ?></span></span>
                            </li>
                            <li>
                                <span about="/content_digital_plan_3/"><span property="content" id="content_digital_plan_3"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_3_s>', 'Upload Unlimited Videos, Max Size 100MB'); ?></span></span>   
                            </li>
                            <li>
                                <span about="/content_digital_plan_4/"><span property="content" id="content_digital_plan_4"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_4_s>', 'Picture(s) Uploaded To Landing Page'); ?></span></span>
                            </li>
                            <li>
                                <span about="/content_digital_plan_5/"><span property="content" id="content_digital_plan_5"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_5_s>', 'Band Blog - Social Media – One Stop Typing, Save Time!'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_6/"><span property="content" id="content_digital_plan_6"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_6_s>', 'Gig & Event Finder'); ?></span></span>
                            </li>
                            <li>
                                <span about="/content_digital_plan_7/"><span property="content" id="content_digital_plan_7"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_7_s>', 'Electronic Press Kit (EPK)'); ?></span></span>
                            </li>
                        </ul>
                        <ul class="col-sm-6">
                            <li>
                            <span about="/content_digital_plan_8/"><span property="content" id="content_digital_plan_8"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_8_s>', 'Fan Capture Emails'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_9/"><span property="content" id="content_digital_plan_9"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_9_s>', 'Maserati Edge - Get Noticed, Get Heard'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_10/"><span property="content" id="content_digital_plan_10"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_10_s>', 'Mirrorball Entertainmment - Improve Your Recrding'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_11/"><span property="content" id="content_digital_plan_11"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_11_s>', 'Artist Support - Talk To Michael Britton'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_12/"><span property="content" id="content_digital_plan_12"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_12_s>', 'Celebrity Endorsements For Top Artist'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_13/"><span property="content" id="content_digital_plan_13"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_13_s>', 'Send Private Messages To Other Members'); ?></span></span>
                            </li>
                            <li>
                            <span about="/content_digital_plan_14/"><span property="content" id="content_digital_plan_14"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_14_s>', 'Add Media To Your Profile'); ?></span></span>
                            </li>
                        </ul>
                        <?php 
                        if ($this->M_user->check_subscription($user_data['id'], 'Artist_basic')) {
                            ?>
                            <a class="btn btn-default" href="#" about="/content_digital_plan_button/"><span property="content" id="content_digital_plan_button"><?php echo $this->M_text->getdatavalue('<_scontent_digital_plan_button_s>', 'Current Plan'); ?></span></a>
                            <?php

                        } ?>
                    </div>    
                </div>
    		</div>
            <?php

        }
        ?>
        <div class="row">
            <?php 
                $check_premium = $this->M_user->check_subscription($user_data['id'], 'Artist_premium');
                $check_basic = $this->M_user->check_subscription($user_data['id'], 'Artist_basic');
                $check_amp = $this->M_user->check_subscription($user_data['id'], 'AMP');
                $check_Featured = $this->M_user->check_subscription($user_data['id'], 'Featured_artist');
                ?>
                <h1 class="text-primary" about="/content_service/"><span property="content" id="content_service"><?php echo $this->M_text->getdatavalue('<_scontent_service_s>', 'Services'); ?></span></h1>
                <hr />
                <?php
                if ($user_data['role'] == 1) {
                    ?>
                    <div class="col-sm-12 col-md-6">
                        <div class="well">
                            <h2 class="text-muted" about="/content_service_h2/"><span property="content" id="content_service_h2"><?php echo $this->M_text->getdatavalue('<_scontent_service_h2_s>', 'Featured / Premium Artists'); ?></span></h2>
                    		<ul>
                    			<li>
                                <span class="text-muted" about="/content_service_h21/"><span property="content" id="content_service_h21"><?php echo $this->M_text->getdatavalue('<_scontent_service_h21_s>', 'Featured / Premium Artists'); ?></span></span>
                                </li>
                    		</ul>          
                    		<p> </p>
                    		<hr/>
                    		
                            <h3 class="text-muted" about="/content_service_h22/"><span property="content" id="content_service_h22"><?php echo $this->M_text->getdatavalue('<_scontent_service_h22_s>', '$4.4/ month'); ?></span></h3>
                            
                    		<hr/>
                            <?php
                            if ($check_amp) {
                                ?>
                                <p><a class="btn btn-default btn-lg" about="/content_service_h23/"><span property="content" id="content_service_h23"><?php echo $this->M_text->getdatavalue('<_scontent_service_h23_s>', '<i class="icon-ok"></i> Current Service'); ?></span></a></p>
                                
                                <?php

                            } else {
                                ?>
                                <p><a class="btn btn-default btn-lg" href="<?php echo base_url()?>subscriptions/checkout/Featured_artist" about="/content_service_h23/"><span property="content" id="content_service_h23"><?php echo $this->M_text->getdatavalue('<_scontent_service_h23_s>', '<i class="icon-ok"></i> Select Service'); ?></span></a></p>
                                
                                <?php

                            } ?>
                    	</div>
                    </div>
                    <?php 
                } else {
                    ?>
                    <div class="col-sm-12 col-md-6">
                        <div class="well">
                    		<h2 class="text-muted">AMP</h2>
                    		<ul>
                    			<li>Fan and artist can be affiliate of multiple artists from 1 same account.</li>
                    			<li>AMPERS playlist can be custom, they can reorganize the playlist and the songs which they re-sale.</li>
                    			<li>Fan and artist AMPER can build custom playlist with songs from different artists.</li>
                    			<li>Fan Landing Page</li>
                    		</ul>          
                    		<p>Fans which are “AMPER” (with subscriptions) have Fan Landing Page page function activated. </p>
                    		<hr/>
                    		<h3> $<?=$setting_global->amp_fee?> / month</h3>
                    		<hr/>
                            <?php
                            if ($check_amp) {
                                ?>
                                <p><a class="btn btn-default btn-lg" href="#"><i class="icon-ok"></i> Current Service</a></p>
                                <?php

                            } else {
                                ?>
                                <p><a class="btn btn-default btn-lg" href="<?php echo base_url()?>subscriptions/checkout/AMP"><i class="icon-ok"></i> Select Service</a></p>
                                <?php

                            } ?>
                    		
                    	</div>
                    </div>
                    <?php

                }
            ?> 
        </div>
	</div>
</section>	        

      