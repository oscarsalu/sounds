<div class="page-title">
    <span class="back_page"><a href="<?php echo base_url('admin/premium');?>">Back Featured/Premium Artist</a> >></span>
    <span class="title"> Manager Expire Premium payment</span>
    <span>
        <input class="btn btn-success bnt_sent_email" type="button" value="Sent email tried Featured/Premium Artist" />
        
    </span>
    <span class="image_load"><img width="30px" src="<?php echo base_url().'assets/img/loader.gif'; ?>" /></span>
    <div class="description">
        <?php if($this->session->flashdata('message_success')){
        ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> <?php echo $this->session->flashdata('message_success')?>
        </div>
        <?php
        }elseif($this->session->flashdata('message_error')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message_error')?>
            </div>
            <?php
        }?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            
            <div class="card-body">                
                <table class="table">
                    <tr>
                        <th>User</th>
                        <th>Pack</th>
                        <th>Start day</th>
                        <th>Expires day</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach($worldwide_artists as $worldwide_artist){?>
                        <tr <?php if($worldwide_artist['active'] == 0){echo 'style="color: red;"';}?> >
                            <td><a href="<?php echo base_url('admin/premium/list').'/'.$worldwide_artist['user_id']; ?>"><?php echo $worldwide_artist['firstname'] . ' '. $worldwide_artist['lastname'];?></a></td>
                            <td><?php if($worldwide_artist['pack'] == 1){echo $worldwide_artist['pack'].' Week';}else{echo $worldwide_artist['pack'].' Weeks';} ?></td>
                            <td><?php echo date("H:i:s m/d/Y",strtotime($worldwide_artist['start_day'])); ?></td>
                            <td><?php echo date("H:i:s m/d/Y",strtotime($worldwide_artist['end_day'])); ?></td>
                            <td><?php echo $worldwide_artist['money'] . ' $'; ?></td>
                            <td><?php if($worldwide_artist['active'] == 0){echo 'Expires';}else{echo 'Active';} ?></td>
                            <td><a class="btn btn-default" href="<?php echo base_url('admin/premium/list').'/'.$worldwide_artist['user_id']; ?>">View</a></td>
                        </tr>
                    <?php
                        } ?>
                    
                </table>
                <ul class="pagination">
                <?php echo $links;?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
    $(".bnt_sent_email").click(function(){
        $(".image_load").css("display","block");
        $.ajax({
			url: '<?php echo base_url(); ?>admin/premium/sent_email_tried_artist',
			type: 'POST',
			dataType: 'json',
            data:{
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
			success: function(response) {
			     $(".image_load").css("display","none");
				//console.log(response);
			}
		})
    });
});
    
</script>