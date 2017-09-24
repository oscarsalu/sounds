<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Temp 4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body >
	<?php
    $data_json = json_decode($customize['data_customize']);
    ?>
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
	<table width="670px" style="background: #F8F8F8;border-top:1px solid #CBD0D6;padding:20px 0">
		<tr style="">
			<td style="font-size:28px;padding-left:10px;color:#595959;" align="center">INFOMATION</td>
		</tr>
	</table>

	<table width="670" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#F8F8F8" style="border-bottom:1px solid #CBD0D6">
		<tr>
			<td  width="180" align="center"> 
				<table>
					<tr >
						<?php if ($photo != 'notfound') {
    ?>
                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/avatar.png ?>" width="150" height="150" />    
	                    <?php 
} else {
    ?>
	                        <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/default-img.gif" width="150" height="150" style="border:1px solid #DDD"/>
	                    <?php 
} ?>
					<p style="font-weight:bold"><?php echo $user_data['artist_name'] ?></p>
					<p><b>From :</b> <?php echo $user_data['city'].', '.$country_code['country'];?> </p>
					<p><b>Genre :</b><?php echo $genres['name'];?></p>
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
				
					</tr>
				</table>
				
			</td>
			<td width="445">

				<table border="0" style="border-collapse: collapse;border:1px solid #CCC;background:#FFF" cellpadding="0" cellspacing="0">
					<tr style="height:30px">
						<th width="215">Gender Demographics</th>
						<th width="220">Age Breakdown</th>
					</tr>	
					<tr>
						<td align="center" style="border-right: 2px dotted #CCC;">
							<p>No Data Available</p>	
						</td>
						<td>
							<table>
								<?php if ($data_json->stats == 'on') {
    ?>
								<tr>
									<td width="50">13-17</td>
									<td width="150" >
										<div style="background: #DDD; height: 17px;">
											<div style="background: rgba(22, 122, 198, 0.73); height: 17px;width:<?php echo $this->Member_model->stast_fan($fans, 13, 17)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">18-24</td>
									<td width="150" >
										<div style="background: #DDD; height: 17px;">
											<div style="background: rgba(22, 122, 198, 0.73); height: 17px;width:<?php echo $this->Member_model->stast_fan($fans, 18, 24)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">25-34</td>
									<td width="150" >
										<div style="background: #DDD; height: 17px;">
											<div style="background: rgba(22, 122, 198, 0.73); height: 17px;width:<?php echo $this->Member_model->stast_fan($fans, 25, 34)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">35-44</td>
									<td width="150" >
										<div style="background: #DDD; height: 17px;">
											<div style="background: rgba(22, 122, 198, 0.73); height: 17px;width:<?php echo $this->Member_model->stast_fan($fans, 35, 44)?>%"></div>
										</div>
									</td>
								</tr>
								<tr>
									<td width="50">45+</td>
									<td width="150" >
										<div style="background: #DDD; height: 17px;">
											<div style="background: rgba(22, 122, 198, 0.73); height: 17px;width:<?php echo $this->Member_model->stast_fan($fans, 45, 200)?>%"></div>
										</div>
									</td>
								</tr>
							</table>
							<?php 
} ?>
						</td>
					</tr>	

					<tr align="center">
						<td style="border-right:2px dotted #CCC;border-top:2px dotted #CCC;height:120px;">0  fans</td>
						<th style="border-top:2px dotted #CCC;height:120px;">Fans Near
							<p>No Data Available</p></th>
					</tr>


					<tr align="center">
						<td colspan="2">*Fan demographics represent 99Sound fans only</td>
						
					</tr>

				</table>

			</td>
		</tr>
	</table>
	<!--END INFORMATION-->

<?php if ($data_json->photo == 'on') {
    ?>
	<!--PHOTOS-->
	<table width="670px" style="background: #F4F4F4;padding:20px ">
		<tr>
			<td style="font-size:28px;color:#888889;" align="center">PHOTOS</td>
		</tr>
	</table>

	<table width="670px" style="background: #F4F4F4;border-bottom:1px solid #CBD0D6;padding-bottom:10px;">
		<tr>
			<?php
                    for ($i = 1; $i <= count($photos);++$i) {
                        if ($i == 4) {
                            break;
                        }
                        if (!empty($photos[$i])) {
                            ?>
					<td width="220"><img src="<?php echo base_url(); ?>uploads/<?php echo $photos[$i]['user_id'] ?>/photo/<?php echo $photos[$i]['filename']; ?>" width="215" height="215"></td>
					<?php 
                        }
                    } ?>
		</tr>
	</table>
	<!--END PHOTOS-->
<?php 
} if ($data_json->stats == 'on') {
    ?>
	<!--STATS-->
	<table width="670px" style="background: #F8F8F8;padding:20px 0;">
		<tr>
			<td style="font-size:28px;color:#595959;" align="center">STATS</td>
		</tr>
	</table>

	<table width="670px" style="background: #F8F8F8;font-size:18px">
		<tr>
			<th>Fan Demographics</th>
		</tr>
		<tr align="center">
			<td>Top Demographics is Females (age 13-60)</td>
		</tr>
		<tr align="center">
			<td>
				<table  style="border-collapse: collapse;border-radius:5px 5px 0 0;line-height:30px">
					<tr style="background:#EFEFEF;font-size:18px;line-height:35px;border-top:1px solid #DEDEDE;border-bottom:1px solid #D0D0D0">
						<th width="150">Female</th>
						<th width="150">Age</th>
						<th width="150">Male</th>
					</tr>

					<tr align="center" style="border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 13, 17, 1)?>%</td>
						<td>13-17</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 13, 17, 2)?>%</td>
					</tr>

					<tr align="center" style="background:#EFEFEF;border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 18, 24, 1)?>%</td>
						<td>18-24</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 18, 24, 2)?>%</td>
					</tr>
					<tr align="center" style="border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 25, 34, 1)?>%</td>
						<td>25-34</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 25, 34, 2)?>%</td>
					</tr>
					<tr align="center" style="background:#EFEFEF;border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 35, 44, 1)?>%</td>
						<td>35-44</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 35, 44, 2)?>%</td>
					</tr>
					<tr align="center" style="border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 45, 54, 1)?>%</td>
						<td>45-54</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 45, 54, 2)?>%</td>
					</tr>
					<tr align="center" style="background:#EFEFEF;border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 55, 200, 1)?>%</td>
						<td>55+</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 55, 200, 2)?>%</td>
					</tr>
					<tr align="center" style="border-bottom:1px solid #D0D0D0">
						<td><?php echo $this->Member_model->stast_fan($fans, 0, 13, 1)?>%</td>
						<td>n/a</td>
						<td><?php echo $this->Member_model->stast_fan($fans, 0, 13, 2)?>%</td>
					</tr>
			</table>

			</td>
		</tr>

		<tr align="center">
			<td>
				<table style="margin:15px 0">
					<tr>
						<th width="300">THEIR FANS LIVE HERE</th>
						<th width="300">FAN SUMMARY</th>
					</tr>
					<tr align="center">
						<td>No Data Available</td>
						<td>0 Total Fans</td>
					</tr>
				</table>
			</td>
			
		</tr>

	</table>
	<!--END STATS-->
<?php 
} if ($data_json->video == 'on') {
    ?>
	<!--VIDEOS-->
	<table width="670" style="background:#F4F4F4;padding:20px 0;border-top:1px solid #CBD0D6">
		<tr>
			<td style="font-size:28px;padding-left:10px;color:#888889;margin:10px 0" align="center">VIDEOS</td>
		</tr>
	</table>

<table width="670px" border="0" cellspacing="0" cellpadding="0" style="background:#F4F4F4;">
    <tr>
        <td align="center" valign="top" style="">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center" valign="top" style="padding-bottom: 0px; padding-left: 0px; padding-right: 10px; padding-top: 0px;">
                        <table width="180" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="border-collapse: collapse;">
                                  <a href="#" border="0"><img src="avatar2.png" width="180"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #888889; font-size: 14px; font-weight: bold; line-height: 16px;   padding-top: 15px; ">
                                    TITLE VIDEO
                                </td>
                            </tr>
                            <tr>
                                <td class="three-col-description" style="color: #c1c4c6; font-size: 14px; line-height: 16px;  padding-top: 15px;">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. 
                                </td>
                            </tr>
                            <tr>
                                <td class="three-col-cta" style="font-size: 14px; font-weight: normal; line-height: 16px; padding-bottom: 20px; padding-left: 0px; padding-top: 15px;">
                                    <a href="#" style="color: #1fa2ea; text-decoration: underline;">View Video</a>
                                </td>
                            </tr>
                      </table>
                    </td>
                    <td align="center" valign="top" style="padding-bottom: 0px; padding-left: 0px; padding-right: 10px; padding-top: 0px;">
                        <table width="180" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="border-collapse: collapse;">
                                  <a href="#" border="0"><img src="avatar3.png" width="180"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #888889; font-size: 14px; font-weight: bold; line-height: 16px;   padding-top: 15px; ">
                                    TITLE VIDEO
                                </td>
                            </tr>
                            <tr>
                                <td class="three-col-description" style="color: #c1c4c6; font-size: 14px; line-height: 16px;  padding-top: 15px;">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. 
                                </td>
                            </tr>
                            <tr>
                                <td class="three-col-cta" style="font-size: 14px; font-weight: normal; line-height: 16px; padding-bottom: 20px; padding-left: 0px; padding-top: 15px;">
                                    <a href="#" style="color: #1fa2ea; text-decoration: underline;">View Video</a>
                                </td>
                            </tr>
                      </table>
                    </td>
                    <td align="center" valign="top" style="padding-bottom: 0px; padding-left: 0px; padding-right: 10px; padding-top: 0px;">
                        <table width="180" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="border-collapse: collapse;">
                                  <a href="#" border="0"><img src="avatar.png" width="180"></a>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: #888889; font-size: 14px; font-weight: bold; line-height: 16px;   padding-top: 15px; ">
                                    TITLE VIDEO
                                </td>
                            </tr>
                            <tr>
                                <td class="three-col-description" style="color: #c1c4c6; font-size: 14px; line-height: 16px;  padding-top: 15px;">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor. 
                                </td>
                            </tr>
                            <tr>
                                <td class="three-col-cta" style="font-size: 14px; font-weight: normal; line-height: 16px; padding-bottom: 20px; padding-left: 0px; padding-top: 15px;">
                                    <a href="#" style="color: #1fa2ea; text-decoration: underline;">View Video</a>
                                </td>
                            </tr>
                      </table>
                    </td>
                </tr>
          </table>
        </td>
    </tr>
 </table>

	<table width="670" style="padding:15px 0;background:#F4F4F4;border-bottom:1px solid #CBD0D6">
		<tr align="center">
			<td width="100" style="font-weight:bolder">TOTAL :</td>
			<td width="155">15 VIDEOS</td>
			<td width="155">15256 VIEWS</td>
			<td width="155">745 COMMENTS</td>
		</tr>
	</table>

	<!--END VIDEOS-->
<?php 
} ?>


	<!--BIOS-->
	<table width="670px" style="background: #F8F8F8;padding:20px 0;">
		<tr>
			<td style="font-size:28px;color:#595959;" align="center">BIOS</td>
		</tr>
	</table>

	<table width="670px" style="background: #F8F8F8;padding-bottom:15px;">
		<tr style="margin-bottom:15px">
			<td align="center" >
				<?php if ($photo != 'notfound') {
    ?>
                    <img width="170" height="170" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                <?php 
} else {
    ?>
                    <img width="170" height="170" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                <?php 
} ?>
			</td>
		</tr>
		<tr width="620">
			<td  align="center" style="color: #888889;font-weight:normal">				
				<h3><?php echo $user_data['artist_name']?></h3>
				<?php echo $user_data['bio']?>
			</td>
		</tr>
	</table>
	<!--END BIOS-->

	<!--SONG-->
	<table width="670px" style="background: #F4F4F4;padding:20px 0;border-top:1px solid #CBD0D6">
		<tr>
			<td style="font-size:28px;color:#888889;;" align="center">SONG</td>
		</tr>
	</table>

	<table width="670px" style="background: #F4F4F4;padding-bottom:10px;border-bottom:1px solid #CBD0D6">
		<tr>
			<td width="400">
				<table border="0" style="border-collapse: collapse;line-height:25px;">
					<tr style="background:#EFEFEF;font-size:20px;line-height:28px;border-top:1px solid #DEDEDE;border-bottom:1px solid #D0D0D0">
						<th width="350">SONG</th>
						<th width="100">VIEWS</th>
					</tr>

					<tr align="center" style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
						<td align="left" style="padding-left:10px">MAOKAI</td>
						<td>5555</td>
					</tr>

					<tr align="center" style="background:#EFEFEF;border-bottom:1px solid #D0D0D0">
						<td align="left" style="padding-left:10px">FIORA</td>
						<td>444</td>
					</tr>
					<tr align="center" style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
						<td align="left" style="padding-left:10px">KARMA</td>
						<td>333</td>
					</tr>
					<tr align="center" style="background:#EFEFEF;border-bottom:1px solid #D0D0D0">
						<td align="left" style="padding-left:10px">MORGANA</td>
						<td>222</td>
					</tr>
					<tr align="center" style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
						<td align="left" style="padding-left:10px">THRESH</td>
						<td>111</td>
					</tr>

			</table>
			</td>
			<td width="150">
				<table align="center">
					<tr>
						<td>150 SONGS</td>
					</tr>
					<tr>
						<td>250,000 VIEWS</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<!--END SONG-->
        <?php 
        if ($data_json->press == 'on') {
            ?>
	<!--PRESS-->
	<table width="672px" style="background: #F8F8F8;padding:20px 0">
		<tr>
			<td style="font-size:28px;color:#595959" align="center">PRESS</td>
		</tr>
	</table>

	<table width="650px" style="background: #F8F8F8;padding-bottom:15px">
		<tr align="center">
			<td style="color: #888889;font-weight:normal"><?php foreach ($press as $row) {
    ?>
					<?php echo $row['quote']?>
					<p> <?php echo $row['author']?> 
	                <?php if (!empty($row['link'])) {
    ?><a href="<?php echo $row['link']?>" target="_blank"><?php

} ?> <span class="publication">~ <?php echo $row['name']; ?></span>
	                <?php if (!empty($row['link'])) {
    ?></a><?php

} ?> </p>
				<?php 
} ?>
			</td>
		
		</tr>
	</table>
	<!--END PRESS-->
        <?php 
        } if ($data_json->show == 'on') {
            ?>
	<!--SHOWS-->
	<table width="670px" style="background: #F4F4F4;padding:20px 0;border-top:1px solid #CBD0D6">
		<tr>
			<td style="font-size:28px;color:#888889" align="center">SHOWS</td>
		</tr>
	</table>

	<table width="670px" style="background: #F4F4F4;padding-bottom:15px;border-bottom:1px solid #CBD0D6">
		<tr>
			<td>
				<table>
					<tr>
						<th style="font-size:22px" >UPCOMING SHOWS</th>
						
					</tr>
					<tr>
						<td>
							<table border="0" style="border-collapse:collapse;line-height:25px">
								<tr style="background:#EFEFEF;font-size:20px;line-height:30px;border-top:1px solid #DEDEDE;border-bottom:1px solid #D0D0D0">
									<th width="110">Date</th>
									<th width="345">Event</th>
									<th width="205">Venue</th>
								</tr>
								<tr style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
									<td>Mo4, 04/11/16</td>
									<td>ROCK TOURNAMENT</td>
									<td>ABC ZS, Toronto, ON</td>
								</tr>
								<tr style="background:#EFEFEF;border-bottom:1px solid #D0D0D0"> 
									<td>Tu, 04/12/16</td>
									<td>DANCE TOURNAMENT</td>
									<td>lio, Los Angles, CL</td>
								</tr>
								<tr style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
									<td>We, 04/13/16</td>
									<td>Marathon AKIZ</td>
									<td>lio, Los Angles, CL</td>
								</tr>
							</table>
						</td>
						<td></td>
					</tr>
				</table>

				<table style="margin:15px 0">
					<tr>
						<th style="font-size:22px" align="center">PAST SHOWS</th>
						
					</tr>
					<tr>
						<td>
							<table  border="0" style="border-collapse:collapse;line-height:25px">
								<tr style="background:#EFEFEF;font-size:20px;line-height:30px;border-top:1px solid #DEDEDE;border-bottom:1px solid #D0D0D0">
									<th width="110">Date</th>
									<th width="345">Event</th>
									<th width="205">Venue</th>
								</tr>
								<tr style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
									<td>Mo, 04/11/16</td>
									<td>ROCK TOURNAMENT</td>
									<td>ABC ZS, Toronto, ON</td>
								</tr>
								<tr style="background:#EFEFEF;border-bottom:1px solid #D0D0D0"> 
									<td>Tu, 04/12/16</td>
									<td>DANCE TOURNAMENT</td>
									<td>lio, Los Angles, CL</td>
								</tr>
								<tr style="background:#F4F4F4;border-bottom:1px solid #D0D0D0">
									<td>We, 04/13/16</td>
									<td>Marathon AKIZ</td>
									<td>lio, Los Angles, CL</td>
								</tr>
							</table>
						</td>
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
					<tr width="330">
						<th colspan="3">Download Assets</th>
					</tr>
					<tr style="color:#000;margin:10px 0">
						<td width="110"><a href="#" style="color:#888889;text-decoration:none">Photo</a></td>
						<td width="110"><a href="#" style="color:#888889;text-decoration:none">Music</a></td>
						<td width="110"><a href="#" style="color:#888889;text-decoration:none">Bio</a></td>
					</tr>
				</table>
			</td>
			<td width="330">
				<a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="float:right;text-decoration: none;border-radius: 3px;padding: 10px 22px 9px;background-color: #71b7e6;font-size: 16px;border-bottom: 4px solid #4292dd;text-transform: uppercase;color: #ffffff;" >View Contact</a>
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
									<img alt="Facebook" height="26" src="https://ci4.googleusercontent.com/proxy/PVk28cKWOvOMVX9gp9u-_7_Rr-CNvmG4StZWwky9aKyu8yR_Ze0VYHlgktyk9n9Eq8WGjAPbJ1Y1Eiz3Jp0u58tv5hBcEZmdks0JnYpnvWDH1n7VyC0wtviet60VlgXbv7ZqRDF_xtHpl-ZEFhNbogPIWiuh9zh_r-jogXEvabH0e6BYp3H1VeLqwKMMbYBKUG_18QBtRbq_Vt3MJREQjjoCED16fgeM=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_facebook_light.png?1446651957" style="border:none" width="26" class="CToWUd">
									</a>
									<a href="https://twitter.com/SoundHouseInc" target="_blank">
									<img alt="Twitter" height="26" src="https://ci4.googleusercontent.com/proxy/WLs2AeRmZ4yZE-St0MLT7pbcWIHDS7ohgyzS2eAqDxotpErx5YQcgADgY3vs6zpr9MAQVrT9NZ-ZmUNcTutMm7SIBlLIgm9rPjDRDKUh7QP2nSKjEDGTi8a_wN7Ffl2B5BrI1Phqnbk2IM_d0jcRKYTo7OK7csOacLsRZi7iYsrXycKH3oqtK_A2iVpo7S_in-RvFukgbK6bzx0NihjbV8kHSiqaXbU=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_twitter_light.png?1446651957" style="border:none" width="26" class="CToWUd">
									</a>
									<a href="https://plus.google.com/104993070863948605840" style="display:inline-block;border:0;text-decoration:none" target="_blank">
									<img alt="gPlus" height="26" src="https://ci3.googleusercontent.com/proxy/QCwjjZ6gyUQlsTWOkQHCywnixjsVrQ3hTiNlAl1xTAYkV-NZBjhhhN3_sipcG9H2H3jtWx2Wvvq-I5x9SabBcHEfOrWXzOtS30sCmfoFeLOoR-nBp8Kn-o_UVvToyaayVtemol-iqpR3q6b09LyoHNVlIUHvfU-e9xbOPJKGeleEpR01Bik9l8bo3axF8E8f6ZThFNWwMpfm19i6cbLmYp2jr3Vb=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_gplus_light.png?1446651957" style="border:none" width="26" class="CToWUd">
									</a>
									<a href="https://www.youtube.com/channel/UCbx21T0l7_ttr26tZ9d2_Zw" style="display:inline-block;border:0;text-decoration:none" target="_blank">
									<img alt="YouTube" height="26" src="https://ci3.googleusercontent.com/proxy/RCnKYJH1Ni3KDEFfk4sMsHaMzIthkyD1yeJwCnk9mfy55E3Gwyy3nRlETsxjRuVhv9PKBqbpHwJg8fpxSUstcagoSsLHXXCoUT39b8jTaJMRmjkjSR7BfySVGdUUUtYgkKdhK3MkYlRM3n0jS9MxUVG6T1dKMwoD6H1fyjiOHPJYe-dEc_DR13KPsDGnets5BNOg7OrHMGbHstcunPmJhYmU4D_RneY=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_youtube_light.png?1446651957" style="border:none" width="26" class="CToWUd">
									</a>
									<a href="https://instagram.com/soundhousepromotions" style="display:inline-block;border:0;text-decoration:none" target="_blank">
									<img alt="Instagram" height="26" src="https://ci5.googleusercontent.com/proxy/nI1UDKboRctXOs7cYWiU5g8cuNNV0ASUu3LBvE2174gq8Gng2BfKU7olsUbqWORKu2ECFdqsgnC8k1d18u0okTgoLlGSbM0AHhzZjcPcR1_5G-5hFjWiL__sSh_BUJbD69Ht0Li43vUJWXeZQdkJSlkzVoLPp-uP8gIEoP0Nn464rffMM6K5MyAy4UXHguOOSicEH-p8fE-FykOLCYDQnNNGOboN82a68w=s0-d-e1-ft#https://gp1.wac.edgecastcdn.net/802892/production_static/20151104151831/images/email/icons_social_media/social-icon_instagram_light.png?1446651957" style="border:none" width="26" class="CToWUd">
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
										<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:1.4;color:#999;font-weight:normal;text-align:center">
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
											<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:1.4;color:#999;font-weight:normal;text-align:center">
												99Sound
											</td>
										</tr>
										<tr>
											<td style="line-height:8px">&nbsp;</td>
										</tr>
										<tr>
											<td style="font-family:Roboto,'Helvetica Neue',Arial,sans-serif;font-size:12px;line-height:1.4;color:#999;font-weight:normal;text-align:center">
												<a href="<?=base_url()?>footer/privacy-policy" target="_blank">Privacy Policy</a>
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