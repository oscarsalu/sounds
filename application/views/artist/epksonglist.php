 
<?php  foreach($video_songs as $play){ ?>
   <?php if($play->type == "link" && strpos($play->link_video,"youtube.com")): ?>
	  <?php 
		$videoArr = explode("v=",$play->link_video);
		$videoId  = ""; 
		if(strpos($videoArr[1],'&'))
		{
			$temp = explode("&",$videoArr[1]);
			$videoId = $temp[0];	
		}
		else
			$videoId = $videoArr[1];
		
	  ?>
      <div class="col-md-3 card card-3 rmvsong ripplelink" id="song<?php echo $play->id;?>"  onClick="videofun(<?php echo $play->id;?>)" style="background-image:url(<?php echo 'https://img.youtube.com/vi/'.$videoId.'/default.jpg'; ?>)">
   <?php elseif($play->type == "file"):?>
      <div class="col-md-3 card card-3 rmvsong ripplelink" id="song<?php echo $play->id;?>"  onClick="videofun(<?php echo $play->id;?>)" style="background-image:url(<?php echo base_url().'uploads/'.$play->user_id.'/video/'.$play->cover_image ?>)">
   <?php else: ?>
      <div class="col-md-3 card card-3 rmvsong ripplelink" id="song<?php echo $play->id;?>"  onClick="videofun(<?php echo $play->id;?>)" style="background-image:url(<?php echo base_url();?>assets/images/music2.png)">
   <?php endif; ?>


<center><?php echo $play->name_video;?></center>

</div><?php } ?>



<style>
.card-4 {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  cursor:pointer;
}
.card:hover{
	z-index:1000;
  box-shadow:rgba(0, 0, 0, 0.3) 0 16px 16px 0;
  -webkit-box-shadow:rgba(0, 0, 0, 0.3) 0 16px 16px 0;
  -moz-box-shadow:rgba(0, 0, 0, 0.3) 0 16px 16px 0;
}

</style>