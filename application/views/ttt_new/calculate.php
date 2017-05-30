<script type="text/javascript">
    $( "#change_date").datepicker();
    $( "#change_date1").datepicker();

    
</script>
<style type="text/css">
    .fixed_height_550{
        min-height: 550px;
    }
    .table_scroll{
        max-height: 350px;
        min-height: 350px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .fixed_height_450{
        min-height: 450px;
    }
</style>
<div class="container">
    <div class="row home-panel">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#cal1">Current Total of Location</a></li>
                <li><a data-toggle="tab" href="#cal2">Current Expenses of All Locations</a></li>
                <li><a data-toggle="tab" href="#cal3">Expense at Location</a></li>
                <li><a data-toggle="tab" href="#cal4">Revenue at Location</a></li>
                <li><a data-toggle="tab" href="#cal5">Expense to Reach Location</a></li>
            </ul>
            <div class="tab-content" id="cal">
                <!-- Section of Location Expenses -->
                <div id="cal1" class="container tab-pane fade in active">
                    <div class="col-md-12 col-sm-12  col-xs-12">
                        <h2 class="tt text_caplock"><i class="fa fa-money"></i> Current Finance of location <i><strong><?=$current_location['location']?></strong></i> of tour <cite><?=$tour['tour']?></cite></h2><hr>
                    </div>
                    <div class="col-md-12 col-sm-12  col-xs-12">
                        <div class="col-md-6  col-sm-6  col-xs-12">
                            <div class="x_panel tile fixed_height_450 overflow_hidden">
                                <div class="x_title weather">
                                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Location </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="form-group">
                                        <label> LOCATION: </label>
                                        <select class="selectcalculatelocation form-input">
                                            <?php foreach ($locations as $location) { ?>
                                            <option <?php if ($location_id == $location['location_id']) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?>
                                            </option>
                                            <?php 
                                                } ?>
                                        </select>
                                    </div>
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
                                                    }?> at <?php echo $current_location['location'];?>
                                            </td>
                                            <td class="text_alginrigt">
                                                <?php 
                                                $money = $income_price - $expenses_price_des;
                                                $this->M_tour->convertmoney($money);?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <div class="x_panel tile fixed_height_450 overflow_hidden">
                                <div class="x_title weather">
                                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Tax of Location </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-xs-12 searchform">
                                        <div>
                                            <label class="col-md-4 col-xs-12"> Tax in location: </label>
                                            <a class="col-md-8 col-xs-12" onclick="addtaxmodal('create','location',0,'name','price');" class="btn">Add tax this location</a>
                                        </div>
                                        <hr>
                                        <?php $taxs = $this->M_tour->getTax('location', $current_location['location_id']);
                                            $total_after_tax = 0;
                                            if ($taxs != false) {
                                        ?>
                                        <table class="table">
                                            <tr>
                                                <th>TAX Name</th>
                                                <th>Tax Amount</th>
                                                <th>Tax Charge</th>
                                                <th>Actions</th>
                                            </tr>
                                            <?php
                                                foreach ($taxs as $tax) 
                                                {
                                            ?>
                                                <tr>
                                                    <td><?php echo $tax['name']; ?></td>
                                                    <td><?php echo $tax['tax']; ?></td>
                                                    <td><?php       
                                                        $show_tax = $money * $tax['tax'] / 100;
                                                        $total_after_tax = $total_after_tax + $show_tax;
                                                        $this->M_tour->convertmoney($show_tax); ?>
                                                    </td>   
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="addtaxmodal('edit','location',<?php echo $tax['id'] ?>,'<?php echo $tax['name']; ?>','<?php echo $tax['tax']; ?>');"><i class="fa fa-edit"></i></a> |
                                                        <a href="javascript:void(0)" onclick="delete_tax($(this), <?php echo $tax['id'] ?>)" title="Delete"><i class="fa fa-trash"></i></a>
                                                    </td>                        
                                                </tr>
                                            <?php 
                                                }
                                            ?>        
                                        </table>
                                        <?php 
                                        ?>
                                        <hr>
                                        <?php
                                            }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel tile  overflow_hidden">
                                <div class="x_title weather">
                                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Current Tour Location Profit/Loss status </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
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
                                                }?> at <?php echo $current_location['location'];?>
                                            </td>
                                            <td class="text_alginrigt">
                                            <?php 
                                            $this->M_tour->convertmoney($money - $total_after_tax);?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section of Location Expenses End  -->
                <!-- Section of Tour Expenses -->
                <div id="cal2" class="container tab-pane fade ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12  col-xs-12">
                            <h2 class="tt text_caplock"><i class="fa fa-money"></i> Current Finance of locations tour <cite><?=$tour['tour']?></cite></h2><hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12  col-xs-12">
                            <div class="col-md-6 col-sm-6  col-xs-12">
                                <div class="x_panel tile fixed_height_450 overflow_hidden">
                                    <div class="x_title weather">
                                        <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> All locations of tour</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
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
                                </div> 
                            </div> 
                            <div class="col-md-6 col-sm-6  col-xs-12">
                                <div class="x_panel tile fixed_height_450  overflow_hidden">
                                    <div class="x_title weather">
                                        <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Tax of tour:</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="searchform col-xs-12 col-sm-12 col-md-12">
                                            <label> Tax in tour: </label>
                                            <a onclick="addtaxmodal('create','tour',0,'name','price');" class="btn">Add tax this tour</a>
                                            <hr>
                                        </div>
                                        <?php $taxs = $this->M_tour->getTax('tour', $tour['tour_id']);
                                            if ($taxs != false) {
                                        ?>
                                        <table class="table">
                                            <tr>
                                                <th>TAX Name</th>
                                                <th>Tax Amount</th>
                                                <th>Tax Charge</th>
                                                <th>Actions</th>
                                            </tr>
                                            <?php
                                                foreach ($taxs as $tax) {
                                            ?>
                                            <tr>
                                                <td><?php echo $tax['name']; ?></td>
                                                <td><?php echo $tax['tax']; ?></td>
                                                <td><?php $this->M_tour->convertmoney($total_money_tax); ?></td>
                                                <td>
                                                <a href="javascript:void(0)" onclick="addtaxmodal('edit','tour',<?php echo $tax['id'] ?>,'<?php echo $tax['name']; ?>','<?php echo $tax['tax']; ?>');"><i class="fa fa-edit"></i></a> |
                                                    <a href="javascript:void(0)" onclick="delete_tax($(this),<?php echo $tax['id'] ?>)" title="Delete"><i class="fa fa-trash"></i></a>
                                            </tr>
                                            <?php
                                             }
                                            ?>

                                        </table>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div> 
                            </div>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel tile  overflow_hidden">
                                <div class="x_title weather">
                                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Total of Tour</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table class="table">
                                        <tr class="color-gre">
                                            <td class="add_text_tran">Total after tax in tour <?php echo $tour['tour'];?></td>
                                            <td ><?php $this->M_tour->convertmoney($total_money);?></td>
                                        </tr>
                                    </table>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section of Tour Expenses End -->
                <!-- Section of Expenses -->

                <div id="cal3" class="container tab-pane fade ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h2 class="tt text_caplock target2"> Expense at <?php echo $current_location['location']; ?>
                                <?php if ($this->uri->segment(5)) {
                                    echo 'for '.$user_data_select['firstname'].' '.$user_data_select['lastname'];
                                    } ?>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div class="col-xs-12 col-md-3 col-sm-4">
                                <div class="x_panel tile fixed_height_550 overflow_hidden">
                                    <div class="x_title">
                                        <h2 class="tt text_caplock">LIST MEMBER</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <ul>
                                            <li>
                                                <a class="contactmemberlink" onclick="get_calculate_view_tourid_location_id(<?=$check_member['tour_id']?>, <?=$location_id?>)" style="cursor: pointer">All member</a>
                                            </li>
                                             <?php foreach ($members as $member) {
                                                if ($member['tm_active'] == 1) {
                                                ?>
                                            <li>
                                                <a style="cursor: pointer" class="contactmemberlink" onclick="get_calculate_view_tourid_locationid_memberid(<?=$check_member['tour_id']?>, <?=$location_id?>, <?=$member['user_id']?>, '#cal3')"><?php echo $member['firstname'].' '.$member['lastname']; ?></a> 
                                            </li>
                                            <?php 
                                            } else {
                                                ?>
                                                <li><?php echo $member['name']; ?></li>
                                                 <?php 
                                                    }
                                                } ?>
                            
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-12 col-md-9 col-sm-8">
                                <div class="x_panel tile fixed_height_550 overflow_hidden">
                                    <div class="x_title">
                                        <h2 class="tt text_caplock"></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table class="table">
                                            <?php if ($check_member['manager_cacula']) {
                                            ?>
                                            <tr class="searchform">
                                                <td class="text-center"><a onclick="addcaculate('expenses','at destination');" class="btn">Add Expense</a></td>
                                            </tr>
                                            <?php 
                                            }?>
                                            <tr>
                                                <td>
                                                    <div class="table_scroll">
                                                    <table class="table ">
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
                            echo 'background: rgba(187, 187, 187, 0.39);';
                            } ?> ">
                                                        <td><?php echo $expense['expense_name']; ?></td>
                                                        <td><?php echo $expense['amount']; ?></td>
                                                        <td><?php $this->M_tour->convertmoney($expense['expense_price']); ?></td>
                                                        <td><?php echo $expense['firstname'].' '.$expense['lastname']; ?></td>
                                                        <td><?php echo date('m-d-Y', strtotime($expense['date'])); ?></td>
                                                        <td><img src="<?php echo base_url()."uploads/".$expense['user_id']."/photo/banner_events/".$expense['receipt']; ?>" width="60" height="60"></td>
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
                                                                <a class="bnt" onclick="show_edit_data($(this),'expenses')" >Edit</a>
                                                                <a class="bnt" onclick="delete_price($(this),'<?php echo $expense['expense_name']; ?>','expenses')">Delete</a>
                                                            </td>
                                                        <?php 
                            } ?>
                                                    </tr>
                                                        <?php

                                                        }
                                                    }
                                                         ?>
                                                    
                                                </table>
                                                </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="total-value color-red">Total: <?php $this->M_tour->convertmoney($total);?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section of Expenses End-->
                <!-- Section of Revenue  -->
                <div id="cal4" class="container tab-pane fade ">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 ">
                            <h2 class="tt text_caplock target3">Revenue at <?php echo $current_location['location']; ?>
                                    <?php if ($this->uri->segment(5)) {
                                    echo 'for '.$user_data_select['firstname'].' '.$user_data_select['lastname'];
                                } ?>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div class="col-xs-12 col-md-3 col-sm-4">
                                <div class="x_panel tile fixed_height_550 overflow_hidden">
                                    <div class="x_title">
                                        <h2 class="tt text_caplock">LIST MEMBER</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <ul>
                                            <li>
                                                <a class="contactmemberlink" onclick="get_calculate_view_tourid_location_id(<?=$check_member['tour_id']?>, <?=$location_id?>)" style="cursor: pointer">All member</a>
                                            </li>
                                             <?php foreach ($members as $member) {
                                                if ($member['tm_active'] == 1) {
                                                ?>
                                            <li>
                                                <a style="cursor: pointer" class="contactmemberlink" onclick="get_calculate_view_tourid_locationid_memberid(<?=$check_member['tour_id']?>, <?=$location_id?>, <?=$member['user_id']?>, '#cal4')"><?php echo $member['firstname'].' '.$member['lastname']; ?></a> 
                                            </li>
                                            <?php 
                                            } else {
                                                ?>
                                                <li><?php echo $member['name']; ?></li>
                                                 <?php 
                                                    }
                                                } ?>
                            
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xs-12 col-md-9 col-sm-8">
                                <div class="x_panel tile fixed_height_550 overflow_hidden">
                                    <div class="x_title">
                                        <h2 class="tt text_caplock"></h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table class="table">
                                            <?php if ($check_member['manager_cacula']) {
                                                    ?>
                                            <tr>
                                                <td class="text-center searchform"> 
                                                    <a onclick="addcaculate('income','none');" class="btn">Add Revenue</a>
                                                </td>
                                            </tr>
                                            <?php 
                                            }?>
                                            <tr>
                                                <td>
                                                    <div class="table_scroll">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Amount</th>
                                                            <th>Price</th>
                                                            <th>Add for</th>
                                                            <th>Receipt</th>
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
                                                                    echo 'background: rgba(187, 187, 187, 0.39);';
                                                                } ?> ">
                                                            <td><?php echo $income['income_name']; ?></td>
                                                            <td><?php echo $income['amount']; ?></td>
                                                            <td><?php $this->M_tour->convertmoney($income['income_price']); ?></td>
                                                            <td><?php echo $income['firstname'].' '.$income['lastname']; ?></td>
                                                            <td><img src="<?php echo base_url()."uploads/".$income['user_id']."/photo/banner_events/".$income['receipt']; ?>" width="60" height="60"></td>
                                                            <td><?php echo date('m-d-Y', strtotime($income['date'])); ?></td>
                                                            <?php if ($check_member['manager_cacula']) {
                                                                ?>
                                                            <td class="searchform formintable">
                                                                <input type="hidden" class="expense_amount" value="<?php echo $income['amount']; ?>" />
                                                                <input type="hidden" class="expense_date" value="<?php echo $income['date']; ?>" />
                                                                <input type="hidden" class="save_id" value="<?php echo $income['income_id']; ?>" />
                                                                <input type="hidden" class="save_name" value="<?php echo $income['income_name']; ?>" />
                                                                <input type="hidden" class="save_price" value="<?php echo $income['income_price']; ?>" />
                                                                <input type="hidden" class="receipt" value="<?php echo $income['receipt']; ?>" />
                                                                <input type="hidden" class="userId" value="<?php echo $income['user_id']; ?>" />
                                                                <a class="bnt" onclick="show_edit_data($(this),'income')" >Edit</a>
                                                                <a class="bnt" onclick="delete_price($(this),'<?php echo $income['income_name']; ?>','income')">Delete</a>
                                                            </td>
                                                                <?php 
                                                                } ?>
                                                        </tr>
                                                            <?php
                                                                }
                                                             ?>
                                                        
                                                    </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td ><span class="total-value color-gre">Total: <?php $this->M_tour->convertmoney($total);?></span></td>
                                                        
                                            </tr>
                                        </table>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section of Revenue End -->
                <!-- Section of Expenses to reach -->
                <div id="cal5" class="container tab-pane fade ">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <h2 class="tt text_caplock target1">Expense to reach <?php echo $current_location['location']; ?>
                                        <?php if ($this->uri->segment(5)) {
                                        echo 'for '.$user_data_select['firstname'].' '.$user_data_select['lastname'];
                                } ?>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <div class="col-md-3 col-xs-12  col-sm-6">
                                <div class="x_panel tile fixed_height_550 overflow_hidden">
                                    <div class="x_title">
                                        <h2 class="tt text_caplock">LIST MEMBER</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <ul>
                                            <li>
                                                <a class="contactmemberlink" onclick="get_calculate_view_tourid_location_id(<?=$check_member['tour_id']?>, <?=$location_id?>)" style="cursor: pointer">All member</a>
                                            </li>
                                             <?php foreach ($members as $member) {
                                                if ($member['tm_active'] == 1) {
                                                ?>
                                            <li>
                                                <a style="cursor: pointer" class="contactmemberlink" onclick="get_calculate_view_tourid_locationid_memberid(<?=$check_member['tour_id']?>, <?=$location_id?>, <?=$member['user_id']?>, '#cal5')"><?php echo $member['firstname'].' '.$member['lastname']; ?></a> 
                                            </li>
                                            <?php 
                                            } else {
                                            ?>
                                            <li><?php echo $member['name']; ?></li>
                                             <?php 
                                                }
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-xs-12  col-sm-6">
                                
                                    <div class="x_panel tile fixed_height_550 overflow_hidden">
                                        <div class="x_title">
                                            <h2 class="tt text_caplock"></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <table class="table">
                                                <?php if ($check_member['manager_cacula']) {
                                                ?>
                                                <tr>
                                                    <td class="text-center searchform"> 
                                                        <a onclick="addcaculate('expenses','travel');" class="btn">Add Expense to reach</a>
                                                    </td>
                                                </tr>
                                                <?php 
                                                }?>
                                                <tr>
                                                    <td>
                                                    <div class="table_scroll">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Amount</th>
                                                                <th>Price</th>
                                                                <th>Add for</th>
                                                                <th>Recipt</th>
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
                                                                <td><img src="<?php echo base_url()."uploads/".$expense['user_id']."/photo/banner_events/".$expense['receipt']; ?>" width="60" height="60"></td>
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
                                                                        <input type="hidden" class="receipt" value="<?php echo $expense['receipt']; ?>" />
                                                                        <input type="hidden" class="userId" value="<?php echo $expense['user_id']; ?>" />
                                                                        <a class="bnt" onclick="show_edit_data($(this),'expenses')" >Edit</a>
                                                                        <a class="bnt" onclick="delete_price($(this),'<?php echo $expense['expense_name']; ?>','expenses')">Delete</a>
                                                                    </td>
                                                                <?php 
                                                                } ?>
                                                                </tr>
                                                                <?php 
                                                                }
                                                            }
                                                                 ?>
                                                            
                                                        </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td ><span class="total-value">Total: <?php $this->M_tour->convertmoney($total);?></span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section of Expenses to reach end -->
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
            <form class="avatar-form" id="edit_price"  enctype="multipart/form-data" method="post">
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
								<img class="receiptImg col-md-8" id="thumb">
							</div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer searchform">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onclick="update_price()" class="btn btn-default avatar-save">Save</button>
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
            <form class="avatar-form" id="addexpense" accept-charset="utf-8" name="addexpense"  enctype="multipart/form-data" method="post" action="">
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
                <button type="button" class="btn btn-default avatar-save" onclick="add_expense(<?php echo $tour['tour_id']; ?>, <?php echo $current_location['location_id'];?>)">Save</button>
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
            <form class="avatar-form" id="add-tax-form" enctype="multipart/form-data" >
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
                <button type="button" class="btn btn-default avatar-save" onclick="add_tax()">Save</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- /.modal -->
<script type="text/javascript">
        
        var domain = "<?php echo base_url(); ?>";
        var delete_price_url = '<?php echo base_url('members/delete_price') ?>';
        var base_url           = '<?php echo base_url() ?>';
        var records_per_page   = '<?php echo $this->security->get_csrf_hash(); ?>';
        var tour_id            ='<?php echo $tour_id;?>';
        var location_id = '<?php echo $location_id;?>';
   
   </script>
