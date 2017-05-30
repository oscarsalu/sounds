<div class="container" style="min-height: 100vh;">
    <div class="row">
        <h2>NOTIFICAIONS</h2>
        <ul class="list-group no-radius no-border" id="mails-list">
            <!-- mail in mails -->
            <?php
            foreach ($notifications as $row) {
                if ($row->type == 'invite') {
                    $link = base_url().'chat/dashboard';
                } elseif ($row->type == 'amper_register') {
                    $link = base_url().'amper/dashboard_affiliates';
                } else {
                    $link = '#';
                } ?>
                <li class="list-group-item b-primary">
                <a href="<?=base_url()?>notifications/remove/<?=$row->id; ?>" /><i class="fa fa-trash-o"></i></a>
                    <a href="<?=$link?>">
                    <div class="media">
                        <div class="media-body">
                            <div class="media-heading m-0">
                                <span class="pull-right text-sm text-muted">
                                  <span class="hidden-xs"><?=date('H:i, d M Y', $row->time) ?>
                                      
                                  </span>
                                </span>
                            </div>
                            <small><?=$row->messages?></small>
                        </div>
                    </div>
                    </a>
                </li>
                <?php

            }
            ?>
         </ul>
         <div class="text-center"><?php echo $this->pagination->create_links();?></div>           
    </div>
</div>