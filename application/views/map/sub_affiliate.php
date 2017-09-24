<div class="container" style="margin-top: 50px;">
	<div class="row">
		<h1 class="text-center">List Sub Affiliates</h1>
        <?php 
            if ($this->session->flashdata('message_error')) {
                ?>
			<div class="">
				<h5 class="text-center"><strong>Error!</strong></h5>
				<p class="error"> <?php echo $this->session->flashdata('message_error')?></p>
			</div>
			<?php

            }
        ?>
        <?php
        if ($this->session->flashdata('message_msg')) {
            ?>
            <div class="">
                <p class="success"> <?php echo $this->session->flashdata('message_msg')?></p>
            </div>
            <?php

        }
        ?>
		<button class="btn btn-primary" data-toggle="modal" data-target=".bs-commission">Set Commission</button>
		<br /><br />
        <div class="modal fade bs-commission" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm" style="margin-top: 80px;">
                
				<div class="modal-content">
                    <form role="form" action="<?php echo base_url('map/commission')?>" method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Set Commission Affiliate</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel panel-default" >
        						<div class="panel-body">
    								<div class="input-group">
    									<span class="input-group-addon">Commission</span>
    									<input type="number" value="<?php echo $U_map['commission'] * 100?>" required="" min="0" max="100" step="5" name="commission" class="form-control"/>
    									<span class="input-group-addon">%</span>
    								</div>
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
		<div class="col-xs-12">
			<ul class="nav nav-tabs" role="tablist">
				<?php
                    if (!empty($sub_affiliates['level1'])) {
                        ?>
				<li class="active"><a href="#level1" role="tab" data-toggle="tab">Affiliates 1</a></li>
				<?php

                    }
                    if (!empty($sub_affiliates['level2'])) {
                        ?>
				<li class=""><a href="#level2" role="tab" data-toggle="tab">Affiliates 2</a></li>
				<?php

                    }
                    if (!empty($sub_affiliates['level3'])) {
                        ?>
				<li class=""><a href="#level3" role="tab" data-toggle="tab">Affiliates 3</a></li>
				<?php

                    }
                    if (!empty($sub_affiliates['level4'])) {
                        ?>
				<li class=""><a href="#level4" role="tab" data-toggle="tab">Affiliates 4</a></li>
				<?php

                    }
                    ?>  
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="level1">
					<table class="table table-bordered">
						<tr>
							<td>Id</td>
							<td>Name</td>
							<td>Email</td>
							<td>Commission</td>
						</tr>
						<?php
                            if (!empty($sub_affiliates['level1'])) {
                                foreach ($sub_affiliates['level1'] as $row) {
                                    ?>
						<tr>
							<td><?php echo $row['affiliate_id']?></td>
							<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
							<td><?php echo $row['email']?></td>
							<td><?php echo $U_map['commission'] * 100?>%</td>
						</tr>
						<?php

                                }
                            }
                            ?>
					</table>
				</div>
				<div class="tab-pane " id="level2">
					<table class="table table-bordered">
						<tr>
							<td>Id</td>
							<td>Name</td>
							<td>Email</td>
							<td>Commission</td>
							<td>Parent Affiliate</td>
						</tr>
						<?php
                            if (!empty($sub_affiliates['level2'])) {
                                foreach ($sub_affiliates['level2'] as $level2) {
                                    foreach ($level2 as $row) {
                                        $parent = $this->M_affiliate->get_affiliate($row['affiliate_id'])
                                    ?>
            						<tr>
            							<td><?php echo $row['affiliate_id']?></td>
            							<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
            							<td><?php echo $row['email']?></td>
            							<td><?php echo $parent['commission'] * 100?>%</td>
            							<td><?php echo $parent['email']?></td>
            						</tr>
            						<?php

                                    }
                                }
                            }
                            ?>
					</table>
				</div>
				<div class="tab-pane " id="level3">
					<table class="table table-bordered">
						<tr>
							<td>Id</td>
							<td>Name</td>
							<td>Email</td>
							<td>Commission</td>
							<td>Parent Affiliate</td>
						</tr>
						<?php
                            if (!empty($sub_affiliates['level3'])) {
                                foreach ($sub_affiliates['level3'] as $level3) {
                                    foreach ($level3 as $row) {
                                        $parent = $this->M_affiliate->get_affiliate($row['affiliate_id'])
                                    ?>
            						<tr>
            							<td><?php echo $row['affiliate_id']?></td>
            							<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
            							<td><?php echo $row['email']?></td>
            							<td><?php echo $parent['commission'] * 100?>%</td>
            							<td><?php echo $parent['email']?></td>
            						</tr>
            						<?php

                                    }
                                }
                            }?>
					</table>
				</div>
				<div class="tab-pane " id="level4">
					<table class="table table-bordered">
						<tr>
							<td>Id</td>
							<td>Name</td>
							<td>Email</td>
							<td>Commission</td>
							<td>Parent Affiliate</td>
						</tr>
						<?php
                        if (!empty($sub_affiliates['level4'])) {
                            foreach ($sub_affiliates['level4'] as $level4) {
                                foreach ($level4 as $row) {
                                    $parent = $this->M_affiliate->get_affiliate($row['affiliate_id'])
                                ?>
        						<tr>
        							<td><?php echo $row['affiliate_id']?></td>
        							<td><?php echo $row['first_name'].' '.$row['last_name']?></td>
        							<td><?php echo $row['email']?></td>
        							<td><?php echo $row['commission'] * 100?>%</td>
        							<td><?php echo $row['email']?></td>
        							<td><?php echo $parent['email']?></td>
        						</tr>
        						<?php

                                }
                            }
                        }?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
