<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/css/main.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>

    

<style type="text/css">
    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}

.pagination li a{
    border-radius: 20px !important;
    margin-right: 5px;
    
}
.pagination li{
    margin-right: 5px;
}

.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus{
    background-color: #fff !important;
    color: blue;
    border-color: red;
    z-index: 2;
    cursor: default;
}
</style>
<div class="row">
    <div class="col-md-12 cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($info_id)?>);">
        <div class="img-avarar">
            <img src="<?php echo $this->M_user->get_avata($info_id)?>" class="thumbnail" height="150" width="150" />
            <div class="decsript searchform">
                <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($info_id)?></h3>
                <h4 class="text_shara">Genre: <?= $this->M_user->get_name_genre($info_id)?></h4>
                <!-- TODO: <a class="btn btn-default bt-sx ">Share</a> -->
            </div>
        </div>
        
    </div>
    <nav class="navbar navbar-default">
        <div class="container align-center">
            <ul class="nav navbar-nav">
               <li class='active'><a href='#'> Photos</a></li>
               <li ><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
               <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
               <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
               <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
    <div id="#demo"></div>
    <div class="container  ">
        <div class="row">
            <h3 class="oswaldregularh3 text-center" style="color:#000">All Photos</h3><hr />
    </div>
        <div class="container all_image_show ">
        <div class="row ">
            <div id="photo" data-lightbox="gallery">  
            <ul class="docs-pictures clearfix">
            <?php foreach ($photos as $photo) {
    ?>
                <li class="col-xs-6 col-sm-4 col-md-3">
                <div class="effect_slide_wp" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>');background-position: 50% 25%;background-size: cover;">
                    <a class="item effect_slide" data-gal="photo" href="#" title="<?php echo $photo['caption']?>" rel="bookmark">
    							
						<figure class="effect-bubba">
														
                            <figcaption>
                                    <!-- styele for showing dots style="display:inline-block;width:180px;white-space: nowrap;
            overflow: hidden;text-overflow: ellipsis;" -->
        								<h2 ><?php if(strlen($photo['caption']) <= 50) {
                                                echo $photo['caption'];
                                            } else{
                                                    echo substr($photo['caption'], 0, 50).'...';
                                                } ?></h2>
								
							</figcaption>
                        </figure>
				   </a>
                </div>
                  <img class="hide" title="sdgdff" width="200px" data-original="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>" />
                 <a href="#" title="edit" data-toggle="modal" data-target="#editphoto_md" data-id="<?php echo $photo['id']; ?>" class="edit editphoto text-primary text-uppercase text-strong text-sm mr-10 ">Edit</a>
                </li>    
            <?php 
} ?>
            </ul>   

        </div>
             <div class="text-center">
                 <?php echo $this->pagination->create_links(); ?>
        </div>
              
            
    </div>
        </div>
    </div>
    
    
</div>


<!--
<div class="container-fluid" style="min-height: 100vh;">
    <div id='cssmenu' class="align-center">
        <ul>
           <li class='active'><a href='<?php echo base_url().$users[0]['home_page']; ?>/photos'> Photos</a></li>
           <li ><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
           <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
           <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
           <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
           <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
           <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2> All Photo</h2>
            <hr />
            <div class="cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($info_id)?>);">
                <div class="img-avarar">
                    <img src="<?php echo $this->M_user->get_avata($info_id)?>" class="thumbnail" height="150" width="150" />
                </div>
                <div class="decsript">
                    <ul class="social_buttons social_buttons_horizontal socialite_container">
                          
                    </ul>
                    <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($info_id)?></h3>
                    <h4 class="text_shara">By: add </h4>
                    <a class="btn btn-default bt-sx ">Share</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="photo" data-lightbox="gallery">  
            <ul class="docs-pictures clearfix">
            <?php foreach ($photos as $photo) {
    ?>
                
                <li>
                <div class="remix_items grid clearfix four_col effect_slide_wp" style="background: url('<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>');background-position: 50% 25%;background-size: cover;">
                    <a class="item effect_slide" data-gal="photo" href="#" title="<?php echo $photo['caption']?>" rel="bookmark">
    							
						<figure class="effect-bubba">
														
                            <figcaption>
								<h2><?php echo $photo['caption']?></h2>
								
							</figcaption>
                        </figure>
				   </a>
                </div>
                    <img class="hide" title="sdgdff" width="200px" data-original="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id'] ?>/photo/<?php echo $photo['filename']; ?>" />
                </li>    
            <?php 
} ?>
            </ul>   
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="viewPhoto" tabindex="-1" role="dialog" aria-labelledby="viewPhotoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Photo</h4>
            </div>
            
            <div class="modal-body text-center">
                <img id="img_t" width="100%" class="img-responsive" />          
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal">View All photos >></a>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(".effect_slide").click(function(){
            $(this).parent().parent().find("img").click();
           console.log($(this).parent().parent().find("img"));
        })
              
</script>
<!-- Modal -->
<div class="modal fade" id="editphoto_md" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalPhoto">Edit Photo</h4>
            </div>
            <form class="form form-signup" id="update_pt" role="form" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                  <div class="form-group">                       
                        <div class="col-md-12">
                            <img id="img_t1" src="" width="535" height="250" class="img-profile-edit"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-input col-md-4">Choose a Photo File</label>
                        <div class="input-group col-md-6">
                            <input type="file" class="form-control imageInput" id="imageInput" name="photo" >
                            <input type="hidden" name="image" id="image" value="">
                        </div>
                    </div>
                    <div class="form-group" style="margin-left:15px">
                        <label class="" style="margin-top: 20px;">Add Caption:</label>
                        <div class="input-save-modal">
                            <input type="text" class="form-control" id="cap_js" name="caption" value="" placeholder="Enter the caption of the photo"/>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-save-modal">Save</button>
                        </div>
                        <?php echo form_error('caption', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                    </div>                    
                    <input type="hidden" name="id_photo" value=""/>
                    <input type="hidden" name="url" value="<?php echo base_url();?><?php echo $this->M_user->get_home_page($info_id);?>/photos">
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function() {
        $('.editphoto').on('click', function (){
            var url = '<?php echo base_url()?>';
            var current = $(this);
            var id_photo = current.attr('data-id');
            
            var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajax({             
                url: url+'artist/load_data_photo',
                type: "post",
                data: { 
                    'id_photo' : id_photo,
                    'csrf_test_name':get_csrf_hash
                },
                dataType: "json",               
                success:function(response){ 
                    $('#img_t1').attr('src',url+'uploads/'+response.user_id+'/photo/'+response.filename);
                    $('#cap_js').val(response.caption);
                    $('#image').val(response.filename);
                    $('#update_pt').attr('action',url+'artist/updatephoto/'+response.id);
                },
            }); 
            
        });
        $('#photopanel').on('click','.delphoto', function (){
            if(confirm("Are you sure you want to delete this record?")){
                return true;
            }else{
                return false;
            }
            
        })
    })    
    
    function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#update_pt + img').remove();
            $("#img_t1").attr("src", e.target.result);
          
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageInput").change(function () {
    filePreview(this);
});
</script>