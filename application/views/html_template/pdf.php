<head>
    <style>
     body
        {
            width:100%;
            font-family:Arial;
            font-size:10pt;
            margin:0;
            padding:0;
        }
    .page
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
    }
    table {
        border-collapse: separate;
        /*border: 4px solid #880000;*/
        padding: 3px;
        margin: 0px 20px 0px 20px;
        empty-cells: hide;
        /*background-color: #FFFFCC;*/
        width: 200mm;
    }
    
    table.outer2 {
        border-collapse: separate;
        border: 4px solid #088000;
        padding: 3px;
        margin: 10px 0px;
        empty-cells: hide;
        background-color: yellow;
    }
    
    table.outer2 td {
        font-family: Times;
    }
    
    table.inner {
        border-collapse: collapse;
        border: 2px solid #000088;
        padding: 3px;
        margin: 5px;
        empty-cells: show;
        background-color: #FFCCFF;

    }
    
    
    
    table.inner td {
        border: 1px solid #000088;
        padding: 0px;
        font-family: monospace;
        font-style: italic;
        font-weight: bold;
        color: #880000;
        background-color: #FFECDF;
    }
    
    table.collapsed {
        border-collapse: collapse;
    }
    
    table.collapsed td {
        background-color: #EDFCFF;
    }
    /*.bord{margin:0 auto; border-radius:4px;border:2px solid gray; border-collapse: collapse;font-family: arial, sans-serif;
    border-collapse: collapse;}
    .bord th,td{ padding: 15px;} 
    .bord th{text-align: justify;background-color:rgb(52,93,125); color:font-size:20px;}
    .bord td{border-bottom:1px solid gray;font-size:16px;}*/
    </style>
</head>

<body>
    <div style="padding: 2mm;width: 200mm">
        <table cellSpacing="2"  align="center" autosize="4">
            <tbody>
            <tr>
                <td>
                    <table style="color:#FFF;font-size:30px;font-weight:bolder;background-color: #0F95DD">
                        <tr>
                            <td align="center" style="color:#FFF;font-size:30px;font-weight:bolder">
                                ELECTRONIC PRESS KIT
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="background-color: #000">
                        <tr>
                            <td>
                                <a href="<?php echo base_url()?>">
                                    <img src="<?php echo base_url()?>assets/logos/logo-07.png" style="width:250px">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table >
                        <tr>
                            <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:10px;background-color: #EFEFEF;color:#000;margin:10px 0">INFOMATION</td>
                        </tr>
                    </table>
                    <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="width: 30%;padding-top: 8px;"> 

                                        <?php if ($photo != 'notfound') { ?>
                                           <img style="border: 4px solid rgb(183, 180, 180); border-radius:4px;" width="150" height="130" src="<?php echo base_url(); ?>uploads/<?php echo $photo['user_id']; ?>/photo/<?php echo $photo['filename']; ?>" />    
                                        <?php } else {     ?>
                                            <img width="150" height="150" src="<?php echo base_url(); ?>assets/images/default-img.gif"/>
                                        <?php }  ?>
                                    
                                        <p><?php echo $res_data_artist['artist_name']?></p>
                                        <p><b>From :</b> <?php echo $res_data_artist['city']?> </p>
                                        <p><b>Genre :</b><?php echo $genre['name'];?></p>
                                        
                                    </td>
                                    
                                    <td style="width: 70%">
                                        <?php 
                                    if ($data_json->stats == 'on') {
                                        ?>
                                        <table border-collapse: collapse; style="background-color:rgb(241,241,241);" >
                                            <tr style="background-color:rgb(52,93,126);color:rgb(245,245,245); line-height:34px;margin-top:0;">
                                                <th colspan="2" style="color:rgb(255,255,255);">STATS</th>
                                            </tr>
                                            <?php if($epk_display_info->song_counts)
                                            { ?> 
                                            <tr>
                                                <td  >Songs Counts</td>
                                                <td  align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?=$num_songs?></td>
                                            </tr>
                                            <?php } if($epk_display_info->video_counts) {?>
                                            <tr>
                                                <td>Video Counts</td>
                                                <td  align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?=$num_video?></td>
                                            </tr>
                                            <?php } if($epk_display_info->blog_counts) {?>
                                            <tr>
                                                <td >Blog Counts</td>
                                                <td  align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?=$num_blogs?></td>
                                            </tr>
                                            <?php } if($epk_display_info->fan_counts) {?>
                                            <tr>
                                                <td >Fans Counts</td>
                                                <td align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?=$num_fans?></td>
                                            </tr>
                                             <?php } if($epk_display_info->comments_counts) {?>
                                            <tr>
                                                <td >Comments Counts</td>
                                                <td  align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?=$num_comments?></td>
                                            </tr>
                                            <?php } if($epk_display_info->show_counts) {?>
                                            <tr>
                                                <td >Events Counts</td>
                                                <td  align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?=$num_events?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td >Views Counts</td>
                                                <td align="center" style="background-color: rgba(22, 122, 198, 0.73); height: 17px;margin: 2px 0 0 45px;"><?php if (empty($view_tats)){echo '0';} else {echo $view_tats['view'];} ?></td>
                                            </tr>
                                        </table>
                                        <?php } ?>
                                    </td>
                                    
                                </tr>
                            </table>
                </td>
            </tr>
            <!--Photo section-->
                     <?php 
                        if ($data_json->photo == 'on') {
                    ?>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:10px;background-color: #EFEFEF;color:#000;margin:10px 0">PHOTOS</td>
                                </tr>
                            </table>
                            <?php  
                                if (!empty($photos)) {
                            ?>

                            <table width="100%">
                                <?php 
                                    $tdCounter = 1;
                                    $count = count($photos);
                                    // for ($i = 0; $i <= count($photos);++$i) 

                                    foreach ($photos as $key => $value) 
                                    {
                                        if($tdCounter%4==1)
                                        {
                                            echo "<tr>";
                                        }
                                     ?>
                                        <td style="padding-left: 1mm">
                                            <img src="<?php echo base_url(); ?>uploads/<?php echo $value['user_id']; ?>/photo/<?php echo $value['filename']; ?>" alt="<?php echo $value['caption']; ?>" width="220" height="220">
                                        </td>
                                    
                                     <?php
                                        if($tdCounter%4==0 || $tdCounter==$count)
                                        {
                                            echo "</tr>";
                                        }
                                        
                                        $tdCounter++;

                                    }
                                    ?>
                                
                            </table>
                            <?php 
                            } else { ?>
                            <table width="670">
                                <tr>
                                
                                    <td width="220">No content Avaliable</td>
                                    
                                </tr>
                            </table>
                            <?php } 
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:10px;background-color: #EFEFEF;color:#000;margin:10px 0">BIOS
                            </td>
                        </tr>
                    </table>
                    <table >
                        <tr>
                            <td width="190"><img src="<?php echo $this->M_user->get_avata($res_data_artist['id'])?>" width="170" height="170"></td>
                            <td width="480" style="color: #888889;font-weight:normal"><?php echo $epk_bio?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--video section-->
                    <?php 
                    if ($data_json->video == 'on') { ?>
                    <tr>
                        <td>
                            <table >
                                <tr>
                                    <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:10px;background-color: #EFEFEF;color:#000;margin:10px 0">VIDEOS</td>
                                </tr>
                            </table>
                            <table width="100%">
                                
                                    <?php $i = 1;
                                    $count=count($videos);
                                        foreach ($videos as $row) {
                                    
                                        if($i%4 == 1)
                                        {
                                            // echo "$i";
                                            // echo ($i%3);
                                            echo "<tr style='border:1px solid red;height:400px;'>";
                                            // echo "tr";
                                        }

                                    ?>
                                    <td width="200" align="center" style="padding: 3px;">
                                        <img src="<?php echo $row['imageSrc'];?>" width="200" height="200">
                                        <p><?php echo $row['name_video'];?></p>
                                        <p><a href="<?php echo base_url().'epk/'.$res_data_artist['home_page'];?>" style="color: #1fa2ea; text-decoration: underline;">View Video</a></p>
                                     
                                    </td>
                                    <?php
                                        if(($i%4 == 0) || $i==$count)
                                        {
                                            echo "</tr>";
                                        }
                                        
                                        $i++;
                                    }  ?> 
                                
                            </table>
                        </td>
                    </tr>
                    <?php

                    } ?> 
                    <!--video section end-->
                    <!--Show Section-->
                    <?php if ($data_json->show == 'on') { ?>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:3mm;background-color: #EFEFEF;color:#000;margin:10px 0">SHOWS</td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <th width="670" style="font-size:22px" >Shows</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table border="0" style="border-collapse:collapse;line-height:25px">
                                                        <tr style="background-color:#345D7E;font-size:20px;line-height:30px;color:#FFF;">
                                                            <th width="110">Date</th>
                                                            <th width="150">Event Pic</th>
                                                            <th width="200">Event</th>
                                                            <th width="210">Venue</th>
                                                        </tr>
                                                        <?php $i = 0;
                                                             foreach ($events as $event) {
                                                                ?>
                                                                <?php if (!empty($event['event_banner'])) {
                                                                    $url_image = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner'];
                                                                    } else {
                                                                        $url_image = base_url().'assets/images/icon/manager_git_event.png';
                                                            } ?>
                                                        <tr style="<?php if($i % 2 == 0) { echo "background-color:#EFEFEF;"; }else{
                                                            echo "background-color:#559ED5;"; } ?>;padding: 5px;">
                                                            <td><?php echo date('D, d/m/y',strtotime($event['event_start_date']));?></td>
                                                            <td><img src="<?php echo $url_image; ?>"   style="width: 80px; height: 80px; background-color: red; "/></td>
                                                            <td><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $event['event_title'])).'-'.$event['event_id'])?>"><?php echo ucfirst($event['event_title']); ?></a></td>
                                                            <td><?php custom_echo_html($event['location'], 400); ?></td>
                                                        </tr>
                                                        <?php 
                                                        $i++;
                            } ?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php } ?>
                    <!--song section-->
                    <?php  if ($data_json->song == 'on') { ?>
                    <tr>
                        <td>
                            <table >
                                <tr>
                                    <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:3mm;background-color: #EFEFEF;color:#000;margin:10px 0">SONG</td>
                                </tr>
                            </table>
                             <table width="670" style=" margin:0 auto; border-radius:4px;border:2px solid gray; border-collapse: collapse;font-family: arial, sans-serif;
    border-collapse: collapse;">
                                      <tr style="background-color:#345D7E;font-size:20px;line-height:8px;color:#FFF;">
                                        <th style="text-align: justify;background-color:rgb(52,93,125); color:font-size:20px;padding:10px;" width="300">songs</th>
                                        <th width="300">artist names</th>
                                      </tr>
                                      <tr>
                                        <td style="border-bottom:1px solid gray;font-size:16px;padding:10px;">Alfreds Futterkiste</td>
                                        <td style="border-bottom:1px solid gray;font-size:16px;padding:10px;text-align:center;">Maria Anders</td>
                                      </tr>
                                      <tr>
                                        <td style="border-bottom:1px solid gray;font-size:16px;padding:10px;">Centro comercial Moctezuma</td>
                                        <td style="border-bottom:1px solid gray;font-size:16px;padding:10px;text-align:center;">Francisco Chang</td>
                                      </tr>
                                      <tr>
                                        <td style="border-bottom:1px solid gray;font-size:16px;padding:10px;">Ernst Handel</td>
                                        <td style="border-bottom:1px solid gray;font-size:16px;padding:10px;text-align:center;">Roland Mendel</td>
                                      </tr>
                                    </table>

                            <!-- <table width="670" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate;">
                            <tr style="background-color:#345D7E;font-size:20px;line-height:30px;color:#FFF;">

                                
                             <?php 
                                    foreach ($songs as $row) {

                                ?>
                                <tr>
                                   <td>
                                        <a href="<?php echo base_url().'epk/'.$res_data_artist['home_page'];?>">
                                            <?=$row['song_name']?>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>  
                            </table> -->
                        </td>
                    </tr>
                    <?php } ?>
                    <!--song section end-->
                     <!--PRESS-->
                    <?php 
                        if ($data_json->press == 'on') {
                    ?>
                    <tr>
                        <td>
                            <table width="672">
                                <tr>
                                    <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:10px;background-color: #EFEFEF;color:#000;margin:10px 0">PRESS</td>
                                </tr>
                            </table>

                            <table  align="center"  cellpadding="0" cellspacing="0" style="border-collapse: separate; ">
                            <?php
                                if($press) {
                                foreach ($press as $row) {
                                    ?>
                                    <tr>
                                        <td>
                                            <table width="672" style="background-color:rgb(241,241,241);margin-bottom:20px;"> 
                                             
                                                <tr  style="background-color:rgb(52,93,126);color:rgb(245,245,245); margin-top:0;">
                                                 <th width="600" colspan="2" style="color:rgb(245,245,245);"><?php echo $row['name']; ?></th>
                                            </tr>
                                          <tr>
                                            <td width="600" colspan="2" style="padding:15px;"><?php echo $row['quote']?></td>
                                            
                                           
                                          </tr>
                                          <tr style="background-color:rgb(52,93,126);color:rgb(245,245,245); margin-top:0;">
                                            <td width="400" style="text-align:justify;padding-left:10px;color:rgb(245,245,245);">author name</td>
                                            <td  width="200" style="color:rgb(245,245,245);padding-left:10px;"><?php echo $row['author']?></td>
                                          </tr>
                                          
                                          </table>
                                        </td>
                                    </tr>
                                  <?php
                                    } 
                                } ?> 
                         <!--    <?php
                                if($press) {
                                foreach ($press as $row) {
                                    ?>
                                <tr>
                                    <td>
                                        <table width="650"  >
                                            <tr>
                                                <th><?php echo $row['name']; ?></th>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $row['quote']?></td>
                                            </tr>
                                            <tr>
                                                <td ><?php echo $row['author']?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>  
                                
                                <?php
                                    } 
                                } ?> -->
                            </table>
                        </td>
                    </tr>
                    <?php } ?>
                    <!--END PRESS-->
                    <!--Blog section-->
                    <tr>
                        <td>
                            <table width="672">
                                <tr>
                                    <td style="border-left:4px solid #337AB7;font-size:22px;padding-left:10px;background-color: #EFEFEF;color:#000;margin:10px 0">Blog</td>
                                </tr>
                            </table>
                            <table width="670">
                            <?php foreach ($epk_blogs as $key => $blog) { 
                            ?>
                                <tr>
                                    <td>
                                        <table border-collapse: collapse; style="background-color:rgb(241,241,241);">
                                            <tr>
                                                <td><img style="width: 200px; height:100px; background-color: red;" src="<?php echo base_url('uploads/'.$blog['user_id'].'/photo/blogs/'.$blog['image_rep']) ?>"/></td>
                                                <td>
                                                    <table>
                                                        <tr style="background-color:rgb(52,93,126);color:rgb(245,245,245); line-height:14px;margin-top:0;">
                                                            <td><h4><a style="color:rgb(245,245,245);text-decoration:none;" href="<?php echo base_url('artist/allblogs').'/'.$blog['user_id'].'/'.$blog['id']?>"><?=$blog['title'] ?></a></h4></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p><?php 
                                                                    $text = strip_tags($blog['content']);
                                                                    $desLength = strlen($text);
                                                                    $stringMaxLength = 250;
                                                                    if ($desLength > $stringMaxLength) {
                                                                        $des = substr($text, 0, $stringMaxLength);
                                                                        $text = $des.'...';
                                                                        echo $text;
                                                                    } else {
                                                                        echo $blog['content'];
                                                                    } ?> </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo date('M d, Y', $blog['time'])?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                                    } ?>
                            </table>
                        </td>
                    </tr>   
                    <!--Blog section end-->

                    <tr>
                        <td>
                            <table width="670" align="center" style="background-color: #F8F8F8">
                                <tr>
                                    <td width="330">
                                        <table>
                                            <tr width="330">
                                                <th colspan="3">Download Assets</th>
                                            </tr>
                                            <tr style="color:#000;margin:10px 0">
                                                <?php if ($data_json->dw_photo == 'on') {
                            ?>
                                                <td width="110"><a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="color:#888889;text-decoration:none">Photo</a></td>
                                                <?php 
                        }
                                             if ($data_json->dw_song == 'on') {
                                                 ?>
                                                <td width="110"><a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="color:#888889;text-decoration:none">Music</a></td>
                                                <?php 
                                             }
                                             if ($data_json->dw_bios == 'on') {
                                                 ?>
                                                <td width="110"><a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="color:#888889;text-decoration:none">Bio</a></td>
                                                <?php 
                                             }
                                             if ($data_json->dw_video == 'on') {
                                             ?>
                                             <td width="110"><a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="color:#888889;text-decoration:none">Videos</a></td>
                                            
                                            <?php 
                                             }
                                             if ($data_json->dw_pdf == 'on') {
                                             ?>
                                             <td width="110"><a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="color:#888889;text-decoration:none">.pdf</a></td>
                                            
                                            <?php 
                                             }
                                             ?>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="330">
                                        <a href="<?php echo base_url('epk/'.$res_data_artist['home_page'])?>" style="float:right;text-decoration: none;padding: 10px 22px 9px;background-color: #71b7e6;font-size: 16px;border-bottom: 4px solid #4292dd;text-transform: uppercase;color: #ffffff;" >View Contact</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table align="center" cellpadding="16" cellspacing="0" border="0" style="max-width:600px;margin-left:auto;margin-right:auto">           
                                <tr>
                                    <td>
                                        <table width="670px" cellpadding="0" cellspacing="0" border="0">
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
            </tbody>
        </table>
    </div>
</body>