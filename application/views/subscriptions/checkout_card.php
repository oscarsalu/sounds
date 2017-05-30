<script src="<?php echo base_url()?>assets/js/Checkout.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/subscribe.css" type="text/css">
<link href="<?php echo base_url(); ?>assets/js/detail_pages/subscriptions/css/checkout_card.css" rel="stylesheet" />

<div class="wrapper" style="min-height: 100vh;">
	<div class="zs-hp-header-footer " id="headerDiv">
		<div style="text-align: center;height: auto;padding: 20.0px 0.0px;">    <span style="font-size: 24.0px;vertical-align: middle;padding-left: 24.0px;">Subscriptions <?php if (isset($plan)) {
    echo $plan_name;
}?></span> </div>
	</div>
	<div id="subscribe-container" class="col-sm-12 container v2-container" style="padding: 0px 0px 80px; min-height: 100%;">
		<form id="form_paypal" action="<?=base_url('subscriptions/checkout_paypal')?>" method="post">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" name="plan_code" value="<?=$this->uri->segment(3);?>" />
        </form>
        <form class="form-vertical"  method="post" action="<?=base_url('subscriptions/create_hostedpages')?>">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" name="plancode" value="<?=$this->uri->segment(3);?>" />
            
        	<div id="error-container" class="hide alert alert-danger"><span id="errormessage"></span> <button type="button" class="close" id="error-close-button" onclick="HostedPageUtil.clearErrors();HostedPageUtil.postMsg();">x</button></div>
			
            <?php if ($this->session->flashdata('message_msg')) {
    ?>
                <div class="alert alert-big alert-lightred alert-dismissable fade in">
                    <p> <?php echo $this->session->flashdata('message_msg')?></p>
                </div>
                <?php

}
            ?>
			<div id="loading-indicator" class="hide">
				<div id="backdrp" class="modal-backdrop fade in bakdrp-white"></div>
			</div>
			<div class="form-group order-container" id="summary-container">
				<div class="os-banner">
					<div class="col-md-12">
						<label>Order Summary</label>
					</div>
				</div>
				<div class="order-summary-container col-md-12">
					<div class=" row">
						<div class="col-xs-5 cell text-left">Plan</div>
						<div class="col-xs-3 cell">Quantity</div>
						<div class="col-xs-4 last-cell">Price</div>
					</div>
					<div class="row item-row">
						<div class="col-xs-5 cell text-left">
							<div class="text-left text-capitalize"><?php if (isset($plan_name)) {
    echo $plan_name;
} else {
    echo 'Demo Tax';
} ?></div>
						</div>
						<div class="col-xs-3 cell"> <?php if (isset($interval_unit)) {
    echo $interval.' '.$interval_unit;
}?></div>
						<div class="col-xs-4 last-cell"><?php if (isset($plan_price)) {
    echo $plan_price;
} ?>$</div>
					</div>
                    <?php
                    if ( $trial_period > 0) {
                        ?>
                        <div class="row item-row">
    						<div class="col-xs-5 cell text-left">
    							<div class="text-left text-capitalize">Trial Period</div>
    						</div>
    						<div class="col-xs-3 cell"> <?=$trial_period ?> Days</div>
    						
    					</div>
                        <?php

                    }
                    ?>
					<div class="row item-row total-row">
						<div class="col-xs-6 cell text-left" style="padding-top:20px;">TOTAL</div>
						<div class="col-xs-6 last-cell"><?php if (isset($plan_price)) {
    echo $plan_price;
} ?> $</div>
					</div>
				</div>
			</div>
            <div class="text-center">
                <br /><br />
                <button class=" btn btn-primary">Subscription </button>
            </div>
		</form>
	</div>
</div>