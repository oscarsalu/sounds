<script>
var link_base = "<?php echo base_url();?>";
</script>

<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/managervideo.js"></script>
<style>
    /* COMMON RADIO AND CHECKBOX STYLES  */
input[type=radio]
{
  /* Hide original inputs */
  visibility: hidden;
  position: absolute;
}
input[type=radio] + label:before
{
  height:12px;
  width:12px;
  margin-right: 2px;
  content: " ";
  display:inline-block;
  vertical-align: baseline;
  border:1px solid #777;
}
input[type=radio]:checked + label:before
{
  background:#5bc0de;
}

/* CUSTOM RADIO AND CHECKBOX STYLES */
input[type=radio] + label:before{
  border-radius:50%;
}

</style>

<div class="" style="min-height: 100vh;">
    <div class="container-fluid fix-amp">
        <div class="row" style="min-height: 300px;">
            <div class="">
                 <?php
                 include('inc_side_menu/menu_artist.php')
                 ?>
		         <div class="side-body">
                    <h2>Video Manager</h2>
                    <hr />
                    <div class="breadcrumb flat" style="    width: 100%">
                    	<a href="<?php echo base_url()?>artist/profile">Profile</a>
                    	<a class="active" href="#">Videos Manager</a>
                    </div>
                     <!-- tile -->
                    <section class="tile" style="padding: 0px;">
        
                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h3 class="custom-font"><strong>Video</strong> Editor</h3>
                            
                        </div>
                        <!-- /tile header -->
                        <div class="description col-md-12">
                            <?php if($this->session->flashdata('message_msg')){
                                ?>
                                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                                    <strong>Well done!</strong> <?= $this->session->flashdata('message_msg')?>!
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if($this->session->flashdata('message_error')){
                                            ?>
                                            <div class="alert alert-big alert-lightred alert-danger alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">�</span><span class="sr-only">Close</span></button>
                                                <h4><strong>Error!</strong></h4>
                                                <p> <?php echo $this->session->flashdata('message_error')?></p>
                                            </div>
                                            <?php
                                        } 
                                        ?>
                        </div>
                        <!-- tile body -->
                        <div class="tile-body">
                            <a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#uploadvideo"><span data-hover="Upload Video">Upload Video</span></a>
                            <div class="table-responsive" id="video-item">
                                <table class="table table-custom" id="editable-usage">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th >Name</th>
                                        <th class="col-md-2">Type</th>
                                        <th class="no-sort">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($listvideo as $video) {
                                            if ($video['type'] == 'file') {
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i?></td>
                                                    <td><img width="50" src="<?=$this->M_video->get_image_video($video['id'])?>" /><?php echo $video['name_video']?></td>
                                                    <td>
                                                        File
                                                    </td>
                                                    <td class="actions">
                                                        <input type="hidden" class ="id" value="<?php echo $video['id']?>"/>
            											<input type="hidden" class ="user_id" value="<?php echo $video['user_id']?>"/>
            											<input type="hidden" class ="name_video" value="<?php echo $video['name_video']?>"/>
                                                        <input type="hidden" class ="file_video" value="<?php echo $video['name_file']?>"/>
                                                        <input type="hidden" class ="cover_image" value="<?php echo $video['cover_image']?>"/>
                                                        <a href="#" title="edit" data-toggle="modal" data-target="#editvideo"  class="edit btn-edit-file text-primary text-uppercase text-strong text-sm mr-10 ">Edit</a>
                                                        <a href="#" class="delete text-danger text-uppercase text-strong text-sm btn-del">Remove</a>
                                                    </td>
                                                </tr>
                                                <?php

                                            } else {
                                                $parse = parse_url($video['link_video']);
                                                if ($parse['host'] == 'www.youtube.com') {
                                                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video['link_video'], $matches);
                                                    $id_link = $matches[0];
                                                } else {
                                                    $id_link = 154545;
                                                } ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $i?></td>
                                                    <td><img width="50"  src="<?=$this->M_video->get_image_video($video['id'])?>" /><?php echo $video['name_video']?></td>
                                                     <td>
                                                       <?php if($video['type']=="link") { echo "Youtube" ;} else { echo "Vimeo" ;}?> 
                                                    </td>
                                                    <td class="actions">
                                                        <input type="hidden" class ="id" value="<?php echo $video['id']?>"/>
            											<input type="hidden" class ="user_id" value="<?php echo $video['user_id']?>"/>
            											<input type="hidden" class ="name_video" value="<?php echo $video['name_video']?>"/>
                                                        <input type="hidden" class ="link_video" value="<?php echo $video['link_video']?>"/>
                                                        <input type="hidden" class ="id_link" value="<?php echo $id_link?>"/>
                                                        <a href="#" title="edit" data-toggle="modal" data-target="#editModal"  class="edit btn-edit text-primary text-uppercase text-strong text-sm mr-10 ">Edit</a>
                                                        <a href="#" class="delete text-danger text-uppercase text-strong text-sm btn-del">Remove</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                            }
                                            ++$i;
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /tile body -->
                        <?php echo $this->pagination->create_links(); ?>
                    </section>
                    <form id="form_delete"action="<?php echo base_url().'artist/deletevideo'?>" method="post" >
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <input type="hidden"  name="delete_id" class="delete_id"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal edit-->
<div display="none" class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> Edit Song</h4>
			</div>
			<div class="modal-body">
				<form class="form form-signup" role="form" action="<?php echo base_url().'artist/editvideo'?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="row">
						<div class="form-group" style="padding-top:30px;">
							<label class="col-sm-6 col-md-3 control-label">Video Name<i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-12" style="padding-left: 0px;">
										<input type="hidden" size="10" name="id" id="id" class="form-control">
										<input type="text" size="10" name="name_video" id="name_video" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding-top:30px;">
							<label class="col-sm-6 col-md-3 control-label">Link Video <i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
							<div class="col-sm-6 col-md-7">
								<div class="row">
									<div class="col-sm-12" style="padding-left: 0px;">
										<div class="form-group">
											<a class="form-control-static" id="link_video" href="#"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group" style="padding-top:30px;padding-bottom: 100px;">
                            <div class="col-lg-12">
                            <img id="video_id" width="100%" src="" />
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-link ok-smt-btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<button type="submit" class="btn btn-primary" >Edit</button>
						</div>
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>
<div display="none" class="modal fade" id="editvideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"> Edit Song</h4>
			</div>
			<div class="modal-body">
				<form class="form form-signup" role="form" action="<?php echo base_url().'artist/editvideo'?>" method="post" enctype="multipart/form-data">
					    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
						<div class="form-group clearfix">
							<label class="col-sm-6 col-md-3 control-label">Video Name<i class="fa fa-asterisk" style="font-size:8px;vertical-align: super;"></i></label>
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-12" style="padding-left: 0px;">
										<input type="hidden" size="10" name="id" class="id form-control">
										<input type="text" size="10" name="name_video" class="name_video form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="form-group clearfix">
							<label class="col-sm-6 col-md-3 control-label">Video </label>
                            <div class="col-sm-7">
                                <img style="width: 100%;" id="fileVideo" src="" />
                            </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-link ok-smt-btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
							<button type="submit" class="btn btn-primary" >Edit</button>
						
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal upload video -->
<div class="modal fade" id="uploadvideo" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true" >
     <div class="modal-dialog">
        <div class="modal-content"style="border-radius:45px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h2 class="modal-title btn btn-info btn-block disabled" id="myModalbg" style="width:50%;text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);font-size:25px;" >Add A New Video</h2>
            </div>   
            <hr style="border-bottom: 1px solid #000;">
            <div class="router-type">
                <div class="input-group col-md-offset-4 col-md-7 ">
                    <div class="radio1">
                        <input type="radio" name="router-type" checked="" value="link" id="youtube"/><label class="radio-label" for="youtube"> Youtube </label>
                        <br> <input type="radio" name="router-type"  value="vimeo-link" id="vimeo"/><label class="radio-label" for="vimeo"> Vimeo </label>
                        <br> <input type="radio" name="router-type" value="file" id="harddrive" /><label class="radio-label" for="harddrive"> Hard Drive </label>
                </div>
                </div>
            </div>
            <form class="form_video_link"  onsubmit="return false"  action="<?php echo base_url().'artist/addvideo'?>" method="post">           
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">YouTube Video Name </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
                        </div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7"> 
                        
                        
                        
                    </div>
                </div>
                 <hr style="border-bottom: 1px solid #000;">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div> 
            </form> 
              <form class="form_video_vimeo_link" style="display: none;" onsubmit="return false"  action="<?php echo base_url().'artist/addvideo'?>" method="post">           
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Vimeo Video Name </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" />
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Url </label>
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="link_video" />
                        </div>
                        
                    </div>
                    <div class="input-group col-md-offset-4 col-md-7"> 
                        
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div> 
            </form>
            <form id="MyUploadForm" class="form_video_file" style="display: none;" action="<?php echo base_url().'artist/upfile_video'?>" onsubmit="return false" method="post" enctype="multipart/form-data" >
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-4">Video Name *</label> 
                        <div class="input-group col-md-7">
                            <input type="text" class="form-control" name="name_video" required />
                        </div>
                    </div>  
                    <div class="form-group">
						<label class="form-input col-xs-4">Choose a video file (Max_size: 150Mb)</label>
						<div class="input-group col-xs-6">
							<input type="file" class="form-control" name="image_file" id="imageInput"  />
						</div>
                    </div>
                    <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                    <div id="output"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit-btn" class="btn btn-primary">Add</button>
                </div> 
            </form>         
        </div>
    </div>
</div>