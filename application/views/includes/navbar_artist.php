<!--Main Menu File-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/navbar/color-theme.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/navbar/webslidemenu.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/js/navbar/webslidemenu.js"></script>
<script>
var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>'; 
var $user_data    = "<?php echo $user_data['id']?>";
var base_url      = '<?php echo base_url()?>';
 
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/include/navbar_artist.js"></script>
<!--Main Menu File-->
<!--For Demo Only (Remove below css file and Javascript) -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/navbar/demo.css">
<div class="wsmenucontainer clearfix" style="margin-top: 0px;">
<div class="wsmenucontent overlapblackbg "></div>        
<div class="wsmenuexpandermain slideRight">
	<a id="navToggle" class="animated-arrow slideLeft "><span></span></a>
	<a href="<?php echo base_url(); ?>" class="smallogo"><img src="<?php echo base_url(); ?>assets/logos/logo-07.png" width="120" alt=""></a>
	<?php if (!empty($user_data['id'])) {
    $notyfi_ = $this->M_user->getnotify($user_data['id'], 1); ?>
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
                    $notify = $this->M_user->getnotify($user_data['id']);
    foreach ($notify as $row) {
        ?>
                        <li class="list-group-item">
                            <a role="button" tabindex="0" class="media" 
                            href="<?php if ($row['type'] == 'invite') {
    echo base_url('chat/dashboard');
}

        if ($row['type'] == 'subscription') {
            echo base_url('account/billing_history');
        } ?>">
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
                    <a role="button" tabindex="0">Show all notifications <i class="fa fa-angle-right pull-right"></i></a>
                </div>
            </div>
        </div>
        <?php

}?>  
          
</div>
<?php 
$params1 = $this->uri->segment(1);
$params2 = $this->uri->segment(2);
if (($params1 == 'mds' || ($params1 == 'artist' && $params2 == 'amp') || ($params1 == 'artist' && $params2 == 'managerrpk') || $params1 == 'chat' || $params1 == 'social_media' || $params1 == 'the_total_tour') && $user_data['role'] != 1) {
    header('Location: '.base_url());
    exit;
}
?>
<div class="header">
	<div class="wrapper clearfix bigmegamenu">
		<div class="logo "><a href="<?php echo base_url(); ?>" title="Responsive Slide Menus"><img width="150px" src="<?php echo base_url(); ?>assets/logos/logo-07.png" alt="" /></a></div>
		<!--Main Menu HTML Code-->
		<nav class="wsmenu slideLeft ">
            <ul class="mobile-sub wsmenu-list wsmenu-list-left">
				<li>
					<span class="wsmenu-click"></span><a <?php if ($params1 == 'features' || $params1 == 'make_money') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;Features<span class="arrow"></span></a>
					<ul class="wsmenu-submenu" style="min-width: 160px;">
						<li <?php if ($params2 == 'fan') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/fan') ?>"><i class="fa fa-arrow-circle-right"></i>Fan Feature</a></li>
                        <li <?php if ($params2 == 'artist') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('features/artist') ?>"><i class="fa fa-arrow-circle-right"></i>Artist Feature</a></li>
						<li <?php if ($params1 == 'make_money') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url(); ?>make_money"><i class="fa fa-arrow-circle-right"></i>Make Money</a></li>
					</ul>
				</li>
				<li>
                    <span class="wsmenu-click"></span><a <?php if ($params1 == 'gigs_events' || $params1 == 'findamusician' || $params1 == 'artists' || $params1 == 'fancapture' || $params1 == 'make_money1' || $params1 == 'amper') {
    echo 'class="active"';
}?> href="#"><i class="fa fa-music"></i>&nbsp;&nbsp;Artists & Fans<span class="arrow"></span></a>
					<ul class="wsmenu-submenu" style="min-width: 160px;">
						<li <?php if ($params1 == 'artists') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('artists') ?>"><i class="fa fa-arrow-circle-right"></i>List Artists</a></li>
                        <li <?php if ($params1 == 'fancapture') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('fancapture') ?>"><i class="fa fa-arrow-circle-right"></i>Fan Capture</a></li>
						<li <?php if ($params1 == 'blogs') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('blogs') ?>"><i class="fa fa-arrow-circle-right"></i>Blogs</a></li>
					   <li><a <?php if ($params1 == 'gigs_events') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('gigs_events') ?>"><i class="fa fa-arrow-circle-right"></i>Gigs &amp; Events</a></li>
				        <li><a <?php if ($params1 == 'find-a-musician') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('find-a-musician') ?>"><i class="fa fa-arrow-circle-right"></i>Find a Musician</a></li>
                        <li <?php if ($params1 == 'amper' && $params2 == 'dashboard') {
    echo 'class="activesub"';
} ?>><a href="<?php echo base_url('amper/dashboard') ?>"><i class="fa fa-arrow-circle-right"></i>Music-Player Dashboard</a></li>
                    </ul>
				</li>
                <?php 
                    if (isset($user_data['id']) && $user_data['role'] == 1) {
                        ?>
                        <li>
                            <span class="wsmenu-click"></span><a <?php if ($params1 == 'mds' || ($params1 == 'artist' && $params2 == 'amp') || ($params1 == 'artist' && $params2 == 'managerrpk') || $params1 == 'chat' || $params1 == 'social_media' || $params1 == 'the_total_tour') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-hand-pointer-o"></i>&nbsp;&nbsp;Tool<span class="arrow"></span></a>
        					
                				<ul class="wsmenu-submenu" style="min-width: 160px;">
                                    <li><a <?php if ($params1 == 'the_total_tour') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('the_total_tour') ?>"><i class="fa fa-arrow-circle-right"></i>The Total Tour</a></li>
                                    <li><a <?php if ($params1 == 'mds') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('mds') ?>"><i class="fa fa-arrow-circle-right"></i>MDS</a></li>
                                   	<li><a <?php if ($params1 == 'artist' && $params2 == 'managerrpk') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('artist/managerrpk')?>"><i class="fa fa-arrow-circle-right"> </i>EPK</a></li>
                                    <li><a <?php if ($params1 == 'chat') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('chat/dashboard') ?>"><i class="fa fa-arrow-circle-right"> </i>Dashboard Chat</a></li>
                                    <li><a <?php if ($params1 == 'social_media') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('social_media') ?>"><i class="fa fa-arrow-circle-right"></i>Social media</a></li>
                                </ul>
                				
        				</li>
                        
                        <li>
                			<span class="wsmenu-click"></span><a <?php if (($params1 == 'artist' && $params2 != 'amp') && $params2 != 'managerrpk' && $params2 != 'profile') {
    echo 'class="active"';
} ?> href="#"><i class="fa fa-heartbeat"></i>&nbsp;&nbsp;Dashboard Functionality<span class="arrow"></span></a>
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
                                <li><a <?php if ($params1 == 'artist' && $params2 == 'managersong12') {
    echo 'class="activesub"';
} ?> href="#"><i class="fa fa-arrow-circle-right"></i>Comments</a></li>
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

                    }
                    if (isset($user_data['id']) && $user_data['role'] == 3) {
                        ?>
                        <li <?php if ($params1 == 'amp' && $params2 == $user_data['home_page']) {
    echo 'class="active"';
} ?>><a href="<?php echo base_url('amp/'.$user_data['home_page']) ?>"><i class="fa fa-arrow-circle-right"></i>Fan/Affiliate </a></li>
                        <li <?php if ($params1 == 'amper' && $params2 == 'dashboard') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url('amper/dashboard') ?>"><i class="fa fa-arrow-circle-right"></i>AMPER Dashboard</a></li>
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
} ?> href="#"><img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" width="30"/> <span><?php echo $this->M_user->get_name($user_data['id'])?></span><span class="arrow"></span></a>
    					<ul class="wsmenu-submenu responsive_menu" style="min-width: 160px;">
    						<?php
                                if ($user_data['role'] == 1) {
                                    if (!empty($is_admin) && $is_admin == 1) {
                                        ?>
                                        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-tachometer"></i>Admin Dashboard</a></li>
                                    <?php 
                                    } ?>
                                    <li><a <?php if ($params1 == 'artist' && $params2 == 'profile') {
    echo 'class="activesub"';
} ?>  href="<?php echo base_url('artist/profile') ?>"><i class="fa fa-tachometer"></i> Create Profile</a></li>
                                    <?php
                                    if ($this->M_user->check_upgrade($user_data['id'])) {
                                        ?><li><a <?php if ($params1 == 'account' && $params2 == 'credit') {
    echo 'class="activesub"';
} ?>  href="<?php echo base_url('account/credit') ?>"><i class="fa fa-tachometer"></i> Credit Account </a></li>
                                        <?php

                                    } else {
                                        ?><li><a <?php if ($params1 == 'subscriptions' && $params2 == 'upgrade') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('subscriptions/upgrade') ?>"><i class="fa fa-tachometer"></i> Upgrade To Premium </a></li>
                                        <?php

                                    } ?>
                                    <li><a <?php if ($params1 == 'subscriptions' && $params2 == 'featured') {
    echo 'class="activesub"';
} ?> href="<?php echo base_url('subscriptions/featured') ?>"><i class="fa fa-tachometer"></i> Upgrade Subscription – Homepage Placement – Get Fans, Get Noticed! </a></li>
                                    <li><a href="<?php echo base_url('account/logout') ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                                    
                                    <?php

                                } else {
                                    ?>
                                    <li><a href="<?php echo base_url('chat/dashboard') ?>">Dashboard Chat</a></li>
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
    $notyfi_ = $this->M_user->getnotify($user_data['id'], 1); ?>
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
                                $notify = $this->M_user->getnotify($user_data['id']);
    foreach ($notify as $row) {
        ?>
                                    <li class="list-group-item">
                                        <a role="button" tabindex="0" class="media" href="<?php if ($row['type'] == 'invite') {
    echo base_url('chat/dashboard');
} ?>">
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
                                <a role="button" tabindex="0">Show all notifications <i class="fa fa-angle-right pull-right"></i></a>
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