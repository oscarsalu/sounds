<script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/menu_artist.js"></script>
<?php
$params1 = $this->uri->segment(1);
$params2 = $this->uri->segment(2);
$params3 = $this->uri->segment(3);

?>
<div class="side-menu">
	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<div class="brand-wrapper">
				<!-- Hamburger -->
				<button type="button" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<!-- Brand -->
				<div class="brand-name-wrapper">
					<a class="navbar-brand" href="#">
					<?php echo $this->M_user->get_name($user_data['id']);?>
					</a>
				</div>
			</div>
		</div>
		<!-- Main Menu -->
		<div class="side-menu-container">
               
			<ul class="nav navbar-nav" style="margin: 0;">
      
				<li <?php if ($params1 == 'artist' && $params2 == 'managerphoto') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url(); ?>artist/managerphoto"><span class="fa fa-picture-o"></span> Photo Manager</a></li>
				<li <?php if ($params1 == 'artist' && $params2 == 'managersong') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url(); ?>artist/managersong"><span class="fa fa-music"></span> Playlist →Song Manager</a></li>
				<li <?php if ($params1 == 'artist' && $params2 == 'managervideo') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url(); ?>artist/managervideo"><span class="fa fa-film"></span> Video Manager</a></li>
                <li <?php if ($params1 == 'artist' && $params2 == 'managerpress') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url()?>artist/managerpress"><span class="fa fa-newspaper-o"></span> Press Manager</a></li>
				<li <?php if ($params1 == 'artist' && $params2 == 'blogsmanager') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url()?>artist/blogsmanager"><span class="fa fa-book"></span> Blog Manager</a></li>
				<li <?php if ($params1 == 'artist' && $params2 == 'managerevent') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url(); ?>artist/managerevent"><span class="fa fa-glass"></span> Gigs & Event Manager</a></li>
				<li <?php if ($params1 == 'artist' && $params2 == 'manager-comment') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url()?>artist/manager-comment"><span class="fa fa-commenting-o"></span> Comment Manager</a></li>
				<li <?php if ($params1 == 'artist' && $params2 == 'basic_info') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url()?>artist/basic_info"><span class="fa fa-cog"></span> Profile Manager</a></li>
        	<li <?php if ($params1 == 'artist' && $params2 == 'biomanager') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url()?>artist/biomanager"><span class="fa fa-cog"></span> Bio Manager</a></li>
             <li <?php if ($params1 == 'artist' && $params2 == 'lyricmanager') {
    echo 'class="active"';
} ?>><a href="<?php echo base_url()?>artist/lyricmanager"><span class="fa fa-cog"></span> Lyric Manager</a></li>           
                        
                        </ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>
</div>