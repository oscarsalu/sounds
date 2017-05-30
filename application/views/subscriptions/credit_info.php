<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/subscriptions/js/credit_info.js"></script>

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
						<li><a href="<?php echo base_url(); ?>account/billing_history"><span class="fa fa-picture-o"></span> Billing History </a></li>
						<li class="active"><a href="#"><span class="fa fa-music"></span> Account Credit</a></li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
		</div>
		<!-- Main Content -->
		<div class="container-fluid">
			<div class="side-body">
                <h2>Balance: $0.00<br />
                Available Balance: $0.00</h2>
                <?php
                if (isset($extrar_users) && $extrar_users['zoho_status'] == 'live') {
                    ?>
                    <a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#cancelSubcriton"><span data-hover="Cancel Plan Upgrade">Cancel Plan Upgrade</span></a>
                    <?php

                }
                ?>
                    
				<!-- tile -->
				<section class="tile" style="padding: 0px;">
					<!-- tile body -->
					<div class="tile-body">
						<div class="table-responsive" id="songtable">
							<table class="table table-custom" id="editable-usage">
								<thead>
									<tr>
										<th class="col-md-2">Date</th>
										<th >Info</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
						</div>
					</div>
					<!-- /tile body -->
				</section>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="cancelSubcriton" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Cancel Plan Upgrade </h4>
            </div>
            <div class="modal-body">              
                Cancel Plan Upgrade <br />
                <ol>
                    <li>After 10 days, your access to site is suspended and nobody will see your page.</li>
                    <li>After 30 days, MDS music is taken down at $1.00 per song</li>
                    <li>Plus a cancelation penality of $50.</li>
                </ol> 
            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url()?>subscriptions/cancel" class="btn btn-primary" >OK</a>  
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>             
            </div>
        </div>
    </div>
</div>
