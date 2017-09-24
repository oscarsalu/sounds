<!DOCTYPE HTML>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Order Summary</title>
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
        <link rel="icon" href="<?php echo base_url(); ?>assets/icon/57.png">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
            <h1 class="text-center"><strong >Download Songs</strong></h1>
            <p class="text-justify">
            Thanks you! Payment Completed
            </p>
            <table class="table table-striped" width="100%" align="center" cellpadding="5">
				<tr>
					<td colspan="4" style="background: #CCC"><strong>Album Name: </strong></td>
				</tr>
				<tr >
					<td width="20%">
						<div align="center"><strong>#</strong></div>
					</td>
					<td width="50%">
						<div align="left"><strong>Song Name</strong></div>
					</td>
					<td width="30%">
						<div align="center"><strong>Actions</strong></div>
					</td>
				</tr>
                <?php
                    $i = 1;
                    foreach ($data_songs as $row) {
                        ?>
                        <tr>
        					<td align="center"><?php echo $i;
                        $i++?></td>
        					<td><?php echo $row['song_name']?></td>
        					<td>
                                                  <?php 
                                                   
                                                  if($row['audio_file1']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file1'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file1']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                
                                 if($row['audio_file1']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file1'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file1']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                
                                 if($row['audio_file2']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file2'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file2']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                
                                 if($row['audio_file3']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file3'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file3']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                
                                 if($row['audio_file4']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file4'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file4']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                 if($row['audio_file5']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file5'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file5']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                  if($row['audio_file6']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['audio_file6'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=audio&filename='.$row['audio_file6']?>">Download <?php echo $ext;?> Audio <i class="fa fa-download"></i> </a>
                               <?php } 
                                
                                if($row['video_file1']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file1'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=video&filename='.$row['video_file1']?>">Download <?php echo $ext;?> Video  <i class="fa fa-download"></i> </a>
                                <?php }
                                if($row['video_file2']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file2'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=video&filename='.$row['video_file2']?>">Download <?php echo $ext;?> Video  <i class="fa fa-download"></i> </a>
                                <?php } 
                                if($row['video_file3']!=""){
                                                  $ext = pathinfo('https://d1oc632jh12ao7.cloudfront.net/uploads/'.$row['user_id'].'/audio/'.$row['video_file3'], PATHINFO_EXTENSION);
                                                  ?>
                                <a href="<?php echo base_url().'map/map_download_song/'.$row['payer_id'].'/'.$row['id'].'?type=video&filename='.$row['video_file3']?>">Download <?php echo $ext;?> Video  <i class="fa fa-download"></i> </a>
                                <?php } ?>
                            </td>
        				</tr>
                        <?php

                    }
                ?>
				
			</table>
		</div>
	</body>
</html>