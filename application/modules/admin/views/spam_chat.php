<style>
.ctn-edit-blogs{
    float: left;
}
.ctn-edit-blogs:hover{
    cursor: pointer;
}
.ctn-edit-blogs div{
    display: none;
}
.delete{
    margin-left: 5px;
    float:left;
}
.ver{
    vertical-align: middle!important;
}
</style>
<div class="page-title">
    <div id="show_error" style="display: none;" class="text-center col-xs-4 alert alert-warning" role="alert">
        <strong>Warning!</strong> Keyword Exist.
    </div>
    <div class="description">     
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Manager Chat Channel</div>                    
                </div>
            </div>
            <div class="card-body" style="padding: 25px 0px;">
                <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#spam_chat"  aria-controls="info" role="tab" data-toggle="tab">Spam Chat</a></li>
                            <li role="presentation"><a href="#key_block" aria-controls="newpass" role="tab" data-toggle="tab">Set blog keywords</a></li>                            
                            <li role="presentation"><a href="#user_report" aria-controls="block_blog" role="tab" data-toggle="tab">User Report</a></li>

                            <li role="presentation"><a href="#add_channel" aria-controls="block_blog" role="tab" data-toggle="tab">Add New Public Channel</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="spam_chat">
                                <!-- Table -->
                                <table class="table">
                                <a class="btn btn-primary" href="<?=base_url('admin/manager_chat')?>">Update</a>
                                    <thead>
                                        <tr style="font-size: 15px;">
                                            <th width="5%">#</th>
                                            <th width="10%">User name</th>
                                            <th width="40%">Messager</th>
                                            <th width= "5%">Channel</th>
                                            <th width="10%">time</th>  
                                            <th width="20%">Actions</th>                                                                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach($spams as $spam){ ?>
                                            <tr>
                                                <th class="ver"><?php echo $i ?></th>
                                                <td class="ver"><?php echo $this->M_user->get_name($spam['user_id'])?></td>
                                                <td class="ver"><?php 
                                                        $text = strip_tags($spam['messages']);                                                                                    
                                                        $desLength 	=   strlen($text);
                                                        //var_dump($desLength);exit;            
                                                	    $stringMaxLength					= 	100;
                                                	    if($desLength > $stringMaxLength){
                                                            $des			= substr($text,0,$stringMaxLength); 
                                              		        $text = $des.'...';   
                                                            echo $text;
                                                        }else{
                                                            echo $spam['messages'];
                                                        }          
                                                    ?>
                                                </td>
                                                <td class="ver"><p><?php echo 'Channel '.$spam['channel']?></p></td>
                                                <td class="ver"><p><?php echo date('l, Y M d h:i:s A',$spam['time'])?></p></td>
                                                <td class="ver">
                                                    <a href="<?=base_url('admin/manager_chat/read_message?id_chat='.$spam['id'])?>" class="btn-default btn btn-sm" title="Read Message">                                                    
                                                        <i class="fa fa-book"></i>                                                    
                                                    </a> 
                                                    <a href="#"class="btn-blocked btn-danger btn btn-sm" title="Delete Message" data-toggle="modal" data-target="#modaltake_down" data-blog="<?php echo $spam['id']?>">                                                    
                                                        <i class="fa fa-close"></i>                                                    
                                                    </a>
                                                    <a href="<?=base_url('admin/manager_chat/accept?id_chat='.$spam['id'])?>" class="btn-success btn btn-sm btn-accept" title="Accept ">                                                    
                                                        <i class="fa fa-check"></i>                                                    
                                                    </a>
                                                </td>
                                            </tr>                                                                                            
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                                <?php echo $this->pagination->create_links();?>     
                            </div>
                            <div role="tabpanel" class="tab-pane" id="key_block">
                                <div class="panel-body" >   
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="key" name="key" placeholder="Enter Keyword"/>                                                                                     
                                    </div>   
                                    <div class="col-sm-1">        
                                    <button type="button" class="btn btn-primary" id="set_keyword" style="margin-top: 0px;">Add</button>
                                    </div>
                                    <div id="show_sc" style="display: none;padding: 8px;margin: 0px;" class="text-center col-sm-4 alert alert-success" role="alert">
                                        <strong>Well done!</strong> Update successfully
                                    </div>
                                    <div class="clearfix">
                                    </div>
                                    <div class="col-sm-6">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr style="font-size: 15px;">
                                                    <th>#</th>
                                                    <th>Keyword</th>
                                                    <th>Actions</th>                                                                                                                                                                       
                                                </tr>
                                            </thead>
                                            <tbody id="load_data">
                                                
                                            </tbody>
                                            
                                        </table>
                                        <a class="btn btn-primary" href="<?=base_url('admin/manager_chat')?>">Update</a>
                                    </div>        
                                </div>
                            </div> 
                            <div role="tabpanel" class="tab-pane" id="user_report">
                                <table class="table">
                                    <thead>
                                        <tr style="font-size: 15px;">
                                            <th>#</th>
                                            <th >User Name</th>
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
                                                <th><?=$user->num_down_chat?></th>
                                                <th><?php
                                                if($user->role==1){
                                                    ?><span class="alert fresh-color alert-info" style="padding: 5px 10px;">Artist</span><?php
                                                }elseif($user->role==2){
                                                    ?><span class="alert fresh-color alert-warning" style="padding: 5px 10px;">Fan</span><?php
                                                }
                                                ?></th>  
                                                <th>
                                                    <?php
                                                    if($this->M_user->check_role(11,$user_data['id'])){}
                                                        ?>
                                                        <a href="#" class="btn btn-warning lock" data-user="<?=$user->id?>" title="Ban User">
                                                            <i class="fa fa-lock"></i>
                                                        </a>
                                                        <?php
                                                    ?>
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
                            <?php
                            if(isset($users_report)){
                                    ?><div class="text-center"><a class="btn btn-primary " href="<?=base_url('admin/manager_chat/all_users_report')?>">All Report</a></div><?php
                                }
                            ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="add_channel">
                            <div class="col-xs-12 col-md-12 text-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add_channel_model" >Add New Public channel</button>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                 <table class="table">
                                    <thead>
                                        <tr style="font-size: 15px;">
                                            <th>#</th>
                                            <th >Channel Name</th>
                                            <th >Channel Type</th>
                                            <th>Actions</th>                                                                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody id="channel_data">
                                        <?php
                                        $i=1;
                                        foreach($channel_data as $row){
                                            ?>
                                            <tr style="font-size: 15px;">
                                                <td><?php echo $i++ ;?></td>  
                                                <td><?php echo $row['name'] ;?></td>
                                                <td><?php echo $row['type'] ;?></td>
                                                <td><a data-toggle="modal" data-target="#edit_channel_model" onclick='set_value_modal("<?=$row['id']?>", "<?=$row['name']?>", "<?=$row['type']?>")'>Edit</a> | <a href='javascript:void(0);'onclick="delete_channel('<?=$row['id']?>')">Delete</a></td>  
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                         
                    </div>  
                </div>  
            </div>
        </div>            
    </div>
</div>

<!-- Modal take down -->
<div class="modal fade " id="modaltake_down" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifications Delete Message For User</h4>                
            </div>
            <form action="<?=base_url('admin/manager_chat/delete_mesage')?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_chat" id="id_chat_mesage" />
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input">Message Notifications</label>
                        <div class="input-group" style="width: 100%;">                                                        
                            <textarea class="form-control"  id="intro" name="message" rows="3" required="">Your message in Chat Channel had negative content! if also recidivism more thrice We will ban your account.
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="submit" class="btn btn btn-primary update_" name="type_submit" value="update">Delete Mesage</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal take down -->
<div class="modal fade " id="add_channel_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Channel</h4>                
            </div>
            <form id="channel_form">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_chat" id="id_chat_mesage" />
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input">Channel name</label>
                        <div class="input-group" style="width: 100%;">         
                            <input type="text" class="form-control" name="channel_name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="button" class="btn btn btn-primary update_" id="channel_save" name="type_submit" value="update" onclick="save_new_channel()" data-dismiss="modal">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal take down -->
<div class="modal fade " id="edit_channel_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Channel</h4>                
            </div>
            <form id="edit_channel_form">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_channel" id="id_channel" />
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input">Channel name</label>
                        <div class="input-group">         
                            <input type="text" class="form-control"  name="edit_channel_name" id="edit_channel_name">
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input">Channel Type</label>
                        <div class="input-group">         
                            <select name="edit_channel_type" id="edit_channel_type">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="button" class="btn btn btn-primary update_" id="channel_edit" name="type_submit" value="update" onclick="edit_channel()" data-dismiss="modal">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$('.btn-blocked').click(function(){ 
    $("#id_chat_mesage").val($(this).attr('data-blog'));
 });

 $('.btn-accept').click(function(e){ 
    if(!confirm("Are you sure you want to accept this message chat?")){
        e.preventDefault(); 
    }
 });

function set_value_modal(id, name, type)
{
    console.log("set valu");
    $("#edit_channel_name").val(name);
    $("#edit_channel_type select").val(type);
    $("#id_channel").val(id);
    console.log($("#id_channel").val());
}
function save_new_channel()
{
    var post_data = $("#channel_form").serialize();
     $url = "<?php echo base_url(); ?>";
     $.ajax({
        url: $url+"admin/manager_chat/add_new_channel",
        type: "post",
        data: post_data,
        dataType: "json",               
        success:function(response){   
            if(response == "success"){        
                 $.ajax({
                    url: $url+"admin/manager_chat/get_all_channels",
                    type: "get",
                    data: "",
                    dataType: "json",               
                    success:function(response){   
                        $("#channel_data").empty(); 
                        var count = 1;
                        $(response).each(function(i){

                            $("#channel_data").append("<tr style='font-size: 15px;'><td>"+count+"</td><td>"+this['name']+"</td><td>"+this['type']+"</td><td><a data-toggle='modal' data-target='#edit_channel_model' onclick='set_value_modal("+this['id']+", "+this['name']+", "+this['type']+")'>Edit</a> | <a href='javascript:void(0);'onclick='delete_channel("+this['id']+")'>Delete</a></td></tr>");
                            count++;
                        });
                                                                
                    }
                });     
               
            }                                                                               
        }
    });    
}
function edit_channel()
{
    var post_data = $("#edit_channel_form").serialize();
    $url = "<?php echo base_url(); ?>";
     $.ajax({
        url: $url+"admin/manager_chat/edit_channel",
        type: "post",
        data: post_data,
        dataType: "json",               
        success:function(response){   
            if(response == "success"){        
                 $.ajax({
                    url: $url+"admin/manager_chat/get_all_channels",
                    type: "get",
                    data: "",
                    dataType: "json",               
                    success:function(response){   
                        $("#channel_data").empty(); 
                        var count = 1;
                        $(response).each(function(i){

                            $("#channel_data").append("<tr style='font-size: 15px;'><td>"+count+"</td><td>"+this['name']+"</td><td>"+this['type']+"</td><td><a data-toggle='modal' data-target='#edit_channel_model' onclick='set_value_modal("+this['id']+", "+this['name']+", "+this['type']+")'>Edit</a> | <a href='javascript:void(0);'onclick='delete_channel("+this['id']+")'>Delete</a></td></tr>");
                            count++;
                        });                                      
                    }
                });     
               
            }                                                                               
        }
    });    
}
function delete_channel(id)
{
    $url = "<?php echo base_url(); ?>";
    $.ajax({
        url: $url+"admin/manager_chat/delete_channel",
        type: "post",
        data: {"id_channel" : id, "<?=$this->security->get_csrf_token_name();?>" : "<?=$this->security->get_csrf_hash();?>"},
        dataType: "json",               
        success:function(response){   
            if(response == "success"){        
                 $.ajax({
                    url: $url+"admin/manager_chat/get_all_channels",
                    type: "get",
                    data: "",
                    dataType: "json",               
                    success:function(response){   
                        $("#channel_data").empty(); 
                        var count = 1;
                        $(response).each(function(i){
                            
                            $("#channel_data").append("<tr style='font-size: 15px;'><td>"+count+"</td><td>"+this['name']+"</td><td>"+this['type']+"</td><td><a data-toggle='modal' data-target='#edit_channel_model' onclick='set_value_modal("+this['id']+", "+this['name']+", "+this['type']+")'>Edit</a> | <a href='javascript:void(0);'onclick='delete_channel("+this['id']+")'>Delete</a></td></tr>");
                            count++;
                        });                                      
                    }
                });     
               
            }                                                                               
        }
    }); 
}
$('#set_keyword').click(function(){
    $key = $('#key').val();
    $url = "<?php echo base_url(); ?>";
     $.ajax({
        url: $url+"admin/manager_chat/set_keyword",
        type: "post",
        data: {
            "keyword":$key,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",               
        success:function(response){   
            if(response == "exist"){        
                $('#show_error').show();
                setTimeout(function(){ $('#show_error').hide(); }, 5000);      
            }else{
                load_data();    
            }
                                                                                               
        }
    });    
});

load_data();   
function load_data()
{        
    $url = "<?php echo base_url(); ?>";
    $.ajax({
        url: $url+"admin/manager_chat/loaddata",
        type: "get",
        data: "",
        dataType: "text",               
        success:function(response){   
            $('#load_data').html(response);                                                                                  
        }
    });   
}
$('#load_data').on('blur','tr',function(){
    $val = $(this).find('#key_').val();
    $id  = $(this).find('#id_key').val();
    $btn_update = $(this).find('.update_key');
    $btn_delete = $(this).find('.delete_key');
    $btn_update.click(function(){       
        $url = "<?php echo base_url(); ?>";
        alert($val);
         $.ajax({             
            url: $url+"admin/manager_chat/update_key",
            type: "post",
            data: {
                "keyword":$val, 
                "id_key":$id,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "text",               
            success:function(response){
                //alert(response);
                if(response == "sc"){
                    $('#show_sc').show();
                    setTimeout(function(){ $('#show_sc').hide(); }, 5000);  
                    load_data();         
                }                                                                                                   
            }
        });  
    });  
    $btn_delete.click(function(){   
        $url = "<?php echo base_url();?>";
         $.ajax({             
            url: $url+"admin/manager_chat/delete_key",
            type: "post",
            data: { 
                "id_key":$id,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "text",               
            success:function(response){
                if(response == "sc"){ 
                    load_data();         
                }                                                                                                   
            }
        });  
    });  
    
});
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
