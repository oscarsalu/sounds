<div class="container" style="margin-top: 60px;">
    <div class="row ">
        <div class="col-xs-12 ">
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
    	   <table class="table table-striped table-bordered">
    		<tr class="head">
    			<th>ID</th>
    			<th>Full Name</th>
    			<th>Email</th>
    			<th>Paypal</th>
    			<th>Actions</th>
    		</tr>
            <?php foreach ($affiliates as $row) {
    ?>
                <tr class="" >
        		    <td><?php echo $row['id']; ?></td>
        			<td><?=$row['first_name'].' '.$row['last_name']; ?></td>
        			
        			<td><?=$row['email']; ?></td>
        			<td><?=$row['paypal']; ?></td>
        			<td> 
                        <a href="<?php echo base_url('map/allow_afiliate/'.$row['affiliate_id'])?>" class="btn btn-success btn-xs action-update" title="Allow Affiliate"><span class="icon-ok  icon-white"></span> Allow</a>
                        <a href="<?php echo base_url('map/delete_afiliate/'.$row['affiliate_id'])?>" class="btn btn-danger btn-xs action-update" title="Delete Affiliate"><span class="icon-ok  icon-white"></span> Delete</a>
                    </td>
        		</tr>
                <?php

}
            ?>
        </table>
		</div>
	</div>
</div>