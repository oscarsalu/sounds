<style>
.img_fans{
   height: 100px;
    background-position: 50% 25%;
    background-size: cover;
    -webkit-transition-duration: 500ms;
    -webkit-transition-property: width, height;
    background-color: transparent;
    position: relative;
    z-index: 2; 
}
</style>
<style type="text/css">
    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
    /* color: #555; */
    color: #fff;
    background-color: #0099CC;
}
</style>
<div class="container-fluid profile_detail" id="allfans" style="min-height: 100vh;">

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
               <li class='active'><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
               <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </div>
     -->
   <nav class="navbar navbar-default">
        <div class="container align-center">
            <ul class="nav navbar-nav">
                <li ><a href='<?php echo base_url().$this->M_user->get_homepage($info_id); ?>/photos'> Photos</a></li>
                <li ><a href='<?php echo base_url(); ?>artist/allsong/<?php echo $info_id?>'>Songs</a></li>
                <li ><a href='<?php echo base_url()?>artist/allvideos/<?php echo $info_id?>'>Videos</a></li> 
                <li ><a href='<?php echo base_url()?>artist/allpress/<?php echo $info_id?>'>Press</a></li>
                <li ><a href='<?php echo base_url()?>artist/allblogs/<?php echo $info_id?>'>Blogs</a></li>
                <li class='active'><a href='<?php echo base_url(); ?>artist/allfans/<?php echo $info_id ?>'>Fans</a></li>
                <li><a href='<?php echo base_url('artist/allcomment').'/'.$info_id?>'>Comments</a></li> 
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
             <h3 class="oswaldregularh3 text-center" style="color: #000;"> All Fans</h3> <hr />
        </div>
        <?php foreach ($fans as $fan) {
    ?>
            <div class="col-md-2 col-sm-4 col-xs-6" >
                <a href="#">
                    <div class="image_fix_value_video" style="margin:0 auto;background-image: url(<?php echo $this->M_user->get_avata($fan['fan_id']) ?>);">
                    <?php if (!empty($user_data['id']) && $user_data['id'] == $fan['user_id']) {
    ?>
                    <!-- <a style="margin-right: 0;" onclick="return confirmDialog();" class="btn btn-default btn-small pd psi" href="<?php echo base_url().'artist/delete-fan/'.$fan['fan_id']; ?>"><i class="glyphicon glyphicon-remove"></i> </a> -->
                <?php 
} ?>
                    </div>
                </a>
                <div class="about-fan text-center">
                    <a href="#"><span ><?php echo $this->M_user->get_name($fan['user_id'])?></span></a>
                </div>
                
            </div>
        <?php 
} ?> 
    </div>
</div>
<script type="text/javascript">
    function confirmDialog() {
        return confirm("Are you sure you want to delete this record?")
    }
</script>