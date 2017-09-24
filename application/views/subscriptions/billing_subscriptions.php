<link href="<?php echo base_url(); ?>assets/js/detail_pages/subscriptions/css/billing_subscriptions.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/subscriptions/js/billing_subsciptions.js"></script>

<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>

<div  style=" min-height: 100vh;padding-top:10px">
	<div class="row">
		<div class="side-menu">
			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div class="brand-wrapper">
						<!-- Hamburger -->
						<button type="button" class="navbar-toggle">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<!-- Brand -->
						<div class="brand-name-wrapper">
							<a class="navbar-brand" href="#">
							<?php echo $this->M_user->get_name($user_data['id']);?>
							</a>
						</div>
					</div>
				</div>
				<!-- Main Menu -->
				<div class="side-menu-container">
					<ul class="nav navbar-nav" style="margin: 0;">
						<table id="ember3825" class="ember-view table zi-table table-hover">
        					<!---->
        					<tbody>
                                <?php
                                foreach ($subscriptions as $subscription) {
                                    if ($subscription->subscription_id == $subscription_current->subscription_id) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    } ?>
                                    <tr data-ember-action="<?=$subscription->subscription_id?>" class="<?=$active?>">
            							<td>
            								<div class="list-primary">
            									<div class="pull-right"> <?=$subscription->currency_symbol.$subscription->amount?> </div>
            									<div class="name">
            										<a id="ember3987" class="ember-view" href="?plan=<?=$subscription->subscription_id?>"> <?=$subscription->name?> </a>
            									</div>
            								</div>
            								<div class="list-secondary">
            									<div class="pull-right text-uppercase f10 status-live "> <?=$subscription->status?> </div>
            									<span class="text-muted"> Next Renewal on <?php 
                                                    if (isset($subscription_current->next_billing_at)) {
                                                        echo $subscription_current->next_billing_at;
                                                    } ?>
                                                </span> 
            								</div>
            							</td>
            						</tr>
                                    <?php

                                }
                                ?>
        					</tbody>
        				</table>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
		</div>
		<!-- Main Content -->
		<div class="container-fluid">
			<div class="side-body">
                
                <?php 
                if ($this->session->flashdata('message_refund')) {
                    ?>
                    <div class="alert alert-big alert-success alert-dismissable fade in">
                        <h4><strong>Succces!</strong></h4>
                        <p> <?php echo $this->session->flashdata('message_refund')?></p>
                    </div>
                    <?php

                }?>
				<!-- tile -->
				<section class="tile" style="padding: 0px;">
					<!-- tile body -->
					<!--include content plan-->
            		<div id="dp-container" class="column content-column ">
                        <?php 
                        if (isset($subscription_current)) {
                            ?>
                            <div class="fill header-small">
                            	<div class="btn-toolbar pl0 pull-left">
                            		
                                    <?php
                                    if ($subscription_current->status == 'live') {
                                        ?>
                                        <button class="btn btn-danger pull-left btn-cancel_sub " data-ember-action="<?=$subscription_current->subscription_id?>"> Cancel Subscription </button>
                                        <?php

                                    } elseif ($subscription_current->status == 'non_renewing') {
                                        ?>
                                        <a class="btn btn-success pull-left " href="<?=base_url('subscriptions/retrieve/'.$subscription_current->subscription_id)?>"  > Retrieve a subscription</a>
                                        <?php

                                    } ?>     
                            	</div>
                            </div>
                			<div id="ember2236" class="ember-view scroll-y fill footer footer-small" style="padding:0">
                				<div class="col-sm-12">
                					<div class="row subs-props-div">
                						<h4>
                							<a id="ember2261" class="ember-view" href="#"> <?=$subscription_current->name?> </a>  &nbsp;
                							<div class="subStatus <?=$subscription_current->status?>"><?= $subscription_current->status?></div>
                						</h4>
                						<div class="alert subs-props col-sm-12 text-center">
                							<div class="row">
                								<div class="col-md-3 field">
                									<div class="legend"><?=$subscription_current->currency_symbol.$subscription_current->amount?></div>
                									<div> <?=$subscription_current->interval.' '.$subscription_current->interval_unit?></div>
                								</div>
                								<div class="col-md-3 field">
                									<div class="legend">
                										<?php 
                                                        if (isset($subscription_current->next_billing_at)) {
                                                            echo $subscription_current->next_billing_at;
                                                        } ?>
                									</div>
                									<div>
                										Next Billing Date
                									</div>
                								</div>
                								<div class="col-md-3 field">
                									<div class="legend"><?=$subscription_current->activated_at?></div>
                									<div>Activation Date</div>
                								</div>
                                                <?php
                                                if ($subscription_current->status == 'cancelled') {
                                                    ?>
                                                    <div class="col-md-3 field" style="min-height: 47px;">
                    									<div class="legend"><?=$subscription_current->expires_at?></div>
                    									<div>Cancelled Date</div>
                    								</div>
                                                    <?php

                                                } else {
                                                    ?>
                                                    <div class="col-md-3 field" style="min-height: 47px;">
                									   <div class="legend"><?=$subscription_current->expires_at?></div>
                									   <div>Expires Date</div>
                								    </div>
                                                    <?php

                                                } ?>
                								
                							</div>
                						</div>
                					</div>
                				</div>
                				<div class="footer-small">
                					<div class="row form-group">
                						<div class="col-sm-12 col-xs-12 col-lg-12 subs-item-table">      
                							<div class="row item-header">
                								<div class="col-md-3 col-sm-3 text-muted">
                									Plan &amp; Addon Details
                								</div>
                								<div class="col-md-1 col-sm-1 text-muted ">
                									Qty
                								</div>
                								<div class="col-md-2 col-sm-2 text-muted ">
                									Discount
                								</div>
                								<div class="col-md-2 col-sm-2 text-muted">
                									Tax
                								</div>
                								<div class="col-md-2 col-sm-2 text-muted ">
                									Rate
                								</div>
                								<div class="col-md-2 col-sm-2 text-muted ">
                									Amount
                								</div>
                							</div>
                							<div class="row item-row">
                								<div class="col-md-3 col-sm-3">
                									<div class="font-large"><?=$subscription_current->name?></div>
                								</div>
                								<div class="col-md-1 col-sm-1 text-right">1</div>
                								<div class="col-md-2 col-sm-2 text-right">-
                								</div>
                								<div class="col-md-2 col-sm-2">-
                								</div>
                								<div class="col-md-2 col-sm-2 text-right"><?=$subscription_current->currency_symbol.$subscription_current->amount?></div>
                								<div class="col-md-2 col-sm-2 text-right"><?=$subscription_current->currency_symbol.$subscription_current->amount?></div>
                							</div>  
                							<div class="row item-header" style="border-top: none">
                								<div class="col-md-3 col-sm-3">   
                								</div>
                								<div class="col-md-offset-5 col-sm-offset-5 col-md-2 col-sm-2 text-right" style=""><span class="f15"> TOTAL </span></div>
                								<div class="col-md-2 col-sm-2 text-right" style=""><span class="f15"> <?=$subscription_current->currency_symbol.$subscription_current->amount?></span></div>
                							</div>
                						</div>
                					</div>
                					<hr/>
                                    <?php
                                    if (isset($card_current)) {
                                        ?>
                                        <div class="row form-group">
                    						<div class="col-md-5">
                    							<h4>Payment Information</h4>
                    							<div class="row">
                    								<div class="col-md-12">
                    									<div class="form-group row">
                    										<div class="col-md-5 text-muted">
                    											Card Number
                    										</div>
                    										<div class="col-md-7">XXXX-XXXX-XXXX-<?=$card_current->last_four_digits?></div>
                    									</div>
                    									<div class="row form-group">
                    										<div class="col-md-5 text-muted">expires on</div>
                    										<div class="col-md-7"><?=$card_current->expiry_month?>/<?=$card_current->expiry_year?></div>
                    									</div>
                    									<div class="row form-group">
                    										<div class="col-md-5 text-muted">Gateway</div>
                    										<div class="col-md-7">Test Gateway</div>
                    									</div>
                    									<!---->              
                    								</div>
                    								<div class="col-md-12">
                    									<span>
                    										<a data-ember-action="2275" data-toggle="modal" data-target=".update_creadit"> Update Card </a>
                    									</span>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                                        <?php

                                    } ?>
                				</div>
            			     </div>
                            <!-- modal cancel -->
                            <div id="modal-cancel" style="display: none;">
                                <div class="f16 black">Cancel on Next Renewal</div>
            					<div class="pt5">Customer can use the service till the end of current term and the subscription will be cancelled on 
                                    <span class="black fw600">
                                    <?php 
                                    if (isset($subscription_current->next_billing_at)) {
                                        echo $subscription_current->next_billing_at;
                                    } ?>
                                    </span>
                                </div>
            					<button type="button" onclick="modal_cancel('1')" class="btn btn-primary btn-cancel-next" style="margin-bottom:25px;" >Cancel On Next Renewal</button>
                				<div class="f16 black mt10">Cancel Immediately</div>
                				<div class="pt5">Subscription will be cancelled immediately and the customer will not be able to use the service from the moment its cancelled.</div>
                                <button type="button" onclick="modal_cancel('2')" class="btn btn-primary btn-cancel-now" style="margin-top:5px;" >Cancel Immediately</button>
                                
                			</div>
                            <!-- modal warning cancel -->
                            <div id="modal-warning-cancel" style="display: none;">              
                                <form id="form_warning" method="post" action="<?=base_url()?>subscriptions/cancel">
                                	<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                                    Cancel Plan Upgrade 
                                	<ol>                                  
                                		<li>After 10 days, your access to site is suspended and nobody will see your page.</li>
                                		<li>After 30 days, MDS music is taken down at $1.00 per song</li>                                
                                		<li>Plus a cancelation penality of $50.</li>                              
                                	</ol>
                                	<div class="checkbox">                                        
                                        <label>                                          
                                            <input required="" type="checkbox"/> Are you sure cancel subscriptions 
                                        </label>                                   
                                    </div>
                                	<input required=""  type="hidden" name="type" id="type_cancel"/>                                   
                                    <input required=""  type="hidden" name="id_sub" id="input_id_hd" value="<?=$subscription->subscription_id?>"/>                                
                                </form>
                            </div>
                             <?php
                                if (isset($card_current)) {
                                    ?>
                                    <!-- modal update credit card  -->
                                    <div class="modal fade update_creadit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title">Edit Credit Card</h4>
                                                </div>
                                                <div class="alert alert-danger fade in" role="alert" id="card_error" style="display: none;">
                                                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                </div>
                                                <form class="form-vertical" onsubmit="return true" method="post" action="<?=base_url('subscriptions/update_card')?>">
                                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                                                    <input type="hidden" name="card_id" value="<?=$card_current->card_id?>" />
                                                    <div  class="modal-body">
                                                		<div class="form-group">
                                                			<label class="control-label mLbl">Credit Card Number</label>
                                                			<div class="row">
                                                				<div class="col-sm-5">
                                                					<input id="ccinput1"  name="ccinput1"class="ember-view ember-text-field form-control" value="<?=$card_current->last_four_digits?>" autofocus="" maxlength="31" type="text">
                                                				</div>
                                                				<div class="cctype   "></div>
                                                			</div>
                                                		</div>
                                                		<div class="row">
                                                			<div class="form-group col-sm-5">
                                                				<label class="control-label mLbl">Card Expires On</label>
                                                				<div class="row">
                                                					<div class="col-sm-6">
                                                						<select id="ccinput2" name="ccinput2"class="ember-view ember-select form-control">
                                                							<option value="">MM</option>
                                                                            <?php for ($i = 1; $i <= 12;++$i) {
    ?><option <?php if ($card_current->expiry_month == $i) {
    echo 'selected';
} ?> value="<?=$i?>"><?=$i?></option><?php

} ?>
                                                						</select>
                                                					</div>
                                                					<div class="col-sm-6">
                                                						<select id="ccinput3" name="ccinput3" class="ember-view ember-select form-control">
                                                							<option value="">YYYY</option>
                                                                            <?php for ($i = 2016; $i <= 2036;++$i) {
    ?><option  <?php if ($card_current->expiry_year == $i) {
    echo 'selected';
} ?> value="<?=$i?>"><?=$i?></option><?php

} ?>
                                                						</select>
                                                					</div>
                                                				</div>
                                                			</div>
                                                			<div class="form-group col-sm-4">
                                                				<label class="control-label mLbl">CVV</label>
                                                				<div class="row">
                                                					<div class="col-sm-8">
                                                						<input id="ccinput4" name="ccinput4" class="ember-view ember-text-field form-control" maxlength="4" type="password">
                                                					</div>
                                                				</div>
                                                			</div>
                                                		</div>
                                                		<div class="form-group">
                                                			<label class="control-label mLbl">Street</label>
                                                			<div class="row">
                                                				<div class="col-sm-10">
                                                					<input id="ccinput7" name="ccinput7" value="<?=$card_current->street?>" class="ember-view ember-text-field form-control" type="text">
                                                				</div>
                                                			</div>
                                                		</div>
                                                		<div class="row">
                                                			<div class="form-group col-sm-5">
                                                				<label class="control-label mLbl">City</label>
                                                				<input id="ccinput8" name="ccinput8" value="<?=$card_current->city?>" class="ember-view ember-text-field form-control" type="text">
                                                			</div>
                                                			<div class="form-group col-sm-5">
                                                				<label class="control-label mLbl">ZIP Code</label>
                                                				<input id="ccinput9" name="ccinput9" value="<?=$card_current->zip?>" class="ember-view ember-text-field form-control" type="text">
                                                			</div>
                                                			<div class="form-group col-sm-5">
                                                				<label class="control-label mLbl">State</label>
                                                				<input id="ccinput10" name="ccinput10"  value="<?=$card_current->state?>" class="ember-view ember-text-field form-control" type="text">
                                                			</div>
                                                			<div class="form-group col-sm-5">
                                                				<label class="control-label mLbl">Country</label>
                                                				<input id="ccinput11" name="ccinput11" value="<?=$card_current->country?>" class="ember-view ember-text-field form-control" type="text">
                                                			</div>
                                                		</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                }//end card popup
                                ?>
                            <?php

                        }?>	
            		</div>
					<!-- /tile body -->
				</section>
                                
                                
                                
                                <?php
if (isset($data_premium) && !empty($data_premium)) {
    ?>

<?php 
} else {
    ?>
<section class="premium_artists_fee">
    <div class="col-md-10 wp_main_pre">
        <div class="header_main">
            <h2>Our Featured / Premium Artists Plan</h2>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="" class="form" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="pack" class="pack" />
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"> Featured/Premium pack</label>
                        <div class="col-sm-8 searchform">
                            <select class="form-control pack_fre" name="pack_fre">
                                <?php $first_key = '';
    foreach ($settings_global as $key => $value) {
        if (!empty($value)) {
            if (str_replace('week', '', $key) == 1) {
                $first_key = str_replace('week', '', $key).' week'; ?>
                                            <option value="<?php echo $value; ?>"><?php echo str_replace('week', '', $key); ?> week</option>
                                <?php 
            } else {
                ?>
                                    <option value="<?php echo $value; ?>"><?php echo str_replace('week', '', $key); ?> weeks</option>
                                        <?php 
            }
        }
    } ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label  class="col-sm-4 control-label"> </label>
                        <div class="col-sm-8 searchform new_form_select">
                            <input type="submit" value=" Upgrade now" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="showcontent">
                    <p>You have select pack <span class="text_pack"><?php echo $first_key; ?></span> with cost <span class="price_pack"><?php echo $settings_global->week1 ?></span>$ .</p>
                    <p>Start date : <span class="start_date"> </span></p>
                    <p>End date : <span class="end_date"> </span></p>
                </div>
            </div>
        </div>
        <?php if (isset($premiums) && count($premiums) > 0) {
    ?>
            <div class="col-md-12 showtable">
                
                <div class="row">
                    <div class="col-md-3">
                        Featured / Premium Artists
                    </div>
                    <div class="col-md-2">
                        Start day
                    </div>
                    <div class="col-md-2">
                        Expires day
                    </div>
                    <div class="col-md-2">
                        Payment
                    </div>
                    <div class="col-md-3">
                        Status
                    </div>
                </div>
            <?php foreach ($premiums as $premium) {
    ?>
                <div class="row <?php if ($premium['active'] == 0) {
    echo 'expires';
} ?>">
                    <div class="col-md-3">
                        <?php if ($premium['pack'] == 1) {
    echo $premium['pack'].' Week';
} else {
    echo $premium['pack'].' Weeks';
} ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo date('H:i:s m/d/Y', strtotime($premium['start_day'])); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo date('H:i:s m/d/Y', strtotime($data_premium['end_day'])); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $premium['money'].' $'; ?>
                    </div>
                    <div class="col-md-3">
                        <?php if ($premium['active'] == 0) {
    echo 'Expires';
} else {
    echo 'Active';
} ?>
                    </div>
                </div>
            <?php 
} ?>
            </div>
        <?php 
} ?>
    </div>
</section>
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/subscriptions/js/featured.js"></script>

<?php 
}?>
			</div>
		</div>
	</div>
</div>
