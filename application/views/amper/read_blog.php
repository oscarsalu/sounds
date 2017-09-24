<script>
var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
var amper_blog     = '<?=base_url('amper/blog')?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/amp/profile.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ckeditor/ckeditor.js"></script>
<style>
.post_new{
    border: 1px solid #686868;
    padding: 5px;
    border-radius: 10px;
}
#post_btn{
    width: 100%;
}
</style>
<div class="container">
    <div class="row">
        <div class="profile-edit">
            <h1>Edit & Read</h1><hr />
            <div class="post_edt">
                <form class="form form-new-blog " method="post" role="form" onsubmit="return false"  action="<?php echo base_url().'amper/edit/blog'?>" enctype="multipart/form-data">
    			    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Title*</label>
                        <div class="input-group col-md-12">
                            <input type="hidden"class="form-control" name="id"  value="<?=$blog->id?>" required />
                            <input type="text"class="form-control" id="title" name="title"  value="<?=$blog->title?>" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Introduction*</label>
                        <div class="input-group col-md-12">                                                        
                            <textarea class="form-control"  name="introduction" rows="3" required=""><?=$blog->introduction?></textarea>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-12">Post Content*</label>
                        <div class="input-group col-md-12">     
                        <textarea class="form-control" id="content"  name="content" rows="0" required=""><?=$blog->content?></textarea>                       
                        </div>
                    </div>  
                    <div class="pull-right"><button type="submit" class="btn submit-btn action-back">Back</button>
    			    <button type="submit" class="btn submit-btn btn-primary">Edit & Post</button><br /></div>  
                    
                </form> 
            </div>
               
        </div>
    </div>
</div>
<script>                
    CKEDITOR.replace('content', {
        removeButtons: 'Save'
    });
</script>
