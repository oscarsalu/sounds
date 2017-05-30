<script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/blogsmanager.js"></script>
<div style=" min-height: 100vh;" >
    <div class="container-fluid fix-amp">
     <?php
      include('inc_side_menu/menu_artist.php')
    ?>
    <div class="side-body">
        <h2>Blog Manager</h2>
        <hr />
        <div class="breadcrumb flat" style="    width: 100%">
			<a href="<?php echo base_url()?>artist/profile">Profile</a>
			<a class="active" href="#">Blog Manager</a>
		</div>
        <!-- tile -->
		<section class="tile" style="padding: 0px;">
			<!-- tile header -->
			<div class="tile-header dvd dvd-btm">
				<h3 class="custom-font"><strong>Editable</strong> Songs</h3>
			</div>
			<!-- /tile header -->
			<!-- tile body -->
			<div class="tile-body">
				<a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#addnewblogs"><span data-hover="New Blog Entry">New Blog Entry</span></a>
				<div class="table-responsive" id="blogs_manager">
					<table class="table table-custom" id="editable-usage">
						<thead>
							<tr>
								<th width="20%"class="col-md-2">Title</th>
								<th width="70%">Content</th>
                                <th width="10%" >Date</th>
                                <th width="10%"class="no-sort">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php 
                             foreach ($listblogs as $row) {
                                 ?> 
							<tr class="odd gradeX <?php if ($row['blocked'] == 1) {
    echo 'blocked';
} ?>" >
								<td class="text-capitalize">
									<?php echo $row['title']?>
								</td>
                                <td>
								    <?php 
                                        $text = strip_tags($row['content']);
                                 $desLength = strlen($text);
                                        //var_dump($desLength);exit;            
                                        $stringMaxLength = 100;
                                 if ($desLength > $stringMaxLength) {
                                     $des = substr($text, 0, $stringMaxLength);
                                     $text = $des.'...';
                                     echo $text;
                                 } else {
                                     echo $row['content'];
                                 } ?>
                                    <br />
                                     <?php
                                        $comment = $this->M_blog->getcomment_blog($row['id']);
                                 if (count($comment) > 0) {
                                     echo '<div class="comment_replies">';
                                     foreach ($comment as $data_cmt) {
                                         ?>
                                    			<div class="comment_reply">
                                    				<a href="#" style=" float: left;padding-right: 15px;"><img alt="aaa" class="thumb_" height="30" src="<?php echo $this->M_user->get_avata($data_cmt['user_id'])?>" title="aaa" width="30"></a>
                                    				<div class="comment_details">
                                    					<a href="#" class="comment_author"><?php echo $this->M_user->get_name($data_cmt['user_id'])?></a>
                                    					<span class="time_since" title="<?php echo date('l, M d Y H:i:S')?>">&nbsp;(about <?php echo $this->M_user->time_calculation($data_cmt['time'])?>)</span><br>
                                    					<div class="comment_body">
                                    						<p><?php echo $data_cmt['comment']?></p>
                                    					</div>
                                    				</div>
                                    			</div>
                                    			<?php
                                                if (end($comment) != $data_cmt) {
                                                    echo '<hr/>';
                                                }
                                     } ?>
                                            </div>
                                            <button class="show-cmt" style="width: 100%;margin: 10px auto;">Hide/Load full post and comments</button>
                                            <?php

                                 } ?> 
								</td>
                                <td>
								    <p><?php echo date('l, Y M d h:i:s A', $row['time'])?></p>
								</td>
								<td class="actions">                                    
									<div title="edit" data-toggle="modal" data-target="#editblogs"  class="ctn-edit-blogs edit btn-edit text-primary text-uppercase text-strong text-sm mr-10 " >                                        
                                        <input type="hidden" class ="id_hd" value="<?php echo $row['id']?>"/>
                                        <input type="hidden" class ="user_id_hd" value="<?php echo $row['user_id']?>"/>
                                        <input type="hidden" class ="title_hd" value="<?php echo $row['title']?>"/>
                                        <input type="hidden" class ="intro_dc" value="<?php echo $row['introduction']?>"/>
                                        <div><?php echo $row['content']?></div>
                                        <!--input type="hidden" class="content_hd" value="<?php //echo $row['content']?>"/-->
                                        Edit                                      
                                    </div>
									<a  href="#" class="delete text-danger text-uppercase text-strong text-sm btn-del">
                                        <input type="hidden" class ="id_hd" value="<?php echo $row['id']?>"/>Remove
                                    </a>                                  
								</td>
							</tr>
							<?php 
                             }
                        ?>
                        
						</tbody>
					</table>
                    <!-- /tile body -->
            <form action="<?php echo base_url()?>artist/deleteblogs" method="post" id="form_delete">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" id ="delete_id" name="id" />
            </form>
            <?php echo $this->pagination->create_links(); ?>
		</section>
	</div>
    </div>	
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>    
<!-- Modal blogs -->
<div class="modal fade" id="addnewblogs" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/addnewblogs'?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">New Blog Entry</h4>
                </div>            
                <div class="modal-body" style="min-height: 700px;">
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
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>                  
            </form>           
        </div>
    </div>
</div>
<!-- Modal edit press -->

<!-- Modal blogs -->
<div class="modal fade" id="editblogs" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/editblogs'?>" method="post">
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
<script>                
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('content');
</script>