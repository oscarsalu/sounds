<html>
<head>
    <title>sound</title>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/access.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/page-4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script type="text/javascript">
	    new WOW().init();        
	</script>
</head>
<body>

 <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

        <!--  <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">Cover</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </nav>
            </div>
          </div>-->

          <div class="inner cover">
              <div class="form-signin">
        <h2 class="form-signin-heading">Please Access In</h2>
       <!--<label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>-->
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="inputPassword"  required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <input type="hidden" name="redirect_url" id="redirect_url" value="<?php if(isset($_GET['redirect_url'])){ echo $_GET['redirect_url']; }?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn-access">Access</button>
  
          </div>
          </div>
          <div class="mastfoot">
            <div class="inner">
              <p>Copyright  &copy OSK Programmers <?php echo date('Y');?></p>
            </div>
          </div>

        </div>

      </div>

    </div>

<script type="text/javascript">
    $("#btn-access").click(function() {        
        //if(e.which == 13) {
            $pass = $('#inputPassword').val();
            $redirect_url=$('#redirect_url').val();
            
            $url = "<?php echo base_url(); ?>";
            $.ajax({
                url: $url+"access_login",
                type: "post",
                data: {
                    "pass":$pass,
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                },
                dataType: "json",               
                success:function(response){   
                    
                    if(response == "ok")
                    {                     
                        window.location = $redirect_url;
                    }else{
                        alert('Password enter not correct!');
                    }
                }
            }); 
        //}
    });
</script>
</body>
</html>