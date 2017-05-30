<div class="container">
<?php if(count($locations)){
    ?>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Location</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table">
                        <tr>
                            <td><label> LOCATON: </label></td>
                            <td>
                                <select class="selectsocaillocation">
                                <?php foreach ($locations as $location) {
    ?>
                                    <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';
    $location_name = $location['location'];
    } ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                <?php 
    } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="weatherScheduleSpan text-center"></div>
                                <br>
                                <div class="weatherScheduleCls"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="x_panel tile  overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Events of <cite><?=$location_name?></cite></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Create by</th>
                            <th>Start date </th>
                            <th>End date</th>
                            <th>Select share</th>
                            <th>Share</th>
                        </tr>
                        <?php foreach ($events as $event) {
                         ?>
                        <tr>
                            <td>
                                <?php if ($event['event_banner'] == '') {
    ?>
                                    <?php $image_url = base_url().'assets/images/icon/manager_git_event.png'; ?>
                                <?php 
} else {
    ?>
                                    <?php $image_url = base_url().'uploads/'.$event['user_id'].'/photo/banner_events/'.$event['event_banner']; ?>
                                <?php 
} ?>
                                    
                                <img width="50px" src="<?php echo $image_url; ?>" />
                            </td>
                            <td><?php echo $event['event_title']; ?></td>
                            <td><?php echo $event['firstname'].' '.$event['lastname']; ?></td>
                            <td><?php echo $event['event_start_date']; ?></td>
                            <td><?php echo  $event['event_end_date'];?></td>
                            <td>
                                <form class="form-horizontal shareFrm_<?php echo $event['event_id']; ?> " id="shareFrm_<?php echo $event['event_id']; ?>" action="<?php echo base_url("the_total_tour/social_share/".$event['tour_id']."/".$event['location_id']); ?>" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                                    <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>" />
                                    <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>" />
                                    <input type="hidden" name="location_id" value="<?php echo $location_id; ?>" />
                                    <input type="hidden" name="url_post_photo_input" class="url_post_photo_input" value="<?php echo $image_url; ?>" />
                                    <input type="hidden" name="twitterMsg_<?php echo $event['event_id']; ?>" value="<?php echo $event['event_title'].'&#010;'.$event['event_desc'].'&#010;Event Time: '.$event['event_start_date'].' to '.$event['event_end_date'].'&#010;Venue: '.$event['location'];?>" class="twitterMsg_<?php echo $event['event_id']; ?>">
                                    <div class="facebook">
                                        <input type="checkbox" value="" id="facebook_<?php echo $event['event_id']; ?>" name="check" checked class="chkBox"/>
                                        <span class="btn btn-social-icon btn-facebook btn-xs">
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                    </div>
                                    <div class="twiterChk">
                                        <input type="checkbox" value="None" id="twiterChk_<?php echo $event['event_id']; ?>" name="check" checked class="twiterChk chkBox"/>
                                        <span class="btn btn-social-icon btn-twitter btn-xs">
                                            <i class="fa fa-twitter"></i>
                                        </span>
                                    </div>
                                    <div class="googleChk">
                                        <input type="checkbox" value="None" id="googleChk_<?php echo $event['event_id']; ?>" name="check" checked class="chkBox"/>
                                        <span class="btn btn-social-icon btn-google btn-xs">
                                            <i class="fa fa-google"></i>
                                        </span>
                                    </div>
                                    <input type="hidden" name="description" value="<?php echo $event['event_title']; ?>" class="description" />
                                    <input type="hidden" name="image" value="<?php echo $image_url; ?>" class="image" />
                                    <input type="hidden" name="description_share" value="<?php echo strip_tags($event['event_desc']); ?>" class="description_share" />
                                    <input type="hidden" name="location_share" value="<?php echo $event['location']; ?>" class="location_share" />
                                    <input type="button" name="facebook" value="Facebook" class="btnFb btn btn-lg btn-primary" style="display:none" />
                                    <input type="submit" name="twitter" value="Twitter" class="btn btn-lg btn-primary twitterShare" style="display:none" />
                                </form>
                                    
                            </td>
                            <td>
                                <input type="button" name="share" value="Share" class="share share_button btn btn-primary" onclick="shareSocial(<?php echo "'".$image_url."','".$event['event_title']."','".$event['location']."','".$event['event_desc']."','".$event['event_start_date']." to ".$event['event_end_date']."','".$event['event_id']."'" ?>)"/>
                            </td>
                        </tr>
                    <?php 
                    }?>
                         
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
}else {
?>
<div class="row text-center">
    <div class="panel panel-danger">
        <div class="panel-heading ">
            <strong> Select Location first <strong> 
        </div>
    </div>
    
</div>
<?php
}
?>
</div>


<script type="text/javascript">
    var tour_id = <?=$tour_id?>;
    var facebook_permissions      = '<?php echo implode(',', $this->config->item('facebook_permissions')); ?>';
    var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
    var page_url                  = '<?php echo base_url(); ?>';
    var facebook_app_id           = '<?php echo $this->config->item('facebook_app_id'); ?>';
    var client_id_googleplus      ='<?php echo $this->config->item('client_id', 'googleplus') ?>';
</script>

