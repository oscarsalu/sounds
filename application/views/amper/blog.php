<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<script>
  var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/amp/blog.js"></script>
<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<div class="container-fluid">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;overflow: hidden;">
        <h4 class="tt text_caplock">BLOG MANAGER</h4>
        <span class="liner"></span>
        
        <div class="row col-md-12 col-sm-12">
            <div class="post_new hidden ">
                <form class="form form-new-blog " method="post" role="form" action="<?php echo base_url().'amper/upload/blog'?>" enctype="multipart/form-data">
    			    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Title*</label>
                        <div class="input-group col-md-12">
                            <input type="text"class="form-control" id="title" name="title" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Introduction*</label>
                        <div class="input-group col-md-12">                                                        
                            <textarea class="form-control"  name="introduction" rows="3" required=""></textarea>
                        </div>
                    </div>
                     <div class="form-group">                        
                        <label class="form-input col-md-12">Upload Image*</label>
                        <div class="input-group col-md-12">
                            <input type="file" class="form-control" name="image_rep" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Post Content*</label>
                        <div class="input-group col-md-12">     
                        <textarea class="form-control" id="content" name="content" rows="0" required=""></textarea>                       
                        </div>
                    </div>    
                    <p style="text-align: center;">     
                        <button type="submit" class="btn submit-btn btn-primary center-block" >Save & Post</button>
                    </p>
                 </form> 
            </div>
            <div class="col-md-4 col-sm-4 panel-heading">
                <button class="button_new" id="post_btn">New Posts</button>
            </div>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th> #</th>
                        <th> Title</th>
                        <th>Introduction</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($blogs as $blog) {
                            ?>
                            <tr>
                                <td> <img class="img" src="<?php echo base_url();?>/uploads/<?=$blog->user_id?>/photo/blogs/<?=$blog->image_rep?>" style="width:150px;height:150px"></td>
                                <td> <?=$blog->title?></td>
                                <td><?=$blog->introduction?></td>
                                <td><?= date('m/d/Y ', $blog->time); ?></td>
                                <td>
                                    <button class="btn btn-primary action-edt" data_blog="<?=$blog->id?>">Read/Edit</button>
                                    <button class="btn btn-danger action-del" data_blog="<?=$blog->id?>">Remove</button>
                                </td>
                            </tr>
                            <?php

                        }
                    ?>
                </tbody>
            </table> 
        </div>
        <!-- END SLIDER -->
    </section>
</div>
<script>                
    CKEDITOR.replace('content', {
        removeButtons: 'Save'
    });
</script>
