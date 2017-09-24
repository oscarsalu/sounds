<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="kesound | Connect with Fans" />
    <meta property="og:description"        content="kesound | Connect with Fans" />
    <meta name="google-signin-client_id" content="614939124466-0rsd0pptd6c443503hqrb2uss5smhbmu.apps.googleusercontent.com">
    <?php
    if (!empty($meta_rpk)) {
        ?>
        <meta property="og:url"  content="<?php echo base_url('artist/'.$user_data['home_page'])?>/presskit" />
        <meta property="og:image" content="<?php echo $avata?>" />    
        <?php

    } else {
        ?>
        <meta property="og:image" content="<?php echo base_url()?>assets/images/logo_sound99.png" />   
        <?php

    }
    ?>
    
    <link rel="canonical" href="<?php echo base_url(); ?>" />
    <link rel="canonical" href="https://dev.twitter.com/web/tweet-button">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="<?php echo base_url(); ?>assets/icon/57.png" />
    <title>Connect with Fans</title>
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url()?>home/combined_homepage_css"/>

    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
  
    <!-- Custom styles for this template -->
  
  

  
    <?php if (isset($custom_header)): ?>
        <?php echo $custom_header ?>
    <?php endif ?>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/navbar/webslidemenu.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
	    new WOW().init();        
	</script> 
</head>
<body>
    
    <script>
      window.___gcfg = {
        lang: 'en-US',
        parsetags: 'onload'
      };
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=<?php echo $this->config->item('facebook_app_id'); ?>";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
