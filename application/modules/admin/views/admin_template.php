<!DOCTYPE html>
<html>

<head>
    <title>99Sound Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/bower_components/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/bower_components/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/bower_components/iCheck/skins/flat/_all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/bower_components/DataTables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/vendor/css/dataTables.bootstrap.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/admin/css/themes.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/css/custome_style.css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/jquery/dist/jquery.min.js"></script>

 </head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <?php $url = $this->uri->segment(2); 
                            if($url == "users"){?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Users</li>
                            </ol>
                        <?php }
                        if($url == "withdrawals"){?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Withdrawals</li>
                            </ol>
                        <?php }else if($url == "backgrounds"){ ?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Backgrounds</li>
                            </ol>
                        <?php }else if($url == "background-video"){ ?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Background Video</li>
                            </ol>
                        <?php }else if($url == "blogs"){ ?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Manager Blogs</li>
                            </ol>
                        <?php }else if($url == "template-land"){ ?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Template</li>
                            </ol>
                        <?php }else{ ?>
                            <ol class="breadcrumb navbar-breadcrumb">
                                <li class="active">Dashboard</li>
                            </ol>
                        <?php } ?>                            
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                        
                        <li class="dropdown profile">
                            <a href="<?php echo base_url(); ?>assets/template/admin/#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php if(isset($user_data['id'])){ echo $user_data['artist_name']; } ?><span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <img src="<?php if(isset($users[0]['filename'])){ echo base_url().'assets/uploads/'.$users[0]['id'].'/photo/'.$users[0]['filename']; }else{ echo base_url().'assets/images/default-img.gif'; } ?>" class="profile-img">
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"><?php if(!empty($users[0]['artist_name'])){ echo $users[0]['artist_name']; } ?></h4>
                                        <p><?php if(!empty($users[0]['email'])){ echo $users[0]['email']; } ?></p>
                                        <div class="btn-group margin-bottom-2x" role="group">                                            
                                            <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button>
                                            <a href="<?php if(isset($user_data['id'])){ echo base_url('account/logout'); } ?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>                                            
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title">99Sound Admin</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="<?php if($url == "dashboard"){ echo "active"; } ?>">
                                <a href="<?php echo base_url(); ?>admin/dashboard">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                                </a>
                                
                            </li>
                            <?php
                                if($this->M_user->check_role(11,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "users"){ echo "active"; } ?>">
                                        <a href="<?php echo base_url(); ?>admin/users">
                                            <span class="icon fa fa-users"></span><span class="title">Users</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(11,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "withdrawals"){ echo "active"; } ?>">
                                        <a href="<?php echo base_url(); ?>admin/withdrawals">
                                            <span class="icon fa fa-paypal"></span><span class="title">Withdrawals</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($user_data['is_admin']==1){
                                    ?>
                                    
                                     <li class="<?php if($url == "roles"){ echo "active"; } ?>">
                                        <a href="<?php echo base_url(); ?>admin/roles">
                                            <span class="icon fa fa-cogs"></span><span class="title">Roles</span>
                                        </a>
                                    </li>
                                    <?php
                                } 
                                
                                if($this->M_user->check_role(2,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "backgrounds"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/backgrounds">
                                            <span class="icon fa fa-desktop"></span><span class="title">Backgrounds</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(17,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "background-video"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/background-video">
                                            <span class="icon fa fa-file-video-o"></span><span class="title">Videos</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(16,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "setting"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/setting">
                                            <span class="icon fa fa-cog"></span><span class="title">Setting Informations</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(12,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "blogs"||$url == "manager_blogs"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/blogs">
                                            <span class="icon fa fa-book"></span><span class="title">Blogs</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(13,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "manager_chat"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/manager_chat">
                                            <span class="icon fa fa-comments"></span><span class="title">Chat</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(15,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "template-land"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/template-land">
                                            <span class="icon fa fa-file-image-o"></span><span class="title">Template Landing</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if($this->M_user->check_role(18,$user_data['id'])){
                                    ?>
                                    <li class="<?php if($url == "plan_setting"){ echo "active"; } ?>">
                                        <a style="" href="<?php echo base_url(); ?>admin/plan_setting">
                                            <span class="icon fa fa-asterisk"></span><span class="title">Plan Setting</span>
                                        </a>
                                    </li>
                                    <?php
                                }
                            ?>
                            
                            <li class="<?php if($url == "premium"){ echo "active"; } ?>">
                                <a style="" href="<?php echo base_url(); ?>admin/premium">
                                    <span class="icon fa fa-money"></span><span class="title">Premium report</span>
                                </a>
                            </li>
                             <li class="<?php if($url == "locations"){ echo "active"; } ?>">
                                <a style="" href="<?php echo base_url(); ?>admin/locations">
                                    <span class="icon fa fa-asterisk"></span><span class="title">Locations</span>
                                </a>
                            </li>
                            
                            <li class="<?php if($url == "invoices"){ echo "active"; } ?>">
                                <a style="" href="<?php echo base_url(); ?>admin/invoices">
                                    <span class="icon fa fa-file-text"></span><span class="title">Invoices</span>
                                </a>
                            </li>
                            <li class="<?php if($url == "subscriptions"){ echo "active"; } ?>">
                                <a style="" href="<?php echo base_url(); ?>admin/subscriptions">
                                    <span class="icon fa fa-star"></span><span class="title">Subscriptions</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <!-- global alert -->   
                    <?php if($this->session->flashdata('message_msg')){
                        ?>
                        <div class="alert alert-big alert-success alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4><strong>Success!</strong></h4>
                            <p> <?php echo $this->session->flashdata('message_msg')?></p>
                        </div>
                        <?php
                    }
                    if($this->session->flashdata('message_error')){
                        ?>
                        <div class="alert alert-big alert-lightred alert-danger alert-dismissable fade in">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4><strong>Error!</strong></h4>
                            <p> <?php echo $this->session->flashdata('message_error')?></p>
                        </div>
                        <?php
                    } 
                    ?>
                    <!-- Main Content -->
                    <?php echo $content; ?>                                                 
                </div>
            </div>
        </div>
        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right">2.0 <a href=""><i class="fa fa-long-arrow-up"></i></a></span> © 2015 Copyright.
            </div>
        </footer>
        <div>
            <!-- Javascript Libs -->            
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/chartjs/Chart.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/iCheck/icheck.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/matchHeight/jquery.matchHeight-min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/vendor/js/dataTables.bootstrap.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/vendor/js/ace/ace.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/vendor/js/ace/mode-html.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/vendor/js/ace/theme-github.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/js/jquery13.js"></script>
            
            <!-- Javascript -->
          
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/js/app.js"></script>
            <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/admin/js/index.js"></script>
</body>

</html>
