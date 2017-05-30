<ol class="breadcrumb">
  <li><a href="<?=base_url('admin/blogs')?>">Manager Blogs</a></li>
  <li class="active">All Blogs Spam</li>
</ol>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">All Spam Blog</div>                    
                </div>
            </div>
            <div class="card-body" style="padding: 25px 0px;">
                
                <hr />
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
    									<a href="<?=base_url('admin/manager_blogs/read_blog?id_blog='.$blog['id'])?>" class="btn-default btn btn-sm" title="Read ">                                                    
                                            <i class="fa fa-book"></i>                                                    
                                        </a> 
                                        <button type="submit" class="btn-blocked btn-info btn btn-sm" title="Take Down Blog" data-toggle="modal" data-target="#modaltake_down" data-blog="<?php echo $blog['id']?>">                                                    
                                            <i class="fa fa-lock"></i>                                                    
                                        </button>
                                        <a href="<?=base_url('admin/manager_blogs/accept?id_blog='.$blog['id'])?>" class="btn-success btn btn-sm btn-accept" title="Accept ">                                                    
                                            <i class="fa fa-check"></i>                                                    
                                        </a>
                                    </td>
                                </tr>                                                                                            
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <?php echo $this->pagination->create_links();?>  
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
                <h4 class="modal-title" id="myModalLabel">Take Down Blog</h4>                
            </div>
            <form action="<?=base_url('admin/manager_blogs/take_down')?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_blog" id="id_blog_take_down" />
                <input type="hidden" name="redirect" value="<?=base_url('admin/manager_blogs/all_spam')?>" />
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
<script type="text/javascript"> 
 $('.btn-blocked').click(function(){ 
    $("#id_blog_take_down").val($(this).attr('data-blog'));
 });
  $('.btn-accept').click(function(e){ 
    if(!confirm("Are you sure you want to accept this blog?")){
        e.preventDefault(); 
    }
 });
</script>