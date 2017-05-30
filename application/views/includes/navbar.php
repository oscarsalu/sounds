<?php
if (isset($user_data['id'])) {
    ?>
    <script>
       var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
       var page_url                  = '<?php echo base_url(); ?>';
       var $user_data                ="<?php echo $user_data['id']?>";       
    </script>
    <script src="<?php echo base_url(); ?>assets/js/detail_pages/include/navbar.js"></script>
    <?php

}
?>

<!--Main Menu File-->
<!--For Demo Only (Remove below css file and Javascript) -->
<div class="wsmenucontainer clearfix"></div>
<div class="wsmenucontent overlapblackbg "></div>        
<div class="wsmenuexpandermain slideRight">
	<a id="navToggle" class="animated-arrow slideLeft "><span></span></a>
	<a href="<?php echo base_url(); ?>" class="smallogo"><img src="<?php echo base_url(); ?>assets/logos/logo-07.png" width="120" alt=""></a>
	<?php if (!empty($user_data['id'])) {
    $notyfi_ = $this->M_notify->getnotify($user_data['id'], 1); ?>
        <div class="callusicon dropdown notifications">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-globe"></i>
            <?php if (count($notyfi_) != 0) {
    ?><span class="badge bg-lightred"><?php echo count($notyfi_)?></span><?php

} ?>
            </a>
            <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInLeft">
                <div class="panel-heading">
                    You have <strong><?php echo count($notyfi_)?></strong> notifications unread
                </div>
                <ul class="list-group">
                    <?php 
                    $notify = $this->M_notify->getnotify($user_data['id']);
    foreach ($notify as $row) {
        if ($row['type'] == 'invite') {
            $link = base_url().'chat/dashboard';
        } elseif ($row['type'] == 'amper_register') {
            $link = base_url().'amper/dashboard_affiliates';
        } elseif ($row['type'] == 'amper_register') {
            $link = base_url().'amper/dashboard_affiliates';
        } elseif ($row['type'] == 'Invite tour') {
            $link = $row['active_url'];
        } else {
            $link = '#';
        }
                        //var_dump($link);exit;
                        ?>
                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media" href="<?=$link?>">
                                <div class="media-body">
                                
                                    <span class="block"><?php echo  $row['messages']?></span>
                                    <small class="text-muted"><?php echo $this->M_user->time_calculation($row['time'])?></small>
                                
                                </div>
                            </a>
                        </li>
                        <?php

    } ?>  
                </ul>
                <div class="panel-footer">
                    <a href="<?=base_url('notifications/all')?>" role="button" tabindex="0">Show all notifications <i class="fa fa-angle-right pull-right"></i></a>
                </div>
            </div>
        </div>
        <?php

}?>  
          
</div>
<?php 
$params1 = $this->uri->segment(1);
$params2 = $this->uri->segment(2);
if (($params1 == 'mds' || ($params1 == 'artist' && $params2 == 'amp') || ($params1 == 'artist' && $params2 == 'managerrpk') || $params1 == 'chat' || $params1 == 'social_media' || $params1 == 'the_total_tour') && $user_data['role'] > 2) {
    header('Location: '.base_url());
    exit;
}
?>
<div class="header">
	<div class="wrapper clearfix bigmegamenu"> 
        <?php if (isset($user_data['id']) && $user_data['role'] == 1) {
    ?>
        <nav class="slideLeft ">
            <ul class="mobile-sub wsmenu-list wsmenu-list-left_logo">
            <!--view login with account artists -->
                <li>
                    <a href="<?php echo base_url(); ?>" title=""><img  src="<?php echo base_url(); ?>assets/logos/logo-07.png" alt="" /></a>
					 <?php 
                        if ($params1 == null) {
                            ?>
                            <ul class="wsmenu-submenu" style="min-width: 160px;">
                                <li ><a href="<?php echo base_url("features/artist");?>"><i class="fa fa-arrow-circle-right"></i>Artist</a></li>
                                <li ><a href="<?php echo base_url("features/fan");?>"><i class="fa fa-arrow-circle-right"></i>Fan</a></li>
                                <li><a href="#worldwide"><i class="fa fa-arrow-circle-right"></i>Worldwide Featured Artist</a></li>
                                <li><a href="#local"><i class="fa fa-arrow-circle-right"></i>Local-Featured Artist</a></li>
                                <li><a href="<?php echo base_url("mds");?>"><i class="fa fa-arrow-circle-right"></i>Music Distribution System</a></li>
                                <li><a href="<?php echo base_url("features/artist#artist_landing");?>"><i class="fa fa-arrow-circle-right"></i>ALP</a></li>
                                <!--<li><a href="#epk"><i class="fa fa-arrow-circle-right"></i>Electronic Press Kit</a></li>-->
                                <li><a href="<?php echo base_url("features/artist#ttt");?>"><i class="fa fa-arrow-circle-right"></i>The Total Tour</a></li>
                                <li><a href="<?php echo base_url("make_money");?>"><i class="fa fa-arrow-circle-right"></i>Artist Music Player</a></li>
                                <li><a href="<?php echo base_url("features/artist#social_media");?>"><i class="fa fa-arrow-circle-right"></i>One Stop Social Media</a></li>
                                <li><a href="<?php echo base_url("features/artist#gigs_events");?>"><i class="fa fa-arrow-circle-right"></i>Gigs & Events</a></li>
                                <!--<li><a href="#dashboard"><i class="fa fa-arrow-circle-right"></i>Dashboard Chat</a></li>-->
                                <li><a href="<?php echo base_url("features/artist#music_referral");?>"><i class="fa fa-arrow-circle-right"></i>Musicians Referral</a></li>
                            </ul>
                            <?php

                        } ?>
				</li>
            </ul>
        </nav>
        <?php 
} else {
    ?>
		  <div class="logo"><a href="<?php echo base_url(); ?>" title=""><img  src="<?php echo base_url(); ?>assets/logos/logo-07.png" alt="" /></a></div>
        <?php 
}?>
		<!--Main Menu HTML Code-->
		<nav class="wsmenu slideLeft ">
			<ul class="mobile-sub wsmenu-list wsmenu-list-left">
                <?php if (isset($user_data)) {
    $check_upgrade = $this->M_user->check_upgrade($user_data['id']);
    if (isset($user_data['id']) && $user_data['role'] == 1 && $user_data['is_admin'] == 1) {
        ?>
                        <!--view login with account ADMIN -->
        				<li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'blogs' || $params1 == 'gigs_events' || $params1 == 'find-a-musician' || $params1 == 'find-a-fan' || $params1 == 'find-an-artist' || $params2 == 'find-a-fan' || $params2 == 'find-an-artist' || $params2 == 'world_wide_featured') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Artists & Fans<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                                <li <?php if ($params1 == 'blogs') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('blogs') ?>"><i class="fa fa-arrow-circle-right"></i>Blogs</a></li>
                                <li><a <?php if ($params1 == 'gigs_events') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('gigs_events') ?>"><i class="fa fa-arrow-circle-right"></i>Book A Show</a></li>
                                <li><a <?php if ($params1 == 'find-a-musician') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('find-a-musician') ?>"><i class="fa fa-arrow-circle-right"></i>Musicians Referral</a></li>
                                <li><a <?php if ($params2 == 'find-a-fan') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/find-a-fan') ?>"><i class="fa fa-arrow-circle-right"></i>Find A Fan</a></li>
                                <li><a <?php if ($params2 == 'find-an-artist') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/find-an-artist') ?>"><i class="fa fa-arrow-circle-right"></i>Find AN Artist</a></li>
                                
        					   
                            </ul>
        				</li>
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'new-treding' || $params1 == 'hot_video_picks' || $params1 == 'fancapture' || $params2 == 'hot_video_picks' || $params2 == 'new-trending') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Our Artist's Music <span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<li <?php if ($params1 == 'fancapture') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('fancapture') ?>"><i class="fa fa-arrow-circle-right"></i>Meet Our Artist</a></li>
                                <!--<li><a <?php if ($params2 == 'new-trending') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/new-trending') ?>"><i class="fa fa-arrow-circle-right"></i>New & Trending</a></li>-->
 <li><a <?php if ($params2 == 'world_wide_featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('world_wide_featured') ?>"><i class="fa fa-arrow-circle-right"></i>World Wide Featured Artist</a></li>
                                <li><a <?php if ($params2 == 'hot_video_picks') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/hot_video_picks') ?>"><i class="fa fa-arrow-circle-right"></i>Hot Video Picks</a></li>
                            </ul>
        				</li>
                        
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'artists' || $params1 == 'make_money' || $params1 == 'top-100-list' || $params1 == 'fancapture') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Earn Money<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
						        <li <?php if ($params1 == 'artists') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('artists') ?>"><i class="fa fa-arrow-circle-right"></i>Create AMP-Video</a></li>
                                <li <?php if ($params1 == 'make_money') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url(); ?>make_money"><i class="fa fa-arrow-circle-right"></i>Artist Music Player</a></li>
                            	<!--<li <?php if ($params1 == '#') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('#') ?>"><i class="fa fa-arrow-circle-right"></i>How to Earn Money</a></li>
                                <li <?php if ($params1 == '#') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url(); ?>#"><i class="fa fa-arrow-circle-right"></i>Signup - AMP</a></li>-->
                                <li <?php if ($params1 == 'fancapture') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('fancapture') ?>"><i class="fa fa-arrow-circle-right"></i>Fan Capture</a></li>
                                <li><a <?php if ($params1 == 'top-100-list') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('top-100-list') ?>"><i class="fa fa-arrow-circle-right"></i>Top 100 Fans - Amp Sales</a></li>
                            </ul>
        				</li>
                        <li>
                            <span class="wsmenu-click"></span>
                            <a <?php if ($params1 == 'mds' || ($params1 == 'artist' && $params2 == 'amp') || ($params1 == 'artist' && $params2 == 'dashboard_epk') || $params1 == 'chat' || $params1 == 'social_media' || $params1 == 'the_total_tour') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-hand-pointer-o"></i>&nbsp;&nbsp;Tool<span class="arrow"></span></a>
        						<ul class="wsmenu-submenu" style="min-width: 160px;">
                                    <li><a <?php if ($params1 == 'the_total_tour') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('the_total_tour') ?>"><i class="fa fa-arrow-circle-right"></i>The Total Tour</a></li>
                                    <li><a <?php if ($params1 == 'mds') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('mds') ?>"><i class="fa fa-arrow-circle-right"></i>MDS</a></li>
                                   	<li><a <?php if ($params1 == 'artist' && $params2 == 'dashboard_epk') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/dashboard_epk')?>"><i class="fa fa-arrow-circle-right"> </i>EPK</a></li>
                                    <li><a <?php if ($params1 == 'chat') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('chat/dashboard') ?>"><i class="fa fa-arrow-circle-right"> </i>Dashboard Chat</a></li>
                                    <li><a <?php if ($params1 == 'social_media') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('social_media') ?>"><i class="fa fa-arrow-circle-right"></i>Social media</a></li>
                                </ul>
        				</li>
                        
                        <li>
                			<span class="wsmenu-click"></span><a <?php if (($params1 == 'artist' && $params2 != 'amp') && $params2 != 'dashboard_epk' && $params2 != 'profile') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-heartbeat"></i>&nbsp;&nbsp;Dashboard<span class="arrow"></span></a>
                			 <ul class="wsmenu-submenu" style="min-width: 160px;">
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'managersong') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managersong') ?>"><i class="fa fa-arrow-circle-right"></i>Songs</a></li>
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'managervideo') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managervideo') ?>"><i class="fa fa-arrow-circle-right"></i>Videos</a></li>
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'managerphoto') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managerphoto') ?>"><i class="fa fa-arrow-circle-right"></i>Photos</a></li>
                                <li><a <?php if ($params1 == 'artist' && $params2 == 'manager-comment') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/manager-comment')?>"><i class="fa fa-arrow-circle-right"></i>Comments</a></li>
                                <li><a <?php if ($params1 == 'artist' && $params2 == 'managerpress') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managerpress') ?>"><i class="fa fa-arrow-circle-right"></i>Press</a></li>
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'blogsmanager') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/blogsmanager') ?>"><i class="fa fa-arrow-circle-right"></i>Blogs</a></li>
            				    <li><a <?php if ($params1 == 'artist' && $params2 == 'basic_info') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/basic_info'); ?>"><i class="fa fa-arrow-circle-right"></i>Customize Profile</a></li>
                            </ul>	
                		</li>
                        
                        <li class="top120">
        					<span class="wsmenu-click"></span><a <?php if ($params2 == 'stop_typing' || $params1 == 'hot_video_picks') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Social Media<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<!-- TODO: <li <?php if ($params2 == 'stop_typing') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('social_media/stop_typing') ?>"><i class="fa fa-arrow-circle-right"></i>1 stop typing</a></li> -->
                                <li <?php if ($params1 == 'hot_video_picks') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/hot_video_picks') ?>"><i class="fa fa-arrow-circle-right"></i>Top 100 Fans - Amp Sales</a></li>
        					</ul>
        				</li>

        				<li class="top120">
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'new_artist') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Music Pages<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                                <li <?php if ($params1 == 'new_artist') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('new_artist') ?>"><i class="fa fa-arrow-circle-right"></i>New Artist</a></li>
                            </ul>
        				</li>
                        
                        <li class="top120">
        					<span class="wsmenu-click"></span><a <?php if ($params1 == 'features') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Features<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<li <?php if ($params2 == 'fan') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/fan') ?>"><i class="fa fa-arrow-circle-right"></i>Fan Feature</a></li>
                                <li <?php if ($params2 == 'artist') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/artist') ?>"><i class="fa fa-arrow-circle-right"></i>Artist Feature</a></li>  
                                <li <?php if ($params2 == 'fan_feature') {
    echo 'class="activesub"';
} ?>><a  href="<?php echo base_url('features/fan_feature') ?>"><i class="fa fa-arrow-circle-right"></i>Fan Features</a>
        					
        				        </li>
                            </ul>
        				</li>

                        
        				<li class="top120">
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'local-featured') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Meet Our Artists<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                                
                                <li><a <?php if ($params1 == 'local-featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('local-featured') ?>"><i class="fa fa-arrow-circle-right"></i>Local Featured Artist</a></li>
                            </ul>
        				</li>
                        <!--
                        <li class="top120">
                            <li <?php if ($params1 == 'gigs_events') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('gigs_events') ?>"><i class="fa fa-music"></i>&nbsp;&nbsp;SHOWs</a></li>

        				</li>-->
                        <li class="top120">
                            <li <?php if ($params1 == '#') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('#') ?>"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</a>
        				</li>
                        
                          
                     <?php 
    } elseif (isset($user_data['id']) && $user_data['role'] == 1) {
        ?>
                    <!--view login with account artists -->
        				<li>
                            <span class="wsmenu-click"></span><a <?php if (($params1 == 'artist' && $params2 == 'showgigs') || $params1 == 'blogs' || $params1 == 'gigs_events' || $params1 == 'find-a-musician' || $params1 == 'find-a-fan' || $params1 == 'find-an-artist' || $params2 == 'find-a-fan' || $params2 == 'find-an-artist'|| $params2 == 'world_wide_featured') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Artists & Fans<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                                <li <?php if ($params1 == 'blogs') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('blogs') ?>"><i class="fa fa-arrow-circle-right"></i>Blogs</a></li>
                                <li><a <?php if ($params1 == 'gigs_events') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('gigs_events') ?>"><i class="fa fa-arrow-circle-right"></i>Book A Show</a></li>
                                <li><a <?php if ($params1 == 'find-a-musician') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('find-a-musician') ?>"><i class="fa fa-arrow-circle-right"></i>Musicians Referral</a></li>
                                <li><a <?php if ($params2 == 'find-a-fan') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/find-a-fan') ?>"><i class="fa fa-arrow-circle-right"></i>Find A Fan</a></li>
                                <li><a <?php if ($params2 == 'find-an-artist') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/find-an-artist') ?>"><i class="fa fa-arrow-circle-right"></i>Find AN Artist</a></li>
                                <!--<li><a <?php if ($params2 == 'showgigs') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/my_location') ?>"><i class="fa fa-arrow-circle-right"></i>Find AN Location</a></li>-->
        					   <li><a <?php if ($params2 == 'showgigs') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/showgigs') ?>"><i class="fa fa-arrow-circle-right"></i>Gig Finder</a></li>
                            </ul>
        				</li>
                        
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'new-treding' || $params1 == 'hot_video_picks' || $params1 == 'fancapture' || $params2 == 'hot_video_picks' || $params2 == 'new-trending') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Our Artist's Music <span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<li <?php if ($params1 == 'fancapture') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('fancapture') ?>"><i class="fa fa-arrow-circle-right"></i>Meet Our Artist</a></li>
                                <!--<li><a <?php if ($params2 == 'new-trending') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/new-trending') ?>"><i class="fa fa-arrow-circle-right"></i>New & Trending</a></li>-->
<li><a <?php if ($params2 == 'world_wide_featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('world_wide_featured') ?>"><i class="fa fa-arrow-circle-right"></i>World Wide Featured Artist</a></li>
                                <li><a <?php if ($params2 == 'hot_video_picks') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/hot_video_picks') ?>"><i class="fa fa-arrow-circle-right"></i>Hot Video Picks</a></li>
                            </ul>
        				</li>
                        
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'artists' || $params1 == 'make_money' || $params1 == 'top-100-list') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Earn Money<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                            	<li <?php if ($params1 == 'make_money') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('make_money') ?>"><i class="fa fa-arrow-circle-right"></i>How to Earn Money</a></li>
                                <!--<li <?php if ($params1 == '#') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('#'); ?>"><i class="fa fa-arrow-circle-right"></i>Signup - AMP</a></li>-->
                                <li <?php if ($params1 == 'fancapture') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('fancapture') ?>"><i class="fa fa-arrow-circle-right"></i>FCP</a></li>
                                <li><a <?php if ($params1 == 'top-100-list') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('top-100-list') ?>"><i class="fa fa-arrow-circle-right"></i>Top 100 Fans - Amp Sales</a></li>
                            </ul>
        				</li>
                        <li>
                            <span class="wsmenu-click"></span>
                            <a <?php if ($params1 == 'mds' || ($params1 == 'artist' && $params2 == 'amp') || ($params1 == 'artist' && $params2 == 'dashboard_epk') || $params1 == 'chat' || $params1 == 'social_media' || $params1 == 'the_total_tour') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-hand-pointer-o"></i>&nbsp;&nbsp;Tool<span class="arrow"></span></a>
        						<ul class="wsmenu-submenu" style="min-width: 160px;">
                                    <li><a <?php if ($params1 == 'the_total_tour') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('the_total_tour') ?>"><i class="fa fa-arrow-circle-right"></i>The Total Tour</a></li>
                                    <li><a <?php if ($params1 == 'mds') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('mds') ?>"><i class="fa fa-arrow-circle-right"></i>MDS</a></li>
                                   	<li><a <?php if ($params1 == 'artist' && $params2 == 'dashboard_epk') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/dashboard_epk')?>"><i class="fa fa-arrow-circle-right"> </i>EPK</a></li>
                                    <li><a <?php if ($params1 == 'chat') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('chat/dashboard') ?>"><i class="fa fa-arrow-circle-right"> </i>Dashboard Chat</a></li>
                                    <li><a <?php if ($params1 == 'social_media') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('social_media') ?>"><i class="fa fa-arrow-circle-right"></i>Social media</a></li>
                                </ul>
        				</li>
                        
                        <li>
                			<span class="wsmenu-click"></span><a <?php if (($params1 == 'artist' && $params2 != 'amp' && $params2 != 'showgigs' && $params2 != 'dashboard_epk') && $params2 != 'managerrpk' && $params2 != 'profile') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-heartbeat"></i>&nbsp;&nbsp;Dashboard<span class="arrow"></span></a>
                            <ul class="wsmenu-submenu" style="min-width: 160px;">
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'managersong') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managersong') ?>"><i class="fa fa-arrow-circle-right"></i>Songs</a></li>
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'managervideo') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managervideo') ?>"><i class="fa fa-arrow-circle-right"></i>Videos</a></li>
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'managerphoto') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managerphoto') ?>"><i class="fa fa-arrow-circle-right"></i>Photos</a></li>
                                <li><a <?php if ($params1 == 'artist' && $params2 == 'manager-comment') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/manager-comment')?>"><i class="fa fa-arrow-circle-right"></i>Comments</a></li>
                                <li><a <?php if ($params1 == 'artist' && $params2 == 'managerpress') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managerpress') ?>"><i class="fa fa-arrow-circle-right"></i>Press</a></li>
            					<li><a <?php if ($params1 == 'artist' && $params2 == 'blogsmanager') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/blogsmanager') ?>"><i class="fa fa-arrow-circle-right"></i>Blogs</a></li>
            				    <li><a <?php if ($params1 == 'artist' && $params2 == 'basic_info') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/basic_info'); ?>"><i class="fa fa-arrow-circle-right"></i>Customize Profile</a></li>
                            </ul>	
                		</li>
                    <?php 
    } elseif (isset($user_data['id']) && $user_data['role'] == 2) {
        ?>
                        <!--view login with account fans -->
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params2 == 'fan_feature') {
    echo 'class="active"';
} ?> href="<?php echo base_url('features/fan_feature') ?>">Fan Features</a>
        				</li>
                        <li>
        					<span class="wsmenu-click"></span><a <?php if ($params2 == 'stop_typing' || $params1 == 'top-100-list') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Social Media<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<!-- TODO: <li <?php if ($params2 == 'stop_typing') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('social_media/stop_typing') ?>"><i class="fa fa-arrow-circle-right"></i>1 stop typing</a></li> -->
                                <li <?php if ($params1 == 'top-100-list') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('top-100-list') ?>"><i class="fa fa-arrow-circle-right"></i>Top 100 Fans - Amp Sales</a></li>
        					</ul>
        				</li>
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'findamusician' || $params1 == 'artists' || $params1 == 'make_money' || $params1 == 'top-100-list') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Earn Money<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<li <?php if ($params1 == 'artists') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('artists') ?>"><i class="fa fa-arrow-circle-right"></i>Create AMP-Video</a></li>
                                 <li <?php if ($params1 == 'make_money') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url(); ?>make_money"><i class="fa fa-arrow-circle-right"></i>Artist Music Player</a></li>
        						<li <?php if ($params1 == 'top-100-list') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('top-100-list') ?>"><i class="fa fa-arrow-circle-right"></i>Top 100 Fans - Amp Sales</a></li>
                            </ul>
        				</li>
        				<li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'fancapture' || $params2 == 'hot_video_picks' || $params1 == 'new-treding') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Music Pages<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                                <li <?php if ($params1 == 'fancapture') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('fancapture') ?>"><i class="fa fa-arrow-circle-right"></i>Meet Our Artist</a></li>
                                <li><a <?php if ($params2 == 'hot_video_picks') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('features/hot_video_picks') ?>"><i class="fa fa-arrow-circle-right"></i>Hot Video Picks</a></li>
                                <li <?php if ($params1 == 'features/new-trending') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/new-trending') ?>"><i class="fa fa-arrow-circle-right"></i>Trending Artist</a></li>
                                <li><a <?php if ($params2 == 'world_wide_featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('world_wide_featured') ?>"><i class="fa fa-arrow-circle-right"></i>World Wide Featured Artist</a></li>
                                <li <?php if ($params1 == 'new_artist') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('new_artist') ?>"><i class="fa fa-arrow-circle-right"></i>New Artist</a></li>
                            </ul>
        				</li>
                       <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'amp' && $params2 == $user_data['home_page']) {
    echo 'class="active"';
} ?> href="<?php echo base_url('amp/'.$user_data['home_page']) ?>"><i class="fa fa-music"></i>&nbsp;&nbsp;Fan Landing</a>
    					</li>
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'find-a-show') {
    echo 'class="active"';
} ?> href="<?php echo base_url('find-a-show') ?>"><i class="fa fa-music"></i>&nbsp;&nbsp;Find A Show</a>
        				</li>
                        <?php

    }//end account Fan
                ?>
                <?php 
} else {
    ?>
                        <!-- before login -->
                                            
        				<li>
        					<span class="wsmenu-click"></span><a <?php if ($params1 == 'features' && ($params2 != 'hot_video_picks')) {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Features<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<li <?php if ($params2 == 'fan') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/fan') ?>"><i class="fa fa-arrow-circle-right"></i>Fan Feature</a></li>
                                <li <?php if ($params2 == 'artist') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/artist') ?>"><i class="fa fa-arrow-circle-right"></i>Artist Feature</a></li>                    	
                            </ul>
        				</li>
                        
        				<li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'local-featured' || $params2 == 'hot_video_picks') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Meet Our Artists<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
                                <li <?php if ($params2 == 'hot_video_picks') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/hot_video_picks') ?>"><i class="fa fa-arrow-circle-right"></i>Hot Video Picks</a></li>
        					    
                                <li><a <?php if ($params1 == 'local-featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('local-featured') ?>"><i class="fa fa-arrow-circle-right"></i>Local Featured Artist</a></li>
        				        
        <li><a <?php if ($params2 == 'world_wide_featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('world_wide_featured') ?>"><i class="fa fa-arrow-circle-right"></i>World Wide Featured Artist</a></li>
                            </ul>
        				</li>
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'findamusician' || $params1 == 'artists' || $params1 == 'make_money' || $params1 == 'top-100-list') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Earn Money<span class="arrow"></span></a>
        					<ul class="wsmenu-submenu" style="min-width: 160px;">
        						<li <?php if ($params1 == 'artists') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('artists') ?>"><i class="fa fa-arrow-circle-right"></i>Create AMP-Video</a></li>
                                 <li <?php if ($params1 == 'make_money') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url(); ?>make_money"><i class="fa fa-arrow-circle-right"></i>Artist Music Player</a></li>
        						<li <?php if ($params1 == 'top-100-list') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('top-100-list') ?>"><i class="fa fa-arrow-circle-right"></i>Top 100 Fans - Amp Sales</a></li>
                            </ul>
        				</li>
                        
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'gigs_events') {
    echo 'class="active"';
} ?> href="<?php echo base_url('gigs_events') ?>"><i class="fa fa-music"></i>&nbsp;&nbsp;SHOWs</a>
                        </li>

                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == '#') {
    echo 'class="active"';
} ?> href="<?php echo base_url('#') ?>"><i class="fa fa-music"></i>&nbsp;&nbsp;Search</a>
                        </li>

                <?php 
}?>
            </ul>
            
            <ul class="mobile-sub wsmenu-list wsmenu-list-right">
                <?php 
                if (isset($user_data)) {
                    ?>
                    <li>
    					<span class="wsmenu-click"></span><a <?php if (($params1 == 'account' && $params2 == 'credit') || ($params1 == 'subscriptions' && $params2 == 'upgrade') || ($params1 == 'artist' && $params2 == 'profile')) {
    echo 'class="active"';
}
if($user_data['role'] == 1)
{
  $image_url =  $this->M_user->get_avata($user_data['id']);
}
else{
    $image_url =  $this->M_user->get_avata_flp($user_data['id']);
}
?> href="#"><img src="<?php echo $image_url?>" width="30"/> <span><?php echo $this->M_user->get_name($user_data['id'])?></span><span class="arrow"></span></a>
    					<ul class="wsmenu-submenu responsive_menu" style="min-width: 160px;">
    						<?php
                                if ($user_data['role'] == 1) {
                                    if ($user_data['is_admin'] != 0) {
                                        ?>
                                        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-tachometer"></i>Admin Dashboard</a></li>
                                    <?php 
                                    } ?>
                                    <li><a <?php if ($params1 == 'artist' && $params2 == 'profile') {
    echo 'class="activesub"';
} ?>  href="<?php echo base_url('artist/profile') ?>"><i class="fa fa-tachometer"></i> Create Profile</a></li>
                                    <li><a <?php if ($params1 == 'amper' && $params2 == 'dashboard') {
    echo 'class="activesub"';
} ?>href="<?php echo base_url('amper/dashboard') ?>"><i class="fa fa-arrow-circle-right"></i>Music-Player Dashboard</a></li>
                                    <?php 
                                    if ($check_upgrade) {
                                        
                                        ?><li><a <?php if ($params1 == 'subscriptions' && $params2 == 'subscriptions_plan') {
    echo 'class="activesub"';
} ?>  href="<?php echo base_url('subscriptions/subscriptions_plan') ?>"><i class="fa fa-tachometer"></i> Subscriptions & Billing</a></li>
                                        <?php

                                    } ?>
                                    <!--<li><a <?php if ($params1 == 'subscriptions' && $params2 == 'upgrade') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('subscriptions/upgrade') ?>"><i class="fa fa-tachometer"></i> Upgrade Subscriptions </a></li>
                                    <li><a <?php if ($params1 == 'subscriptions' && $params2 == 'featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('subscriptions/featured') ?>"><i class="fa fa-tachometer"></i> Upgrade Subscription – Homepage Placement – Get Fans, Get Noticed! </a></li>-->
                                    <li><a href="<?php echo base_url('account/logout') ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                                    <?php

                                } elseif ($user_data['role'] == 2) {
                                    ?>
                                    <li><a <?php if ($params1 == 'amper' && $params2 == 'dashboard') {
    echo 'class="activesub"';
} ?>href="<?php echo base_url('amper/dashboard') ?>"><i class="fa fa-arrow-circle-right"></i>AMPER Dashboard</a></li>
                                    <?php 
                                    if ($check_upgrade) {
                                        ?><li><a <?php if ($params1 == 'subscriptions' && $params2 == 'subscriptions_plan') {
    echo 'class="activesub"';
} ?>  href="<?php echo base_url('subscriptions/subscriptions_plan') ?>"><i class="fa fa-tachometer"></i> Subscriptions/Billing </a></li>
                                        <?php

                                    } else {
                                        ?><li><a <?php if ($params1 == 'subscriptions' && $params2 == 'upgrade') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('subscriptions/upgrade') ?>"><i class="fa fa-tachometer"></i> Upgrade Subscriptions </a></li>
                                        <?php

                                    } ?>
                                        <li><a href="<?php echo base_url('chat/dashboard') ?>"><i class="fa fa-arrow-circle-right"></i>Dashboard Chat</a></li>
                                        <li><a href="<?php echo base_url('account/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                                    <?php

                                } else {
                                    ?>
                                    <li><a href="<?php echo base_url('account/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                                <?php

                                } ?>
    					</ul>
				    </li>
                    <?php

                } else {
                    ?>
                        <li><a <?php if ($params1 == 'account' && $params2 == 'signup') {
    echo 'class="active"';
} ?> href="<?php echo base_url('account/signup') ?>"><i class="fa fa-user-plus"></i> Join</a></li>
                        <li><a <?php if ($params1 == 'account' && $params2 == 'login') {
    echo 'class="active"';
} ?> href="<?php echo base_url('account/login') ?>"><i class="fa fa-sign-in"></i> Login</a></li>
                        
                    <?php

                }
                ?>
                <?php if (!empty($user_data['id'])) {
    $notyfi_ = $this->M_notify->getnotify($user_data['id'], 1); ?>
                    <li class=" dropdown notifications noti2 ">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-globe" style="font-size:2em;display: block!important"></i>
                        <?php if (count($notyfi_) != 0) {
    ?><span class="badge bg-lightred"><?php echo count($notyfi_)?></span><?php

} ?>
                        </a>
                        <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInLeft">
                            <div class="panel-heading">
                                You have <strong><?php echo count($notyfi_)?></strong> notifications unread
                            </div>
                            <ul class="list-group">
                                <?php 
                                $notify = $this->M_notify->getnotify($user_data['id']);
    foreach ($notify as $row) {
        if ($row['type'] == 'invite') {
            $link = base_url().'chat/dashboard';
        } elseif ($row['type'] == 'amper_register') {
            $link = base_url().'amper/dashboard_affiliates';
        } elseif ($row['type'] == 'amper_register') {
            $link = base_url().'amper/dashboard_affiliates';
        } elseif ($row['type'] == 'Invite tour') {
            $link = $row['active_url'];
        } else {
            $link = '#';
        } ?>
                                    <li class="list-group-item">
                                        <a role="button" tabindex="0" class="media" href="<?=$link?>">
                                            <div class="media-body">
                                                <span class="block"><?php echo  $row['messages']?></span>
                                                <small class="text-muted"><?php echo $this->M_user->time_calculation($row['time'])?></small>
                                            </div>
                                        </a>
                                    </li>
                                    <?php

    } ?>
                            </ul>
                            <div class="panel-footer">
                                <a href="<?=base_url('notifications/all')?>" role="button" tabindex="0">Show all notifications <i class="fa fa-angle-right pull-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <?php

}?>  
                
			</ul>
		</nav>
		<!--Menu HTML Code--> 
	</div>
</div>
<div class="padingheader-top"></div>
