<div class="page-title">
    <span class="title">Manager Template</span>
    <div class="description">
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Delete template success!
        </div>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="lock_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Blocked template success!
        </div>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="unlock_suc" style="display: none;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> Unblocked template success!
        </div>
    </div>
</div>

<?php if(isset($template_lands) && !empty($template_lands)){?>
<div class="row">
    <div class="col-xs-12">
        <div class="card ">
            <div class="card-header">

                <div class="card-title">
                    <div class="title">
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#landing_t" id="landing_t_" aria-controls="landing_t" role="tab" data-toggle="tab">Landing template</a></li>
                            <li role="presentation"><a href="#epk_t" id="epk_t_" aria-controls="epk_t" role="tab" data-toggle="tab">EPK template</a></li>                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body tab-content">
                <div role="tabpanel" class="tab-pane active" id="landing_t">
                    <div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Add New Template</div>                    
                </div>
            </div>
            <div class="card-body">                
                <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('admin/template/add'); ?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="col-sm-7 col-sm-offset-5" style="margin-bottom: 20px;">                    
                        <input type="hidden" name="template_type" value="landing" />                       
                    </div>
                    
                    <div class="form-group">
                        <label for="template_name" class="col-sm-2 control-label">* Template Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Template Name"/>                            
                            <span id="have-err"><?php echo form_error('template_name','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">* Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" cols="80" rows="10" id="description" placeholder="Description" name="description"></textarea>
                            <?php echo form_error('description','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="template_position" class="col-sm-2 control-label">* Template position</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="template_position" name="template_position" placeholder="Template position"/>                            
                            <span id="have-err"><?php echo form_error('template_position','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="template_image" class="col-sm-2 control-label">* Template image</label>
                        <div class="col-sm-9">
                            
                            <input type="file" class="form-control" id="template_image" name="template_image" placeholder="Template image"/>                            
                            <span id="have-err"><?php if(isset($update_error) && !empty($update_error)){?><div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong><?php  echo $update_error; ?></strong></div><?php } ?></span>                             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="template_type" class="col-sm-2 control-label">* Template For</label>
                        <div class="col-sm-9">
                            <select name="type" class="form-control">
								<option value="1">Artist Landing Page</option>
								<option value="2">Fan Landing Page</option>
							</select>                             
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
                    <table class="set_value datatable table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Template position</th>
                                <th>Template Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Template position</th>
                                <th>Template Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody id="view_data">
                            <?php foreach($template_lands as $template_land){
                                if($template_land['type'] == 'landing' || $template_land['type'] == 'landing_flp'){
                                ?>
                                <tr class="<?php if($template_land['active'] == 0){ echo 'warning'; } ?>">                               
                                    <td style="padding-top: 23px;"><?php echo $template_land['position']; ?></td>
                                    <td style="padding-top: 23px;"><?php echo $template_land['name']; ?></td>
                                    <td style="padding-top: 23px;"><?php echo $template_land['type']; ?></td>
                                    <td style="padding-top: 23px;">
                                        <a href="#" class="btn-edit-view" data-toggle="modal" data-target="#modalview">
                                            <img width="200px" src="<?php echo base_url().'/uploads/templates/'.$template_land['type'].'/'.$template_land['images'] ?>" />
                                            <input type="hidden" id="type_i" value="<?php echo $template_land['type']; ?>" />
                                            <input type="hidden" id="images_i" value="<?php echo $template_land['images']; ?>" />
                                        </a>
                                    </td>
                                    <td style="padding-top: 23px;">
                                        <?php if($template_land['active'] == 0){ ?>
                                            <span class="alert fresh-color alert-warning-" style="padding: 5px 10px;background-color: darkorange;">Blocked</span>
                                        <?php }else{ ?>
                                            <span class="alert fresh-color alert-info" style="padding: 5px 10px;">Active</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-group-sm btn-edit" data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit"></i>
                                            <input type="hidden" id="template_id" value="<?php echo $template_land['id']; ?>" />
                                            <input type="hidden" id="template_name" value="<?php echo $template_land['name']; ?>" />
                                            <input type="hidden" id="position" value="<?php echo $template_land['position']; ?>" />
                                            <input type="hidden" id="type" value="<?php echo $template_land['type']; ?>" />
                                            <input type="hidden" id="images" value="<?php echo $template_land['images']; ?>" />
                                            <input type="hidden" id="des" value="<?php echo $template_land['des']; ?>" />
                                                                                   
                                        </a>
                                        <?php if($template_land['active'] == 1){ ?>
                                            <a href="#" class="btn btn-warning unlock" id="" type=""><i class="fa fa-unlock"></i><input type="hidden" id="unlock_" value="<?php echo $template_land['id']; ?>" /></a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-warning lock" id="" type=""><i class="fa fa-lock"></i><input type="hidden" id="lock_" value="<?php echo $template_land['id']; ?>" /></a>
                                        <?php } ?>                                                                        
                                        <a href="#" class="btn btn-danger btn-group-sm del"><i class="fa fa-remove"></i>
                                            <input type="hidden" id="id_del" value="<?php echo $template_land['id']; ?>" />
                                        </a>                                    
                                    </td>
                                   
                                </tr>
                            <?php } 
                            } ?>
                        </tbody>
                    </table> 
                </div>
                <div role="tabpanel" class="tab-pane" id="epk_t">
                <div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Add New Template</div>                    
                </div>
            </div>
            <div class="card-body">                
                <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('admin/template/add'); ?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="col-sm-7 col-sm-offset-5" style="margin-bottom: 20px;">          
                        <input type="hidden" name="template_type" value="epk" />          
                                            
                    </div>
                    
                    <div class="form-group">
                        <label for="template_name" class="col-sm-2 control-label">* Template Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Template Name"/>                            
                            <span id="have-err"><?php echo form_error('template_name','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">* Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" cols="80" rows="10" id="description" placeholder="Description" name="description"></textarea>
                            <?php echo form_error('description','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="template_position" class="col-sm-2 control-label">* Template position</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="template_position" name="template_position" placeholder="Template position"/>                            
                            <span id="have-err"><?php echo form_error('template_position','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="template_image" class="col-sm-2 control-label">* Template image</label>
                        <div class="col-sm-9">
                            
                            <input type="file" class="form-control" id="template_image" name="template_image" placeholder="Template image"/>                            
                            <span id="have-err"><?php if(isset($update_error) && !empty($update_error)){?><div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong><?php  echo $update_error; ?></strong></div><?php } ?></span>                             
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
                    <table class="set_value datatable1 table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Template position</th>
                                <th>Template Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Template position</th>
                                <th>Template Name</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody id="view_data">
                            <?php foreach($template_lands as $template_land){
                                if($template_land['type'] == 'epk'){
                            ?>
                                <tr class="<?php if($template_land['active'] == 0){ echo 'warning'; } ?>">                               
                                    <td style="padding-top: 23px;"><?php echo $template_land['position']; ?></td>
                                    <td style="padding-top: 23px;"><?php echo $template_land['name']; ?></td>
                                    <td style="padding-top: 23px;"><?php echo $template_land['type']; ?></td>
                                    <td style="padding-top: 23px;">
                                        <a href="#" class="btn-edit-view" data-toggle="modal" data-target="#modalview">
                                            <img width="200px" src="<?php echo base_url().'/uploads/templates/'.$template_land['type'].'/'.$template_land['images'] ?>" />
                                            <input type="hidden" id="type_i" value="<?php echo $template_land['type']; ?>" />
                                            <input type="hidden" id="images_i" value="<?php echo $template_land['images']; ?>" />
                                        </a>
                                    </td>
                                    <td style="padding-top: 23px;">
                                        <?php if($template_land['active'] == 0){ ?>
                                            <span class="alert fresh-color alert-warning-" style="padding: 5px 10px;background-color: darkorange;">Blocked</span>
                                        <?php }else{ ?>
                                            <span class="alert fresh-color alert-info" style="padding: 5px 10px;">Active</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-group-sm btn-edit" data-toggle="modal" data-target="#modalEdit"><i class="fa fa-edit"></i>
                                            <input type="hidden" id="template_id" value="<?php echo $template_land['id']; ?>" />
                                            <input type="hidden" id="template_name" value="<?php echo $template_land['name']; ?>" />
                                            <input type="hidden" id="position" value="<?php echo $template_land['position']; ?>" />
                                            <input type="hidden" id="type" value="<?php echo $template_land['type']; ?>" />
                                            <input type="hidden" id="images" value="<?php echo $template_land['images']; ?>" />
                                            <input type="hidden" id="des" value="<?php echo $template_land['des']; ?>" />
                                                                                   
                                        </a>
                                        <?php if($template_land['active'] == 1){ ?>
                                            <a href="#" class="btn btn-warning unlock" id="" type=""><i class="fa fa-unlock"></i><input type="hidden" id="unlock_" value="<?php echo $template_land['id']; ?>" /></a>
                                        <?php }else{ ?>
                                            <a href="#" class="btn btn-warning lock" id="" type=""><i class="fa fa-lock"></i><input type="hidden" id="lock_" value="<?php echo $template_land['id']; ?>" /></a>
                                        <?php } ?>                                                                        
                                        <a href="#" class="btn btn-danger btn-group-sm del"><i class="fa fa-remove"></i>
                                            <input type="hidden" id="id_del" value="<?php echo $template_land['id']; ?>" />
                                        </a>                                    
                                    </td>
                                   
                                </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table> 
                </div>             
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modalview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">View</h4>                
            </div>
            <div class="modal-body" style="padding: 0px;">
                <img id="image_u" src="" style="width: 100%; height: auto;" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                
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
                <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url('admin/template/update'); ?>" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" id="id" name="id" />
                    <input type="hidden" id="type_a" name="type" />
                    <div class="form-group">
                        <label for="template_name" class="col-sm-2 control-label">* Template Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name_a" name="template_name" placeholder="Template Name"/>                            
                            <span id="name_a"><?php echo form_error('template_name','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">* Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" cols="80" rows="10" id="description_a" placeholder="Description" name="description"></textarea>
                            <?php echo form_error('description','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="template_position" class="col-sm-2 control-label">* Template position</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="position_a" name="template_position" placeholder="Template position"/>                            
                            <span id="position"><?php echo form_error('template_position','<div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong>','</strong></div>'); ?></span>                             
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="template_image" class="col-sm-2 control-label">* Template image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="template_image" name="template_image" placeholder="Template image"/>                            
                            <span id="have-err"><?php if(isset($update_error) && !empty($update_error)){?><div class="alert alert-warning col-sm-5" style="padding:10px;margin-top:10px;margin-bottom:0px;" role="alert"><strong><?php  echo $update_error; ?></strong></div><?php } ?></span>                             
                        </div>
                    </div>    
                    <div class="form-group">
                        <label for="template_image" class="col-sm-2 control-label">Show image</label>
                        <div class="col-sm-9">
                            <img id="image_a" src="" style="width: 200px; height: auto;" />                                
                        </div>
                    </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                <button type="submit" class="btn btn btn-primary update_" name="type_submit" value="update">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php }?>
<script type="text/javascript">        
     $(".btn-edit-view").click(function(){
        $images = $(this).find('#images_i').val();
        $type = $(this).find('#type_i').val();
        $("#image_u").attr("src","<?php echo base_url().'/uploads/templates/' ?>/"+$type+'/'+$images);  
     });
    $('.btn-edit').click(function (){
        $id_ = $(this).find('#template_id').val();
        $name_a = $(this).find('#template_name').val();
        $position = $(this).find('#position').val();
        $images = $(this).find('#images').val();
        $des = $(this).find('#des').val();
        $type = $(this).find('#type').val();
        $('#id').val($id_);
        $('#name_a').val($name_a);
        $('#position_a').val($position);
        $('#description_a').val($des);
        $('#type_a').val($type);
        
        $("#image_a").attr("src","<?php echo base_url().'/uploads/templates/' ?>/"+$type+'/'+$images);                            
    });    
    
    
    
    $('.set_value').on('click','.del', function(){
        $id_delete = $(this).find('#id_del').val();
        if(confirm("Are you sure you want to delete this record?")){            
            $url = "<?php echo base_url(); ?>";
            $.ajax({
                url: $url+"admin/tempate/delete",
                type: "post",
                data: {
                    "id_dele":$id_delete,
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'    
                },
                dataType: "text",
                success:function(response){
                    if(response == "success")
                    {
                        location.reload();  
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
            url: $url+"admin/tempate/lock_tempate",
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
            url: $url+"admin/tempate/unlock_tempate",
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
