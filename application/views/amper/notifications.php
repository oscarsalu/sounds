<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<script>
   var onoff_notifi = "<?php echo base_url('amper/notifications/onoff_notifi') ?>";
   var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/amp/js/onoff_notifi.js"></script>
<div class="container-fluid">
    <section class=" full-width header_new_style header_wrap" style="margin-bottom: 20px; margin-top:20px; padding:20px">
        <div class="col-md-6">
            <div class="text-center">
                <h4 class="tt text_caplock" style="border-bottom:2px solid #ef773e;">Notifications Sales</h4>
                <span class="liner"></span>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"  id="myonoffswitch" <?php if ($user_data['onoffsales'] == 1) {
    echo 'checked';
}?>  />
                    <label class="onoffswitch-label" for="myonoffswitch">
                        <span class="onoffswitch-inner" style="text-align:left;"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class="text-center">
                <h4 class="tt text_caplock text-center" style="border-bottom:2px solid #ef773e;">show all notifications </h4>
                <span class="liner"></span>
                <div class="onoffswitch">
                    <input type="checkbox" name="onoffswitch2" class="onoffswitch-checkbox" id="myonoffswitch2" <?php if ($user_data['onoff_request'] == 1) {
    echo 'checked';
}?>/>
                    <label class="onoffswitch-label" for="myonoffswitch2">
                        <span class="onoffswitch-inner" style="text-align:left;"></span>
                        <span class="onoffswitch-switch" ></span>
                    </label>
                </div>
            </div>
        </div>
    </section>
</div>