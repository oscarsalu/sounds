<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Temp 2</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
</head>
<body >
<?php 
    $data_json = json_decode($customize['data_customize']);
?>


<table style="border-collapse: collapse;background-color:#F0F0F0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding:0 5px;" width="670px" cellspacing="0" cellpadding="0" border="0" align="center">
<table width="100%" style="font-family: Arial, 'Trebuchet MS', Verdana, sans-serif;">
<tr>
<td>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="670px" style="border-collapse: collapse;" >
<tr>
<td>

	<table width="670px">
		<tr>
			<td height="10"></td>
		</tr>
	</table>


	<table width="670px" bgcolor="#000">
		<tr>
			<td width="670px">
				<img src="<?php echo base_url(); ?>assets/logos/logo-07.png" style="width:250px">
			</td>
			<td></td>
		</tr>
	</table>
	<!--INFORMATION-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px;  background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>1.</td><td >INFOMATION</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<!-- <table width="670px" style="background: #fffafa;border-top:1px solid #CBD0D6;padding:20px">
		<tr style="">
			<td style="font-size:28px;padding-left:10px;color:#337AB7;">1. INFOMATION</td>
		</tr>
	</table> -->
	
	<table width="670px" style="background: #fffafa;">
		<tr style="">
			<td width="390">
				<table  cellpadding="0" cellspacing="0" style="font-weight: normal;color: #5F6263;">
					<!-- <tr style="height:30px">
						<th width="215">Gender Demographics</th>
						<th width="220">Age Breakdown</th>
					</tr> -->	
					<!-- <tr> --><!-- 
						 <td align="center" style="border-right: 2px dotted #CCC;">
							<p>No Data Available</p>	
						</td>  -->
						<td>
							<?php if ($data_json->stats == 'on') {
    ?>
							<table style="">
								<tr>
									<th width="50">13-17</th>
									<td width="150">
										<div style="background: #CCC; height: 20px;">
											<div style="background: #337AB7; height: 20px;width:<?php echo $this->Member_model->stast_fan($fans, 13, 17)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">18-24</td>
									<td width="150">
										<div style="background: #CCC; height: 20px;">
											<div style="background: #337AB7; height: 20px;width:<?php echo $this->Member_model->stast_fan($fans, 18, 24)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">25-34</td>
									<td width="150">
										<div style="background: #CCC; height: 20px;">
											<div style="background: #337AB7; height: 20px;width:<?php echo $this->Member_model->stast_fan($fans, 25, 34)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">35-44</td>
									<td width="150">
										<div style="background: #CCC; height: 20px;">
											<div style="background: #337AB7; height: 20px;width:<?php echo $this->Member_model->stast_fan($fans, 34, 44)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">45+</td>
									<td width="150">
										<div style="background: #CCC; height: 20px;">
											<div style="background: #337AB7; height: 20px;width:<?php echo $this->Member_model->stast_fan($fans, 44, 200)?>%"></div>
										</div>
									</td>
								</tr>
							</table>
						</td>
				<!-- 	</tr>	 -->
					<!-- <tr align="center">
						<td style="border-right:2px dotted #CCC;border-top:2px dotted #CCC;height:120px;"><?php echo count($fans)?>  fans</td>
						<th style="border-top:2px dotted #CCC;height:120px;">Fans Near
							<p>No Data Available</p></th>
					</tr> -->
					<tr align="center">
						<td colspan="2">*Fan demographics represent Sound fans only</td>
						
					</tr>
				</table>	
				<?php 
} ?>


			<td  width="140" align="center"> 
				<table>
					<tr >
						<td>
							 <?php if ($photo != 'notfound') {
    ?>
                                <img  src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/avatar.png"  width="150" height="150"/ style="border-radius: 50%;">      
                            <?php 
} else {
    ?>
                                <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/default-img.gif" width="150" height="150" style="border:1px solid #DDD"/>
                            <?php 
} ?>
						</td>
					</tr> 
					<tr style="font-weight: normal;color: #5F6263;">
						<td>
					<p style="font-weight: 900;color: #5F6263"><?php echo $user_data['artist_name'] ?></p>
					<p><b>From :</b> <?php echo $user_data['city'].', ';?> </p>
					<p><b>Genre :</b><?php echo $genre['name'];?></p>
					<p><b>Members : </b>
					<?php
                       foreach ($groups_member as $member) {
                           echo $member['name_member'].' - '.$member['contribution'];
                           if (!empty($member['contribution2'])) {
                               echo '/'.$member['contribution2'];
                           }
                           if ($member != end($groups_member)) {
                               echo ',';
                           }
                       }
                       ?> </p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>


	<!--END INFORMATION-->
	

<?php if ($data_json->photo == 'on') {
    ?>
	<!--PHOTOS-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px;  background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>2.</td><td>PHOTOS</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>

	
	<table width="670px" style="background: #fffafa;border-bottom:1px solid #CBD0D6;padding-bottom:10px; text-decoration:none;">
		
			<?php  
                if (!empty($photos)) {
            ?>
            <?php 
            $tdCounter = 1;
            $count = count($photos);
            
            foreach ($photos as $key => $pt) 
            {
                if($tdCounter%3==1)
                {
                    echo "<tr>";
                }
             ?>
            <td width="162">
            	<img width="162" height="162" src="<?php echo base_url(); ?>uploads/<?php echo $pt['user_id']; ?>/photo/<?php echo $pt['filename']; ?>" />
            </td> 
              <?php
                                        if($tdCounter%3==0 || $tdCounter==$count)
                                        {
                                            echo "</tr>";
                                        }
                                        
                                        $tdCounter++;

                                    }
                                    ?>
		
		<?php 
                            } else { ?>
                            <table width="670">
                                <tr>
                                
                                    <td width="220">No content Avaliable</td>
                                    
                                </tr>
                            </table>
        <?php } ?>                    
	</table>
	<!--END PHOTOS-->
	<?php 
}
        if ($data_json->stats == 'on') {
            ?>
	<!--STATS-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px;  background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>3.</td><td>STATS</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<table width="670px" style="background: #fffafa;font-size:18px">

		<tr>
		<?php if($epk_display_info->song_counts)
                                            { ?> 
		<td width="100" style="background-color:#15a7ad; color:#fff; border-radius:10px; padding-right:5px; ">
				<table align="center">
					<tr>
						<td  align="center"><img width="40" height="40" src="<?php echo base_url(); ?>assets\premail-image/music.png"/></td>
					</tr>
					<tr>
						<td  align="center"><?=$num_songs?></td>
					</tr>

					<tr>
						<td>Songs Counts</td>
					</tr>
					
				</table>
			</td>
			<?php } if($epk_display_info->blog_counts) {?>
			<td width="100" style="background-color:#15a7ad; color:#fff; border-radius:10px; ">
				<table align="center">
					<tr>
						<td  align="center"><img width="40" height="40" src="<?php echo base_url(); ?>assets\premail-image/rss.png"/></td>
					</tr>
					<tr>
						<td  align="center"><?=$num_blogs?></td>
					</tr>

					<tr>
						<td>Blogs Counts</td>
					</tr>
					
				</table>
			</td>
			<?php } if($epk_display_info->video_counts) {?>
			<td width="100" style="background-color:#15a7ad; color:#fff; border-radius:10px;">
				<table align="center">
					<tr>
					<td  align="center"><img width="40" height="40" src="<?php echo base_url(); ?>assets\premail-image/video-camera.png"/></td>
						
					<tr>
						<td  align="center"><?=$num_video?></td>
					</tr>

					<tr>
						<td>Video Counts</td>
					</tr>
					
				</table>
			</td>
			<?php } ?>
		</tr>
		<tr>
		<?php  if($epk_display_info->fan_counts) {?>
		<td width="100" style="background-color:#15a7ad; color:#fff; border-radius:10px; padding-right:5px; ">
				<table align="center">
					<tr>
						<td  align="center"><img width="40" height="40" src="<?php echo base_url(); ?>assets\premail-image/users.png"/></td>
						</tr>
					<tr>
						<td  align="center"><?=$num_fans?></td>
					</tr>

					<tr>
						<td>Fans Counts</td>
					</tr>
					
				</table>
			</td>
			<?php } if($epk_display_info->comments_counts) {?>
			<td width="100" style="background-color:#15a7ad; color:#fff; border-radius:10px; ">
				<table align="center">
					<tr>
						<td  align="center"><img width="40" height="40" src="<?php echo base_url(); ?>assets\premail-image/comments.png"/></td>
						
					</tr>
					<tr>
						<td  align="center"><?=$num_comments?></td>
					</tr>

					<tr>
						<td>Comments Counts</td>
					</tr>
					
				</table>
			</td>
			<?php } if($epk_display_info->show_counts) {?>
			<td width="100" style="background-color:#15a7ad; color:#fff; border-radius:10px;">
				<table align="center">
					<tr>
					<td  align="center"><img width="40" height="40" src="<?php echo base_url(); ?>assets\premail-image/calendar.png"/></td>
					</tr>
					<tr>
						<td  align="center"><?=$num_events?></td>
					</tr>

					<tr>
						<td>Events Counts</td>
					</tr>
					
				</table>
			</td>
			<?php } ?>
		</tr>
		<tr>
			<td height="20"></td>
		</tr>
	</table>
	<!--END STATS-->
	<?php 
        }
        if ($data_json->video == 'on') {
            ?>

	<!--VIDEOS-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px;background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>4.</td><td>VIDEOS</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<!-- <table width="670" style="background:#fffafa;padding:20px;border-top:1px solid #CBD0D6">
		<tr>
			<td style="font-size:28px;color:#337AB7">4. VIDEOS</td>
		</tr>
	</table> -->

<table width="670px" cellspacing="0" cellpadding="0" style="background:#fffafa;">
    <?php $i = 1;
                $count=count($videos);
                    foreach ($videos as $row) {
                
        if($i%3 == 1)
        {
            // echo "$i";
            // echo ($i%3);
            echo "<tr>";
            // echo "tr";
        }

    ?>
        <td align="center" valign="top" style="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" valign="top" style="padding-bottom: 0px; padding-left: 0px; padding-right: 10px; padding-top: 0px;">
                        <table width="180" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="border-collapse: collapse;">
                                  <a href="#" border="0"><img src="<?php echo $row['imageSrc'];?>" width="180" style="border:4px solid #ADABAB;"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: 900;color: #5F6263; line-height: 16px;   padding-top: 15px; ">
                                    <?php echo $row['name_video'];?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="three-col-cta" style="font-size: 14px; font-weight: normal; line-height: 16px; padding-bottom: 20px; padding-left: 0px; padding-top: 15px;">
                                    <a href="<?php echo base_url().'epk/'.$res_data_artist['home_page'];?>" style="color: #1fa2ea; text-decoration:none;">View Video</a>
                                </td>
                            </tr>
                      </table>
                    </td>
                    <?php
                        if(($i%3 == 0) || $i==$count)
                        {
                            echo "</tr>";
                        }
                        
                        $i++;
                    }  ?> 
                    
          </table>
        </td>
    </tr>
 </table>

	<table width="670" style="padding:15px 0;background:#fffafa;border-bottom:1px solid #CBD0D6">
		
	</table>

	<!--END VIDEOS-->
<?php 
        } ?>


	<!--BIOS-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px;  background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>5.</td><td>BIOS</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<table width="670px" style="background: #fffafa;padding-bottom:15px;">
		<tr>
			<td width="190">
				<?php if ($photo != 'notfound') {
    ?>
                    <img  src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/avatar.png"  width="170" height="170" style=" border-radius: 50%; border:4px solid #ADABAB;"/>       
                <?php 
} else {
    ?>
                    <img width="170" height="170" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                <?php 
} ?>

			</td>
			<td width="480" style="color: #888889;font-weight:normal;">
				<h3 style="font-weight: 900;color: #5F6263;"><?php echo $user_data['artist_name']?></h3>
				<?php echo $user_data['bio']?>
			</td>
		</tr>
	</table>
	<!--END BIOS-->

	<!--SONG-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px;  background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>6.</td><td>SONG</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<table width="670px" style="background: #fffafa;padding-bottom:10px;border-bottom:1px solid #CBD0D6">
		<tr>
			<td width="400">
				<table align="center" border="0" style="border-collapse: collapse;line-height:25px;">
					<tr style="background:#15a7ad; color:#fff; font-size:20px;line-height:28px;border-top:1px solid #DEDEDE;border-bottom:1px solid #D0D0D0">
						<th align="left" style="padding-left:10px;" width="350">SONG</th>
						<th width="100">Price</th>
					</tr>
					<?php 
                        foreach ($songs as $row) {

                    ?>
					<tr align="center" style="border-bottom:1px solid #D0D0D0;font-weight: normal;color: #5F6263;">
						<td align="left" style="padding-left:10px"><?=$row['song_name']?></td>
						<td><?=$row['price']?></td>
					</tr>
					<?php } ?> 
					

			</table>
			</td>
			<td width="150" height="150px">
				<table align="center" style="background:#15a7ad; color:#fff ; border-radius: 50%;padding: 21px 16px 29px;background-color: #15a7ad;font-size: 16px;border-bottom: 4px solid #069196;text-transform: uppercase;color: #ffffff;">
					<tr>
						<td><?php echo count($songs);?> SONGS</td>
					</tr>
					<tr>
						<td><?php echo count($view_tats);?> VIEWS</td>
					</tr>
					<!-- <td width="330">
				<a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="float:right;text-decoration: none;border-radius: 3px;padding: 10px 22px 9px;background-color: #15a7ad;font-size: 16px;border-bottom: 4px solid #069196;text-transform: uppercase;color: #ffffff;" >150 SONGS</a>
			</td> -->
				</table>
			</td>
		</tr>
	</table>
	<!--END SONG-->
	<!--blog-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px; background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>7.</td><td>blog</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td> 
	</tr>
	</table>
	<table width="666px" style="background: #fffafa;padding-bottom:10px;border-bottom:1px solid #CBD0D6;">
	<?php foreach ($epk_blogs as $key => $blog) {
		# code...
	?>
		<tr>
			<td>
				<table  width="666px" align="center" style="border:2px solid #15a7ad;line-height:25px;">
					<td width="190" style="background-color:#15a7ad;"><img src="<?php echo  base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>" width="170" height="170" style="border-radius: 50%;"></td>
					<td style="padding-left:14px;font-weight:normal;color: #5F6263;"><span>
						<img width="15" height="15" src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>"/>
						<a href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>" style="color: #5F6263; text-decoration:none;font-weight: 900;"><?=$blog['title'] ?></a>
						</span><br/>
						<img width="15" height="15" src="<?php echo base_url(); ?>assets\premail-image/calendar1.png"/>
						<a href="#" style="color:#5F6263; text-decoration:none;font-weight: 900;">1/24/2017</a>
						<img width="15" height="15" src="<?php echo base_url(); ?>assets\premail-image/comments1.png"/>
						<a href="#" style="color:#5F6263; text-decoration:none;font-weight: 900;">12</a>
					
						<p style="font-weight:normal;"><?php 
                                                $text = strip_tags($blog['content']);
                                                $desLength = strlen($text);
                                                $stringMaxLength = 250;
                                                if ($desLength > $stringMaxLength) {
                                                    $des = substr($text, 0, $stringMaxLength);
                                                    $text = $des.'...';
                                                    echo $text;
                                                } else {
                                                    echo $blog['content'];
                                                } ?> <a href="#" style="color: #1fa2ea; text-decoration:none;">More</a></p>
					</td>	
				</table>
			</td>
		</tr>
		<?php 
		} ?>
		
	</table>
	<!--END blog-->

	    <?php 
        if ($data_json->press == 'on') {
            ?>
	<!--PRESS-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:10px; background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>8.</td><td>PRESS</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<table width="670px" style="background: #fffafa;padding-bottom:15px">
	 <?php
            if($press) {
            foreach ($press as $row) {
                ?>
		<tr >
			<td >
				<table border-collapse: collapse; style="border:2px solid #15a7ad;width: 650px" s>
					<tr style="background:#15a7ad; color:#fff;font-size:20px;line-height:30px;">		
						<th><?php echo $row['name']; ?></th>	
					</tr>
					<tr>
						<td><p style="color:#5F6263";><?php echo $row['quote']?></p></td>
					</tr>
					<tr style="background:#15a7ad; color:#fff;font-size:20px;line-height:30px;">		
										
						<td style="float:right;"><img width="24" height="24" style="vertical-align:middle" src="<?php echo base_url(); ?>assets\premail-image/user.png"/>
							<a href="#" style="color: #fff;font-size:18px; text-decoration:none;">By ~ <?php echo $row['author']?></a>
						</td>	
					</tr>
				</table>
			</td>
		</tr>
		<?php
                                    } 
                                } ?>
	
	</table>
	
	<!--END PRESS-->
        <?php 
        }
        if ($data_json->show == 'on') {
            ?>

	<!--SHOWS-->
	<table width="670px" style="background: #fffafa; border-top:1px solid #CBD0D6; ">
	<tr>
		<td height="20"></td>
	</tr>
		<tr style="font-size:22px;color:#fff;padding-left:12px;background-color:rgb(45,62,80);">
			<td>
			<table><tr style=" font-weight: bold;text-shadow: 1px 1px 1px;margin-left: 8px;"><td>9.</td><td>SHOWS</td></tr></table>
			</td>
		</tr>
		<tr>
		<td height="10"></td>
	</tr>
	</table>
	<!-- <table width="670px" style="background: #fffafa;padding:20px;border-top:1px solid #CBD0D6">
		<tr>
			<td style="font-size:28px;color:#337AB7">8. SHOWS</td>
		</tr>
	</table> -->

	<table width="670px" style="background: #fffafa;padding-bottom:15px;border-bottom:1px solid #CBD0D6">
		<tr>
			<td>
				<table>
					<tr>
						<th style="font-size:22px;color:#337AB7;">SHOWS</th>
					</tr>
					<tr>
						<td>
							<table border="0" style="border-collapse:collapse;line-height:25px">

								<tr style="background:#15a7ad; color:#fff;font-size:20px;line-height:30px;border-top:1px solid #DEDEDE;border-bottom:1px solid #D0D0D0;">
									<th width="110">Date</th>
									<th width="345">Event</th>
									<th width="205">Venue</th>
								</tr>
								<?php $i = 0;
                                 foreach ($events as $event) {
                                    ?>
								<tr style="<?php if($i % 2 == 0) { echo "border-bottom:1px solid #D0D0D0;font-weight: normal;color: #5F6263;"; }else{
			                                                            echo "background:#EFEFEF;border-bottom:1px solid #D0D0D0;font-weight: normal;color: #5F6263;"; } ?>;padding: 5px;">
									<td><?php echo date('D, d/m/y',strtotime($event['event_start_date']));?></td>
									<td align="center"><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></td>
									<td ><?php custom_echo_html($event['location'], 400);?></td>
								</tr>
								<?php 
			                                                        $i++;
			                            } ?>
								
							</table>
						</td>
						<td></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
	<!--END SHOW-->
    <?php 
        } ?>
	<!--FOOTER-->
	<table width="670" align="center" style="background: #F8F8F8">
		<tr>
			<td width="330">
				<table>
					<tr width="330" style="font-weight: normal;color: #5F6263;">
						<th colspan="3">Download Assets</th>
					</tr>
					<tr style="color:#000;margin:10px 0">
						<td width="110"><a href="#" style="color:#337AB7;text-decoration:none">Photo</a></td>
						<td width="110"><a href="#" style="color:#337AB7;text-decoration:none">Music</a></td>
						<td width="110"><a href="#" style="color:#337AB7;text-decoration:none">Bio</a></td>
					</tr>
				</table>
			</td>
			<td width="330">
				<a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="float:right;text-decoration: none;border-radius: 3px;padding: 10px 22px 9px;background-color: #15a7ad;font-size: 16px;border-bottom: 4px solid #069196;text-transform: uppercase;color: #ffffff;" >View Contact</a>
			</td>
		</tr>
	</table>


	<table width="670" align="center" style="background: #F8F8F8">			
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: #F8F8F8	">
					
						<tr>
							<td style="line-height:16px">&nbsp;</td>
						</tr>
						<tr>
							<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:10px;line-height:1.6;color:#333;font-weight:normal;text-align:center">
								<p style="margin-bottom:0">
									<a href="https://www.facebook.com/99sounds" target="_blank">
									<img alt="Facebook" height="26" src="https://ci4.googleusercontent.com/proxy/PVk28cKWOvOMVX9gp9u-_7_Rr-CNvmG4StZWwky9aKyu8yR_Ze0VYHlgktyk9n9Eq8WGjAPbJ1Y1Eiz3Jp0u58tv5hBcEZmdks0JnYpnvWDH1n7VyC0wtviet60VlgXbv7ZqRDF_xtHpl-ZEFhNbogPIWiuh9zh_r-jogXEvabH0e6BYp3H1VeLqwKMMbYBKUG_18QBtRbq_Vt3MJREQjjoCED16fgeM=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_facebook_light.png?1446651957" style="border:none;text-decoration: none;color:#15a7ad;" width="26" class="CToWUd">
									</a>
									<a href="https://twitter.com/SoundHouseInc" target="_blank">
									<img alt="Twitter" height="26" src="https://ci4.googleusercontent.com/proxy/WLs2AeRmZ4yZE-St0MLT7pbcWIHDS7ohgyzS2eAqDxotpErx5YQcgADgY3vs6zpr9MAQVrT9NZ-ZmUNcTutMm7SIBlLIgm9rPjDRDKUh7QP2nSKjEDGTi8a_wN7Ffl2B5BrI1Phqnbk2IM_d0jcRKYTo7OK7csOacLsRZi7iYsrXycKH3oqtK_A2iVpo7S_in-RvFukgbK6bzx0NihjbV8kHSiqaXbU=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_twitter_light.png?1446651957" style="border:none;text-decoration: none;color:#15a7ad;" width="26" class="CToWUd">
									</a>
									<a href="https://plus.google.com/104993070863948605840" style="display:inline-block;border:0;text-decoration:none" target="_blank">
									<img alt="gPlus" height="26" src="https://ci3.googleusercontent.com/proxy/QCwjjZ6gyUQlsTWOkQHCywnixjsVrQ3hTiNlAl1xTAYkV-NZBjhhhN3_sipcG9H2H3jtWx2Wvvq-I5x9SabBcHEfOrWXzOtS30sCmfoFeLOoR-nBp8Kn-o_UVvToyaayVtemol-iqpR3q6b09LyoHNVlIUHvfU-e9xbOPJKGeleEpR01Bik9l8bo3axF8E8f6ZThFNWwMpfm19i6cbLmYp2jr3Vb=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_gplus_light.png?1446651957" style="border:none;text-decoration: none;color:#15a7ad;" width="26" class="CToWUd">
									</a>
									<a href="https://www.youtube.com/channel/UCbx21T0l7_ttr26tZ9d2_Zw" style="display:inline-block;border:0;text-decoration:none" target="_blank">
									<img alt="YouTube" height="26" src="https://ci3.googleusercontent.com/proxy/RCnKYJH1Ni3KDEFfk4sMsHaMzIthkyD1yeJwCnk9mfy55E3Gwyy3nRlETsxjRuVhv9PKBqbpHwJg8fpxSUstcagoSsLHXXCoUT39b8jTaJMRmjkjSR7BfySVGdUUUtYgkKdhK3MkYlRM3n0jS9MxUVG6T1dKMwoD6H1fyjiOHPJYe-dEc_DR13KPsDGnets5BNOg7OrHMGbHstcunPmJhYmU4D_RneY=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_youtube_light.png?1446651957" style="border:none;text-decoration: none;color:#15a7ad;" width="26" class="CToWUd">
									</a>
									<a href="https://instagram.com/soundhousepromotions" style="display:inline-block;border:0;text-decoration:none" target="_blank">
									<img alt="Instagram" height="26" src="https://ci5.googleusercontent.com/proxy/nI1UDKboRctXOs7cYWiU5g8cuNNV0ASUu3LBvE2174gq8Gng2BfKU7olsUbqWORKu2ECFdqsgnC8k1d18u0okTgoLlGSbM0AHhzZjcPcR1_5G-5hFjWiL__sSh_BUJbD69Ht0Li43vUJWXeZQdkJSlkzVoLPp-uP8gIEoP0Nn464rffMM6K5MyAy4UXHguOOSicEH-p8fE-FykOLCYDQnNNGOboN82a68w=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_instagram_light.png?1446651957" style="border:none;text-decoration: none;color:#15a7ad;" width="26" class="CToWUd">
									</a>
								</p>
							</td>
						</tr>
						<tr>
							<td style="line-height:0">&nbsp;</td>
						</tr>
					
							</table>
							</td>
						</tr>

					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="670" align="center" style="background: #F8F8F8">
						
						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									
									<tr>
										<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:1.4;color: #5F6263;font-weight:normal;text-align:center">
											Your preferences are set to receive
											<strong>Booking Requests</strong>
											<i>daily</i>.<br>
											You can receive this email
											<a href="#" style="line-height:2;color:#666" target="_blank">instantly</a>
											or
											<a href="#" style="color:#666;line-height:2" target="_blank">unsubscribe</a>.
										</td>
									</tr>
									
								</table>
							</td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="670" align="center" style="background: #F8F8F8">

						<tr>
							<td>
								<table width="100%" cellpadding="0" cellspacing="0" border="0">
									
										<tr>
											<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:1.4;color: #5F6263;font-weight:normal;text-align:center">
												99Sound
											</td>
										</tr>
										<tr>
											<td style="line-height:8px">&nbsp;</td>
										</tr>
										<tr>
											<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:1.4;color:#999;font-weight:normal;text-align:center">
												<a style="text-decoration: none;color:#15a7ad;" href="<?=base_url()?>footer/privacy-policy" target="_blank">Privacy Policy</a>
											</td>
										</tr>
										<tr>
											<td style="line-height:16px">&nbsp;</td>
										</tr>
								
								</table>
							</td>
						</tr>
						
					</table>
				</td>
			</tr>
		
	</table>
	<!--END FOOTER-->
</td>
</tr>
</table>

</td>
</tr>
</table>
</body>
</html>