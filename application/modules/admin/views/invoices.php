<div class="page-title">
    <span class="title">Manager Invoices</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if(isset($_GET['filter'])){
                            if($_GET['filter']=="Status.OverDue")
                                echo "Overdue Invoices";
                            elseif($_GET['filter']=="Status.Sent")
                                echo "Sent Invoices";
                            elseif($_GET['filter']=="Status.Paid")
                                echo "Paid Invoices";
                            elseif($_GET['filter']=="InvoiceDate.ThisMonth")
                                echo "ThisMonth Invoices";
                            elseif($_GET['filter']=="InvoiceDate.PreviousMonth")
                                echo "Last Month Invoices";   
                        }else
                            echo "All";
                        ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('admin/invoices')?>">All </a></li>
                        <li><a href="<?=base_url('admin/invoices?filter=Status.OverDue')?>">Overdue Invoices</a></li>
                        <li><a href="<?=base_url('admin/invoices?filter=Status.Sent')?>">Open Invoices</a></li>
                        <li><a href="<?=base_url('admin/invoices?filter=Status.Paid')?>">Paid Invoices </a></li>
                        <li><a href="<?=base_url('admin/invoices?filter=InvoiceDate.ThisMonth')?>">This Month Invoices</a></li>
                        <li><a href="<?=base_url('admin/invoices?filter=InvoiceDate.PreviousMonth')?>">Last Month Invoices</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table class="set_value datatable table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>CUSTOMER NAME</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>
                            <th>DUE DATE</th> 
                            <th>AMOUNT</th>
                            <th>BALANCE DUE</th>
                        </tr>
                    </thead>
                    <tbody id="view_data">
                        <?php foreach($invoices as $invoice){ ?>
                            <tr class="">                               
                                <td><?=$invoice->invoice_date?></td>
                                <td><a target="_blank" href="<?=base_url('view_invoice/'.$invoice->invoice_id)?>"><?=$invoice->number?></a></td>
                                <td class="text-capitalize"><?=$invoice->customer_name?></td>
                                <td><?=$invoice->email?></td>
                                <td>
                                <?php
                                if($invoice->status=='paid')
                                    $color = "#528B00";
                                elseif($invoice->status=='sent')
                                    $color = "#3AA6CA";
                                elseif($invoice->status=='overdue')
                                    $color = "#CA4F4B";
                                elseif($invoice->status=='overdue')
                                    $color = "#CA4F4B";
                                else{
                                    $color = "#000";
                                }
                                ?>
                                <span class="text-uppercase"  style="color: <?=$color?>;"><?=$invoice->status?></span> </td>
                                <td><?=$invoice->due_date?></td>
                                <td><?=$invoice->currency_symbol.$invoice->total?></td>
                                <td><?=$invoice->currency_symbol.$invoice->balance?></td>
                               
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
                        ?><li class="paginate_button previous " ><a href="<?=base_url('admin/invoices?page='.$page_pre.$filter)?>" >Previous</a></li><?php
                    }
                    if($page_context->has_more_page){
                        $page_next = $page_context->page + 1;
                        ?><li class="paginate_button next"><a href="<?=base_url('admin/invoices?page='.$page_next.$filter)?>" rel="next">Next</a></li><?php
                    }else{
                        ?><li class="paginate_button next disabled" ><a href="#" >Next</a></li><?php
                    }
                    ?>
                </ul>     
            </div>
        </div>
    </div>
</div>