<div class="page-title">
    <span class="title">Manager Subscriptions</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                       
                        <?php
                        if(isset($_GET['filter'])){
                            if($_GET['filter']=="SubscriptionStatus.LIVE")
                                echo "Active Subscriptions ";
                            elseif($_GET['filter']=="SubscriptionStatus.TRIAL")
                                echo "Trial Subscriptions";
                            elseif($_GET['filter']=="SubscriptionStatus.CANCELLED_THIS_MONTH")
                                echo "Cancelled Subscriptions - This Month";
                            elseif($_GET['filter']=="SubscriptionStatus.CANCELLED_LAST_MONTH")
                                echo "Cancelled Subscriptions - Last Month";
                            elseif($_GET['filter']=="SubscriptionStatus.PAST_DUE")
                                echo "Dunning Subscriptions";
                        }else
                            echo "All";
                        ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('admin/subscriptions')?>">All </a></li>
                        <li><a href="<?=base_url('admin/subscriptions?filter=SubscriptionStatus.LIVE')?>">Active Subscriptions </a></li>
                        <li><a href="<?=base_url('admin/subscriptions?filter=SubscriptionStatus.TRIAL')?>">Trial Subscriptions</a></li>
                        <li><a href="<?=base_url('admin/subscriptions?filter=SubscriptionStatus.CANCELLED_THIS_MONTH')?>">Cancelled Subscriptions - This Month </a></li>
                        <li><a href="<?=base_url('admin/subscriptions?filter=SubscriptionStatus.CANCELLED_LAST_MONTH')?>">Cancelled Subscriptions - Last Month</a></li>
                        <li><a href="<?=base_url('admin/subscriptions?filter=SubscriptionStatus.PAST_DUE')?>">Dunning Subscriptions</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table class="set_value datatable table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>CUSTOMER NAME</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>
                            <th>PLAN NAME</th>  
                            <th>AMOUNT</th>
                            <th>ACTIVATED ON</th>
                            <th>LAST BILLED ON</th>
                            <th>NEXT BILLING ON</th>
                        </tr>
                    </thead>
                    <tbody id="view_data">
                        <?php foreach($subscriptions as $subcription){ ?>
                            <tr class="">                               
                                <td><?=$subcription->created_at?></td>
                                <td><?=$subcription->customer_name?></td>
                                <td class="text-capitalize"><?=$subcription->email?></td>
                                <td>
                                <?php
                                if($subcription->status=='live')
                                    $color = "#528B00";
                                elseif($subcription->status=='cancelled')
                                    $color = "#AEAEAE";
                                elseif($subcription->status=='dunning')
                                    $color = "#BF504C";
                                elseif($subcription->status=='trial')
                                    $color = "#CA4F4B";
                                else{
                                    $color = "#000";
                                }
                                ?>
                                <span class="text-uppercase"  style="color: <?=$color?>;"><?=$subcription->status?></span> </td>
                                <td><?=$subcription->plan_name?></td>
                                <td><?=$subcription->currency_symbol.$subcription->sub_total?></td>
                                <td><?php if(isset($subcription->activated_at)) echo $subcription->activated_at?></td>
                                <td><?php if(isset($subcription->last_billing_at)) echo $subcription->last_billing_at?></td>
                                <td><?php if(isset($subcription->next_billing_at)) echo $subcription->next_billing_at?></td>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>      
                <ul class="pagination">
                    <?php 
                    $filter = isset($_GET['filter'])? '&filter='.$_GET['filter']: '';
                    if($page_context->page==1){
                        ?><li class="paginate_button previous disabled" ><a href="#" >Previous</a></li><?php
                    }else{
                        $page_pre = $page_context->page - 1;
                        ?><li class="paginate_button previous " ><a href="<?=base_url('admin/subscriptions?page='.$page_pre.$filter)?>" >Previous</a></li><?php
                    }
                    if($page_context->has_more_page){
                        $page_next = $page_context->page + 1;
                        ?><li class="paginate_button next"><a href="<?=base_url('admin/subscriptions?page='.$page_next.$filter)?>" rel="next">Next</a></li><?php
                    }else{
                        ?><li class="paginate_button next disabled" ><a href="#" >Previous</a></li><?php
                    }
                    ?>
                </ul>     
            </div>
        </div>
    </div>
</div>