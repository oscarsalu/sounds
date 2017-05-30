<!--Main Menu File-->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/navbar/color-theme.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/navbar/webslidemenu.css">
<script type="text/javascript" src="<?php echo base_url()?>assets/js/navbar/webslidemenu.js"></script>
<script>
   var base_url       = '<?php echo base_url()?>';
   var $U_map         ="<?php echo $U_map['id']?>";   
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/amp/js/navbar.js"></script>
<!--Main Menu File-->
<!--For Demo Only (Remove below css file and Javascript) -->
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>assets/css/navbar/demo.css">
<div class="wsmenucontainer clearfix" style="margin-top: 0px;">
<div class="wsmenucontent overlapblackbg "></div>        
<div class="wsmenuexpandermain slideRight">
	<a id="navToggle" class="animated-arrow slideLeft "><span></span></a>
	<a href="<?php echo base_url(); ?>" class="smallogo"><img src="<?php echo base_url(); ?>assets/logos/logo-07.png" width="120" alt=""></a>
	<?php if (!empty($U_map['id'])) {
    $notyfi_ = $this->M_user->getnotify($U_map['id'], 1); ?>
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
                    $notify = $this->M_user->getnotify($U_map['id']);
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
?>
<div class="header">
	<div class="wrapper clearfix bigmegamenu">
		<div class="logo "><a href="<?php echo base_url(); ?>" title="Responsive Slide Menus"><img width="150px" src="<?php echo base_url(); ?>assets/logos/logo-07.png" alt="" /></a></div>
		<!--Main Menu HTML Code-->
		<nav class="wsmenu slideLeft ">
			<ul class="mobile-sub wsmenu-list wsmenu-list-left">
				<?php
                if (!empty($U_map)) {
                    $home_page = $this->M_user->get_home_page($U_map['user_id']); ?>
                    <li <?php if ($params1 == 'fap' && $params2 == $home_page) {
    echo 'class="active"';
} ?>><a href="<?php echo base_url('fap/'.$home_page) ?>"><i class="fa fa-arrow-circle-right"></i>Fan/Affiliate </a></li>
                    <li <?php if ($params1 == 'amp' && $params2 == 'dashboard') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url('amp/dashboard') ?>"><i class="fa fa-arrow-circle-right"></i>AMPER Dashboard</a></li>
                    <?php
                    if ($U_map['level'] <= 3) {
                        ?>
                        <li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Affiliates <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('map/manager_affiliates')?>">Manager Affiliates</a></li>
                            </ul>
                        </li>
                        <?php

                    } ?>
                    <?php

                }?>
			</ul>
            <ul class="mobile-sub wsmenu-list wsmenu-list-right">
                <?php 
                if (isset($U_map)) {
                    ?>
                    <li>
    					<span class="wsmenu-click"></span><a <?php if (($params1 == 'account' && $params2 == 'credit') || ($params1 == 'subscriptions' && $params2 == 'upgrade') || ($params1 == 'artist' && $params2 == 'profile')) {
    echo 'class="active"';
} ?> href="#"><img src="<?php echo $this->M_user->get_avata($U_map['id'])?>" width="30"/> <span><?php echo $this->M_affiliate->get_name($U_map['id'])?></span><span class="arrow"></span></a>
    					<ul class="wsmenu-submenu responsive_menu" style="min-width: 160px;">
                            <li><a href="<?php echo base_url('fap/logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
				    </li>
                    <?php

                } else {
                    ?>
                        <li><a <?php if ($params1 == 'fap' && $params2 == 'login') {
    echo 'class="active"';
} ?> href="<?php echo base_url('fap/login') ?>"><i class="fa fa-sign-in"></i> Login</a></li>
                        
                    <?php

                }
                ?>
                <?php if (!empty($U_map['id'])) {
    $notyfi_ = $this->M_user->getnotify($U_map['id'], 1); ?>
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
                                $notify = $this->M_user->getnotify($U_map['id']);
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