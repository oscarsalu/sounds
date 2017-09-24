<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel='stylesheet' href='<?php echo base_url() ?>assets/dist/fullcalendar/lib/cupertino/jquery-ui.min.css' />
<?php $params_data = $this->uri->segment(2); ?>
<link href="<?php echo base_url('assets/css/ttt_styles.css');?>" rel="stylesheet" />
<div class="wrap-ttt remove_padding target0">
    <div class="col-md-12">
        <div class="col-md-12 remove_padding">
            <div class="col-md-12 remove_padding  ttt_pack">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">Tour : <?php echo $tour['tour'];?></h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding searchform_new">
                        <a class="btn" href="<?php echo base_url('the_total_tour');?>">Home tour</a>
                        <a class="btn <?php if ($params_data == 'members') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/members').'/'.$check_member['tour_id'];?>">Manager Member</a>
                        <a class="btn <?php if ($params_data == 'caculate') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/caculate').'/'.$check_member['tour_id'];?>">Manager Calculate</a>
                        <a class="btn <?php if ($params_data == 'event') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/event').'/'.$check_member['tour_id'];?>">Manager Event</a>
                        <a class="btn <?php if ($params_data == 'schedules') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/schedules').'/'.$check_member['tour_id'];?>">Daily Schedules</a>
                        <a class="btn <?php if ($params_data == 'find_locations') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/find_locations').'/'.$check_member['tour_id'];?>">Find locations</a>
                        <a class="btn <?php if ($params_data == 'social_media') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/social_media').'/'.$check_member['tour_id'];?>">Social media</a>
                        <a class="btn <?php if ($params_data == 'chat_members') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/chat_members').'/'.$check_member['tour_id'];?>">Chat Member</a>
                        <a class="btn <?php if ($params_data == 'roadtour') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/roadtour').'/'.$check_member['tour_id'];?>">Road map tour</a>
                        <a class="btn <?php if ($params_data == 'bookashow') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/bookashow').'/'.$check_member['tour_id'];?>">Book a show</a>
                    </div>
                </div>
            </div>
        </div>
        