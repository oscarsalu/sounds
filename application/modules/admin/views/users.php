<div class="page-title">
    <span class="title">Manager Users</span>
    <div class="description">
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Delete user success!
        </div>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="lock_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Blocked user success!
        </div>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="unlock_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Unblocked user success!
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
                <table class="set_value datatable table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Lading page</th>
                            <th>Role</th>
                            <th>Birthday</th>
                            <th>Status</th>
                            <th>Parent Approved</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Lading page</th>
                            <th>Role</th>
                            <th>Birthday</th>
                            <th>Status</th>
                             <th>Parent Approved</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody id="view_data">
                        <?php foreach($list_users as $user){ ?>
                            <tr class="<?php if($user['lock'] == 1){ echo 'warning'; } ?>">                               
                                <td><?php echo $this->M_user->get_name($user['id']); ?></td>
                                <td><?php echo $user['home_page']; ?></td>
                                <td style="padding-top: 23px;">
                                    <?php if($user['is_admin'] == 1){ ?>
                                        <span class="alert fresh-color alert-info" style=" padding: 5px 10px;">Admin Master</span>                                        
                                    <?php }else if($user['is_admin'] == 2){ ?>
                                        <span class="alert fresh-color alert-danger" style="padding: 5px 10px;">Admin</span>                                                                            
                                    <?php }else if($user['role'] == 1){ ?>
                                        <span class="alert fresh-color alert-success" style="padding: 5px 10px;">Artist</span>                                                                            
                                    <?php }else{ ?>
                                        <span class="alert fresh-color alert-warning" style="padding: 5px 10px;">Fan</span>                                        
                                    <?php } ?>
                                </td>
                                <td><?php echo date('Y-m-d',$user['birthday']) ?></td>
                                <td style="padding-top: 23px;">
                                <?php if($user['lock'] == 1){ ?>
                                    <span class="alert fresh-color alert-warning-" style="padding: 5px 10px;background-color: darkorange;">Blocked</span>
                                <?php }else{ ?>
                                    <span class="alert fresh-color alert-info" style="padding: 5px 10px;">Active</span>
                                <?php } ?>
                                </td>
                                <td style="padding-top: 23px;">
                                    <?php 
                                    $from = new DateTime( date('Y-m-d',$user['birthday']));
$to   = new DateTime('today');
$age= $from->diff($to)->y; 
if($age<18){
                                    if($user['parental_approve']==0){ ?> <span class="alert fresh-color alert-danger" style="padding: 5px 10px;">Un approved</span> <?php } else { ?>
<span class="alert fresh-color alert-success" style="padding: 5px 10px;">Approved</span>
                                        
                                        <?php     } } ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-group-sm btn-edit" data-toggle="modal" data-target="#modalEdit" data-user="<?=$user['id']?>"><i class="fa fa-edit"></i>
                                    </a>
                                    <?php if($user['lock'] == 1){ ?>
                                        <a href="#" class="btn btn-warning unlock" id="" type=""><i class="fa fa-unlock"></i><input type="hidden" id="unlock_" value="<?php echo $user['id']; ?>" /></a>
                                    <?php }else{ ?>
                                        <a href="#" class="btn btn-warning lock" id="" type=""><i class="fa fa-lock"></i><input type="hidden" id="lock_" value="<?php echo $user['id']; ?>" /></a>
                                    <?php } ?>                                                                        
                                    <a href="#" class="btn btn-danger btn-group-sm del"><i class="fa fa-remove"></i>
                                        <input type="hidden" id="id_del" value="<?php echo $user['id']; ?>" />
                                    </a>  
                                        <?php  
if($age<18){
?>
                                        <a href="#" class="btn btn-success btn-group-sm btn-parent" data-toggle="modal" data-target="#modalParental" data-user="<?=$user['id']?>">Parental Control
                                        
                                         <input type="hidden" id="id_parent" value="<?php echo $user['id']; ?>" />
                                        </a>
<?php } 
                                        ?>
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
<!-- Modal Edit -->
<div class="modal fade bs-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit User</h4>                
            </div>
            <div class="modal-body" style="padding: 0px;">
                <div class="card-body no-padding">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#info" id="info_" aria-controls="info" role="tab" data-toggle="tab">Change Infomation</a></li>
                            <li role="presentation"><a href="#newpass" id="newpass_" aria-controls="newpass" role="tab" data-toggle="tab">Change Password</a></li>                            
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info">
                                <form id="form_edit" class="form-horizontal" action="<?php echo base_url('admin/users/'); ?>" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <div class="form-group artist_form">
                                        <label for="artist_name" class="col-sm-2 control-label">* Artist Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="artist_name" name="artist_name" placeholder="Artist Name"/>                            
                                            <?php echo form_error('artist_name','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>                             
                                        </div>
                                    </div>    
                                    <div class="form-group fan_form">
                                        <label for="artist_name" class="col-sm-2 control-label">* Fan Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fan_name" name="fan_name" placeholder="Fan Name"/>                            
                                            <?php echo form_error('fan_name','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>                             
                                        </div>
                                    </div>              
                                    <div class="form-group">
                                		<label for="genre" class="col-sm-2 control-label">* Genre</label>
                                		<div class="col-sm-9">
                                            <select id="genre" name="genre" class="form-control">
                                                <?php                                                 
                                                foreach($genres as $key){
                                                    ?><option value="<?php echo $key['id'] ?>" ><?php echo $key['name']?></option><?php 
                                                }
                                                ?>                                            
                                            </select>
                                            <?php echo form_error('genre,<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>       		  
                                		</div>
                                	</div>        
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-2 control-label">* First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"/>
                                            <?php echo form_error('firstname','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname" class="col-sm-2 control-label">* Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"/>
                                            <?php echo form_error('lastname','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">* Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" disabled="" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                            <?php echo form_error('phone','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                            <?php echo form_error('address','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label for="city" class="col-sm-2 control-label">* City</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City">
                                            <?php echo form_error('city','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                                        </div>
                                    </div> 
                                    <div class="form-group ">
                                        <label for="city" class="col-sm-2 control-label">* Birthday</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="birthday" name="birthday" placeholder="">
                                            <?php echo form_error('birthday','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                		<label for="zipcode" class="col-sm-2 control-label">ZIP/Post Code</label>
                                		<div class="col-sm-9">
                                			<input type="text" id="zipcode" name="zipcode" class="form-control" value=""/>
                                            <?php echo form_error('zipcode','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>                        
                                		</div>
                                	</div>
                                    <div class="form-group">
                                		<label for="state" class="col-sm-2 control-label">State / Province</label>
                                		<div class="col-sm-9">
                                			<input type="text" id="state" name="state" class="form-control" value=""/>  
                                            <?php echo form_error('state','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert">','</strong></div>'); ?>                         
                                		</div>
                                	</div>
                                    <input type="hidden" id="id_update" name="id_update" value=""/>                                    
                            </div>
                            <div role="tabpanel" class="tab-pane" id="newpass">
                                <div class="form-horizontal">                                    
                                    <div class="col-sm-6 col-sm-offset-3 alert alert-success" id="sucess_pass" role="alert">
                                        <strong>Well done!</strong> Update success
                                    </div>
                                    <div class="col-sm-12"></div>
                                    <div class="form-group ad art">
                                        <label for="check_pass" class="col-sm-2 control-label">* Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="check_pass" name="check_pass" placeholder="Old Password"/>                                            
                                            <div class="alert alert-warning" style="padding: 10px;margin-top: 10px;margin-bottom: 0px;" id="err_1" role="alert">
                                                <strong>Warning!</strong> Something wrong, change a few things up and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ad art">
                                        <label for="a_password" class="col-sm-2 control-label">* New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="a_password" name="a_password" placeholder="New Password"/>                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ad art">
                                        <label for="a_password" class="col-sm-2 control-label">* Confirm New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm New Password">
                                            <div class="alert alert-warning" id="err_2" style="padding: 10px;margin-top: 10px;" role="alert">
                                                <strong>Warning!</strong> Confirm new password not correct.
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                <button type="submit" class="btn btn btn-primary update_" name="type_submit" value="update">Update</button>
                <button type="button" class="btn btn btn-primary update_1" id="update_pass">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Parental -->
<div class="modal fade bs-example-modal-lg" id="modalParental" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Parental Approval forms</h4>                
            </div>
            <div class="modal-body" style="padding: 0px;">
                <div class="card-body no-padding">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#info" id="info_" aria-controls="info" role="tab" data-toggle="tab">AMP</a></li>
                           <!-- <li role="presentation"><a href="#newpass" id="newpass_" aria-controls="newpass" role="tab" data-toggle="tab">Change Password</a></li> -->                           
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info">
                                
                                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="parent_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Data Updated!
        </div>
                                <form id="form_edit" class="form-horizontal" action="<?php echo base_url('admin/users/'); ?>" method="post">
                                   
                                    <table class="table">
                                        <tr>
                                            <th>
                                                Name of parent and/or legal guardian:
                                            </th>
                                            <td id="name_parent">
                                              
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                               Address of parent and/or legal guardian:
                                            </th>
                                            <td id="address_parent">
                                                
                                            </td>
                                        </tr>
                                         <tr>
                                            <th>
                                            Telephone number of parent and/or legal guardian:
                                            </th>
                                            <td id="telephone">
                                                
                                            </td>
                                        </tr>
                                     
                                     <!--   <tr>
                                            <th>
                                              I am the lawful parent and/or legal guardian of:
                                            </th>
                                            <td>
                                                
                                            </td>
                                        </tr> -->
                                         <tr>
                                            <th>
                                              Date of birth of the 99sound.com Customer: 
                                            </th>
                                            <td id="dob">
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                              Place of birth of the 99sound.com Customer:
                                            </th>
                                            <td id="place_of_birth">
                                                
                                            </td>
                                        </tr>
                                    </table>   
                                
                                
                                </form> 
                                    <input type="hidden" id="id_update" name="id_update" value=""/>                                    
                            </div>
                            <!--<div role="tabpanel" class="tab-pane" id="newpass">
                                <div class="form-horizontal">                                    
                                    <div class="col-sm-6 col-sm-offset-3 alert alert-success" id="sucess_pass" role="alert">
                                        <strong>Well done!</strong> Update success
                                    </div>
                                    <div class="col-sm-12"></div>
                                    <div class="form-group ad art">
                                        <label for="check_pass" class="col-sm-2 control-label">* Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="check_pass" name="check_pass" placeholder="Old Password"/>                                            
                                            <div class="alert alert-warning" style="padding: 10px;margin-top: 10px;margin-bottom: 0px;" id="err_1" role="alert">
                                                <strong>Warning!</strong> Something wrong, change a few things up and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ad art">
                                        <label for="a_password" class="col-sm-2 control-label">* New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="a_password" name="a_password" placeholder="New Password"/>                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ad art">
                                        <label for="a_password" class="col-sm-2 control-label">* Confirm New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm New Password">
                                            <div class="alert alert-warning" id="err_2" style="padding: 10px;margin-top: 10px;" role="alert">
                                                <strong>Warning!</strong> Confirm new password not correct.
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div> -->                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                <?php if($user['parental_approve']==0){ ?>
                <button type="button" class="btn btn-success type_approve btn-approve" name="type_approve" id="type_approve" value="update" data-user="">Approve</button>
                <?php } else { ?>
                    <button type="button" class="btn  btn-danger type_approve btn-unapprove" name="type_approve" id="type_approve" value="update" data-user="">Un Approve</button>
             <?php   }?>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Withdraw -->
<div class="modal fade bs-example-modal-lg" id="modalWithdraw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Parental Approval forms</h4>                
            </div>
            <div class="modal-body" style="padding: 0px;">
                <div class="card-body no-padding">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#info" id="info_" aria-controls="info" role="tab" data-toggle="tab">AMP</a></li>
                           <!-- <li role="presentation"><a href="#newpass" id="newpass_" aria-controls="newpass" role="tab" data-toggle="tab">Change Password</a></li> -->                           
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info">
                                
                                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="parent_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Data Updated!
        </div>
                                <form id="form_edit" class="form-horizontal" action="<?php echo base_url('admin/users/'); ?>" method="post">
                                   
                                    <table class="table">
                                        <tr>
                                            <th>
                                                Name of parent and/or legal guardian:
                                            </th>
                                            <td id="name_parent">
                                              
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                               Address of parent and/or legal guardian:
                                            </th>
                                            <td id="address_parent">
                                                
                                            </td>
                                        </tr>
                                         <tr>
                                            <th>
                                            Telephone number of parent and/or legal guardian:
                                            </th>
                                            <td id="telephone">
                                                
                                            </td>
                                        </tr>
                                     
                                     <!--   <tr>
                                            <th>
                                              I am the lawful parent and/or legal guardian of:
                                            </th>
                                            <td>
                                                
                                            </td>
                                        </tr> -->
                                         <tr>
                                            <th>
                                              Date of birth of the 99sound.com Customer: 
                                            </th>
                                            <td id="dob">
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                              Place of birth of the 99sound.com Customer:
                                            </th>
                                            <td id="place_of_birth">
                                                
                                            </td>
                                        </tr>
                                    </table>   
                                
                                
                                </form> 
                                    <input type="hidden" id="id_update" name="id_update" value=""/>                                    
                            </div>
                            <!--<div role="tabpanel" class="tab-pane" id="newpass">
                                <div class="form-horizontal">                                    
                                    <div class="col-sm-6 col-sm-offset-3 alert alert-success" id="sucess_pass" role="alert">
                                        <strong>Well done!</strong> Update success
                                    </div>
                                    <div class="col-sm-12"></div>
                                    <div class="form-group ad art">
                                        <label for="check_pass" class="col-sm-2 control-label">* Old Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="check_pass" name="check_pass" placeholder="Old Password"/>                                            
                                            <div class="alert alert-warning" style="padding: 10px;margin-top: 10px;margin-bottom: 0px;" id="err_1" role="alert">
                                                <strong>Warning!</strong> Something wrong, change a few things up and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ad art">
                                        <label for="a_password" class="col-sm-2 control-label">* New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="a_password" name="a_password" placeholder="New Password"/>                                        
                                        </div>
                                    </div>
                                    
                                    <div class="form-group ad art">
                                        <label for="a_password" class="col-sm-2 control-label">* Confirm New Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm New Password">
                                            <div class="alert alert-warning" id="err_2" style="padding: 10px;margin-top: 10px;" role="alert">
                                                <strong>Warning!</strong> Confirm new password not correct.
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div> -->                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                <?php if($user['parental_approve']==0){ ?>
                <button type="button" class="btn btn-success type_approve btn-approve" name="type_approve" id="type_approve" value="update" data-user="">Approve</button>
                <?php } else { ?>
                    <button type="button" class="btn  btn-danger type_approve btn-unapprove" name="type_approve" id="type_approve" value="update" data-user="">Un Approve</button>
             <?php   }?>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">        
    $('.art').hide();  
    $('.ad').show();        
    
    if($('#have-err').text() != "")
    {
        $('#artist').attr('checked','checked');        
        $('.ad').hide();
        $('.art').show(); 
        $('#sub').show();
    }  
            
    $('.btn-edit').click(function (){
        $url = "<?php echo base_url(); ?>";
        id_user = $(this).attr("data-user");
        $.ajax({
            url: $url+"admin/users/get_data_user",
            type: "post",
            data: {
                "user_id":id_user, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            success:function(response){                        
                if(response.smg != "error"){
                    $("#id_update").val(response.id);
                    $("#genre").val(response.genre);
                    $("#firstname").val(response.firstname);
                    $("#lastname").val(response.lastname);
                    $("#email").val(response.email);
                    $("#address").val(response.address);
                    $("#phone").val(response.phone);
                    $("#city").val(response.city);
                    $("#birthday").val(response.birthday);
                    $("#zipcode").val(response.zipcode);
                    $("#state").val(response.state);
                    //role artist
                    if(response.role==1){
                        $("#artist_name").val(response.artist_name);
                        $("#form_edit").attr('action',$url+'admin/users/update_user_artist');
                        $(".fan_form").hide();
                        $(".artist_form").show();
                    }else if(response.role==2){
                        $("#fan_name").val(response.fan_name);
                        $("#form_edit").attr('action',$url+'admin/users/update_user_fan');
                        $(".fan_form").show();
                        $(".artist_form").hide();
                    }                          
                }                                                                
            }
        });             
                                     
    });        
    $('#update_pass').hide(); 
    $('#info_').click(function(){
        $('.update_').show();
        $('#update_pass').hide();       
    });
    $('#newpass_').click(function(){
        $('.update_').hide();
        $('#update_pass').show();     
    });            
            
    $('#update_pass').click(function(){    
        $url = "<?php echo base_url(); ?>";
        $old_pass = $('#check_pass').val();
        $new_pass = $('#a_password').val();
        $confirm  = $('#confirm').val();
        $id = $('#id_update').val();
      
        $('#err_2').hide();
        $('#err_1').hide();
        if($new_pass != $confirm)
        {
            $('#err_2').show();
        }else
        {
            $.ajax({
                url: $url+"admin/users/change_pass",
                type: "post",
                data: {
                    "id_update":$id, 
                    "old_pass":$old_pass, 
                    "new_pass": $new_pass,
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "text",
                beforeSend:function(){
                    
                },
                complete:function(){
                    
                },
                success:function(response){    
                    console.log(response);
                    if(response == "wrong")
                    {
                        $('#sucess_pass').hide();
                        $('#err_1').show();                        
                    }else if(response == "success")
                    {
                        $('#err_1').hide();
                        $('#sucess_pass').show();                        
                    }                                                                 
                }
            }); 
        }                            
    });
    $('#err_2').hide();
    $('#err_1').hide();
    $('#sucess_pass').hide();
    
    $('.set_value').on('click','.del', function(){
        $id_delete = $(this).find('#id_del').val();
        if(confirm("Are you sure you want to delete this record?")){            
            $url = "<?php echo base_url(); ?>";
            $.ajax({
                url: $url+"admin/users/delete_user",
                type: "post",
                data: {
                    "id_dele":$id_delete,
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "text",               
                success:function(response){                        
                    if(response == "success")
                    {
                        $('#del_suc').css('display','block');                             
                    }                                                                                  
                }
            });                 
        }
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
    
    
     $('.btn-parent').click(function (){
    
         $url = "<?php echo base_url(); ?>";
        id_user = $(this).attr("data-user");
      
        $.ajax({
            url: $url+"admin/users/get_parental_form_details",
            type: "post",
            data: {
                "user_id":id_user, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
           complete:function(response){  
          
                
                    $.each(response,function(){
       
        $("#name_parent").html(this.name_parent);
         $("#address_parent").html(this.address_parent);
          $("#telephone").html(this.telephone_parent);
          $("#dob").html(this.dob);
          $("#place_of_birth").html(this.place_of_birth);
        
     $('.type_approve').attr("data-user", this.user_id);
      
    });
                                        
                                                                               
            }
        });             
                                     
    });        
                                     
$(document). on('click','.btn-approve',function (){ 
             $url = "<?php echo base_url(); ?>";
        id_user = $(this).attr("data-user");
      
        $.ajax({
            url: $url+"admin/users/update_parental_approve",
            type: "post",
            data: {
                "user_id":id_user, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
            context: this,
           complete:function(response){  
          $(this).removeClass('btn-approve').addClass('btn-unapprove');
     $(this).removeClass('btn-success').addClass('btn-danger'); 
       $ (this).text('Un Approve');
                   $('#parent_suc').css('display','block'); 
       
                                        
                                                                               
            }
        });
    });
 
       $(document). on('click','.btn-unapprove',function (){ 
             $url = "<?php echo base_url(); ?>";
        id_user = $(this).attr("data-user");
      
        $.ajax({
            url: $url+"admin/users/update_parental_unapprove",
            type: "post",
            data: {
                "user_id":id_user, 
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "json",
             context: this,
           complete:function(response){  
         $(this).removeClass('btn-unapprove').addClass('btn-approve');
     $(this).removeClass('btn-danger').addClass('btn-success');
    $ (this).text('Approve');
                   $('#parent_suc').css('display','block'); 
       
                                    
                                                                               
            }
        });
    });                              
</script>