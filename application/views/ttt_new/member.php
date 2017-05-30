<script type="text/javascript">
    $('.colorpicker').colorpicker();
    $("#cont_date1").datepicker();
</script>
<div class="container home_panel">
<div class="col-md-12 col-sm-12  col-xs-12">
    <h2 class="tt text_caplock"><i class="fa fa-users"></i>Current members of tour <cite><?=$tour['tour']?></cite></h2>
</div>

<div class="col-md-12 col-sm-12  col-xs-12  table-responsive">
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
            <?php if ($check_member['manager_member']) {?>
            <th>Action</th><?php }?>
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
            <a onclick="show_edit_member($(this))" title="Edit"><i class="fa fa-edit"></i></a>
                                            
        </td>
        <?php } ?>
        <?php } else {
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
            } ?>
        </td>
        <td><?php if ($member['manager_event'] == 1) {
                echo 'Yes';
            } else {
                echo 'No';
            } ?>
        </td>
        <td><?php if ($member['manager_cacula'] == 1) {
                echo 'Yes';
            } else {
                echo 'No';
            } ?>
        </td>
        <td><?php if ($member['manager_schedule'] == 1) {
                echo 'Yes';
            } else {
                echo 'No';
            } ?>
        </td>
                                        <?php if ($check_member['manager_member']) {
    ?>
                                            <td class="searchform formintable">
                                                <input type="hidden" class="save_id" value="<?php echo $member['tm_id']; ?>" />
                                                
                                                <a onclick="show_edit_member($(this))" title="Edit"><i class="fa fa-edit"></i></a> |
                                                <a class="deleteanchor" onclick="delete_member($(this),'<?php echo $member['firstname'].' '.$member['lastname']; ?>')" title="Delete"><i class="fa fa-trash"></i></a>
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
                                                <a class="edit" onclick="show_edit_member($(this))" title="Edit"><i class="fa fa-edit"></i></a> |
                                                <a class="deleteanchor" onclick="delete_member($(this),'<?php echo $member['name']; ?>')" title="Delete"><i class="fa fa-trash"></i></a>
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

                        <!-- modal to edit member modal start -->
    <div class="modal fade new_modal_style" id="edit-member-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="tt">Edit</h4>
                <span class="liner"></span>
            </div>
            <form class="avatar-form" id="update_member"  enctype="multipart/form-data" method="post">
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
                                    <input name="cont_date" type="text" class="form-control cont_date1" id="cont_date1" required />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-4">Name</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_name" type="text" class="form-control cont_name1" required />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-3">Address</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_address" type="text" class="form-control cont_address1" />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-3">Reserve</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_reserv" type="text" class="form-control cont_reserv1" required />
                                </div>
                            </div>
                            <div class="col-md-4 remove_padding">
                                <label class="form-input col-md-4">Obligation</label>
                                <div class="input-group col-md-8">
                                    <input name="cont_press" type="text" class="form-control cont_press1" required />
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">                        
                            <label class="form-input col-md-3">Additional Info</label>
                            <div class="input-group col-md-8">
                                <input type="text" class="form-control cont_addInfo1" name="cont_addInfo" />
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
                <button type="button" class="btn btn-default avatar-save" onclick="update_member_info()">Save</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- /.modal -->
<!-- modal to edit member model end -->
