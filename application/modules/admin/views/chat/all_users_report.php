<ol class="breadcrumb">
  <li><a href="<?=base_url('admin/manager_chat')?>">Manager Chat</a></li>
  <li class="active">All Users Report</li>
</ol>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">All Users Report</div>                    
                </div>
            </div>
            <div class="card-body" >
                <hr />
                 <table class="table" id="blogs_manager">
                        <thead>
                            <tr style="font-size: 15px;">
                                <th>#</th>
                                <th >User Name</th>
                                <th >Email</th>
                                <th >Count Take Down Message</th>
                                <th >Role</th>  
                                <th>Actions</th>                                                                                                                                    
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        foreach($users_report as $user){
                            ?>
                            <tr style="font-size: 15px;">
                                <th><?=$i++?></th>
                                <th><?=$this->M_user->get_name($user->id)?></th>
                                <th><?=$user->email?></th>
                                <th><?=$user->num_down_chat?></th>
                                <th><?php
                                if($user->role==1){
                                    ?><span class="alert fresh-color alert-info" style="padding: 5px 10px;">Artist</span><?php
                                }elseif($user->role==2){
                                    ?><span class="alert fresh-color alert-warning" style="padding: 5px 10px;">Fan</span><?php
                                }
                                ?></th>  
                                <th>
                                    <a href="#" class="btn btn-warning lock" data-user="<?=$user->id?>" title="Ban User">
                                        <i class="fa fa-lock"></i>
                                    </a>
                                    <a href="#" class="btn btn-info refresh" data-user="<?=$user->id?>" title="Restart Count Take Down">
                                        <i class="fa fa-refresh"></i>
                                    </a>
                                </th>                                                                                                                                    
                            </tr>
                            <?php
                        }
                        ?>    
                        </tbody>
                    </table>
                    <?php echo $this->pagination->create_links();?>  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('.lock').click(function(){
    $url = "<?php echo base_url(); ?>";        
    $id_lock = $(this).attr('data-user');
    $.ajax({
        url: $url+"admin/users/lock_user",
        type: "post",
        data: {
            "id_lock":$id_lock,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",               
        success:function(response){    
            location.reload();                                                                                      
        }
    });    
});
$('.refresh').click(function(){
    $url = "<?php echo base_url(); ?>";        
    $id_lock = $(this).attr('data-user');
    $.ajax({
        url: $url+"admin/manager_chat/refresh",
        type: "post",
        data: {
            "id_user":$id_lock,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",               
        success:function(response){    
            location.reload();                                                                                      
        }
    });    
});
</script>