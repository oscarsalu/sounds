<link href="<?php echo base_url(); ?>assets/css/new_style.css" rel="stylesheet" />

<?php
if (isset($data_premium) && !empty($data_premium)) {
    ?>
<section class="premium_artists_fee">
    <div class="col-md-10 wp_main_pre">
        <div class="header_main">
            <h2>Our Featured / Premium Artists</h2>
            <p>You have used pack Featured / Premium Artists in <span>
            <?php 
            if ($data_premium['pack'] == 1) {
                echo $data_premium['pack'].' week';
            } else {
                echo $data_premium['pack'].' weeks';
            } ?> 
            </span></p>
            <p>Start date : <span> <?php echo date('H:i:s m/d/Y', strtotime($data_premium['start_day'])); ?> </span></p>
            <p>Expires date : <span>  <?php echo date('H:i:s m/d/Y', strtotime($data_premium['end_day'])); ?> </span></p>
        </div>
        <?php if (isset($premiums) && count($premiums) > 0) {
    ?>
            <div class="col-md-12 showtable">
                
                <div class="row">
                    <div class="col-md-3">
                        Featured / Premium Artists
                    </div>
                    <div class="col-md-2">
                        Start day
                    </div>
                    <div class="col-md-2">
                        Expires day
                    </div>
                    <div class="col-md-2">
                        Payment
                    </div>
                    <div class="col-md-3">
                        Status
                    </div>
                </div>
            <?php foreach ($premiums as $premium) {
    ?>
                <div class="row <?php if ($premium['active'] == 0) {
    echo 'expires';
} ?>">
                    <div class="col-md-3">
                        <?php if ($premium['pack'] == 1) {
    echo $premium['pack'].' Week';
} else {
    echo $premium['pack'].' Weeks';
} ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo date('H:i:s m/d/Y', strtotime($premium['start_day'])); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo date('H:i:s m/d/Y', strtotime($data_premium['end_day'])); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $premium['money'].' $'; ?>
                    </div>
                    <div class="col-md-3">
                        <?php if ($premium['active'] == 0) {
    echo 'Expires';
} else {
    echo 'Active';
} ?>
                    </div>
                </div>
            <?php 
} ?>
            </div>
        <?php 
} ?>
    </div>
</section>
<?php 
} else {
    ?>
<section class="premium_artists_fee">
    <div class="col-md-10 wp_main_pre">
        <div class="header_main">
            <h2>Our Featured / Premium Artists</h2>
            <p>This is text need put in here.</p>
            <p>This is text need put in here.</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="" class="form" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="pack" class="pack" />
                    <div class="form-group">
                        <label  class="col-sm-4 control-label"> Featured/Premium pack</label>
                        <div class="col-sm-8 searchform">
                            <select class="form-control pack_fre" name="pack_fre">
                                <?php $first_key = '';
    foreach ($settings_global as $key => $value) {
        if (!empty($value)) {
            if (str_replace('week', '', $key) == 1) {
                $first_key = str_replace('week', '', $key).' week'; ?>
                                            <option value="<?php echo $value; ?>"><?php echo str_replace('week', '', $key); ?> week</option>
                                <?php 
            } else {
                ?>
                                    <option value="<?php echo $value; ?>"><?php echo str_replace('week', '', $key); ?> weeks</option>
                                        <?php 
            }
        }
    } ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label  class="col-sm-4 control-label"> </label>
                        <div class="col-sm-8 searchform new_form_select">
                            <input type="submit" value=" Upgrade now" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="showcontent">
                    <p>You have select pack <span class="text_pack"><?php echo $first_key; ?></span> with cost <span class="price_pack"><?php echo $settings_global->week1 ?></span>$ .</p>
                    <p>Start date : <span class="start_date"> </span></p>
                    <p>End date : <span class="end_date"> </span></p>
                </div>
            </div>
        </div>
        <?php if (isset($premiums) && count($premiums) > 0) {
    ?>
            <div class="col-md-12 showtable">
                
                <div class="row">
                    <div class="col-md-3">
                        Featured / Premium Artists
                    </div>
                    <div class="col-md-2">
                        Start day
                    </div>
                    <div class="col-md-2">
                        Expires day
                    </div>
                    <div class="col-md-2">
                        Payment
                    </div>
                    <div class="col-md-3">
                        Status
                    </div>
                </div>
            <?php foreach ($premiums as $premium) {
    ?>
                <div class="row <?php if ($premium['active'] == 0) {
    echo 'expires';
} ?>">
                    <div class="col-md-3">
                        <?php if ($premium['pack'] == 1) {
    echo $premium['pack'].' Week';
} else {
    echo $premium['pack'].' Weeks';
} ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo date('H:i:s m/d/Y', strtotime($premium['start_day'])); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo date('H:i:s m/d/Y', strtotime($data_premium['end_day'])); ?>
                    </div>
                    <div class="col-md-2">
                        <?php echo $premium['money'].' $'; ?>
                    </div>
                    <div class="col-md-3">
                        <?php if ($premium['active'] == 0) {
    echo 'Expires';
} else {
    echo 'Active';
} ?>
                    </div>
                </div>
            <?php 
} ?>
            </div>
        <?php 
} ?>
    </div>
</section>
<script type="text/javascript" src="<?=base_url()?>assets/js/detail_pages/subscriptions/js/featured.js"></script>

<?php 
}?>


