<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/js/easypiechart/jquery.easypiechart.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.resize.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.orderBars.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.stack.min.js"></script>
<script src="<?=base_url()?>assets/js/flot/jquery.flot.pie.min.js"></script>
 <?php
if (isset($commission_affiliate)) {
    $level1 = $commission_affiliate['commission_1'];
    $level2 = $commission_affiliate['commission_2'];
    $level3 = $commission_affiliate['commission_3'];
    $level4 = $commission_affiliate['commission_4'];
} else {
    $level1 = $level2 = $level3 = $level4 = 0;
}
if (isset($limit_affiliates)) {
    $limit_level1 = $limit_affiliates['level_1'];
    $limit_level2 = $limit_affiliates['level_2'];
    $limit_level3 = $limit_affiliates['level_3'];
    $limit_level4 = $limit_affiliates['level_4'];
} else {
    $limit_level1 = $limit_level2 = $limit_level3 = $limit_level4 = 0;
}
$commission_artist = 100 - $level1 - $level2 - $level3 - $level4;
?>
<script>
var link = "<?php echo base_url('amper/affiliates/load_level');?>";
var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
var link1 = "<?php echo base_url('amper/affiliates/load_new_affiliate');?>";
var data = [
        { label: 'Level 1', data: <?=$level1?> },
        { label: 'Level 2', data: <?=$level2?> },
        { label: 'Level 3', data: <?=$level3?> },
        { label: 'Level 4', data: <?=$level4?> },
        { label: 'Artist', data: <?=$commission_artist?>}
    ];
var data6 = [
        { label: 'Level 1', data: <?=$level1?> },
        { label: 'Level 2', data: <?=$level2?> },
        { label: 'Level 3', data: <?=$level3?> },
        { label: 'Level 4', data: <?=$level4?> },
        { label: 'Artist', data: <?=$commission_artist?>}
    ];    

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/detail_pages/amp/affiliates.js"></script>
<div class="container-fluid">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;overflow: hidden;">
        <h4 class="tt text_caplock">Dashboard Affiliates</h4>
        <span class="liner"></span>
        <div class="row">
            <div class="col-md-4 panel-heading">
                <button class="button_new"  data-toggle="modal" data-target="#setting_commission"><i class="fa fa-plus"></i> Setting Percentage Commission</button>
            </div>
        </div>
        <div class="row">
             
            <div class="col-md-6">
                <div id="total-chart" style=" height: 250px"></div>
            </div> 
            <div class="col-md-6">
                <div id="donut-chart" style=" height: 250px"></div>
            </div>
        </div>
        <div class="alert subs-props col-sm-12 text-center">
			<div class="row">
				<div class="col-md-3 col-xs-6 field">
					<div class="legend">
                        <div class="easypiechart animate" data-percent="<?=$level1?>" data-size="180" data-scale-color="false" data-bar-color="#1693A5" data-line-cap="round" data-line-width="5" style="width:180px;">
                            <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$level1?></span></div>
                        </div>
                    </div>
					<div> LEVEL 1</div>
				</div>
				<div class="col-md-3 col-xs-6 field">
					<div class="legend">
						<div class="easypiechart animate" data-percent="<?=$level2?>" data-size="180" data-scale-color="false" data-bar-color="#A40778" data-line-cap="round" data-line-width="5" style="width:180px;">
                            <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$level2?></span></div>
                        </div>         									
                    </div>
					<div>
						LEVEL 2
					</div>
				</div>
				<div class="col-md-3 col-xs-6 field">
					<div class="legend">
                        <div class="easypiechart animate" data-percent="<?=$level3?>" data-size="180" data-scale-color="false" data-bar-color="#e05d6f" data-line-cap="round" data-line-width="5" style="width:180px;">
                            <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$level3?></span></div>
                        </div>
                    </div>
					<div>LEVEL 3</div>
				</div>
                <div class="col-md-3 col-xs-6 field" style="min-height: 47px;">
				   <div class="legend">
                        <div class="easypiechart animate" data-percent="<?=$level4?>" data-size="180" data-scale-color="false" data-bar-color="#5cb85c" data-line-cap="round" data-line-width="5" style="width:180px;">
                            <div class="pie-percent custom-font" style="line-height: 170px;"><span><?=$level4?></span></div>
                        </div>
                   </div>
				   <div>LEVEL 4</div>
			    </div>
                                    								
			</div>
		</div>
        <!-- END SLIDER -->
        <div class="row">
            <div class="col-md-4 panel-heading">
                <button class="button_new"  data-toggle="modal" data-target="#setting_limit"><i class="fa fa-plus"></i> Setting Limit affiliate</button>
            </div>
            <div class="col-md-6">
                
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-3 col-xs-6 text-center">
				<div class="legend">
                    <span class="limit_number"><?php if ($limit_level1) {
    echo $limit_level1;
} else {
    echo 'Unlimit';
}?></span>
                </div>
				<div>LIMIT LEVEL 1</div>
			</div>
            <div class="col-md-3 col-xs-6 text-center">
				<div class="legend">
                    <span class="limit_number"><?php if ($limit_level2) {
    echo $limit_level2;
} else {
    echo 'Unlimit';
}?></span>
                </div>
				<div>LIMIT LEVEL 2</div>
			</div>
            <div class="col-md-3 col-xs-6 text-center">
				<div class="legend">
                    <span class="limit_number"><?php if ($limit_level3) {
    echo $limit_level3;
} else {
    echo 'Unlimit';
}?></span>
                </div>
				<div>LIMIT LEVEL 3</div>
			</div>
            <div class="col-md-3 col-xs-6 text-center">
				<div class="legend">
                    <span class="limit_number"><?php if ($limit_level4) {
    echo $limit_level4;
} else {
    echo 'Unlimit';
}?></span>
                </div>
				<div>LIMIT LEVEL 4</div>
			</div>
        </div>
        <hr />
        <div class="row">
            <ul id="affiliate-action" >
                <li class="active" ><a href="#list_new" role="tab" data-toggle="tab">New Affiliate <span class="badge bg-lightred"><?=$this->M_affiliate->count_level_new($user_data['id'])?></span></a></li>
                <li  ><a href="#list_1" role="tab" data-toggle="tab">List Affilaite Level 1 <span class="badge bg-blue"><?=$this->M_affiliate->count_list_level(1, $user_data['id'])?></span></a></li>
                <li ><a href="#list_2" role="tab" data-toggle="tab">List Affilaite Level 2 <span class="badge bg-blue lt"><?=$this->M_affiliate->count_list_level(2, $user_data['id'])?></span></a></li>
                <li ><a href="#list_3" role="tab" data-toggle="tab">List Affilaite Level 3 <span class="badge bg-blue lter"><?=$this->M_affiliate->count_list_level(3, $user_data['id'])?></span></a></li>
                <li><a href="#list_4" role="tab" data-toggle="tab">List Affilaite Level 4 <span class="badge bg-blue dk"><?=$this->M_affiliate->count_list_level(4, $user_data['id'])?></span></a></li>
            </ul>
            <div class="clearfix"></div>
            <div class="tab-content">
                <div class="tab-pane active" id="list_new">
                    <ul class="list_affilaite_new">
                        <input type="hidden" value="1" class="level_data" />
                        <input type="hidden" value="1" class="level_page" />
                        <?php
                        foreach ($list_new as $new) {
                            ?>
                            <li><a target="_blank" href="<?=$this->M_user->get_url_alp($new->id)?>"><?=$this->M_user->get_name($new->id)?></a> - <?=$new->email?> - Level <?=$new->LEVEL?>
                            <a href="<?php echo base_url('amper/affiliates/allow_afiliate/'.$new->ID_level)?>" class="btn btn-success btn-xs " title="Allow Affiliate"> Allow</a>
                            <a href="<?php echo base_url('amper/affiliates/delete_afiliate/'.$new->ID_level)?>" class="btn btn-danger btn-xs " title="Delete Affiliate">Delete</a>
                            </li>
                            <?php

                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-pane" id="list_1">
                    <ul class="list_affilaite">
                        <input type="hidden" value="1" class="level_data" />
                        <input type="hidden" value="1" class="level_page" />
                        <?php
                        foreach ($list_level_1 as $l1) {
                            ?>
                            <li>
                                <a target="_blank" href="<?=$this->M_user->get_url_alp($l1->id)?>"><?=$this->M_user->get_name($l1->id)?></a>
                                - <?=$l1->email?>
                                <?php 
                                if ($l1->Status == 2) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/unlock/'.$l1->ID_level)?>" class="btn btn-danger btn-xs" id="unlock" title="Unlock Affiliate">Unlock</a>

                                     <?php

                                } elseif ($l1->Status == 1) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/lock/'.$l1->ID_level)?>" class="btn btn-primary btn-xs" id="lock" title="Lock Affiliate"> Lock</a>
                                    <?php

                                } ?>
                             </li>
                            <?php

                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-pane " id="list_2">
                    <ul class="list_affilaite">
                         <input type="hidden" value="2" class="level_data" />
                         <input type="hidden" value="1" class="level_page" />
                        <?php
                        foreach ($list_level_2 as $l2) {
                            ?>
                            <li>
                                <a target="_blank" href="<?=$this->M_user->get_url_alp($l2->id)?>"><?=$this->M_user->get_name($l2->id)?></a>
                                 - <?=$l2->email?>
                                <?php 
                                if ($l2->Status == 2) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/unlock/'.$l2->ID_level)?>" class="btn btn-danger btn-xs" title="Unlock Affiliate">Unlock</a>
                                     <?php

                                } elseif ($l2->Status == 1) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/lock/'.$l2->ID_level)?>" class="btn btn-primary btn-xs" title="Lock Affiliate"> Lock</a>
                                    <?php

                                } ?>
                            </li>
                            <?php

                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-pane" id="list_3">
                    <ul class="list_affilaite">
                         <input type="hidden" value="3" class="level_data" />
                         <input type="hidden" value="1" class="level_page" />
                        <?php
                        foreach ($list_level_3 as $l3) {
                            ?>
                            <li>
                                <a target="_blank" href="<?=$this->M_user->get_url_alp($l3->id)?>"><?=$this->M_user->get_name($l3->id)?></a>
                                - <?=$l3->email?>
                                <?php 
                                if ($l3->Status == 2) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/unlock/'.$l3->ID_level)?>" class="btn btn-danger btn-xs" title="Unlock Affiliate">Unlock</a>
                                     <?php

                                } elseif ($l3->Status == 1) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/lock/'.$l3->ID_level)?>" class="btn btn-primary btn-xs" title="Lock Affiliate"> Lock</a>
                                    <?php

                                } ?> 
                            </li>
                            <?php

                        }
                        ?>
                    </ul>
                </div>
                <div class="tab-pane" id="list_4">
                    <ul class="list_affilaite">
                        <input type="hidden" value="4" class="level_data" />
                        <input type="hidden" value="1" class="level_page" />
                        <?php
                        foreach ($list_level_4 as $l4) {
                            ?>
                            <li>
                                <a target="_blank" href="<?=$this->M_user->get_url_alp($l4->id)?>"><?=$this->M_user->get_name($l4->id)?></a>
                                - <?=$l4->email?>
                                <?php 
                                if ($l4->Status == 2) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/unlock/'.$l4->ID_level)?>" class="btn btn-danger btn-xs" title="Unlock Affiliate">Unlock</a>
                                     <?php

                                } elseif ($l4->Status == 1) {
                                    ?>
                                    <a href="<?php echo base_url('amper/affiliates/lock/'.$l4->ID_level)?>" class="btn btn-primary btn-xs" title="Lock Affiliate"> Lock</a>
                                    <?php

                                } ?>
                            </li>
                            <?php

                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade new_modal_style" id="setting_commission" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
	<div class="modal-dialog modal-lg">
        
		<div class="modal-content ">
            <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="tt">Setting commission for affiliates </h4>
        		<span class="liner"></span>
        	</div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6"><div id="total-chart2" style=" height: 250px;width: 350px;"></div></div>
                     <div class="col-md-6"><div id="pie-chart" style="height: 250px;width: 350px;"></div></div></div>
                 </div>
    			<form class="form-style-7" action="<?=base_url('amper/post_commission')?>" method="post">
                     <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" /><ul>
                     <div class="col-md-6 li-ina">
                             <li>
                                <label for="affiliate1">Affiliate Level 1</label>
                                <input class="input_commission" type="number" name="aff1" placeholder="%"  max="100" min="0"<?php 
                                    if (isset($commission_affiliate)) {
                                        ?>
                                        value="<?=$commission_affiliate['commission_1']?>"
                                        <?php

                                    }
                                ?> />
                                <span>Enter Percentage Commission Level 1</span>
                            </li>
                       </div>
                       <div class="col-md-6 li-ina">
                           <li>
                                <label for="affiliate2">Affiliate Level 2</label>
                                <input class="input_commission" type="number" name="aff2" placeholder="%" max="100" min="0"<?php 
                                    if (isset($commission_affiliate)) {
                                        ?>
                                        value="<?=$commission_affiliate['commission_2']?>"
                                        <?php

                                    }
                                ?> />
                                <span>Enter Percentage Commission Level 2</span>
                            </li> 
                       </div>
                       <div class="col-md-6 li-ina">
                           <li>
                                <label for="affiliate3">Affiliate Level 3</label>
                                <input class="input_commission" type="number" name="aff3" placeholder="%" max="100" min="0"<?php 
                                    if (isset($commission_affiliate)) {
                                        ?>
                                        value="<?=$commission_affiliate['commission_3']?>"
                                        <?php

                                    }
                                ?> />
                                <span>Enter Percentage Commission Level 3</span>
                            </li>
                       </div>
                       <div class="col-md-6 li-ina">
                            <li>
                                <label for="affiliate4">Affiliate Level 4</label>
                                <input class="input_commission" type="number" name="aff4" placeholder="%" max="100" min="0"<?php 
                                    if (isset($commission_affiliate)) {
                                        ?>
                                        value="<?=$commission_affiliate['commission_4']?>"
                                        <?php

                                    }
                                ?> />
                                <span>Enter Percentage Commission Level 4</span>
                            </li>
                       </div>
                       <div class="clearfix"></div>
                        <li>
                            <div class="alert alert-danger" id="msg-error" style="display: none;" >setting error: level 1 + level 2 + level 3 + level 4  </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="submit_form" type="submit" class="btn btn-primary">Save changes</button>
                        </li>
                    </ul>
                </form>
            </div>
            
		</div>
	</div>
</div>
<div class="modal fade new_modal_style" id="setting_limit" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
            <div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="tt">Setting limmit for affiliates </h4>
        		<span class="liner"></span>
        	</div>
			<form action="<?=base_url('amper/post_limit_affiliates')?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" /><ul>
                    <div class="form-group">
                         <label for="affiliate1">Limit Affiliate Level 1</label>
                         <input min="0" type="number" class="form-control" name="limit_aff1" placeholder="Enter number" <?php 
                            if (isset($limit_affiliates)) {
                                ?>
                                value="<?=$limit_affiliates['level_1']?>"
                                <?php

                            }
                        ?> />
                        <span>Default unlimit affiliates is 0</span>
                    </div>
                    <div class="form-group">
                         <label for="affiliate1">Limit Affiliate Level 2</label>
                         <input min="0" type="number" class="form-control" name="limit_aff2" placeholder="Enter number" <?php 
                            if (isset($limit_affiliates)) {
                                ?>
                                value="<?=$limit_affiliates['level_2']?>"
                                <?php

                            }
                        ?> />
                        <span>Default unlimit affiliates is 0</span>
                    </div>
                    <div class="form-group">
                         <label for="affiliate1">Limit Affiliate Level 1</label>
                         <input min="0" type="number" class="form-control" name="limit_aff3" placeholder="Enter number" <?php 
                            if (isset($limit_affiliates)) {
                                ?>
                                value="<?=$limit_affiliates['level_3']?>"
                                <?php

                            }
                        ?> />
                        <span>Default unlimit affiliates is 0</span>
                    </div>
                    <div class="form-group">
                         <label for="affiliate1">Limit Affiliate Level 4</label>
                         <input min="0" type="number" class="form-control" name="limit_aff4" placeholder="Enter number" <?php 
                            if (isset($limit_affiliates)) {
                                ?>
                                value="<?=$limit_affiliates['level_4']?>"
                                <?php

                            }
                        ?> />
                        <span>Default unlimit affiliates is 0</span>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button  type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
		</div>
	</div>
</div>

