<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/chat/jChat.css" rel="stylesheet" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/chosen.jquery.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/chat/custom_chat.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url()?>assets/js/chat/jchat_custom.js"></script>
<script>

var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
var link = "<?php echo base_url();?>";
(function($){
        $(window).load(function(){
            $(".sidehieght").mCustomScrollbar({theme:"minimal-dark"});
        });
        
    })(jQuery);
    
</script>
<link href="<?php echo base_url()?>assets/css/chat/chatdashboard.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?php echo base_url(); ?>assets/js/chat/chat_dashboard.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center" style="background: rgba(153, 153, 153, 0.35);">
            <h1>
                Dashboard Chat
            </h1>
        </div>
    </div>
    <br>
        <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 col-sm-12">
                <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                      <h2> Search</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght" style="display: none;">
                        <form action="<?php echo base_url('chat/search')?>" method="post">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <input class="form-control" id="searchid" name="key" placeholder="Search by email or name">
                            <div class="search-chat" id="result"></div>
                        </form>   
                    </div>
                </div>
                
                <!-- <div class="panel panel-success panel-height">
                
                    <div class="panel-heading pancol">
                        <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel">Search</a>
                                <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel">
                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                </span>
                            </h4>
                    </div> 
                    
                    <div id="filterPanel" class="panel-collapse panel-collapse collapse">
                        <div class="panel-body sidehieght">
                            
                            <form action="<?php echo base_url('chat/search')?>" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <input class="form-control" id="searchid" name="key" placeholder="Search by email or name">
                                    <div class="search-chat" id="result"></div>
                                  
                            </form>
                        </div>
                    </div>
                </div> -->
                <div class="x_panel tile overflow_hidden" >
                    <div class="x_title">
                      <h2> Recent</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght" style="display: none;">
                        <input type="hidden" value="1" class="level_page" />
                            <table class="table table-condensed margin-reset">
                                <tbody>
                                     <?php
                                    foreach ($recent_chat as $row) {
                                        
                                    if ($row->receiver == $user_data['id']) {
                                        $avata  = base_url().'assets/images/user_default.gif';
                                        if($this->M_user->get_user_role($row->user_id) == 1)
                                        {
                                            $avata = $this->M_user->get_avata($row->user_id);
                                        }
                                        else{
                                            $avata = $this->M_user->get_avata_flp($row->user_id);
                                            }
                                        $num_unread = $this->M_affiliate->total_chat_unread($row->user_id, $row->receiver); ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->user_id?>"/>
                                            <img class="img-circle" height="35px" width="35px" src="<?=$avata?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->user_id?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row->user_id)?></span>
                                                            <?php if ($num_unread != 0) {
    ?><span class="badge bg-lightred"><?=$num_unread?></span></a> <br></td>
                                            <td><span class="on-row"><span class="label label-success"><?php
                                                                } ?>
                                                            
                                                            <small class="text-muted pull-right"><?=time_calculation($row->max_time)?></small></span></span></td>
                                            
                                        </tr>    
                                        <?php

                                        } else{
                                            $avata  = base_url().'assets/images/user_default.gif';
                                            if($this->M_user->get_user_role($row->receiver) == 1)
                                        {
                                            $avata = $this->M_user->get_avata($row->receiver);
                                        }
                                        else{
                                            $avata = $this->M_user->get_avata_flp($row->receiver);
                                            }
                                            ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->receiver?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?=$avata?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->receiver?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row->receiver)?></span></a> <br></td>
                                            <td><span class="on-row"><span class="label label-success"><?=time_calculation($row->max_time)?></span></span></td>
                                           
                                        </tr>    
                                        <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>  
                    </div>
                </div>
                <!-- <div class="panel panel-success panel-height">
                    <div class="panel-heading pancol">
                        <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel2">Recent</a>
                                <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel2">
                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                </span>
                        </h4>
                    </div>
                    <div id="filterPanel2" class="panel-collapse panel-collapse collapse">
                        <div class="panel-body sidehieght">
                            <input type="hidden" value="1" class="level_page" />
                            <table class="table table-condensed margin-reset">
                                <tbody>
                                     <?php
                                    foreach ($recent_chat as $row) {
                                        
                                    if ($row->receiver == $user_data['id']) {
                                        $num_unread = $this->M_affiliate->total_chat_unread($row->user_id, $row->receiver); ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->user_id?>"/>
                                            <img class="img-circle" height="35px" width="35px" src="<?=$this->M_user->get_avata($row->user_id)?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->user_id?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row->user_id)?></span>
                                                            <?php if ($num_unread != 0) {
    ?><span class="badge bg-lightred"><?=$num_unread?></span></a> <br></td>
                                            <td><span class="on-row"><span class="label label-success"><?php

} ?>
                                                            
                                                            <small class="text-muted pull-right"><?=time_calculation($row->max_time)?></small></span></span></td>
                                            
                                        </tr>    
                                        <?php

                                        } else{
                                            ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->receiver?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?=$this->M_user->get_avata($row->receiver)?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->receiver?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row->receiver)?></span></a> <br></td>
                                            <td><span class="on-row"><span class="label label-success"><?=time_calculation($row->max_time)?></span></span></td>
                                           
                                        </tr>    
                                        <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                                
                        </div>
                    </div>
                </div> -->
                <div class="x_panel tile overflow_hidden" data-toggle="collapse">
                    <div class="x_title">
                      <h2> Contacts</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght" style="display: none;">
                           <table class="table table-condensed margin-reset">
                                <tbody>
                                    <?php
                                    foreach ($friends as $row) {
                                        if ($row['role'] == 1) {
                                            ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?php echo  $this->M_user->get_avata($row['id']); ?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row['id']) ?> (Artist)</span></a> <br><span class="status"><?php echo $row['status']?></span></td>
                                            
                                            
                                        </tr>    
                                        <?php

                                        } elseif ($row['role'] == 2) {
                                            ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?php echo  $this->M_user->get_avata_flp($row['id']); ?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row['id']) ?> (Fan)</span></a> <br><span class="status"><?php echo $row['status']?></span></td>
                                            
                                           
                                        </tr>    
                                        <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                </div>
                <!-- <div class="panel panel-success panel-height">
                    <div class="panel-heading pancol">
                        <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel3">Contacts</a>
                                <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel3">
                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                </span>
                               </h4>
                    </div>
                    <div id="filterPanel3" class="panel-collapse panel-collapse collapse">
                        <div class="panel-body sidehieght table-reponsive">
                           <table class="table table-condensed margin-reset">
                                <tbody>
                                    <?php
                                    foreach ($friends as $row) {
                                        if ($row['role'] == 1) {
                                            ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?php echo  $this->M_user->get_avata($row['id']); ?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row['id']) ?> (Artist)</span></a> <br><span class="status"><?php echo $row['status']?></span></td>
                                            
                                            
                                        </tr>    
                                        <?php

                                        } elseif ($row['role'] == 2) {
                                            ?>
                                        <tr>
                                            <td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?php echo  $this->M_user->get_avata_flp($row['id']); ?>">
                                            </a></td>
                                            <td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row['id']) ?> (Fan)</span></a> <br><span class="status"><?php echo $row['status']?></span></td>
                                            
                                           
                                        </tr>    
                                        <?php

                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
                <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                      <h2> Groups</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght" style="display: none;">
                        <a class=" link-effect link-effect-2" data-toggle="modal" data-target="#addgroup"><span data-hover="Add New Group">Add New Group</span></a>
                            <table class="table table-condensed margin-reset">
                                <tbody>
                                    <?php foreach ($groups as $row) {
                                    $member_row = $this->M_user->member_group($row['id']); ?>
                                        <tr>
                                            <td><a href="#"><img class="img-rounded" height="35px" width="35px" src="<?php echo base_url()?>uploads/groups/avata/<?php echo $row['avata']?>"></a></td>
                                            <td>
                                                <a class="load_iframe" href="#">
                                                <input type="hidden" name="link_iframe" value="<?php echo base_url('chat/group').'/'.$row['id']?>" />
                                                <span class="userNames"><?php echo $row['name']?></span>
                                                </a> 
                                            </td>
                                            
                                            <td>
                                                <?php
                                                if ($row['key_user'] == $user_data['id']) {
                                                    ?>
                                                   <div class="btn-group" >
                                                        <button  class="btn btn-hover btn-xs dropdown-toggle" data-toggle="dropdown" >
                                                            <i class="fa fa-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu menu" role="menu">
                                                            <input type="hidden" id="id_gr" value="<?php echo $row['id']?>" />
                                                            <input type="hidden" id="name_gr" value="<?php echo $row['name']?>" />
                                                            <input type="hidden" id="member_gr" value="<?php echo implode(',', $member_row)?>" />
                                                            <li><a class="btn-edit" href="#" data-toggle="modal" data-target="#editgroup"> Edit Group</a></li>
                                                            <li><a class="btn-del" href="#"> Delete Group</a></li>
                                                        </ul>
                                                    </div>
                                                   <?php 
                                                } ?>
                                                
                                            </td>
                                        </tr>
                                        <?php

} ?>
                                    
                                </tbody>
                            </table> 
                    </div>
                </div>
               <!--  <div class="panel panel-success panel-height">
                    <div class="panel-heading pancol">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel4">Groups</a>
                            <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel4">
                                <i class="glyphicon glyphicon-chevron-down"></i>
                            </span>
                       </h4>
                    </div>
                    <div id="filterPanel4" class="panel-collapse panel-collapse collapse">
                        <div class="panel-body sidehieght">
                           <a class=" link-effect link-effect-2" data-toggle="modal" data-target="#addgroup"><span data-hover="Add New Group">Add New Group</span></a>
                            <table class="table table-condensed margin-reset">
                                <tbody>
                                    <?php foreach ($groups as $row) {
                                    $member_row = $this->M_user->member_group($row['id']); ?>
                                        <tr>
                                            <td><a href="#"><img class="img-rounded" height="35px" width="35px" src="<?php echo base_url()?>uploads/groups/avata/<?php echo $row['avata']?>"></a></td>
                                            <td>
                                                <a class="load_iframe" href="#">
                                                <input type="hidden" name="link_iframe" value="<?php echo base_url('chat/group').'/'.$row['id']?>" />
                                                <span class="userNames"><?php echo $row['name']?></span>
                                                </a> 
                                            </td>
                                            
                                            <td>
                                                <?php
                                                if ($row['key_user'] == $user_data['id']) {
                                                    ?>
                                                   <div class="btn-group" style="float: right;">
                                                        <button  class="btn btn-hover btn-xs dropdown-toggle" data-toggle="dropdown" >
                                                            <i class="fa fa-chevron-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu menu" role="menu">
                                                            <input type="hidden" id="id_gr" value="<?php echo $row['id']?>" />
                                                            <input type="hidden" id="name_gr" value="<?php echo $row['name']?>" />
                                                            <input type="hidden" id="member_gr" value="<?php echo implode(',', $member_row)?>" />
                                                            <li><a class="btn-edit" href="#" data-toggle="modal" data-target="#editgroup"><i class="glyphicon glyphicon-edit"></i> Edit Group</a></li>
                                                            <li><a class="btn-del" href="#"><i class="glyphicon glyphicon-remove-circle"></i> Delete Group</a></li>
                                                        </ul>
                                                    </div>
                                                   <?php 
                                                } ?>
                                                
                                            </td>
                                        </tr>
                                        <?php

} ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
                <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                      <h2> Channels</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght" style="display: none;">
                        <ul>
                                <li style="vertical-align: middle;">
                                    <h4>Public channels</h4>
                                    <table>
                                        <tbody>
                                                <?php foreach($public_channels as $row) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <span class="userNames">Channel <?=$row['name']?></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li style="vertical-align: middle;">
                                    <h4>Artist channels</h4>
                                    
                                    <table>
                                        <tbody>
                                        <?php if($user_data['role'] == 1)
                                {
                                    ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?=$this->M_user->get_avata($user_data['id'])?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#"  value="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>" /> My Channel</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php 
                                            foreach($list_artist as $id_user) {
                                                if ($id_user != $user_data['id']) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$this->M_affiliate->get_affilaite_id($id_user)?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?=$this->M_user->get_avata($id_user)?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$this->M_affiliate->get_affilaite_id($id_user)?>" />
                                                        <span class="userNames"><?=$this->M_user->get_name($id_user)?></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php } }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li style="vertical-align: middle;">
                                    <h4>Tour channels</h4>
                                    <table>
                                        <tbody>
                                            <?php 
                                            foreach($tour_channels as $row) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <span class="userNames">Channel <?=$row['name']?></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li style="vertical-align: middle;">
                                    <h4>Band channels</h4>
                                    <table>
                                        <tbody>
                                            
                                                <?php 
                                                foreach($band_channel as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <?php if($user_data['role'] == 1)
                                {
                                    ?>

                                
                                <li style="vertical-align: middle;">
                                    <h4>Personal Affiliates Channels</h4>
                                    <table>
                                        <tbody>
                                            
                                                <?php $i = 1;
                                                foreach($affiliates_channel as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <span class="userNames"><!-- Channel <?=$row['name']?> -->
                                                               <?php echo "affiliate-level".$i; ?>
                                                            </span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php $i++; }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <?php } ?>
                                <li style="vertical-align: middle;">
                                    <h4>Other Affiliates channels</h4>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Level 1</td>
                                            </tr>
                                             <?php 
                                                foreach($dataChannel1 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="2">Level 2</td>
                                                </tr>
                                                <?php 
                                                foreach($dataChannel2 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="2">Level 3</td>
                                                </tr>
                                                <?php 
                                                foreach($dataChannel3 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="2">Level 4</td>
                                                </tr>
                                                <?php 
                                                foreach($dataChannel4 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>   
                    </div>
                </div>
                <!-- <div class="panel panel-success panel-height">
                    <div class="panel-heading pancol">
                        <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel5">Channels</a>
                                <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel5">
                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                </span>
                               </h4>
                    </div>
                    <div id="filterPanel5" class="panel-collapse panel-collapse collapse">
                        <div class="panel-body sidehieght">
                            <ul>
                                <li style="vertical-align: middle;">
                                    <h4>Public channels</h4>
                                    <table>
                                        <tbody>
                                                <?php foreach($public_channels as $row) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <span class="userNames">Channel <?=$row['name']?></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li style="vertical-align: middle;">
                                    <h4>Artist channels</h4>
                                    
                                    <table>
                                        <tbody>
                                        <?php if($user_data['role'] == 1)
                                {
                                    ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?=$this->M_user->get_avata($user_data['id'])?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#"  value="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>" /> My Channel</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php 
                                            foreach($list_artist as $id_user) {
                                                if ($id_user != $user_data['id']) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$this->M_affiliate->get_affilaite_id($id_user)?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?=$this->M_user->get_avata($id_user)?>">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/artist/<?=$this->M_affiliate->get_affilaite_id($id_user)?>" />
                                                        <span class="userNames"><?=$this->M_user->get_name($id_user)?></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php } }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li style="vertical-align: middle;">
                                    <h4>Tour channels</h4>
                                    <table>
                                        <tbody>
                                            <?php 
                                            foreach($tour_channels as $row) {
                                                ?>
                                            <tr>
                                                <td>
                                                    <a class="load_iframe" href="#" >
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="load_iframe" href="#">
                                                        <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                        <span class="userNames">Channel <?=$row['name']?></span>
                                                    </a> 
                                                </td>
                                            </tr>
                                            <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <li style="vertical-align: middle;">
                                    <h4>Band channels</h4>
                                    <table>
                                        <tbody>
                                            
                                                <?php 
                                                foreach($band_channel as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <?php if($user_data['role'] == 1)
                                {
                                    ?>

                                
                                <li style="vertical-align: middle;">
                                    <h4>Personal Affiliates Channels</h4>
                                    <table>
                                        <tbody>
                                            
                                                <?php 
                                                foreach($affiliates_channel as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                                <?php } ?>
                                <li style="vertical-align: middle;">
                                    <h4>Other Affiliates channels</h4>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">Level 1</td>
                                            </tr>
                                             <?php 
                                                foreach($dataChannel1 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="2">Level 2</td>
                                                </tr>
                                                <?php 
                                                foreach($dataChannel2 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="2">Level 3</td>
                                                </tr>
                                                <?php 
                                                foreach($dataChannel3 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="2">Level 4</td>
                                                </tr>
                                                <?php 
                                                foreach($dataChannel4 as $row) {
                                                    ?>
                                                <tr>
                                                    <td>
                                                        <a class="load_iframe" href="#" >
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="load_iframe" href="#">
                                                            <input type="hidden" name="link_iframe" value="<?php echo base_url()?>chat/channel/<?=$row['channel_id']?>" />
                                                            <span class="userNames">Channel <?=$row['name']?></span>
                                                        </a> 
                                                    </td>
                                                </tr>
                                                <?php }
                                                ?>
                                        </tbody>
                                    </table>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                      <h2> Notify <?php if (count($invite_contacts) != 0) {
    echo '<span class="badge">'.count($invite_contacts).'</span>';
}?></h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght" id="invite_contacts" style="display: none;">
                        <div class="notification">
                                <ul class="media-list">
                                    <?php 
                                    foreach ($invite_contacts as $row) {
                                        if($this->M_user->get_user_role($row['user_invite']) == 1)
                                        {
                                            $avata = $this->M_user->get_avata($row['user_invite']);
                                        }
                                        else{
                                            $avata = $this->M_user->get_avata_flp($row['user_invite']);
                                            }
                                        ?>
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                              <img class="media-object" width="35" height="35" src="<?php echo $avata; ?>" alt="...">
                                            </a>
                                            <div class="media-body">
                                                <input type="hidden" name="invite"  value="<?php echo $row['id']?>" />   
                                                <h4 class="media-heading"><?php echo  $this->M_user->get_name($row['user_invite'])?><button class="label label-primary btn_accept">Accept</button> <button class="label label-danger btn_delete">Delete</button></h4>
                                                 <?php echo $row['messages']?>
                                            </div>
                                        </li>
                                        <?php

                                    }
                                    ?>
                                    
                                </ul>
                                <form id="contact_form_accept" action="<?php echo base_url()?>chat/addfriend" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <input type="hidden" id="id_invite" name="id_invite"/>
                                </form>
                                <form id="contact_form_delete" action="<?php echo base_url()?>chat/deleteinvite" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <input type="hidden" class="id_invite" name="id_invite"/>
                                </form>                               
                            </div>   
                    </div>
                </div>
               <!--  <div class="panel panel-success panel-height">
                    <div class="panel-heading pancol">
                        <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#filterPanel6">Notify <?php if (count($invite_contacts) != 0) {
    echo '<span class="badge">'.count($invite_contacts).'</span>';
}?></a> 
                                <span class="pull-right panel-collapse-clickable" data-toggle="collapse" data-parent="#accordion" href="#filterPanel6">
                                    <i class="glyphicon glyphicon-chevron-down"></i>
                                </span>
                               </h4>
                    </div> -->
                   <!--  <div id="filterPanel6" class="panel-collapse panel-collapse collapse">
                        <div class="panel-body sidehieght" id="invite_contacts"> 
                            <div class="notification">
                                <ul class="media-list">
                                    <?php 
                                    foreach ($invite_contacts as $row) {
                                        if($this->M_user->get_user_role($row['user_invite']) == 1)
                                        {
                                            $avata = $this->M_user->get_avata($row['user_invite']);
                                        }
                                        else{
                                            $avata = $this->M_user->get_avata_flp($row['user_invite']);
                                            }
                                        ?>
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                              <img class="media-object" width="35" height="35" src="<?php echo $avata; ?>" alt="...">
                                            </a>
                                            <div class="media-body">
                                                <input type="hidden" name="invite"  value="<?php echo $row['id']?>" />   
                                                <h4 class="media-heading"><?php echo  $this->M_user->get_name($row['user_invite'])?><button class="label label-primary btn_accept">Accept</button> <button class="label label-danger btn_delete">Delete</button></h4>
                                                 <?php echo $row['messages']?>
                                            </div>
                                        </li>
                                        <?php

                                    }
                                    ?>
                                    
                                </ul>
                                <form id="contact_form_accept" action="<?php echo base_url()?>chat/addfriend" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <input type="hidden" id="id_invite" name="id_invite"/>
                                </form>
                                <form id="contact_form_delete" action="<?php echo base_url()?>chat/deleteinvite" method="post">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <input type="hidden" class="id_invite" name="id_invite"/>
                                </form>                               
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-md-8 col-sm-12">
            <!-- <div class="x_panel tile overflow_hidden">
                    <div class="x_title">
                      <h2> Search</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content sidehieght">
                        <iframe id="frame" src="<?php echo base_url()?>chat/channel/1" frameborder="0" scrolling="auto" width="100%" style="height: 100%; border: none">
                        </iframe>  
                    </div>
                </div> -->
                <div class="main-box">
                   <?php
            if (!empty($data_search)) {
                ?>
                <div class="search-chat panel panel-default">
                    <table class="table table-condensed margin-reset">
                        <tbody>
                            <?php
                                foreach ($data_search as $row) {
                                    if ($row['role'] == 1) {
                                        ?>
                                    <tr>
                                        <td><img class="img-circle" height="35px" width="35px" src="<?php echo  $this->M_user->get_avata($row['id']); ?>"></td>
                                        <td>
                                           <a target="_blank" href="<?php echo base_url().$row['home_page']?>"><span class="userNames"><?=$this->M_user->get_name($row['id'])?> (Artist)</span></a>
                                        </td>  
                                        <td>
                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id']?>" />
                                        <input type="hidden" name="id" id="name_invite" value="<?=$this->M_user->get_name($row['id'])?>" />
                                        <a href="#" class="invitecontact link-effect link-effect-2" data-toggle="modal" data-target="#invite-contact"><span data-hover="Add to Contacts">Add to Contacts</span></a>
                                    </tr>
                                    <?php

                                    } elseif ($row['role'] == 2) {
                                        ?>
                                    <tr>
                                        <td><img class="img-circle" height="35px" width="35px" src="<?php echo base_url()?>assets/images/default-img.gif"></td>
                                        <td>
                                           <a target="_blank" href="#"><span class="userNames"><?=$this->M_user->get_name($row['id'])?> (Fan)</span></a>
                                        </td> 
                                        <td>
                                            <input type="hidden" name="id" id="id" value="<?php echo $row['id']?>" />
                                            <input type="hidden" name="id" id="name_invite" value="<?=$this->M_user->get_name($row['id'])?>" />
                                            <a href="#" class="invitecontact link-effect link-effect-2" data-toggle="modal" data-target="#invite-contact"><span data-hover="Add to Contacts">Add to Contacts</span></a>
                                        </td>
                                    </tr>
                                    <?php

                                    }
                                } ?>
                        </tbody>
                    </table>
                </div>
                <?php

            } else {
                ?>
                <div class="search-chat panel11 panel-default" style="position: relative;height: 554px;">
                    <iframe id="frame" src="<?php echo base_url()?>chat/channel/1" frameborder="0" scrolling="auto" width="100%" style="height: 100%; border: none">
                     </iframe>
                </div>
                <?php

            }
            ?>
                </div>
                <!--end box1-->
            </div>
        </div>
    </div>
</div>
<!-- Modal Invite Contact -->
<div class="modal fade" id="invite-contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Invite Contact (<span class="name_contact"></span>)</h4>
            </div>
            <form class="form form-signup" action="<?php echo base_url()?>chat/invite_contact" method="post"  >
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-input col-md-3">Messages</label>
                        <div class="input-group col-md-8">
                            <input type="hidden" name ="user_invite" value="<?php echo $user_data['id']?>" />
                            <input type="hidden" name ="user_to" id="user_id2" value="<?php echo $user_data['id']?>" />
                            <textarea class="form-control" rows="5" name="messages_invite">Hi, I'd like to add you as a contact.</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add to Contacts</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal New Group -->
<div class="modal fade" id="addgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Group</h4>
            </div>
            <form class="form form-signup" action="<?php echo base_url()?>chat/addgroup" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-input col-md-3">Name Group:</label>
                    <div class="input-group col-md-8">
                        <input type="text"class="form-control" name="name" required=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-input col-md-3">Member :</label>
                    <div class="input-group col-md-8">
                        <select name="members[]" class="chosen-select form-control" multiple="multiple" data-placeholder="Choose Member..." id="editar-element-6">
                        <?php foreach ($friends as $row) {
                            if ($row['role'] == 1) {
                                ?><option  value="<?php echo $row['id']?>"><?=$this->M_user->get_name($row['id'])?> (A)</option><?php

                            } elseif ($row['role'] == 2) {
                                ?><option value="<?php echo $row['id']?>"><?=$this->M_user->get_name($row['id'])?>(F)</option><?php

                            }
                        }?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-input col-md-3">Avata :</label>
                    <div class="input-group col-md-8">
                        <input type="file" class="form-control" name="avata" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Group -->
<div class="modal fade" id="editgroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
            </div>
            <form class="form form-signup" action="<?php echo base_url()?>chat/editgroup" method="post" enctype="multipart/form-data" >
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-input col-md-3">Name Group *:</label>
                    <div class="input-group col-md-8">
                        <input type="hidden" class="form-control" name="id_group" required="" id="edit_group"/>
                        <input type="text" class="form-control" name="name" required="" id="edit_name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-input col-md-3">Member :</label>
                    <div class="input-group col-md-8">
                        <select name="members[]" id="edit_member" class="chosen-select form-control" multiple="multiple" data-placeholder="Choose Member..." id="editar-element-6">
                        <?php foreach ($friends as $row) {
    if ($row['role'] == 1) {
        ?><option value="<?php echo strval($row['id'])?>"><?=$this->M_user->get_name($row['id'])?> (A)</option><?php

    } elseif ($row['role'] == 2) {
        ?><option value="<?php echo strval($row['id'])?>"><?=$this->M_user->get_name($row['id'])?>(F)</option><?php

    }
}?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-input col-md-3">Avata :</label>
                    <div class="input-group col-md-8">
                        <input type="file" class="form-control" name="avata" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<form id="form_delete" action="<?php echo base_url()?>chat/delgroup" method="post">
    <input type="hidden" id="delete_id" name="id" />
</form>

<script type="text/javascript">
function set_value(name, id){
        $('#user_id2').val(id);
        $('.name_contact').html(name);
    }
    $(function(){
$(document).on("keyup", "#searchid",function() 
{ 
    var searchid = $(this).val();
var dataString = {"key":searchid,
   "<?=$this->security->get_csrf_token_name();?>":"<?=$this->security->get_csrf_hash();?>"
};

if(searchid!='')
{
    console.log("function call");
    $.ajax({
    type: "POST",
    url: "<?php echo base_url('chat/search')?>",
    data: dataString,
    dataType : "json",
    cache: false,
    success: function(html)
    {
        $("#result").html(html).show();
    }
    });
}return false;    
});

});
</script>

