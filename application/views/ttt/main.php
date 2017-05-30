
        <div class="col-md-12 remove_padding">
            <div class="col-md-4 right_padding  ttt_pack right_ttt2">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">NEW MEMBER</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                            <form action="" method="post" style="padding-top:10px;" id="cont_promo">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                
                               <div class="searchform searchform_new">
                                   <h4 class="showaddcontact"><label><a href="<?php echo base_url('the_total_tour/members') ?>">Add Contact/Promoter</a></label></h4>
                                   <div class="wp_showaddcontact">
                                        <?php if ($check_member['manager_member']) {
    ?>
                                        <h2>Detail Info</h2>
                                       <div class="form-group">
                                          <input type="number" value="" placeholder="Tel:99 999 999" class="cont_tele" style="width:100%;" name="cont_tele">
                                       </div>
                                       <div class="form-group">
                                          <input type="email" value="" placeholder="name@address.com" class="cont_email" style="width:100%;" name="cont_email">
                                       </div>
                                       <div class="table-responsive">
                                       <table class="table inline-form table-custom">
                                          <tr>
                                             <td><label>Color</label></td>
                                             <td>
                                                <div>
                                                    <div class="input-group colorpicker">
                                                        <input class="color_front" type="text" name="color_front" value="" class="form-control" />
                                                        <span class="input-group-addon"><i></i></span>
                                                    </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td><label>Date of event/Hotel</label></td>
                                             <td><input type="text" value="" class="cont_date  form-custom-control"name="cont_date" id="cont_date" /></td>
                                          </tr>
                                          <tr>
                                             <td>  <label>Name</label></td>
                                             <td>  <input type="text" value="" class="cont_name form-custom-control"name="cont_name" /></td>
                                          </tr>
                                          <tr>
                                             <td>   <label>Address</label></td>
                                             <td>    <input type="text" value="" class="cont_address form-custom-control"name="cont_address" />
                                             </td>
                                          </tr>
                                          <tr>
                                             <td><label>Reserve</label></td>
                                             <td>   <input type="text" value="" class="cont_reserv form-custom-control"name="cont_reserv" /></td>
                                          </tr>
                                          <tr>
                                             <td>   <label>Press Obligation</label></td>
                                             <td>  <input type="text" value="" class="cont_press form-custom-control"name="cont_press" /></td>
                                          </tr>
                                          <tr>
                                             <td>   <label>Additional Info</label></td>
                                             <td> <input type="text" value="" class="cont_addInfo form-custom-control" name="cont_addInfo" /></td>
                                          </tr>
                                          <tr>
                                             <td colspan="2">   <h2>Permissions Info</h2></td>
                                          </tr>
                                          
                                          <tr>
                                             <td>   <label>Manager member</label></td>
                                             <td> <input type="checkbox" class="manager_member form-custom-control" name="manager_member" /></td>
                                          </tr>
                                          <tr>
                                             <td>   <label>Manager event</label></td>
                                             <td> <input type="checkbox" class="manager_event form-custom-control" name="manager_event" /></td>
                                          </tr>
                                          <tr>
                                             <td>   <label>Manager caculate</label></td>
                                             <td> <input type="checkbox" class="manager_cacula form-custom-control" name="manager_cacula" /></td>
                                          </tr>
                                          <tr>
                                             <td style="width: 28%;">   <label>Manager schedule</label></td>
                                             <td> <input type="checkbox" class="manager_schedule form-custom-control" name="manager_schedule" /></td>
                                          </tr>
                                          <tr>
                                             <td style="width: 28%;">   <label>Add Expense & receipt </label></td>
                                             <td> <input type="checkbox" class="expenseAdd form-custom-control" name="add_expense" /></td>
                                          </tr>
                                       </table>
                                       </div>
                                       <input type="submit" class="btn btn-block" id="submit_contact" value="Add Contact/Promoter" />
                                       <?php 
} else {
    echo "<p>You don't have permission add member</p>";
}?>
                                    </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 left_padding  ttt_pack left_ttt2">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">LIST MEMBER</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding ">
                      <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th>Obligation</th>
                                <th>Active member</th>
                                <th>Active event</th>
                                <th>Active calculate</th>
                                <th>Active schedule</th>
                                <?php if ($check_member['manager_member']) {
    ?><th>Action</th><?php 
}?>
                            </tr>
                            
                            <?php foreach ($members as $member) {
    ?>
                            <tr style="color: <?php echo $member['color_front']; ?>; <?php if ($check_member['id'] == $member['tm_id']) {
    echo 'background: #ccc;';
} ?> ">
                            <?php if ($member['own'] == 1) {
    ?>
                                    <td><a href="<?php echo base_url('the_total_tour/members'); ?>/<?php echo $tour_id; ?>/<?php echo $member['user_id']; ?>"><?php echo $member['firstname'].' '.$member['lastname']; ?></a></td>
                                    <td>Own</td>
                                    <td>Manager</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <td>Yes</td>
                                    <?php if ($check_member['manager_member']) {
    ?>
                                        <td class="searchform formintable">
                                            <input type="hidden" class="save_id" value="<?php echo $member['tm_id']; ?>" />
                                            <a class="bnt" onclick="show_edit_member($(this))" >Edit</a>
                                            <!--<a class="bnt" onclick="delete_member($(this),'<?php echo $member['firstname'].' '.$member['lastname']; ?>')">Delete</a>-->
                                        </td>
                                    <?php 
} ?>
                                <?php 
} else {
    if ($member['tm_active'] == 1) {
        ?>
                                        <td><a href="<?php echo base_url('the_total_tour/members'); ?>/<?php echo $tour_id; ?>/<?php echo $member['user_id']; ?>"><?php echo $member['firstname'].' '.$member['lastname']; ?></a></td>
                                        <td>Member</td>
                                        <td>Yes</td>
                                        <td><?php echo $member['press']; ?></td>
                                        <td><?php if ($member['manager_member'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <td><?php if ($member['manager_event'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <td><?php if ($member['manager_cacula'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <td><?php if ($member['manager_schedule'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <?php if ($check_member['manager_member']) {
    ?>
                                            <td class="searchform formintable">
                                                <input type="hidden" class="save_id" value="<?php echo $member['tm_id']; ?>" />
                                                <a class="bnt" onclick="show_edit_member($(this))" >Edit</a>
                                                <a class="bnt" onclick="delete_member($(this),'<?php echo $member['firstname'].' '.$member['lastname']; ?>')">Delete</a>
                                            </td>
                                        <?php 
} ?>
                                    <?php 
    } else {
        ?>
                                        <td><?php echo $member['name']; ?></td>
                                        <td>Member</td>
                                        <td>No</td>
                                        <td><?php echo $member['press']; ?></td>
                                        <td><?php if ($member['manager_member'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <td><?php if ($member['manager_event'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <td><?php if ($member['manager_cacula'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <td><?php if ($member['manager_schedule'] == 1) {
    echo 'Yes';
} else {
    echo 'No';
} ?></td>
                                        <?php if ($check_member['manager_member']) {
    ?>
                                            <td class="searchform formintable">
                                                <input type="hidden" class="save_id" value="<?php echo $member['tm_id']; ?>" />
                                                <a class="bnt" onclick="show_edit_member($(this))" >Edit</a>
                                                <a class="bnt" onclick="delete_member($(this),'<?php echo $member['name']; ?>')">Delete</a>
                                            </td>
                                        <?php 
} ?>
                                    <?php 
    } ?>
                                    
                                <?php 
} ?>
                                    
                            </tr>
                                <?php 
}
                                 ?>
                        </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


<div class="modal fade new_modal_style" id="edit-member-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="tt">Edit</h4>
                <span class="liner"></span>
            </div>
            <form class="avatar-form" action="<?php echo base_url(); ?>members/update_member" enctype="multipart/form-data" method="post">
            <div class="modal-body">
                <div class="col-md-12 remove_padding">
                    <h3>Detail Info</h3>
                    <hr />
                    
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <input type="hidden" name="member_id" class="member_id_data" value="member_id" />
                        <input type="hidden" name="tour_id" class="tour_id_data" value="<?php echo $tour_id;?>"/>
                        <div class="form-group">                        
                            <label class="form-input col-md-3">Phone</label>
                            <div class="input-group col-md-8">
                                <input type="number" class="form-control cont_tele1" placeholder="Tel:99 999 999" name="cont_tele" required />
                            </div>
                        </div>
                        <div class="form-group disable_div">                        
                            <label class="form-input col-md-3">Email</label>
                            <div class="input-group col-md-8">
                                <input type="email"class="form-control cont_email1" name="cont_email" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-3">Color</label>
                                <div class="input-group col-md-8">
                                    
                                    <div class="input-group colorpicker">
                                        <input name="color_front" type="text" class="form-control color_front1" required />
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-3">Date</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_date" type="text"class="form-control cont_date1" id="cont_date1" required />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-4">Name</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_name" type="text"class="form-control cont_name1" required />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-3">Address</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_address" type="text"class="form-control cont_address1" />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-3">Reserve</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_reserv" type="text"class="form-control cont_reserv1" required />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-4">Obligation</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_press" type="text"class="form-control cont_press1" required />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">                        
                            <label class="form-input col-md-3">Additional Info</label>
                            <div class="input-group col-md-8">
                                <input type="text"class="form-control cont_addInfo1" name="cont_addInfo" />
                            </div>
                        </div>
                        <h3 class="disable_div">Permissions Info</h3>
                        <hr />
                        <div class="form-group disable_div">
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-6">Manager member</label>
                                <div class="input-group col-md-6">
                                    <input type="checkbox" class="manager_member1 form-custom-control" name="manager_member" />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-6">Manager event</label>
                                <div class="input-group col-md-6">
                                    <input type="checkbox" class="manager_event1 form-custom-control" name="manager_event" />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-6">Manager calculate</label>
                                <div class="input-group col-md-6">
                                    <input type="checkbox" class="manager_cacula1 form-custom-control" name="manager_cacula" />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-6">Manager schedule</label>
                                <div class="input-group col-md-6">
                                    <input type="checkbox" class="manager_schedule1 form-custom-control" name="manager_schedule" />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-6">Add Expense & Receipt </label>
                                <div class="input-group col-md-6">
                                    <input type="checkbox" class="add_expense1 form-custom-control" name="add_expense" />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default avatar-save">Save</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- /.modal -->


<script type="text/javascript">
    var base_url           = '<?php echo base_url() ?>';
    var records_per_page   = '<?php echo $this->security->get_csrf_hash(); ?>';
    var $tour_id            ='<?php echo $tour_id;?>';
</script>
<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/main.js"></script>
<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/main_2.js"></script>

<link href='<?php echo base_url() ?>assets/dist/css/alertify.default.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/dist/css/alertify.core.css' rel='stylesheet' />

<link href="<?php echo base_url(); ?>assets/map/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<script src="<?php echo base_url('assets/dist/js/alertify.min.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/bootstrap-datepicker.min.js');?>"></script>


<script src="<?php echo base_url(); ?>assets/map/js/bootstrap-colorpicker.min.js"></script>
