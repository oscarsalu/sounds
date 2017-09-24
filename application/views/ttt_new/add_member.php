<script type="text/javascript">
    $('.colorpicker-component').colorpicker();
    $("#cont_date").datepicker();
</script>
<div class="container home_panel">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h2 class="tt text_caplock"><i class="fa fa-user-plus"></i>Add NEW MEMBER of tour <cite><?=$tour['tour']?></cite></h2>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <form action="" method="post" style="padding-top:10px;" id="cont_promo1">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                 <div class="searchform searchform_new">
                    <div>
                        <?php if ($check_member['manager_member']) {
                        ?>
                        <h2>Detail Info</h2>
                       <div class="form-group">
                            
                       </div>
                       <div class="form-group">
                          
                       </div>
                       <div class="table-responsive">
                            <table class="table inline-form table-custom">
                                <tr>
                                    <td><label>Telephone</label></td>
                                    <td><input type="number" value="" placeholder="Tel:99 999 999" class="cont_tele" style="width:100%;" name="cont_tele"></td>
                                </tr>
                                <tr>
                                    <td><label>Email</label></td>
                                    <td><input type="email" value="" placeholder="name@address.com" class="cont_email" style="width:100%;" name="cont_email"></td>
                                </tr>
                                <tr>
                                    <td><label>Color</label></td>
                                    <td>
                                        <div class="input-group colorpicker-component">
                                            <input class="color_front" type="text" name="color_front" value="" class="form-control" />
                                            <span class="input-group-addon"><i></i></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Date of event/Hotel</label></td>
                                    <td><input type="text" value="" class="cont_date  form-custom-control" name="cont_date" id="cont_date" /></td>
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
                                    <td >   <h2>Permissions Info</h2></td>
                                    <td>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label>Manager member</label>
                                                <input type="checkbox" class="manager_member form-custom-control" name="manager_member" />
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label>Manager event</label>
                                                <input type="checkbox" class="manager_event form-custom-control" name="manager_event" />
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label>Manager caculate</label>
                                                <input type="checkbox" class="manager_cacula form-custom-control" name="manager_cacula" />
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label>Manager schedule</label>
                                                <input type="checkbox" class="manager_schedule form-custom-control" name="manager_schedule" />
                                            </div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">
                                                <label>Add Expense & receipt </label>
                                                <input type="checkbox" class="expenseAdd form-custom-control" name="add_expense" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td >
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-info" id="submit_contact" value="Add Contact/Promoter" />
                                        </div>
                                        
                                    </td>
                                </tr>  
                            </table>
                        </div>
                       
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
  