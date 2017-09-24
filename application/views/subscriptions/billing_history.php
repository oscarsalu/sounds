<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?=base_url('assets/jwplayer7/jwplayer.js')?>"></script>
<script>jwplayer.key="<?=$this->M_setting->get_jwplayer_key()?>";</script>
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/subscriptions/js/billing_history.js"></script>
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
						<li class="active"><a href="<?php echo base_url(); ?>account/billing_history"><span class="fa fa-picture-o"></span> Billing History </a></li>
						<li ><a href="<?php echo base_url(); ?>account/credit"><span class="fa fa-music"></span> Account Credit</a></li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
		</div>
		<!-- Main Content -->
		<div class="container-fluid">
			<div class="side-body">
                
                <?php if ($this->session->flashdata('message_msg')) {
    ?>
                    <div class="alert alert-big alert-success alert-dismissable fade in">
                        <h4><strong>Succces!</strong></h4>
                        <p> <?php echo $this->session->flashdata('message_msg')?></p>
                    </div>
                    <?php

}
                if ($this->session->flashdata('message_refund')) {
                    ?>
                    <div class="alert alert-big alert-success alert-dismissable fade in">
                        <h4><strong>Succces!</strong></h4>
                        <p> <?php echo $this->session->flashdata('message_refund')?></p>
                    </div>
                    <?php

                }
                if ($this->session->flashdata('message_error')) {
                    ?>
                    <div class="alert alert-big alert-lightred alert-dismissable fade in">
                        <h4><strong>Error!</strong></h4>
                        <p> <?php echo $this->session->flashdata('message_error')?></p>
                    </div>
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
                                        <th >Id</th>
										<th>Date</th>
										<th >Service</th>
										<th>Amount</th>
                                        <th>Status</th>
									</tr>
								</thead>
								<tbody>
								    <?php foreach ($billing as $row) {
    ?>
                                        <tr>
                                            <th ><?php echo $row->customer_id?></th>
    										<th ><?php echo $row->created_time?></th>
    										<th ><?php echo $row->name?></th>
    										<th><?php echo $row->amount.$row->currency_symbol?></th>
                                            <th><?php echo $row->status?></th>
    									</tr>
                                        <?php

}

                                    ?>	
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
