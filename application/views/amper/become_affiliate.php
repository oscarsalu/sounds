<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"/>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/detail_pages/amp/become_affiliates.js"></script>
<div class="container-fluid" style="min-height: 100vh;" >
    <div class="row">
        <div class="">
            <h2>To Become an Affilaites</h2>
        </div>
        <ul class="network_ul">
            <?php
            foreach ($networks as $network) {
          
                if ($network['level'] == 0) {
                    $check_connect = $this->M_affiliate->check_connect($U_map['affiliate_id'], $network['affiliate_id']);
                    $check_limit = $this->M_affiliate->check_limit_affiliates($network['artist_id'], $network['level']);
                } elseif ($network['level'] == 1) {
                    
                    $check_connect = $this->M_affiliate->check_connect($U_map['affiliate_id'], $network['affiliate_1']);
                } elseif ($network['level'] == 2) {
                    $check_connect = $this->M_affiliate->check_connect($U_map['affiliate_id'], $network['affiliate_2']);
                } elseif ($network['level'] == 3) {
                    $check_connect = $this->M_affiliate->check_connect($U_map['affiliate_id'], $network['affiliate_3']);
                }
                $check_limit = $this->M_affiliate->check_limit_affiliates($network['artist_id'], $network['level']);
                if (!$check_connect && $check_limit) {
                    ?>
                    <ol>
                        <div class="network_container" style="border: none; margin: 50px 0;">
                            <input class="input_select" onclick="update_select()" value="<?=$network['id']?>" type="checkbox" checked="" style="vertical-align: middle;line-height: 120px;"/>
                        </div>
                        <?php
                        if (!empty($network['affiliate_3'])) {
                            ?>
                            <div class="network_container text-center">
                                <div class="name_network">
                                    <span>Level 3</span>
                                </div>
                                <div class="avata_level">
                                    <img width="70px" src="<?=$this->M_user->get_avata($this->M_affiliate->get_id_user($network['affiliate_3']))?>" />
                                </div>
                                <div class="network_info">
                                    <span ><?=$this->M_user->get_name($this->M_affiliate->get_id_user($network['affiliate_3']))?></span>
                                </div>
                            </div>
                            <div class="network_container" style="border: none;">
                                <i class="fa fa-arrow-right" style="vertical-align: middle;line-height: 120px;"></i>
                            </div>
                            <?php

                        }
                    if (!empty($network['affiliate_2'])) {
                        ?>
                            <div class="network_container text-center">
                                <div class="name_network">
                                    <span>Level 2</span>
                                </div>
                                <div class="avata_level">
                                    <img width="70px" src="<?=$this->M_user->get_avata($this->M_affiliate->get_id_user($network['affiliate_2']))?>" />
                                </div>
                                <div class="network_info">
                                    <span ><?=$this->M_user->get_name($this->M_affiliate->get_id_user($network['affiliate_2']))?></span>
                                </div>
                            </div>
                            <div class="network_container" style="border: none;">
                                <i class="fa fa-arrow-right" style="vertical-align: middle;line-height: 120px;"></i>
                            </div>
                            <?php

                    }
                    if (!empty($network['affiliate_1'])) {
                        ?>
                            <div class="network_container text-center">
                                <div class="name_network">
                                    <span>Level 1</span>
                                </div>
                                <div class="avata_level">
                                    <img width="70px" src="<?=$this->M_user->get_avata($this->M_affiliate->get_id_user($network['affiliate_1']))?>" />
                                </div>
                                <div class="network_info">
                                    <span ><?=$this->M_user->get_name($this->M_affiliate->get_id_user($network['affiliate_1']))?></span>
                                </div>
                            </div>
                            <div class="network_container" style="border: none;">
                                <i class="fa fa-arrow-right" style="vertical-align: middle;line-height: 120px;"></i>
                            </div>
                            <?php

                    } ?>
                        <div class="network_container text-center">
                            <div class="name_network">
                                <span>Artist</span>
                            </div>
                            <div class="avata_level">
                                <img width="70px" src="<?=$this->M_user->get_avata($network['artist_id'])?>" />
                            </div>
                            <div class="network_info">
                                <span ><?=$this->M_user->get_name($network['artist_id'])?></span>
                            </div>
                        </div>
                        <div class="network_container text-center" style="margin: 40px 0;">
                        Artist Pay <br />Commission for You <?=$this->M_affiliate->get_commission_by_level($network['artist_id'], $network['level'] + 1)?>%
                        </div>
                        
                    </ol>
                    <div class="clearfix"><hr /></div>
                    <?php 
                }
            }
            ?>
            <div class="clearfix"></div>
            <hr />
            <form action="<?=base_url('amper/confirm_amper')?>" method="post" >
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" id="result_select" name="list_select" value=""/>
                <input type="hidden" name="AffiliateRootId" value="<?=$AffiliateRootId?>"/>
                <p class="text-center"> 
                    <button id="confirm_finish" class="btn btn-primary">Finish</button>
                </p>
            </form>
        </ul>
    </div>
    <div class="clearfix"></div>
      
</div>