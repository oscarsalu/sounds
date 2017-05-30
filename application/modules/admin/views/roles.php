
<div class="page-title">
    <span class="title">Setting Roles Admin</span>
    <div class="description">
        <?php if($this->session->flashdata('message_msg')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Well done!</strong> <?= $this->session->flashdata('message_msg')?>!
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="row" id="addnew_admin" style="display: none;">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Add New User Admin</div>                    
                </div>
            </div>
            <div class="card-body">                
                <form class="form-horizontal" action="<?php echo base_url('admin/roles/add_admin'); ?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    
                    <div class="form-group ad">
                        <label for="firstname" class="col-sm-2 control-label">* First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"/>
                            <?php echo form_error('firstname','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?> 
                        </div>
                    </div>
                    <div class="form-group ad">
                        <label for="lastname" class="col-sm-2 control-label">* Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"/>
                            <?php echo form_error('lastname','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                        </div>
                    </div>
                    <div class="form-group ad art">
                        <label for="email" class="col-sm-2 control-label">* Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"/>
                            <?php echo form_error('check_email','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                        </div>
                    </div>
                    <div class="form-group ad art">
                        <label for="password" class="col-sm-2 control-label">* Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <?php echo form_error('password','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                        </div>
                    </div>
                    <div class="form-group ad art">
                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                            <?php echo form_error('phone','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                        </div>
                    </div>
                    <div class="form-group ad art">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                            <?php echo form_error('address','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                        </div>
                    </div>  
                    <div class="form-group ad art">
                        <label for="city" class="col-sm-2 control-label">* City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City">
                            <?php echo form_error('city','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                        </div>
                    </div>               
                    <div class="form-group" id="sub">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success add_" name="type_submit" value="add">Add New User</button>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                <div class="title">Table</div>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-success add_ " id="empty_admin">Create New Admin</button>
                <table class="set_value datatable table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="view_data">
                        <?php foreach($list_admin as $admin){ ?>
                            <tr class="<?php if($admin['lock'] == 1){ echo 'warning'; } ?>">    
                                <td><?php echo $admin['email']; ?></td>
                                <td style="padding-top: 23px;">
                                <?php if($admin['lock'] == 1){ ?>
                                    <span class="alert fresh-color alert-warning-" style="padding: 5px 10px;background-color: darkorange;">Blocked</span>
                                <?php }else{ ?>
                                    <span class="alert fresh-color alert-info" style="padding: 5px 10px;">Active</span>
                                <?php } ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-group-sm btn-edit setting-roles " data-toggle="modal" data-target="#modalEdit" data-admin="<?=$admin['id']?>"><i class="fa fa-edit"></i>
                                       Setting Role                                   
                                    </a>
                                    <?php if($admin['lock'] == 1){ ?>
                                        <a href="#" class="btn btn-warning unlock" id="" type=""><i class="fa fa-unlock"></i><input type="hidden" id="unlock_" value="<?php echo $admin['id']; ?>" /></a>
                                    <?php }else{ ?>
                                        <a href="#" class="btn btn-warning lock" id="" type=""><i class="fa fa-lock"></i><input type="hidden" id="lock_" value="<?php echo $admin['id']; ?>" /></a>
                                    <?php } ?>                                        
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
                <?php echo $this->pagination->create_links();?>                      
            </div>
        </div>
    </div>
</div>
<!-- Modal Setting -->
<div class="modal fade bs-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Setting Role</h4>                
            </div>
            <form action="<?=base_url('admin/roles/setting_role')?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body" >
                    <?php
                        foreach($list_roles as $row){
                            ?>
                            <div class="col-sm-4">
                                <label class="checkbox checkbox-custom">
                                      <input type="checkbox" <?php ?> name="role_value[<?=$row['id']?>]" /><i></i><span class="text-capitalize"><?=$row['name']?></span> 
                                 </label>
                            </div>
                            <?php
                        } 
                    ?>
                </div>
                <input type="hidden" name="id_admin" id="id_admin_input" />
                <div class="modal-footer" style="   clear: both;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="submit" class="btn btn btn-primary " >Save</button>
                </div> 
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">   
    $('#empty_admin').click(function(){
        $("#addnew_admin").toggle( "slow" );
        var text = $('#empty_admin').text();
        $('#empty_admin').text(text == "Create New Admin" ? "Hiden Form" : "Create New Admin");
    });
    $('.setting-roles').click(function(){
        $url = "<?php echo base_url(); ?>";        
        $id_admin = $(this).attr('data-admin');
        $("#id_admin_input").val($id_admin);
        $.ajax({
            url: $url+"admin/roles/data_role",
            type: "post",
            data: {
                "id_user":$id_admin,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",               
            success:function(response){
                $("input[type='checkbox']").prop("checked", false);
                for (i = 0; i < response.length; i++) { 
                    $("input[name='role_value["+response[i].role+"]']").prop("checked", true);
                }                                                                      
            },
        });    
    });
    $('.lock').click(function(){
        $url = "<?php echo base_url(); ?>";        
        $id_lock = $(this).find('input').val();
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
                $('#lock_suc').css('display','block');                                                                                         
            }
        });    
    });
    
    $('.unlock').click(function(){
        $url = "<?php echo base_url(); ?>";
        $id_unlock = $(this).find('input').val();
        $.ajax({
            url: $url+"admin/users/unlock_user",
            type: "post",
            data: {
                "id_unlock":$id_unlock,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "text",               
            success:function(response){    
                location.reload();
                $('#unlock_suc').css('display','block');                                                                               
            }
        });    
    });    
</script>