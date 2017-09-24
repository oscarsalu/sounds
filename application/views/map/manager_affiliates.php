<style>
tr.locked{
    background: #81807F;
}
</style>
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
            <?php foreach ($sub_affiliates as $row) {
    ?>
                <tr class="<?php if ($row['active'] == 2) {
    echo 'locked';
} ?>" >
        		      <td><?php echo $row['id']; ?></td>
        			<td><?=$row['first_name'].' '.$row['last_name']; ?></td>
        			
        			<td><?=$row['email']; ?></td>
        			<td><?=$row['paypal']; ?></td>
        			<td> 
                       <?php
                       if ($row['active'] == 2) {
                           ?>
                        <a href="<?php echo base_url('map/unlock/'.$row['affiliate_id'])?>" class="btn btn-danger btn-xs action-update" title="Unlock Affiliate"><span class="icon-ok  icon-white"></span> Unlock</a>
                         <?php

                       }
    if ($row['active'] == 1) {
        ?>
                        <a href="<?php echo base_url('map/lock/'.$row['affiliate_id'])?>" class="btn btn-primary btn-xs action-update" title="Lock Affiliate"><span class="icon-ok  icon-white"></span> Lock</a>
                        <?php

    } ?>
                    </td>
        		</tr>
                <?php

}
            ?>
        </table>
		</div>
	</div>
</div>