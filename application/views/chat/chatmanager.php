<link href="<?php echo base_url()?>assets/css/chosen.min.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/chat/jChat.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo base_url()?>assets/css/chat/chatdashboard.css" rel="stylesheet" media="screen" type="text/css" />
<script src="<?php echo base_url()?>assets/js/chosen.jquery.min.js" type="text/javascript"></script> 
<script>
var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
var link = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/chat/chat_dashboard.js"></script>  
<div class="dashboard-chat container" style="min-height: 100vh;">
	<div class="row">   
        <h1 class="oswaldregularh3" about="/content_homes1_tittle_new1_81/">
             <span property="content" id= "content_homes1_tittle_new1_81">
                <?php
                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_81_s>', 'Dashboard Chat');
                ?>
            </span>
        </h1>
        <div class="bottomheader wow zoomIn" data-wow-delay="0.5s"></div>
        
		<div class="col-md-5 col-lg-5">
			<div class="panel panel-default" style="background-color: rgba(0, 0, 0, 0.53);">
				<div class="panel-heading">
                    <h4 class="tt" about="/content_homes1_tittle_new1_82/">                        
                         <span property="content" id= "content_homes1_tittle_new1_82">
                                <?php
                                    echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_82_s>', 'Profile');
                                ?>
                         </span>
                    </h4>
                    <span class="liner"></span>
				</div>
				<div class="panel-body" style=" color: #fff;">
					<span class="rect image_frame"><img height="50px" width="50px"class="img-circle" alt="" src="<?php echo $avata?>" title=""></span>
					<div class="text text-capitalize">
						<?= $this->M_user->get_name($user_data['id'])?>
					</div>
					<hr />
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#recent" role="tab" data-toggle="tab">Recent</a></li>
						<li><a href="#friend" role="tab" data-toggle="tab">Contacts</a></li>
						<li><a href="#groups" role="tab" data-toggle="tab">Groups</a></li>
						<li><a href="#channel" role="tab" data-toggle="tab">Channel </a></li>
                        <li><a href="#invite_contacts" role="tab" data-toggle="tab"><?php if (count($invite_contacts) != 0) {
    echo '<span class="badge pull-right">'.count($invite_contacts).'</span>';
}?> Notify </a></li>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
                        <div class="tab-pane active" id="recent">
        				    <ul class="list-unstyled list_recent_chat" id="inbox">
                                <input type="hidden" value="1" class="level_page" />
                                <?php
                                foreach ($recent_chat as $row) {
                                    if ($row->receiver == $user_data['id']) {
                                        $num_unread = $this->M_affiliate->total_chat_unread($row->user_id, $row->receiver); ?>
                                        <li>
                    						<a class="load_iframe" href="#" >
                                                <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->user_id?>" />
                                                <div class="media">
                    								<div class="media-left thumb thumb-sm">
                    									<img class="media-object img-circle"  src="<?=$this->M_user->get_avata($row->user_id)?>"/>
                    								</div>
                    								<div class="media-body">
                    									<p class="media-heading">
                    										<span class="text-strong"><?=$this->M_user->get_name($row->user_id)?></span>
                    									    <?php if ($num_unread != 0) {
    ?><span class="badge bg-lightred"><?=$num_unread?></span><?php

} ?>
                                                            
                                                        	<small class="text-muted pull-right"><?=time_calculation($row->max_time)?></small>
                    									</p>
                                                    </div>
                    							</div>
                    						</a>
                    					</li>
                                    <?php

                                    } else {
                                        ?>
                                        <li >
                    						<a class="load_iframe" href="#" >
                                                <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row->receiver?>" />
                                                <div class="media">
                    								<div class="media-left thumb thumb-sm">
                    									<img class="media-object img-circle"  src="<?=$this->M_user->get_avata($row->receiver)?>"/>
                    								</div>
                    								<div class="media-body">
                    									<p class="media-heading">
                    										<span class="text-strong"><?=$this->M_user->get_name($row->receiver)?></span>
                    									    <small class="text-muted pull-right"><?=time_calculation($row->max_time)?></small>
                    									</p>
                                                    </div>
                    							</div>
                    						</a>
                    					</li>
                                    <?php

                                    }
                                }
                                ?>
                            </ul>
                        </div>
						<div class="tab-pane " id="friend">
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
    										<td><span class="on-row"><span class="label label-success">online</span></span></td>
                                            <td>
                                                <div class="btn-group" style="float: right;">
                                                    <button  class="btn btn-hover btn-xs dropdown-toggle" data-toggle="dropdown" >
                                                        <i class="fa fa-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu menu" role="menu">
                                                        <li><a class="btn-del" href="#"> Profile</a></li>
                                                        <li><a class="btn-del" href="<?php echo base_url().'chat/endcontact/'.$row['id']?>"><i class="glyphicon glyphicon-remove-circle"></i> End Contact</a></li>
                                                    </ul>
                                                </div>
                                            </td>
    									</tr>    
                                        <?php

                                        } elseif ($row['role'] == 2) {
                                            ?>
                                        <tr>
    										<td><a class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <img class="img-circle" height="35px" width="35px" src="<?php echo  $this->M_user->get_avata($row['id']); ?>">
                                            </a></td>
    										<td><a  class="load_iframe"  href="#">
                                            <input type="hidden" name="link_iframe" value="<?php echo base_url().'chat/'.$row['id']?>" />
                                            <span class="userNames"><?=$this->M_user->get_name($row['id']) ?> (Fan)</span></a> <br><span class="status"><?php echo $row['status']?></span></td>
    										<td><span class="on-row"><span class="label label-success">online</span></span></td>
                                            <td>
                                                <div class="btn-group" style="float: right;">
                                                    <button  class="btn btn-hover btn-xs dropdown-toggle" data-toggle="dropdown" >
                                                        <i class="fa fa-chevron-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu menu" role="menu">
                                                        <li><a class="btn-del" href="#"> Profile</a></li>
                                                        <li><a class="btn-del" href="<?php echo base_url().'chat/endcontact/'.$row['id']?>"><i class="glyphicon glyphicon-remove-circle"></i> End Contact</a></li>
                                                    </ul>
                                                </div>
                                            </td>
    									</tr>    
                                        <?php

                                        }
                                    }
                                    ?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane " id="groups">
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
						<div class="tab-pane" id="channel">
                            <table class="table table-condensed margin-reset">
								<tbody>
                                    <tr>
                                        <th>Public channels</th>
                                    </tr>
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
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Private channels</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <th>Tour Channels</th>
                                                </tr>
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
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <th>Band Channel</th>
                                                </tr>
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
                                            </table>
                                        </td>
									</tr>
								</tbody>
							</table>
                        </div>
                        <div class="tab-pane" id="invite_contacts">
                            <div class="notification">
                                <ul class="media-list">
                                    <?php 
                                    foreach ($invite_contacts as $row) {
                                        ?>
                                        <li class="media">
                                            <a class="pull-left" href="#">
                                              <img class="media-object" width="35" height="35" src="<?php echo  $this->M_user->get_avata($row['user_invite']); ?>" alt="...">
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
				</div>
			</div>
		</div>
		<div class="col-md-7 col-lg-7">
			<div class="panel panel-default">
                <div class="panel-heading">                   
                    <h4 class="tt" about="/content_homes1_tittle_new1_85/">
                         <span property="content" id= "content_homes1_tittle_new1_85">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_85_s>', 'Search');
                            ?>
                        </span>
                   </h4>
                    <span class="liner"></span>
				</div>
                  <div class="panel-body">
                    <div class="row">
                    	<div class="col-lg-10">
                            Search Name or Email
                            <form action="<?php echo base_url('chat/search')?>" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <div class="input-group">
                        			<input type="text" id="searchid" class="input_chat form-control search" name="key" required="" />
                                    <div class="search-chat" id="result"></div>
                        			<!-- <span class="input-group-btn">
                        			<button type="submit" class="btn btn-default" type="button">Search</button>
                        			</span> -->
                        		</div>
                            </form>
                    	</div>
                    </div>
                  </div>
            </div>
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
                    <iframe id="frame" src="<?php echo base_url()?>chat/channel/1" frameborder="0" scrolling="auto" width="100%" style="position: absolute; height: 100%; border: none">
                     </iframe>
                </div>
                <?php

            }
            ?>
            
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
                        <input type="hidden"class="form-control" name="id_group" required="" id="edit_group"/>
						<input type="text"class="form-control" name="name" required="" id="edit_name"/>
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
        console.log(id);
        console.log(name);
        $('#user_id2').val(id);
        $('.name_contact').html(name);
    }
    $(function(){
$(document).on("keyup", ".search",function() 
{ 
    console.log("function");
var searchid = $(this).val();
console.log(searchid);
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
        console.log("res");
        console.log(html);

        $("#result").html(html).show();
    }
    });
}return false;    
});

});
</script>
