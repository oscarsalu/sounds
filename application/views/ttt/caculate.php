        <div class="col-md-12 remove_padding">
            <div class="col-md-4 right_padding  ttt_pack" id="rmpd_calculate">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">Location</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <hr />
                        <div class="form-group">                        
                            <label class="form-input col-md-3">LOCATION: </label>
                            <div class="input-group col-md-8">
                                <select class="selectlocation">
                                    <?php foreach ($locations as $location) {
    ?>
                                        <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';
} ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                    <?php 
} ?>
                                </select>
                                <hr />
                                
                            </div>
                            <div class="col-md-12">
                                <table class="table ">
                                    <tr class="color_green">
                                        <td class="add_text_tran">Expense to reach <?php echo $current_location['location'];?></td>
                                        <td class="text_alginrigt"><?php $this->M_tour->convertmoney($expenses_price_travel);?></td>
                                    </tr>
                                    <tr class="color-red">
                                        <td class="add_text_tran">Expense at <?php echo $current_location['location'];?></td>
                                        <td class="text_alginrigt"><?php $this->M_tour->convertmoney($expenses_price_des);?></td>
                                    </tr>
                                    <tr class="color-gre">
                                        <td class="add_text_tran">Revenue at <?php echo $current_location['location'];?></td>
                                        <td class="text_alginrigt"><?php $this->M_tour->convertmoney($income_price);?></td>
                                    </tr>
                                    <tr class="<?php if (($income_price - $expenses_price_des) > 0) {
    echo 'color-gre';
} else {
    echo 'color-red';
}?>">
                                        <td class="add_text_tran">Current <?php if (($income_price - $expenses_price_des) > 0) {
    echo 'Profit';
} else {
    echo 'losses';
}?> at <?php echo $current_location['location'];?></td>
                                        <td class="text_alginrigt">
                                        <?php 
                                        $money = $income_price - $expenses_price_des;
                                        $this->M_tour->convertmoney($money);?>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12 searchform_new searchform">
                                    Tax in location:
                                    <a onclick="addtaxmodal('create','location',0,'name','price');" class="btn">Add tax this location</a>
                                    
                                </div>
                                
                                <div class="col-md-12 remove_padding">
                                    <?php $taxs = $this->M_tour->getTax('location', $current_location['location_id']);
                                    $total_after_tax = 0;
                                    if ($taxs != false) {
                                        echo '<hr />';
                                        foreach ($taxs as $tax) {
                                            ?>
                                        <div class="col-md-12 remove_padding">
                                            <label class="col-md-4"><?php echo $tax['name']; ?> :</label>
                                            <div class="col-md-2 remove_padding searchform_new">
                                                <input class="bnt new_style_tax" readonly="true" type="text" value="<?php echo $tax['tax']; ?>" />
                                            </div>
                                            <div class="col-md-4">
                                                <?php $show_tax = $money * $tax['tax'] / 100;
                                            $total_after_tax = $total_after_tax + $show_tax;
                                            $this->M_tour->convertmoney($show_tax); ?>
                                            </div>
                                            <div class="col-md-2 remove_padding">
                                                <a href="javascript:void(0)" onclick="addtaxmodal('edit','location',<?php echo $tax['id'] ?>,'<?php echo $tax['name']; ?>','<?php echo $tax['tax']; ?>');">Edit</a>
                                                <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url('') ?>the_total_tour/delete_tax/<?php echo $tour['tour_id']; ?>/<?php echo $current_location['location_id']; ?>/<?php echo $tax['id'] ?>">Delete</a>
                                            </div>
                                        </div>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-12">
                                <table class="table ">
                                    <tr class="<?php if (($income_price - $expenses_price_des) > 0) {
    echo 'color-gre';
} else {
    echo 'color-red';
}?>">
                                        <td class="add_text_tran">Current <?php if (($income_price - $expenses_price_des) > 0) {
    echo 'Profit';
} else {
    echo 'losses';
}?> at <?php echo $current_location['location'];?></td>
                                        <td class="text_alginrigt">
                                        <?php 
                                        $this->M_tour->convertmoney($money - $total_after_tax);?>
                                        </td>
                                    </tr>
                                    
                                </table>
                            </div>
                            </div>
                            
                        </div>
                        <hr />
                        
                    </div>
                </div>
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">All location of tour</h2>
                    <span class="liner_landing"></span>
                    
                    <div class="col-md-12 remove_padding">
                        <table class="table">
                            <?php 
                            $total = 0;

                            foreach ($location_caculates as $location_caculate) {
                                $total = $total + $location_caculate['tax_location_result']; ?>
                                <tr class="color_green">
                                    <td class="add_text_tran">Total at <?php echo $location_caculate['location']; ?></td>
                                    <td class="text_alginrigt"><?php $this->M_tour->convertmoney($location_caculate['tax_location_result']); ?></td>
                                </tr>
                            <?php 
                            } ?>
                                <tr class="color-gre">
                                    <td class="add_text_tran">Total before tax in tour <?php echo $tour['tour'];?></td>
                                    <td class="text_alginrigt"><?php $this->M_tour->convertmoney($total);?></td>
                                </tr>
                                <?php
                                $taxs = $this->M_tour->getTax('tour', $tour['tour_id']);
                                $total_money_tax = 0;
                                if ($taxs != false) {
                                    foreach ($taxs as $tax) {
                                        $total_money_tax = $total_money_tax + $total * $tax['tax'] / 100;
                                    }
                                    $total_money = $total - $total_money_tax;
                                } else {
                                    $total_money = $total;
                                }

                                ?>
                                
                            
                        </table>
                            
                    </div>
                    <div class="col-md-12 ">
                        <div class="col-md-12 searchform_new searchform">
                            Tax in tour:
                            <a onclick="addtaxmodal('create','tour',0,'name','price');" class="btn">Add tax this tour</a>
                        </div>
                        
                        <div class="col-md-12 remove_padding">
                            
                            <?php $taxs = $this->M_tour->getTax('tour', $tour['tour_id']);
                                if ($taxs != false) {
                                    echo '<hr />';
                                    foreach ($taxs as $tax) {
                                        ?>
                                    <div class="col-md-12 remove_padding">
                                        <label class="col-md-4"><?php echo $tax['name']; ?> :</label>
                                        <div class="col-md-2 remove_padding searchform_new">
                                            <input class="bnt new_style_tax" readonly="true" type="text" value="<?php echo $tax['tax']; ?>" />
                                        </div>
                                        <div class="col-md-4">
                                            <?php $this->M_tour->convertmoney($total_money_tax); ?>
                                        </div>
                                        <div class="col-md-2 remove_padding">
                                            <a href="javascript:void(0)" onclick="addtaxmodal('edit','tour',<?php echo $tax['id'] ?>,'<?php echo $tax['name']; ?>','<?php echo $tax['tax']; ?>');">Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo base_url('') ?>the_total_tour/delete_tax/<?php echo $tour['tour_id']; ?>/<?php echo $current_location['location_id']; ?>/<?php echo $tax['id'] ?>">Delete</a>
                                        </div>
                                    </div>
                                <?php 
                                    }
                                }
                                ?>
                            
                        </div>
                    </div>
                    <div class="col-md-12 remove_padding">
                        <table class="table">
                            <tr class="color-gre">
                                <td class="add_text_tran">Total after tax in tour <?php echo $tour['tour'];?></td>
                                <td class="text_alginrigt"><?php $this->M_tour->convertmoney($total_money);?></td>
                            </tr>
                        </table>
                            
                    </div>
                    
                </div>
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">LIST MEMBER</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <ul>
                            <li><a href="<?php echo base_url('the_total_tour/caculate').'/'.$check_member['tour_id'].'/'.$location_id;?>">All member</a></li>
                            <?php foreach ($members as $member) {
    if ($member['tm_active'] == 1) {
        ?>
                                    <li><a href="<?php echo base_url('the_total_tour/caculate').'/'.$check_member['tour_id'].'/'.$location_id.'/'.$member['user_id']; ?>"><?php echo $member['firstname'].' '.$member['lastname']; ?></a></li>
                            <?php 
    } else {
        ?>
                                    <li><?php echo $member['name']; ?></li>
                             <?php 
    }
} ?>
                            <li></li>
                        </ul>
                            
                    </div>
                </div>
                
            </div>
            <div class="col-md-8 left_padding  ttt_pack">
                
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock target2">Expense at <?php echo $current_location['location']; ?>
                    <?php if ($this->uri->segment(5)) {
    echo 'for '.$user_data_select['firstname'].' '.$user_data_select['lastname'];
} ?>
                    </h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <?php if ($check_member['manager_cacula']) {
    ?>
                            <div class="col-md-12 remove_padding searchform_new">
                                <a onclick="addcaculate('expenses','at destination');" class="btn">Add Expense</a>
                            </div>
                        <?php 
}?>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Add for</th>
                                <th>Date</th>
                                <th>Receipt</th>
                                <?php if ($check_member['manager_cacula']) {
    ?><th>Action</th><?php 
}?>
                            </tr>
                            <?php 
                            $total = 0;
                            foreach ($expenses as $expense) {
                                if ($expense['expense_type'] == 'at destination') {
                                    $total = $total + $expense['expense_price'] * $expense['amount']; ?>
                            <tr style="color: <?php echo $expense['color_front']; ?>; <?php if ($check_member['id'] == $expense['user_m_id']) {
    echo 'background: #ccc;';
} ?> ">
                                <td><?php echo $expense['expense_name']; ?></td>
                                <td><?php echo $expense['amount']; ?></td>
                                <td><?php $this->M_tour->convertmoney($expense['expense_price']); ?></td>
                                <td><?php echo $expense['firstname'].' '.$expense['lastname']; ?></td>
                                <td><?php echo date('m-d-Y', strtotime($expense['date'])); ?></td>
                                <td><img src="<?php echo base_url()."/uploads/".$expense['user_id']."/photo/banner_events/".$expense['receipt']; ?>"width="60" height="60"></td>
                                <?php if ($check_member['manager_cacula']) {
    ?>
                                    <td class="searchform formintable">
                                        <input type="hidden" class="save_id" value="<?php echo $expense['expense_id']; ?>" />
                                        <input type="hidden" class="save_name" value="<?php echo $expense['expense_name']; ?>" />
                                        <input type="hidden" class="expense_type" value="at destination" />
                                        <input type="hidden" class="expense_amount" value="<?php echo $expense['amount']; ?>" />
                                        <input type="hidden" class="expense_date" value="<?php echo $expense['date']; ?>" />
                                        <input type="hidden" class="save_price" value="<?php echo $expense['expense_price']; ?>" />
                                        <input type="hidden" class="receipt" value="<?php echo $expense['receipt']; ?>" />
                                        <input type="hidden" class="userId" value="<?php echo $expense['user_id']; ?>" />
                                        <a class="bnt" onclick="show_edit_member($(this),'expenses')" >Edit</a>
                                        <a class="bnt" onclick="delete_price($(this),'<?php echo $expense['expense_name']; ?>','expenses')">Delete</a>
                                    </td>
                                <?php 
} ?>
                            </tr>
                                <?php

                                }
                            }
                                 ?>
                            <tr>
                                <td colspan="5"><span class="total-value color-red">Total: <?php $this->M_tour->convertmoney($total);?></span></td>
                                
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock target3">Revenue at <?php echo $current_location['location']; ?>
                    <?php if ($this->uri->segment(5)) {
    echo 'for '.$user_data_select['firstname'].' '.$user_data_select['lastname'];
} ?>
                    </h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <?php if ($check_member['manager_cacula']) {
    ?>
                            <div class="col-md-12 remove_padding searchform_new">
                                <a onclick="addcaculate('income','none');" class="btn">Add Revenue</a>
                            </div>
                        <?php 
}?>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Add for</th>
                                <th>Date</th>
                                <?php if ($check_member['manager_cacula']) {
    ?><th>Action</th><?php 
}?>
                            </tr>
                            <?php 
                            $total = 0;
                            foreach ($incomes as $income) {
                                $total = $total + $income['income_price'] * $income['amount']; ?>
                            <tr style="color: <?php echo $income['color_front']; ?>; <?php if ($check_member['id'] == $income['user_m_id']) {
    echo 'background: #ccc;';
} ?> ">
                                <td><?php echo $income['income_name']; ?></td>
                                <td><?php echo $income['amount']; ?></td>
                                <td><?php $this->M_tour->convertmoney($income['income_price']); ?></td>
                                <td><?php echo $income['firstname'].' '.$income['lastname']; ?></td>
                                <td><?php echo date('m-d-Y', strtotime($income['date'])); ?></td>
                                <?php if ($check_member['manager_cacula']) {
    ?>
                                    <td class="searchform formintable">
                                        <input type="hidden" class="expense_amount" value="<?php echo $income['amount']; ?>" />
                                        <input type="hidden" class="expense_date" value="<?php echo $income['date']; ?>" />
                                        
                                        <input type="hidden" class="save_id" value="<?php echo $income['income_id']; ?>" />
                                        <input type="hidden" class="save_name" value="<?php echo $income['income_name']; ?>" />
                                        <input type="hidden" class="save_price" value="<?php echo $income['income_price']; ?>" />
                                        <a class="bnt" onclick="show_edit_member($(this),'income')" >Edit</a>
                                        <a class="bnt" onclick="delete_price($(this),'<?php echo $income['income_name']; ?>','income')">Delete</a>
                                    </td>
                                <?php 
} ?>
                            </tr>
                                <?php

                            }
                                 ?>
                            <tr>
                                <td colspan="5"><span class="total-value color-gre">Total: <?php $this->M_tour->convertmoney($total);?></span></td>
                                
                            </tr>
                        </table>
                        
                    </div>
                </div>
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock target1">Expense to reach <?php echo $current_location['location']; ?>
                    <?php if ($this->uri->segment(5)) {
    echo 'for '.$user_data_select['firstname'].' '.$user_data_select['lastname'];
} ?>
                    </h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <?php if ($check_member['manager_cacula']) {
    ?>
                            <div class="col-md-12 remove_padding searchform_new">
                                <a onclick="addcaculate('expenses','travel');" class="btn">Add Expense to reach</a>
                            </div>
                        <?php 
}?>
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Price</th>
                                <th>Add for</th>
                                <th>Date</th>
                                <?php if ($check_member['manager_cacula']) {
    ?><th>Action</th><?php 
}?>
                            </tr>
                            <?php 
                            $total = 0;
                            foreach ($expenses as $expense) {
                                if ($expense['expense_type'] == 'travel') {
                                    $total = $total + $expense['expense_price'] * $expense['amount']; ?>
                            <tr style="color: <?php echo $expense['color_front']; ?>; <?php if ($check_member['id'] == $expense['user_m_id']) {
    echo 'background: #ccc;';
} ?> ">
                                <td><?php echo $expense['expense_name']; ?></td>
                                <td><?php echo $expense['amount']; ?></td>
                                <td><?php $this->M_tour->convertmoney($expense['expense_price']); ?></td>
                                <td><?php echo $expense['firstname'].' '.$expense['lastname']; ?></td>
                                <td><?php echo date('m-d-Y', strtotime($expense['date'])); ?></td>
                                <?php if ($check_member['manager_cacula']) {
    ?>
                                    <td class="searchform formintable">
                                        <input type="hidden" class="expense_amount" value="<?php echo $expense['amount']; ?>" />
                                        <input type="hidden" class="expense_date" value="<?php echo $expense['date']; ?>" />
                                        <input type="hidden" class="save_id" value="<?php echo $expense['expense_id']; ?>" />
                                        <input type="hidden" class="save_name" value="<?php echo $expense['expense_name']; ?>" />
                                        <input type="hidden" class="save_price" value="<?php echo $expense['expense_price']; ?>" />
                                        <input type="hidden" class="expense_type" value="travel" />
                                        <a class="bnt" onclick="show_edit_member($(this),'expenses')" >Edit</a>
                                        <a class="bnt" onclick="delete_price($(this),'<?php echo $expense['expense_name']; ?>','expenses')">Delete</a>
                                    </td>
                                <?php 
} ?>
                            </tr>
                                <?php 
                                }
                            }
                                 ?>
                            <tr>
                                <td colspan="5"><span class="total-value">Total: <?php $this->M_tour->convertmoney($total);?></span></td>
                                
                            </tr>
                        </table>
                        
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
                <h4 class="tt edit_text">Edit</h4>
                <span class="liner"></span>
            </div>
            <form class="avatar-form" action="<?php echo base_url(); ?>members/update_price" enctype="multipart/form-data" method="post">
            <div class="modal-body">
                <div class="col-md-12 remove_padding">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="price_id" class="price_id_data" value="price_id" />
                    <input type="hidden" name="tour_id" class="tour_id_data" value="<?php echo $tour_id;?>"/>
                    <input type="hidden" name="type" class="type_data" value="expenses"/>
                    <input type="hidden" name="expense_type" class="expense_type_edit" value="travel"/>
                    <input type="hidden" name="location" class="location" value="<?php echo $current_location['location_id'];?>"/>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Name</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_name" name="change_name" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Price</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_price" name="change_price" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Amount</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_amount_edit" value="1" name="change_amount" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Date</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_date_edit" value="<?php echo date('m/d/Y');?>" id="change_date" name="change_date" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Receipt</label>
                        <div class="input-group col-md-8">
							
							<div class="zoom_img">
								<img src="<?php echo base_url()."/uploads/"; ?>" class="receiptImg col-md-8" id="thumb">
							</div>
							
							
									
								
                        </div>
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
<div class="modal fade new_modal_style" id="add-caculate-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="tt edit_text_model">Add </h4>
                <span class="liner"></span>
            </div>
            <?php if(count($expensePer) > 0 && $expensePer['add_expense'] == 1): ?>
            <form class="avatar-form" action="<?php echo base_url(); ?>members/addcaculate" enctype="multipart/form-data" method="post">
            <div class="modal-body">
                <div class="col-md-12 remove_padding">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" name="type" class="type_data_add" value="expenses"/>
                    <input type="hidden" name="expense_type" class="expense_type_add" value="travel"/>
                    <input type="hidden" name="tour_id" value="<?php echo $tour['tour_id']; ?>"/>
                    <input type="hidden" name="location" class="location_add" value="<?php echo $current_location['location_id'];?>"/>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Name</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_name1" name="change_name" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Price</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_price1" name="change_price" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Amount</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_amount" value="1" name="change_amount" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Date</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_date" value="<?php echo date('m/d/Y');?>" id="change_date1" name="change_date" />
                        </div>
                    </div>
                    <div class="form-group disable_div">                        
                        <label class="form-input col-md-3">Upload Receipt</label>
                        <div class="input-group col-md-8">
                            <input type="file" name="receipt" id="receiptUp">
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default avatar-save">Save</button>
            </div>
        </form>
        <?php else: ?>
			<p style="text-align:center">You don't have persmission to add expense.</p>
        <?php endif; ?>
        </div>
    </div>
</div><!-- /.modal -->

<div class="modal fade new_modal_style" id="add-tax-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="tt edit_text_model">Add tax</h4>
                <span class="liner"></span>
            </div>
            <form class="avatar-form" action="<?php echo base_url(); ?>more_ttt/addtaxcaculate" enctype="multipart/form-data" method="post">
            <div class="modal-body">
                <div class="col-md-12 remove_padding">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    
                    <input type="hidden" name="tour_id" value="<?php echo $tour['tour_id']; ?>"/>
                    <input type="hidden" name="location" class="location_add" value="<?php echo $current_location['location_id'];?>"/>
                    <input type="hidden" name="type" class="type_tax" value="location"/>
                    <input type="hidden" name="type_data" class="type_data" value="create" />
                    <input type="hidden" name="tax_id" class="tax_id" value="0" />
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Name tax</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control change_name_tax" name="change_name" />
                        </div>
                    </div>
                    <div class="form-group disable_div">
                        <label class="form-input col-md-3">Tax</label>
                        <div class="input-group col-md-8">
                            <input type="number" min="0.01" step="0.01" max="2500" value="00.00" class="form-control change_price_tax" name="change_price" />
                        </div>
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
var value = $(".<?php echo $this->session->userdata('target'); ?>").offset().top - 100;
var domain = "<?php echo base_url(); ?>";

$(".selectlocation").change(function(){
    location_id = $(this).val();
    <?php
    if ($this->uri->segment(5)) {
        ?>
        location.href = "<?php echo base_url('the_total_tour/caculate/').'/'.$tour_id.'/'; ?>"+location_id+'/'+<?php echo $this->uri->segment(5); ?>;
    <?php 
    } else {
        ?>
        location.href = "<?php echo base_url('the_total_tour/caculate/').'/'.$tour_id.'/'; ?>"+location_id;
    <?php 
    }
    ?> 
});
var delete_price_url = '<?php echo base_url('members/delete_price') ?>';
var base_url           = '<?php echo base_url() ?>';
var records_per_page   = '<?php echo $this->security->get_csrf_hash(); ?>';
var tour_id            ='<?php echo $tour_id;?>';
</script>

<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/caculate.js"></script>

<link href='<?php echo base_url() ?>assets/dist/css/alertify.default.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/dist/css/alertify.core.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/css/ttt_styles.css' rel='stylesheet' />
<link href="<?php echo base_url(); ?>assets/map/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<script src="<?php echo base_url('assets/dist/js/alertify.min.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/bootstrap-datepicker.min.js');?>"></script>


<script src="<?php echo base_url(); ?>assets/map/js/bootstrap-colorpicker.min.js"></script>
