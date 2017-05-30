<style type="text/css">

    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}
</style>
<div class="container-fluid profile_detail" style="min-height: 100vh;" >

    <div class="row">
        <div class="col-md-12">

            <div class="cover-allsong" style="background-image: url(<?php echo $this->M_user->get_cover($info_id)?>);">
                <div class="img-avarar">
                    
                    <img src="<?php echo $this->M_user->get_avata($info_id)?>" class="thumbnail" height="150" width="150" />
                    <div class="decsript searchform">
                        <h3 class="text-capitalize text_shara" > <?php echo $this->M_user->get_name($info_id)?></h3>
                        <h4 class="text_shara">Genre: <?= $this->M_user->get_name_genre($info_id)?></h4>
                        <!-- TODO: <a class="btn btn-default bt-sx ">Share</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-12 menu_detailprofile">
        <div id='cssmenu' class="align-center">
            <ul>
               <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
               <li><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
               <li><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
               <li><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
               <li><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
               <li class='active'><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </div> -->
    <nav class="navbar navbar-default">
        <div class="container align-center">
            <ul class="nav navbar-nav">
                <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
                <li ><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
                <li ><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
                <li ><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
                <li ><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
                <li ><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li class='active'><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
         
     <div class="container">
        <div class="row">
             <h3 class="oswaldregularh3 text-center" style="color: #000;">  All Comments</h3> <hr />
        </div>
        <div class="row allcmt" >
            <?php foreach ($comments as $comment) {
    ?>
            <?php if (!empty($comments)) {
    ?>
            <?php if (empty($comment['comment_id'])) {
    ?>
                <div class="col-xs-12 no-padding" style="margin-left: 0px;padding:10px 0;width:100%">
                    <div class="col-xs-2 n-padding">
                        <div class="image_fix_value_video" style="margin:0 auto;background: url('<?php echo $this->M_user->get_avata($info_id)?>');"></div>
                        <h3 class="text-center"><a href="<?php echo $this->M_user->get_homepage($comment['user_id'])?>"><?php echo $this->M_user->get_name($comment['user_id'])?></a></h3>
                    </div>
                    <div class="col-xs-10" style="min-height: 0px;">
                        <!--
                        <span class="col-md-12" style="font-size: 20px;"><a href="<?php echo $this->M_user->get_homepage($comment['user_id'])?>"><?php echo $this->M_user->get_name($comment['user_id'])?></a></span>
                        -->
                        <span class="col-xs-12"><?php echo $comment['comment']; ?></span>
                    </div>                                              
                </div>
            <?php 
} else {
    $cm = $this->db->select('*')
                        ->from('comments')
                        ->where('comments.comment_id', $comment['comment_id'])
                        ->get()->result_array(); ?>
                <div class="col-md-12 no-padding">
                    <div class="col-md-2 n-padding">
                        <img width="130" style="min-height: 100px;" src="<?php echo $this->M_user->get_avata($cm[0]['user_id'])?>" />
                    </div>
                    <div class="col-md-10" style="min-height: 130px;">
                        <span class="col-md-12" style="font-size: 20px;"><a href="<?php echo $this->M_user->get_homepage($cm[0]['user_id'])?>"><?php echo $this->M_user->get_name($cm[0]['user_id'])?></a></span>
                        <span class="col-md-12"><?php echo $cm[0]['comment']; ?></span>
                    </div>                                              
                </div>
            <?php 
} ?>   
            <?php 
}
} ?>    
        </div>
    </div>
    
</div>
