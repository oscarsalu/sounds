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
<script>
   $(document).ready(function() {           
        $('#blogs_manager').on('click','.btn-edit', function (){
            var id = $(this).find('.id_hd').val();
            var title = $(this).find('.title_hd').val();   
            var intro = $(this).find('.intro_hd').val();         
            var content =  $(this).find('div').html();
            var user_id = $(this).find('.user_id_hd').val();
            CKEDITOR.instances.content.setData(content); 
            $('#id').val(id);
            $('#title').val(title);  
            $('#intro').val(intro);          
            $("#user_id").val(user_id);
        });
        $('#blogs_manager').on('click','.btn-del', function (){
            if(confirm("Are you sure you want to delete this record?")){
                var id = $(this).find('.id_hd').val();                
                $('#delete_id').val(id); 
                $('#form_delete').submit();
            }
        })
    }) 
</script>
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
                    <div class="title">Manager Blogs</div>                    
                </div>
            </div>
            <div class="card-body" style="padding: 25px 0px;">
                <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#blog"  aria-controls="info" role="tab" data-toggle="tab">Write blogs</a></li>
                            <li role="presentation"><a href="#key_block" aria-controls="newpass" role="tab" data-toggle="tab">Set blog keywords</a></li>                            
                            <li role="presentation"><a href="#spam_blog" aria-controls="block_blog" role="tab" data-toggle="tab">Spam blogs</a></li>
                            <li role="presentation"><a href="#blocked_blog" aria-controls="block_blog" role="tab" data-toggle="tab">Blocked Blog</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="blog">
                                <div class="panel-body">                                
                                    <button type="button" class="btn btn-primary" id="add_new_blog" style="margin-top: 0px;" data-toggle="modal" data-target="#modal_addblog">Add New Blog</button>
                                   
                                </div>
                                <!-- Table -->
                                <table class="table" id="blogs_manager">
                                    
                                    <thead>
                                        <tr style="font-size: 15px;">
                                            <th width="5%">#</th>
                                            <th width="10%">Title</th>
                                            <th width="50%">Content</th>
                                            <th width="20%">Date</th>  
                                            <th width="15%">Actions</th>                                                                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach($listblogs as $blog){ ?>
                                            <tr>
                                                <th class="ver"><?php echo $i; ?></th>
                                                <td class="ver"><?php echo $blog['title'] ?></td>
                                                <td class="ver"><?php 
                                                        $text = strip_tags($blog['content']);                                                                                    
                                                        $desLength 	=   strlen($text);
                                                        //var_dump($desLength);exit;            
                                                	    $stringMaxLength					= 	100;
                                                	    if($desLength > $stringMaxLength){
                                                            $des			= substr($text,0,$stringMaxLength); 
                                              		        $text = $des.'...';   
                                                            echo $text;
                                                        }else{
                                                            echo $blog['content'];
                                                        }          
                                                    ?>
                                                </td>
                                                <td class="ver"><p><?php echo date('l, Y M d h:i:s A',$blog['time'])?></p></td>
                                                <td class="ver">
                                                    <div title="edit" data-toggle="modal" data-target="#editblogs"  class="ctn-edit-blogs edit btn-edit text-primary text-uppercase text-strong text-sm mr-10 ">                                        
                                                        <input type="hidden" class ="id_hd" value="<?php echo $blog['id_blog']?>"/>
                                                        <input type="hidden" class ="user_id_hd" value="<?php echo $blog['user_id']?>"/>
                                                        <input type="hidden" class ="title_hd" value="<?php echo $blog['title']?>"/>
                                                        <input type="hidden" class ="intro_hd" value="<?php echo $blog['introduction']?>"/>
                                                        <div><?php echo $blog['content']?></div>                                                        
                                                        <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>                                  
                                                    </div>                                                    
                									<a href="#" class="delete btn-del btn btn-danger btn-sm">
                                                        <input type="hidden" class ="id_hd" value="<?php echo $blog['id_blog']?>"/><i class="fa fa-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>                                                                                            
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                                <?php echo $this->pagination->create_links();?>     
                                <form action="<?php echo base_url()?>admin/delete-blog" method="post" id="form_delete">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <input type="hidden" id ="delete_id" name="id" />
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="key_block">
                                <div class="panel-body" style="padding: 0px;">   
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
                                         <a class="btn btn-primary" href="<?=base_url('admin/blogs')?>">Update</a>
                                    </div>        
                                </div>
                            </div> 
                            <div role="tabpanel" class="tab-pane" id="spam_blog">
                                <table class="table" id="blogs_manager">
                                    <thead>
                                        <tr style="font-size: 15px;">
                                            <th width="5%">#</th>
                                            <th width="10%">Title</th>
                                            <th width="50%">Content</th>
                                            <th width="20%">Date</th>  
                                            <th width="15%">Actions</th>                                                                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach($spam_blogs as $spam){ ?>
                                        <tr class="warning ">
                                            <th class="ver"><?php echo $i; ?></th>
                                            <td class="ver"><?php echo $spam['title'] ?></td>
                                            <td class="ver"><?php 
                                                    $text = strip_tags($spam['content']);                                                                                    
                                                    $desLength 	=   strlen($text);
                                                    //var_dump($desLength);exit;            
                                            	    $stringMaxLength					= 	100;
                                            	    if($desLength > $stringMaxLength){
                                                        $des			= substr($text,0,$stringMaxLength); 
                                          		        $text = $des.'...';   
                                                        echo $text;
                                                    }else{
                                                        echo $spam['content'];
                                                    }          
                                                ?>
                                            </td>
                                            <td class="ver"><?php echo date('l, Y M d h:i:s A',$spam['time'])?></td>
                                            <td class="ver">    
                                                <a href="<?=base_url('admin/manager_blogs/read_blog?id_blog='.$spam['id'])?>" class="btn-default btn btn-sm" title="Read ">                                                    
                                                    <i class="fa fa-book"></i>                                                    
                                                </a> 
                                                <button type="submit" class="btn-blocked btn-info btn btn-sm" title="Take Down Blog" data-toggle="modal" data-target="#modaltake_down" data-blog="<?php echo $spam['id']?>">                                                    
                                                    <i class="fa fa-lock"></i>                                                    
                                                </button>
                                                 <a href="<?=base_url('admin/manager_blogs/accept?id_blog='.$spam['id'])?>" class="btn-success btn btn-sm btn-accept" title="Accept ">                                                    
                                                    <i class="fa fa-check"></i>                                                    
                                                </a> 
                                            </td>
                                        </tr>                                                                                            
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                            <div class="text-center"><a class="btn btn-primary " href="<?=base_url('admin/manager_blogs/all_spam')?>">All Spam Blogs</a></div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="blocked_blog">
                                <table class="table" >
                                    <thead>
                                        <tr style="font-size: 15px;">
                                            <th width="5%">#</th>
                                            <th width="10%">Title</th>
                                            <th width="50%">Content</th>
                                            <th width="20%">Date</th>  
                                            <th width="15%">Actions</th>                                                                                                                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach($blocked_blogs as $blocked){ ?>
                                        <tr class="warning ">
                                            <th class="ver"><?php echo $i; ?></th>
                                            <td class="ver"><?php echo $blocked['title'] ?></td>
                                            <td class="ver"><?php 
                                                    $text = strip_tags($blocked['content']);                                                                                    
                                                    $desLength 	=   strlen($text);
                                                    //var_dump($desLength);exit;            
                                            	    $stringMaxLength					= 	100;
                                            	    if($desLength > $stringMaxLength){
                                                        $des			= substr($text,0,$stringMaxLength); 
                                          		        $text = $des.'...';   
                                                        echo $text;
                                                    }else{
                                                        echo $blocked['content'];
                                                    }          
                                                ?>
                                            </td>
                                            <td class="ver"><?php echo date('l, Y M d h:i:s A',$blocked['time'])?></td>
                                            <td class="ver">    
                                                <a href="<?=base_url('admin/manager_blogs/read_blog?id_blog='.$blocked['id'])?>" class="btn-default btn btn-sm" title="Read ">                                                    
                                                    <i class="fa fa-book"></i>                                                    
                                                </a> 
                                                <button type="submit" class="btn-unblocked btn-info btn btn-sm" title="Unblock Blog" data-toggle="modal" data-target="#modal_unblock" data-blog="<?php echo $blocked['id']?>">                                                    
                                                    <i class="fa fa-unlock"></i>                                                    
                                                </button>
                                                <a href="<?=base_url('admin/manager_blogs/delete_blogs?id='.$blocked['id'])?>" class="delete btn-del-blog btn btn-danger btn-sm" title="Delete Blog" >
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>                                                                                            
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                            <div class="text-center"><a class="btn btn-primary " href="<?=base_url('admin/manager_blogs/all_blocked')?>">All Blocked Blogs</a></div>
                        </div>                           
                    </div>  
                </div>  
            </div>
        </div>            
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<!-- Modal create blog-->    
<div class="modal fade" id="modal_addblog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <form class="" action="<?php echo base_url().'admin/blog-create'?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Blog Entry</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Title*</label>
                        <div class="input-group col-md-12">
                            <input type="text"class="form-control" name="title" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Image represent*</label>
                        <div class="input-group col-md-12">
                            <input type="file"class="form-control imageInput" name="image_rep" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Introduction*</label>
                        <div class="input-group col-md-12">                            
                            <textarea class="form-control" name="introduction" rows="3" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Post Content*</label>
                        <div class="input-group col-md-12">
                            <textarea class="form-control" id="editor1" name="content" rows="6" required=""></textarea>                             
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Create</button>
                </div>
            </form>      
         </div>         
    </div>
</div>   
<!-- Modal blogs -->
<div class="modal fade" id="editblogs" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'admin/edit-blog'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Edit Blog</h4>
                </div>            
                <div class="modal-body" style="min-height: 640px;">
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Title*</label>
                        <div class="input-group col-md-12">
                            <input type="hidden"class="form-control" id="id" name="id"  />
                            <input type="text"class="form-control" id="title" name="title" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Introduction*</label>
                        <div class="input-group col-md-12">                                                        
                            <textarea class="form-control" id="intro" name="introduction" rows="3" required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Post Content*</label>
                        <div class="input-group col-md-12">
                            <textarea class="form-control" id="content" name="content" rows="6" required=""></textarea>                             
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>                  
            </form>           
        </div>
    </div>
</div>
<!-- Modal take down -->
<div class="modal fade " id="modaltake_down" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Take Down Blog</h4>                
            </div>
            <form action="<?=base_url('admin/manager_blogs/take_down')?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_blog" id="id_blog_take_down" />
                <input type="hidden" name="redirect" value="<?=base_url('admin/blogs')?>" />
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input">Message Notifications</label>
                        <div class="input-group" style="width: 100%;">                                                        
                            <textarea class="form-control"  id="intro" name="message" rows="3" required="">
                            Your blog take down, had negative content!
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="submit" class="btn btn btn-primary update_" name="type_submit" value="update">Take Down Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Unblock -->
<div class="modal fade " id="modal_unblock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Unblock Blog</h4>                
            </div>
            <form action="<?=base_url('admin/manager_blogs/unblock')?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_blog" id="id_blog_unblock" />
                <input type="hidden" name="redirect" value="<?=base_url('admin/blogs')?>" />
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input">Message Notifications</label>
                        <div class="input-group" style="width: 100%;">                                                        
                            <textarea class="form-control"  id="intro" name="message" rows="3" required="">
                            Your blog unblocked success! 
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="submit" class="btn btn btn-primary update_" name="type_submit" value="update">Unblock</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>                
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('content');
</script>
<script type="text/javascript">
$('.btn-blocked').click(function(){ 
    $("#id_blog_take_down").val($(this).attr('data-blog'));
 });
 $('.btn-unblocked').click(function(){ 
    $("#id_blog_unblock").val($(this).attr('data-blog'));
 });
 $('.btn-del-blog').click(function(e){ 
    if(!confirm("Are you sure you want to delete this record?")){
        e.preventDefault(); 
    }
 });
 $('.btn-accept').click(function(e){ 
    if(!confirm("Are you sure you want to accept this blog?")){
        e.preventDefault(); 
    }
 });
$('#set_keyword').click(function(){
    $key = $('#key').val();
    $url = "<?php echo base_url(); ?>";
     $.ajax({
        url: $url+"admin/set_keyword",
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
        url: $url+"admin/keyword/loaddata",
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
    $btn = $(this).find('.update_key');
    $btn_delete = $(this).find('.delete_key');
    $btn.click(function(){       
        $url = "<?php echo base_url(); ?>";
         $.ajax({             
            url: $url+"admin/update_key",
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
            url: $url+"admin/manager_blogs/delete_key",
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
</script>
