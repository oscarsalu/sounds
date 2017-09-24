<div class="container-fluid profile_detail" style="min-height: 100vh;" >
    <div class="row">
        <div class="col-md-12">
            <div class="cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($user_current->id)?>);">
                <div class="img-avarar">
                    
                    <a href="<?=base_url('amp/'.$homepage)?>"> <img src="<?php echo $this->M_user->get_avata($user_current->id)?>" class="thumbnail" height="150" width="150" /></a>
                    <div class="decsript">
                        <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($user_current->id)?></h3>
                        <h4 class="text_shara">City: <?= $this->M_user->get_city($user_current->id)?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li><a href='<?php echo base_url('amper/allblogs').'/'.$homepage?>'>Blogs</a></li>
               <li class='active'><a href='<?php echo base_url('amper/allcomment').'/'.$homepage?>'>Comment</a></li> 
            </ul>
        </div>
    </div>
    <h2 class="oswaldregularh2 text-center" style="color: #000;margin-top:50px;"> All Comment</h2>
    <hr />     
    <div class="container">
        <div class="row allcmt" >
            <div class="text-center">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addComment">New Comment</a>
            </div>
            <?php foreach ($comments as $comment) {
    ?>
                <div class="col-xs-12 no-padding" style="margin-left: 0px;padding:10px 0;width:100%">
                    <div class="col-xs-2 n-padding">
                        <div class="image_fix_value_video" style="width: 50px; height: 50px;;margin:0 auto;background: url('<?php echo $this->M_user->get_avata($comment->client)?>');"></div>
                        <h3 class="text-center">
                        <a href="<?php echo $this->M_user->get_homepage($comment->client)?>">
                            <?php echo $this->M_user->get_name($comment->client)?></a>
                        </h3>
                    </div>
                    <div class="col-xs-10" style="min-height: 0px;">
                        <span class="col-xs-12"><?php echo $comment->comment; ?></span>
                    </div>                                              
                </div>
                <?php 
}
             ?>
            
        </div>
        <div class="text-center">
            <?php echo $this->pagination->create_links(); ?>
        </div>     
    </div>
    
</div>
<!-- Modal comment -->
<div class="modal fade new_modal_style" id="addComment" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url('amper/member_post_comment')?>" method="post">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="tt">Add a Comment</h4>
                    <span class="liner"></span>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-2">Comment (max 1000 characters)</label>
                        <div class="input-group col-md-9">
                            <textarea class="form-control" name="comment" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_flp" value="<?=$user_current->id?>" />
                <div class="modal-footer searchform">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>   
            </form>
        </div>      
    </div>
</div>
