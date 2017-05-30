<link rel="stylesheet" href="<?=base_url()?>assets/css/amper_chat.css"/>
<script>
var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
var link = "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/amp/chat.js"></script>
<div class="page page-full page-chat" style="min-height: 100vh;">
	<div class="tbox tbox-sm header_wrap" style="position:relative">
		<!-- left side -->
		<div class="tcol w-xl bg-tr-white lt b-r">
			<!-- left side header-->
			<div class="p-15 bg-white">
				<div class="btn-group pull-right">
					<button class="btn btn-sm btn-default pull-right visible-sm visible-xs ml-5 collapsed" data-toggle="collapse" data-target="#open-chats" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-bars"></i></button>
				</div>
			</div>
			<!-- /left side header -->
			<!-- left side body -->
			<div class="p-15 collapse-xs collapse-sm collapse" id="open-chats" aria-expanded="false" style="height: 30px;">
				<div style="width:100%;position:relative">
                	<i class="fa fa-search search_icon"></i>
                </div>
                <input type="text" class="form-control new_search" placeholder="Search...">
                <ul class="nav nav-tabs tab_wrap" role="tablist">
                    <li class="active"><a href="#recent" role="tab" data-toggle="tab"><i class="fa fa-history"></i> Recent</a></li>
                    <?php
                    if ($user_data['role'] == 1) {
                        ?>
                        <li ><a href="#mychannel"  onclick="load_iframe_artist('<?=$U_map['affiliate_id']?>');" role="tab" data-toggle="tab">
                        <i class="fa fa-signal"></i> My Channel</a></li>
					    <?php
                    }
                    ?>
                    <li><a href="#channel_art" role="tab" data-toggle="tab"><i class="fa fa-music"></i> Channel Artist</a></li>
                    <li><a href="#affiliate1" role="tab" data-toggle="tab"><i class="fa fa-headphones"></i> Level 1</a></li>
					<li><a href="#affiliate2" role="tab" data-toggle="tab"><i class="fa fa-headphones"></i> Level 2</a></li>
					<li><a href="#affiliate3" role="tab" data-toggle="tab"><i class="fa fa-headphones"></i> Level 3 </a></li>
                    <li><a href="#affiliate4" role="tab" data-toggle="tab"><i class="fa fa-headphones"></i> Level 4 </a></li>
                </ul>
                <!-- Tab panes -->
				<div class="tab-content"> 
                    <!-- Tab panes group-->
                    <div class="tab-pane active" id="recent">
        				<ul class="list-unstyled list_recent_chat" id="inbox">
                            <input type="hidden" value="1" class="level_page" />
                            <?php
                            foreach ($list_chat as $row) {
                                if ($row->receiver == $user_data['id']) {
                                    $num_unread = $this->M_affiliate->total_chat_unread($row->user_id, $row->receiver); ?>
                                    <li>
                						<a href="javascript:;" onclick="load_iframe('<?=$row->user_id?>');"  >
                							<div class="media">
                								<div class="media-left thumb thumb-sm">
                									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($row->user_id)?>"/>
                								</div>
                								<div class="media-body">
                									<p class="media-heading">
                										<span class="text-strong"><?=$this->M_user->get_name($row->user_id)?></span>
                									    <?php if ($num_unread != 0) {
    ?><span class="badge bg-lightred"><?=$num_unread?></span><?php

} ?>
                                                        
                                                    	<small class="text-muted pull-right"><?=time_calculation($row->max_time)?></small>
                									</p>
                									<div class="chat-actions pull-right">
                										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
                										<span class="archive"><i class="fa fa-times"></i></span>
                									</div>
                                                </div>
                							</div>
                						</a>
                					</li>
                                <?php

                                } else {
                                    ?>
                                    <li>
                						<a href="javascript:;" onclick="load_iframe('<?=$row->receiver?>');"  >
                							<div class="media">
                								<div class="media-left thumb thumb-sm">
                									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($row->receiver)?>"/>
                								</div>
                								<div class="media-body">
                									<p class="media-heading">
                										<span class="text-strong"><?=$this->M_user->get_name($row->receiver)?></span>
                									    <small class="text-muted pull-right"><?=time_calculation($row->max_time)?></small>
                									</p>
                									<div class="chat-actions pull-right">
                										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
                										<span class="archive"><i class="fa fa-times"></i></span>
                									</div>
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
                    <?php
                    if ($user_data['role'] == 1) {
                        ?>
                        <div class="tab-pane " id="mychannel"></div>
                        <?php

                    }?>
                    <div class="tab-pane " id="channel_art">
        				<ul class="list-unstyled list_artist_chat" id="inbox">
        					<input type="hidden" value="1" class="level_data" />
                            <input type="hidden" value="1" class="level_page" />
                            <?php
                            foreach ($list_artist as $id_user) {
                                if ($id_user != $user_data['id']) {
                                    ?>
                                    <li>
                						<a href="javascript:;" onclick="load_iframe_artist('<?=$this->M_affiliate->get_affilaite_id($id_user)?>');"  >
                							<div class="media">
                								<div class="media-left thumb thumb-sm">
                									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($id_user)?>">
                								</div>
                								<div class="media-body">
                									<p class="media-heading">
                										<span class="text-strong"><?=$this->M_user->get_name($id_user)?></span>
                										<small class="text-muted pull-right">16:54, 24.11.2014</small>
                									</p>
                									<div class="chat-actions pull-right">
                										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
                										<span class="archive"><i class="fa fa-times"></i></span>
                									</div>
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
					<div class="tab-pane" id="affiliate1">
        				<ul class="list-unstyled list_affilaite" id="inbox">
                            <input type="hidden" value="1" class="level_data" />
                            <input type="hidden" value="1" class="level_page" />
                            <?php
                            foreach ($list_level_1 as $row) {
                                ?>
                                <li>
            						<a href="javascript:;" onclick="load_iframe('<?=$row->id?>');"  >
            							<div class="media">
            								<div class="media-left thumb thumb-sm">
            									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($row->id)?>">
            								</div>
            								<div class="media-body">
            									<p class="media-heading">
            										<span class="text-strong"><?=$this->M_user->get_name($row->id)?></span>
            										<small class="text-muted pull-right">16:54, 24.11.2014</small>
            									</p>
            									<div class="chat-actions pull-right">
            										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
            										<span class="archive"><i class="fa fa-times"></i></span>
            									</div>
                                            </div>
            							</div>
            						</a>
            					</li>
                                <?php

                            }
                            ?>
        					
        				</ul>
                    </div>
                    <div class="tab-pane" id="affiliate2">
                        <ul class="list-unstyled list_affilaite" id="inbox">
                            <input type="hidden" value="2" class="level_data" />
                            <input type="hidden" value="1" class="level_page" />
                            <?php
                            foreach ($list_level_2 as $row) {
                                ?>
                                <li>
            						<a href="javascript:;" onclick="load_iframe('<?=$row->id?>');" >
            							<div class="media">
            								<div class="media-left thumb thumb-sm">
            									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($row->id)?>">
            								</div>
            								<div class="media-body">
            									<p class="media-heading">
            										<span class="text-strong"><?=$this->M_user->get_name($row->id)?></span>
            										<small class="text-muted pull-right">16:54, 24.11.2014</small>
            									</p>
            									<div class="chat-actions pull-right">
            										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
            										<span class="archive"><i class="fa fa-times"></i></span>
            									</div>
                                            </div>
            							</div>
            						</a>
            					</li>
                                <?php

                            }
                            ?>
        					
        				</ul>
                    </div>
                    <div class="tab-pane" id="affiliate3">
        				<ul class="list-unstyled list_affilaite" id="inbox">
                            <input type="hidden" value="3" class="level_data" />
                            <input type="hidden" value="1" class="level_page" />
        					<?php
                            foreach ($list_level_3 as $row) {
                                ?>
                                <li>
            						<a href="javascript:;" >
            							<div class="media">
            								<div class="media-left thumb thumb-sm">
            									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($row->id)?>">
            								</div>
            								<div class="media-body">
            									<p class="media-heading">
            										<span class="text-strong"><?=$this->M_user->get_name($row->id)?></span>
            										<small class="text-muted pull-right">16:54, 24.11.2014</small>
            									</p>
            									<div class="chat-actions pull-right">
            										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
            										<span class="archive"><i class="fa fa-times"></i></span>
            									</div>
                                            </div>
            							</div>
            						</a>
            					</li>
                                <?php

                            }
                            ?>
        				</ul>
                    </div>
                    <div class="tab-pane" id="affiliate4">
        				<ul class="list-unstyled list_affilaite" id="inbox">
                            <input type="hidden" value="4" class="level_data" />
                            <input type="hidden" value="1" class="level_page" />
        					<?php
                            foreach ($list_level_4 as $row) {
                                ?>
                                <li>
            						<a href="javascript:;" >
            							<div class="media">
            								<div class="media-left thumb thumb-sm">
            									<img class="media-object img-circle" src="<?=$this->M_user->get_avata($row->id)?>">
            								</div>
            								<div class="media-body">
            									<p class="media-heading">
            										<span class="text-strong"><?=$this->M_user->get_name($row->id)?></span>
            										<small class="text-muted pull-right">16:54, 24.11.2014</small>
            									</p>
            									<div class="chat-actions pull-right">
            										<span class="mark-readed"><i class="fa fa-circle-o"></i></span>
            										<span class="archive"><i class="fa fa-times"></i></span>
            									</div>
                                            </div>
            							</div>
            						</a>
            					</li>
                                <?php

                            }
                            ?>
        				</ul>
                    </div>
                </div>
                
			</div>
			<!-- /left side body -->
		</div>
		<!-- /left side -->
		<!-- right side -->
		<div class="tcol">
			<!-- right side header -->
			<!-- /right side header -->
			<!-- right side body -->
			<div class="p-15">
				<!-- chats -->
                <?php
                if ($user_data['role'] == 1) {
                    ?>
                    <iframe id="frame" src="<?php echo base_url()?>chat/artist/<?=$U_map['affiliate_id']?>" frameborder="0" scrolling="auto" width="100%" style="border: none;height: 530px"></iframe>
                    <?php

                } else {
                    ?>
                    <iframe id="frame" src="" frameborder="0" scrolling="auto" width="100%" style="border: none;height: 530px"></iframe>
                    <?php

                }
                ?>
				
				<!-- / chats -->
			</div>
			<!-- /right side body -->
		</div>
		<!-- /right side -->
	</div>
</div>