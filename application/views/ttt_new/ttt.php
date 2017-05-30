<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel='stylesheet' href='<?php echo base_url() ?>assets/dist/fullcalendar/lib/cupertino/jquery-ui.min.css' />
<link href="<?php echo base_url('assets/css/ttt_styles.css');?>" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/map/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/bootstrap-social.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
<link href='<?php echo base_url() ?>assets/dist/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/dist/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href='<?php echo base_url() ?>assets/dist/css/alertify.default.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/dist/css/alertify.core.css' rel='stylesheet' />
<link href="<?php echo base_url('assets/dist/css/map-styles.css');?>" rel="stylesheet" />

<link href="<?php echo base_url() ?>assets/ttt_new/new_ttt.css" rel="stylesheet">
<style type="text/css">
body {
    background: #2A3F54;
}
.home_panel{
	background : rgba(153, 153, 153, 0.35);
}
.min_height90{
	min-height: 90px !important;
}
.min_height75{
	min-height: 75px;
}
#map_canvas {background: transparent url(<?php echo base_url() ?>assets/images/ajax-loading.gif) no-repeat center center;}
</style>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?php echo $this->M_user->get_avata($user_data['id'])?>" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome, <?php echo $user_data['artist_name']?> </span>
                            <h2><i class="fa fa-map-marker"></i> <?php echo $user_data['city']?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu1">
                                <li>
                                	<a data-toggle="pill"  href="#home"><i class="fa fa-home"></i> Home Tour</a>
                                </li>
                                <li >
                                	<a  data-toggle="pill"  href="#manager_member_div"  onclick="get_manager_member_view($('#tours').val())"><i class="fa fa-edit"></i> Manager Member </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#manager_calculate_div" onclick="if($('#location_all').val() !== ''){get_calculate_view_tourid_location_id($('#tours').val(),$('#location_all option:selected').val() )}else{get_manager_calculate_view($('#tours').val())}"><i class="fa fa-calculator"></i> Manager Calculate </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#manager_event_div" onclick="if($('#location_all').val() !== ''){get_manager_event_view_tour_location($('#tours').val(),$('#location_all option:selected').val() )}else{get_manager_event_view($('#tours').val())}"><i class="fa  fa-calendar"></i> Manager Event </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#daily_schedules_div" onclick="if($('#location_all').val() !== ''){get_daily_schedules_view_tour_location($('#tours').val(),$('#location_all option:selected').val() )}else{get_daily_schedules_view($('#tours').val())}"><i class="fa fa-bar-chart-o"></i> Daily Schedules </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#find_locations_div"  onclick="get_find_locations_view($('#tours').val())"><i class="fa fa-location-arrow"></i> Find locations </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#social_media_div" onclick="if($('#location_all').val() !== ''){get_social_media_view_tour_location($('#tours').val(),$('#location_all option:selected').val() )}else{get_social_media_view($('#tours').val())}"><i class="fa fa-clone"></i> Social media </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#chat_member_div"  onclick="get_chat_members_view($('#tours').val())"><i class="fa fa-wechat" ></i> Chat Member </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"   href="#road_map_tour_div" onclick="get_road_map_tour_view($('#tours').val())"><i class="fa fa-road"></i> Road map tour </a>
                                </li>
                                <li>
                                	<a data-toggle="pill"  href="#book_show_div" onclick="if($('#location_all').val() !== ''){get_book_show_tour_view_location($('#tours').val(),$('#location_all option:selected').val() )}else{get_book_show_tour_view($('#tours').val())}"><i class="fa fa-road"></i> Book Show </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <!-- page content -->
            <div class="tab-content">
            	<!-- Section for home started -->
	            <div class="right_col tab-pane fade in active" role="main" id="home">
	            	<div class="home_page_div">
	            		<div class="container">
							<h2>Home Tour</h2>            		
    						<br>
							<div class="row">
								<div class="home_panel tile col-xs-12 col-md-12 col-sm-12">
									<h2 class="tt text_caplock">Destination</h2>
									<hr>
									<div class="col-md-4 col-sm-4 col-xs-12">
						              	<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-plus-square"></i> Add New Tour</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
								                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								                    </li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
							                  	<form action="javascript:void(0);" method="post">
						            				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
						            				<br>
						            				<div class="searchform col-xs-12 col-md-12 col-sm-12 min_height75 text-center">
						                                <button class="btn btn-primary" onclick="view_tour_modal('new')">Add new Tour</button>
						                            </div>
						                            
						                            <div class="searchform col-xs-12 col-md-12 col-sm-12 min_height75"> 
						                             	<div class="col-md-4">
						                             		<label id="label-tour">List tours: </label> 
						                             	</div>      
						                                 <div class="col-md-8 tours"> 
						                                    <select class="" id="tours" onchange="get_location($(this).val());">
						                                      <?php if (isset($tours) and !empty($tours)): ?>
						                                        <?php foreach ($tours as $tour): ?>
						                                          <option value="<?= $tour['tour_id'] ?>"><?= ucfirst($tour['tour']) ?></option>    
						                                        <?php endforeach;?>                         
						                                      <?php else: ?>
						                                        <option value="">No Reocrd Found!!!</option>
						                                      <?php endif; ?>
						                                    </select>
						                            	</div>
													</div>
													<br>
						                            <br>
													<div class="searchform col-xs-12 col-md-12 min_height90 col-sm-12 detele_edit " >
													   <div class="col-md-6 col-sm-6 col-xs-12 text-center">
													   		 <input type="submit" value="Delete" id="delete_tour_d" onclick="delete_tour()" class="btn btn-danger" />
														</div>
														<div class="col-md-6 col-sm-6 col-xs-12 text-center">
															
						                                    <input type="submit" value="Edit" id="edit_tour_e" name="edit" class="btn btn-info inputblue" onclick="view_tour_modal('edit')" />     
						                                </div> 
												  </div>
						                      	</form>
							                </div>
						              	</div>
						            </div>
						            <div class="col-md-4 col-sm-4 col-xs-12">
						              	<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa  fa-map-marker"></i> Find or Add New Location</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
								                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								                    </li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
						                  	 	<form action="" method="post" style="padding-top:10px;" id="cont_promo">
						            				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
						                            <div class="col-xs-12 col-md-12 min_height90 col-sm-12">
						                            	<div class="col-xs-12 col-md-6 col-sm-6 text-center">
						                            		<button class="btn btn-primary left_find" onclick="view_location_home_modal('new','save_location()')" >Find new Location</button>
						                            	</div>
						                            	<div class="col-xs-12 col-md-6 col-sm-6 text-center">
						                            		<button class="btn btn-primary" onclick="view_create_location_modal('new','save_location()')" >Add new Location</button>
						                            	</div>
						                                
						                                
						                            </div>
						                            <div class="searchform col-xs-12 col-md-12 min_height90 col-sm-12 detele_edit2">
						                                <div class="col-md-4 col-sm-6">
						                                 	<label id="label-tour">List Locations: </label>
						                             	</div> 
						                            	<div class="col-md-8 col-sm-6 tours"> 
						                            		<select id="location_all" onchange="create_map();change_location(this.value)" class="location_all">
						                                    	<option value="">Location</option>
						                                   	</select>
						                             	</div>
						                            </div>
						                            <div class="col-xs-12 col-md-12 min_height75 col-sm-12 detele_edit">
													    <div class="searchform col-md-6 col-sm-6 col-xs-12">
						                                 	<input type="submit" value="Delete" id="delete_ttt" onclick="delete_location()" class="btn btn-danger" />
														</div>
														<div class="searchform col-md-6 col-sm-6 col-xs-12">
						                                  	<input type="submit" value="Edit" id="delete_ttt" onclick="view_location_home_modal('edit','save_location()')" class="btn btn-info inputblue" />
						                              	</div>
						                         	</div>
						                        </form>
							                </div>
						              	</div>
						            </div>
						            <div class="col-md-4 col-sm-4 col-xs-12">
						              	<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-tasks"></i> List Contact/Promoter</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
								                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								                    </li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
							                  	<div class="searchform searchform_new ">
						                           <h4 ><label>List Contact/Promoter</label></h4>
						                           <div class="showlisr_member"></div>
						                        </div>
						                        <div class="text-center">
						                           <a data-toggle="pill" 
						                           href="#manager_member_div" class="btn btn-primary linkmenumember" onclick="get_manager_member_view($('#tours').val())">Manager member</a>
						                        </div>
							                </div>
						              	</div>
						            </div>
								</div>	            			
							</div> <!--Row destination end-->
							<br>
							<div class="row">
								<div class="home_panel tile col-md-12 col-xs-12 col-sm-12">
									<h2 class="tt text_caplock">Details Tour</h2>
									<hr>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-file-text"></i> Description</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
							                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    	</li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content searchform">
							                  	<div class="show_des"></div>
						                        <input type="button" name="add" class="btn btn-info tour_des mj_width " data-toggle="modal" data-target="#uploadDescription" value="Add">
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-hotel"></i> Hotels</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
							                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    	</li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content searchform">
							                  	<div class="show_hotels"></div>
						                        <!-- <button class="btn btn-defaulf tour_tour_hotels mj_width searchform" onclick="add_detail_tour($(this),0,'Add','hotels')" value="Add" >Add</button> -->
						                        <input type="button" name="add" class="btn btn-info tour_tour_hotels mj_width " onclick="add_detail_tour($(this),0,'Add','hotels')" value="Add">
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-road"></i> Transport</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
							                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    	</li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content searchform">
							                  	<div class="show_transport"></div>
						                        <!-- <button class="btn btn-defaulf tour_tour_transport mj_width searchform" onclick="add_detail_tour($(this),0,'Add','transport')" value="Add" >Add</button> -->
						                        <input type="button" name="add" class="btn btn-info tour_tour_transport mj_width" onclick="add_detail_tour($(this),0,'Add','transport')" value="Add">
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-plane"></i> Flight</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
							                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    	</li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content searchform">
							                 	<div class="show_flight"></div>
						                        <!-- <button class="btn btn-defaulf tour_tour_flight mj_width searchform" onclick="add_detail_tour($(this),0,'Add','flight')" value="Add" >Add</button>  -->
						                        <input type="button" name="add" class="btn btn-info tour_tour_flight mj_width " onclick="add_detail_tour($(this),0,'Add','flight')" value="Add">
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-user"></i> Contacts</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
							                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    	</li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
							                  	<div class="detail_contact"></div>
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-clock-o"></i> Local Time</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
							                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    	</li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
							                  	System <span class="clock"></span>
							                </div>
						              	</div>
									</div>
								</div>
							</div> <!--Row Detailed Tour end-->
							<br>
							<div class="row">
								<div class="home_panel tile col-xs-12 col-sm-12 col-md-12">
									<h2 class="tt text_caplock">Manager</h2>
									<hr>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Schedules </h2>
							                  	<ul class="nav navbar-right panel_toolbox">
								                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								                    </li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
							                  	<div class="col-md-12 col-xs-12 col-sm-12 remove_padding  text-center">
						                            
						                            <a data-toggle="pill" 
						                           href="#daily_schedules_div" class="btn btn-primary" onclick="get_daily_schedules_view($('#tours').val())">Manager schedules</a>

						                            <div class="clearfix"></div>
						                        </div>
						                        <table class="table daily_schedules mj_tbl">
						                            
						                        </table>
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title">
							                  	<h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Event</h2>
							                  	<ul class="nav navbar-right panel_toolbox">
								                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								                    </li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content" >
							                  	<div class="col-md-12 col-xs-12 col-sm-12 remove_padding text-center">
						                            
						                            <a data-toggle="pill" 
						                           href="#manager_event_div" class="btn btn-primary" onclick="get_manager_event_view($('#tours').val())">Manager event</a>
						                            <div class="clearfix"></div>
						                        </div>
						                        <div class="col-md-12 remove_padding">
						                            <table class="table table_events mj_tbl">
						                        
						                            </table>
						                        </div>	
							                </div>
						              	</div>
									</div>
									<div class="col-md-4 col-sm-6 col-xs-12">
										<div class="x_panel tile fixed_height_320 overflow_hidden">
							                <div class="x_title weather">
							                  	<h2 class="tt text_caplock"><i class="fa fa-tasks"></i> <span id="content_homes1_tittle_new1_71" class="weatherSpan">Weather Forecast</span></h2>
							                  	<ul class="nav navbar-right panel_toolbox">
								                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
								                    </li>
							                  	</ul>
							                  	<div class="clearfix"></div>
							                </div>
							                <div class="x_content">
							                  	<div class="weatherCls"></div>
							                </div>
						              	</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div  class="col-md-6 col-sm-6 col-xs-12">
									<div id="mj_scal" class="x_panel tile overflow_hidden">
						                <div class="x_title">
						                  	<h2 class="tt text_caplock "> <i class="fa fa-cloud"></i> Weekly Schedules</h2>
						                  	<ul class="nav navbar-right panel_toolbox">
							                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    </li>
						                  	</ul>
						                  	<div class="clearfix"></div>
						                </div>
						                <div class="x_content">
						                  	<div id="calendar"></div>
						                </div>
						          	</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="x_panel tile overflow_hidden">
						                <div class="x_title">
						                  	<h2 class="tt text_caplock "> <i class="fa fa-map-marker"></i> Map</h2>
						                  	<ul class="nav navbar-right panel_toolbox">
							                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							                    </li>
						                  	</ul>
						                  	<div class="clearfix"></div>
						                </div>
						                <div class="x_content">
						                	<div class="bottom_map searchform_new searchform row">
						                       <div class="col-xs-6 max_with" style="float: left;">
											       <div class="col-xs-12 remove_padding">
						                            <input id="geocomplete" class="mj-width" type="text" placeholder="Type in an address" value="" />           </div>
												   <div class="col-xs-12 remove_padding">
						                            <input id="find" class="mj_width" type="button" value="Find Locations" />
												   </div>
						                       </div>
						                        <div class="col-xs-6 max_with" style="float: left;">
												   <div class="col-xs-12 remove_padding">
						                            <input id="lat" class="mj-width" name="lat" type="text" placeholder="Latitude" value=""/>                     </div>
													<div class="col-xs-12 remove_padding">
						                            <input class="mj-width" name="lng" id="lng" type="text" placeholder="Longitute" value="" />                     </div>
													<div class="col-xs-12 remove_padding">
						                            <input name="formatted_address" type="hidden" value="" />
						                            <a id="reset" href="#" style="display:none;">Reset Marker</a>
													</div>
						                        </div>
						                    </div>
						                  	<div class="map_canvas"></div>
						                </div>
						          	</div>	
								</div>
							</div>
						</div>
	            	</div>
	            </div>
	            <!-- Section for home ended -->
	            <!-- Section for Manager Member started -->
	            <div class="right_col tab-pane fade" id="manager_member_div">
	            	<div class="container">
	            		<h2>Manager Member</h2>
	            		<ul class="nav nav-tabs">
	                        <li class="active"><a data-toggle="tab" href="#member1" onclick="get_manager_member_view($('#tours').val())">Current Member</a></li>
	                        <li><a data-toggle="tab" href="#member2" onclick="get_add_new_member_view($('#tours').val())">Add new member</a></li>
                    	</ul>
                    	<div class="tab-content">
	                        <div id="member1" class="container tab-pane fade in active">
	                        	<div id="displayMember"></div>
	                        </div>
	                        <div id="member2" class="container tab-pane fade">
	                        	<div id="addmember">
	                        		
	                        	</div>
	                        </div>
                        </div>	
	            	</div>
	            </div>
	            <!-- Section for Manager Member ended -->
	            <!-- Section for Manager Calculate  started -->
	            <div class="right_col tab-pane fade" id="manager_calculate_div">
	            	<div class="container">
	            		<h2>Manager Calculate</h2>
	            		<div class="container" id="manager_calculate"></div>
	            	</div>
	            </div>
	            <!-- Section for Manager Calculate  ended -->
	            <!-- Section for Manager Event  started -->
	            <div class="right_col tab-pane fade "  id="manager_event_div">
	            	<div class="container">
	            		<h2>Manager Event</h2>
	            		<div id="manager_event"></div>
	            	</div>
	            </div>
	            <!-- Section for Manager Event  ended -->
	            <!-- Section for Daily Schedules  started -->
	            <div class="right_col tab-pane fade" id="daily_schedules_div">
	            	<div class="container">
	            		<h2>Daily Schedules</h2>
	            		<div id="daily_schedules"></div> 
	            	</div>
	            </div>
	            <!-- Section for Daily Schedules  ended -->
	            <!-- Section for Find locations started -->
	            <div class="right_col tab-pane fade "  id="find_locations_div">
	            	<div class="container">
	            		<h2>Find Locations</h2>
            		 	<div id="find_locations"></div> 
	            	</div>
	            </div>
	            <!-- Section for Find locations ended -->
	            <!-- Section for Social Media started -->
	            <div class="right_col tab-pane fade "  id="social_media_div">
	            	<div class="container">
	            		<h2>Social Media</h2>
	            		<script src="https://apis.google.com/js/platform.js" ></script>
						<script src="https://platform.twitter.com/widgets.js" ></script>
						<script src="https://apis.google.com/js/client:platform.js" ></script>
            		 	<div id="social_media"></div> 
	            	</div>
	            </div>
	            <!-- Section for Social Media ended -->
	            <!-- Section for Chat Member started -->
	            <div class="right_col tab-pane fade " id="chat_member_div">
	            	<div class="container">
	            		<h2>Chat Member</h2>
	            		<div id="chat_members"></div> 
	            	</div>
	            </div>
	            <!-- Section for Chat Member ended -->
	            <!-- Section for Road map tour  started -->
	            <div class="right_col tab-pane fade"  id="road_map_tour_div">
	            	<div class="container">
	            		<h2>Road Map Tour</h2>
	            		<script src="<?php echo base_url(); ?>assets/js/detail_pages/ttt/jquery.tokenize.js"></script>
						<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/detail_pages/ttt/jquery.tokenize.css" />
						
	            		<div id="road_map_tour"></div> 
	            	</div>
	            </div>
	            <!-- Section for Road map tour  ended -->
	            <!-- Section for Book Show started -->
	            <div class="right_col tab-pane fade" id="book_show_div">
	            	<div class="container">
	            		<h2>Book Show</h2>
	            		<div id="book_show"></div>
	            	</div>
	            </div>
	            <!-- Section for Book Show ended -->
	            <div class="row description">
                    <?php if ($this->session->flashdata('success_add')) {?>
                    <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                        <strong>Success: </strong> <?php echo $this->session->flashdata('success_add')?> 
                    </div>
                <?php } elseif ($this->session->flashdata('error_add')) { ?>
                    <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error_add'); ?>
                    </div>
                                    <?php

} ?>
             	</div>
            </div><!-- tab content  -->
            <!-- /page content -->
            
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/dist/js/alertify.min.js');?>"></script>
    <script type="text/javascript">
	var intervalId;
	var base_url = "<?php echo base_url() ?>";
	
	var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
	var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
	var user_data_id = <?php echo $user_data['id']; ?>;

	var countries = [];
	<?php foreach ($countries as $country) {
	    ?>
	countries.push("<?php echo $country['country']; ?>");
	<?php 
	}?>
	</script>
	<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=<?php echo $apikey;?>"></script>
	<script src="<?php echo base_url('assets/dist/js/bootstrap-datepicker.min.js');?>"></script>

	<script src="<?php echo base_url('assets/dist/js/jquery.geocomplete.min.js');?>"></script>
	<script src="<?php echo base_url(); ?>assets/js/editor/nicEdit.js" type="text/javascript">
	</script>
	<script src='<?php echo base_url() ?>assets/dist/fullcalendar/lib/moment.min.js'></script>
	<script src='<?php echo base_url() ?>assets/dist/fullcalendar/fullcalendar.min.js'></script>
	
	
	<div id="add_detail_tour" class="modal fade new_modal_style " role="dialog">
    	<div class="modal-dialog">
	     	 <!-- Modal content-->
	      	<div class="modal-content">
	        	<div class="modal-header">
		            <button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
		            <h4 class="tt modal-title">Add description</h4>
		            <span class="liner"></span>
		        </div>
	        	<form id="form_tour_detail_submit" action="<?php echo base_url('') ?>" method="post">
	        
	            	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
	            	<input type="hidden" name="tour_id" class="tour_id_detail" />
	       			 <div class="modal-body" id="form_content_data"></div>
	        		<div class="modal-footer searchform">
	            		<img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
	         		 	<input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
	        		</div>
	        	</form> 
	      	</div>
	 	</div>
	</div>
	<!--Modal to add Description -->
	<div id="uploadDescription" class="modal fade new_modal_style " role="dialog">
    	<div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="tt modal-title">Add description</h4>
		          	<span class="liner"></span>
		        </div>
        		<form id="form_tour_des_submit" action="<?php echo base_url('') ?>" method="post">
        			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
        			<input type="hidden" name="tour_id" class="tour_id_des" />
			        <div class="modal-body" id="form_content">
			            <label class="form-input col-md-12 col-sm-12 col-xs-12" for="event_desc">Description</label>
			            <div class="input-group col-md-12 col-sm-12 col-xs-12
			            ">
			                <textarea class="form-control" id="event_desc_tour" name="event_desc" ></textarea>
			                <span id="er-des"></span>
			            </div>
			        </div>
	        		<div class="modal-footer searchform">
	          			<img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
			          	<input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
			        </div>
        		</form> 
      		</div>
    	</div>
	</div>
	<!-- Modal for add location -->
	<div id="add_detail_location_new" class="modal fade new_modal_style " role="dialog">
    	<div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
	        	<div class="modal-header">
	          		<button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
	          		<h4 class="tt modal-title">Add Location</h4>
	          		<span class="liner"></span>
	        	</div>
        		<form id="form_tour_submit" action="<?php echo base_url('the_total_tour/save_location') ?>" method="post">
        			<input type="hidden" name="get_location" value="get_location" />
        			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
        			<input type="hidden" name="tour_id" class="tour_id_detail" />
        			<input type="hidden" id="tour_name" name="tour" value="1" class="form-control tour_name_val" />
			        <div class="modal-body" id="form_content_data">
			            <div class="form-group">
			                <label class="form-input col-md-3" for="location_country" >Country</label>
			                <div class="input-group col-md-8">
			                    <select name="location_country" onchange="load_locations($(this),'location_city','city')" class="form-control" id="location_country">
			                        <option>- Select -</option>
			                        <?php foreach ($countries as $country) {
			    ?>
			                            <option value="<?php echo $country['country']; ?>"><?php echo $country['country']; ?></option>
			                        <?php 
			}?>
			                    </select>
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="form-input col-md-3" for="location_city">City</label>
			                <div class="input-group col-md-8">
			                    <select name="location_city" onchange="load_locations($(this),'location_name','street1')" class="form-control"  id="location_city">
			                        <option>- Select -</option>
			                        
			                    </select>
			                </div>
			            </div>
			            <div class="form-group">
			                <label class="form-input col-md-3" for="location_name">Address</label>
			                <div class="input-group col-md-8">
			                    <select class="form-control" name="location_name" id="location_name">
			                        <option>- Select -</option>
			                        
			                    </select>
			                </div>
			            </div>
			        </div>
			        <div class="modal-footer searchform">
			          	<img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
			          
			          	<input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
			        </div>
		        </form> 
      		</div>
	 	</div>
	</div>
	<!-- Modal add location ends -->
	<!-- Modal to add new location in database -->
	<div id="add_detail_location_new_create1" class="modal fade new_modal_style " role="dialog">
    	<div class="modal-dialog">
	      	<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="tt modal-title">Add Location</h4>
		          	<span class="liner"></span>
		        </div>
		        <form id="form_tour_submit_new1" action="<?php echo base_url('the_total_tour/save_location') ?>" method="post">
					<input type="hidden" id="emailLoc" name="email_location">
		            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
		            <input type="hidden" name="tour_id" class="tour_id_detail" />
		            <input type="hidden" id="tour_name" name="tour" value="" class="form-control tour_name_val" />
		            <div class="modal-body" id="form_content_data">
		                <div class="form-group">
		                    <label class="form-input col-md-3" for="location_company" >Company</label>
		                    <div class="input-group col-md-8" >
		                        <input type="text" name="location_company" class="form-control" id="location_company"  />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="form-input col-md-3" for="location_email" >Email</label>
		                    <div class="input-group col-md-8" >
		                        <input type="email" name="location_email" class="form-control" id="location_email" />
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="form-input col-md-3" for="location_country" >Country</label>
		                    <div class="input-group col-md-8" >
		                        <input type="text" name="location_country" class="form-control" id="location_country" />
		                        
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="form-input col-md-3" for="location_city">City</label>
		                    <div class="input-group col-md-8">
		                        <input type="text" name="location_city" class="form-control" id="location_city" />
		                        
		                    </div>
		                </div>
		                <div class="form-group">
		                    <label class="form-input col-md-3" for="location_name">Address</label>
		                    <div class="input-group col-md-8">
		                        <input type="text" name="location_name" class="form-control" id="location_name" />
		                        
		                    </div>
		                </div>
		            </div>
		            <div class="modal-footer searchform">
		              <img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
		              
		              <input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
		            </div>
		        </form> 
      		</div>
    	</div>
	</div>

	<!-- odal to add new tour -->
	<div id="form-modal" class="modal fade new_modal_style " role="dialog">
	    <div class="modal-dialog">
			<!-- Modal content-->
	      	<div class="modal-content">
		        <div class="modal-header">
		          	<button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
		          	<h4 class="tt modal-title"><!-- title will apear here --></h4>
		          	<span class="liner"></span>
		        </div>
		        <form id="form_tour_submit_data" action="<?php echo base_url() ?>the_total_tour/save_tour">
			        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
			        <div class="modal-body" id="form_content">
			            <label>Tour</label>
			            <input type="text" id="tour_name_form" name="tour" class="form-control" />
			            <input type="hidden" id="tour_id_form" name="tour_id"  />
			        </div>
			        <div class="modal-footer searchform">
			          	<input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
		        	</div>
		        </form> 
	      	</div>
	    </div>
	</div>
	<!-- modal to add new tour end -->
	<!--modal booking request-->
<div class="modal fade" id="bookShow">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Booking Request</h4>
			</div>
			<div class="modal-body">
				   <form  role="form" action="<?php echo base_url(''); ?>/artist/showgigs/booking_request" method="post">
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />                         
                          <input type="hidden" id="tour_booking"     name="tour_booking"/>
                          <input type="hidden" id="location_booking" name="location_booking"/>                         
                          <input type="hidden" id="user_booking"     name="user_booking"/>
                          <div class="alert alert-danger" style="display: none;" id="error_email">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Warning!</strong>! Please enter a valid email address.
                          </div>
                          <div class="alert alert-danger" style="display: none;" id="error_form">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Warning!</strong>! Please complete the fields valid.
                          </div>
                          <div class="row form-group">
                               <div class="col-md-3">
                                       <label for="email_booking">Form *</label>
                               </div>                               
                               <div class="col-md-9">
                                        <input type="text" class="form-control" id="email_booking" name="email_booking" value="<?php echo $user_data['email'];?>"/>
                               </div>                            
                          </div>
                          
                          <div class="row form-group">
                               <div class="col-md-3">
                                      <label for="expected_draw">Expected Draw*</label>
                               </div>
                               <div class="col-md-9">
                                        <input type="text" class="form-control" id="expected_draw" name="expected_draw"/>
                               </div>                            
                          </div>
                          <div class="row form-group">                               
                               <div class="col-md-3">
                                      <label for="message_booking">Message</label>
                               </div>
                               <div class="col-md-9">
                                     <textarea name="message_booking" id="message_booking" class="form-control" rows="5"></textarea>
                               </div>                            
                          </div>                          
                           <div class="row form-group">
                               <div class="col-md-3">
                                      <label for="contact_booking">Contact Info</label>
                               </div>
                               <div class="col-md-9">
                                     <input type="text" class="form-control" id="contact_booking" name="contact_booking"/>
                               </div>                            
                          </div> 
                          <div class="row form-group">
                               <div class="col-md-3">
                                      <label for="date_booking_from">Available Dates*</label>
                               </div>
                               <div class="col-md-9">                                       
                                     <label for="date_booking_from">From</label><br />  
                                     <input type="text" class="form-control" id="date_booking_from" name="date_booking_from" data-date-format="mm-dd-yyyy"/> <br/>                                  
                                     <br /><label for="date_booking_to">To</label>  
                                     <input type="text" class="form-control" id="date_booking_to" name="date_booking_to" data-date-format="mm-dd-yyyy"/>
                               </div>                            
                          </div> 
                          <input type="hidden" name="email_book" id="email_book">
                          <input type="hidden" name="company_book" id="company_book">                        
                          <div class="modal-footer">                           
            				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            				<button class="btn btn-default previewBtn" type="button">Preview</button>                           
            				<button type="button" class="btn btn-primary" id="button_booking_request">Send</button>
            			</div>                                      
                    </form>                   
		    	</div>		
		</div>
	</div>
</div>
<!--end modal booking-->
<!-- start of EPK selection modal-->
<div class="modal fade" id="previewEPK">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">EPK preview</h4>
                
            </div>
            <form class="form form-signup searchform" id="update_pt" role="form" action="<?php echo base_url()?>artist/presskit/sendmail" method="post">
				<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-body">
					<div class="form-group">
						<label class="form-input col-md-3"> Choose Template Email:</label>
						<div class="input-group col-md-8">
                            <div class="epk-tpl_box_scroll">
                                <ul>
                                <?php  for ($i = 1;$i <= 6;++$i) {
     ?>
                                <li class="<?php if (1 == $i) {
    echo 'selected';
} ?>">
                                    <input type="hidden" class="hidden-val" value="<?= $i?>" />
                                    <a class="clearbg" href="#myModal" data-toggle="modal" data-target="#preview" data-img-url="<?php echo base_url()?>assets/images/email_tpl/tpl_email_epk<?=$i?>.png">
                                    <img style="width: 65px; height: 65px;box-shadow:0px 2px 10px #333;vertical-align: middle; margin-right: 20px;" src="<?php echo base_url()?>assets/images/email_tpl/tpl_email_epk<?=$i?>.png"/>
                                    </a>
                                    <span>Template <?= $i?></span>
                                </li>
                                <?php 
 } ?>   
                                </ul> 
                            </div>
                            
							<input type="hidden" class="form-control" rows="6" name="tpl_email" id="tpl_email" value="1"/>
                          	<input type="hidden" class="form-control" rows="6" name="tpl_email" id="tpl_email" value="<?php echo $epk->tpl_epk ?>"/>
                        </div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">Message:</label>
						<div class="input-group col-md-8">
							<textarea class="form-control" rows="6" name="msg" id="msgBook">
							</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="form-input col-md-3">Available Dates:</label>
						<div class="input-group col-md-8">
							<p id="date"></p>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>                                
					</div>
				</div>
			</form>  
    	</div>
	</div>
</div>
<!-- EPK preview modal end-->
<!-- Modal -->
<div class="modal new_modal_style" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalPhoto" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				
                <h4 class="tt">Email EPK</h4>
                <span class="liner"></span>
			</div>
            <div class="modal-body" >
                <div id="template1">
                    <img class="img-responsive" src="#" />
                </div>
				<div class="modal-footer">  
					<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>                                
				</div>
			</div>
		</div>
	</div>
</div>
	
	<script src="<?php echo base_url(); ?>assets/map/js/bootstrap-colorpicker.min.js"></script>

	<script type="text/javascript">
	    var base_url           = '<?php echo base_url() ?>';
	    var records_per_page   = '<?php echo $this->security->get_csrf_hash(); ?>';
	    var $tour_id            =$('#tours').val();
	</script>
	
	<script src="<?=base_url('assets/js/ckeditor/ckeditor.js')?>"></script>
	<script>                
    	CKEDITOR.replace('event_desc_tour');
	</script>

	<script src="<?php base_url() ?>assets/ttt_new/event.js"></script>
	
	<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/main.js"></script>
	<script src="<?php base_url() ?>assets/ttt_new/new_ttt.js"></script>
	<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/caculate.js"></script>

	<script src="<?php base_url() ?>assets/js/newrpk/custom.js"></script>
<script type="text/javascript"> 
function test()
{
	if($("#tours").val() === ""){
		$("#li2").removeAttr('data-toggle');
	}
}
test();
	

	
	function get_home_page()
	{
		$.ajax({
	    url:base_url+'the_total_tour/home',
	    success: function(data){
	    	$('div #home_page_div').empty();
        	$('div #home_page_div').html(data);

    		}
	    });
	}
	get_home_page();
	
	function get_manager_calculate_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/caculate/'+tour_id,
	    success: function(data){
	    	$('div #manager_calculate').empty();
        	$('div #manager_calculate').html(data);
    		}
	    });
	}
	function get_manager_event_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/event/'+tour_id,
	    success: function(data){
	    	$('div #manager_event').empty();
        	$('div #manager_event').html(data);
    		}
	    });
	}

	function get_manager_event_view_tour_location(tour_id, location_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/event/'+tour_id+'/'+location_id,
	    success: function(data){
	    	$('div #manager_event').empty();
        	$('div #manager_event').html(data);
    		}
	    });
	}
	function get_manager_member_view(tour_id)
	{
		
		$.ajax({
    	url:base_url+'the_total_tour/members/'+tour_id,
    	data:{'type': "member"},
    	success: function(data){
	    	$('div #displayMember').empty();
	        $('div #displayMember').html(data);
    		}
    	});
	}

	function get_add_new_member_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/members/'+tour_id,
	    data:{'type': "new_member"},
	    success: function(data) {
	        $('div #addmember').html(data);
    		}
	    });
	}

	function get_daily_schedules_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/schedules/'+tour_id,
	    success: function(data){
	    	$('div #daily_schedules').empty();
        	$('div #daily_schedules').html(data);
    		}
	    });
	}

	function get_find_locations_view(tour_id)
	{

		$.ajax({
	    url:base_url+'the_total_tour/find_locations/'+tour_id,
	    success: function(data){
	    	$('div #find_locations').empty();
        	$('div #find_locations').html(data);
        	initialize_map() ;
    		}
	    });
	}

	function get_daily_schedules_view_tour_location(tour_id, location_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/schedules/'+tour_id+'/'+location_id,
	    success: function(data){
	    	$('div #daily_schedules').empty();
        	$('div #daily_schedules').html(data);
    		}
	    });
	}

	function get_social_media_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/social_media/'+tour_id,
	    success: function(data){
	    	$('div #social_media').empty();
        	$('div #social_media').html(data);
        	window.fbAsyncInit = function() {
			    FB.init({
			        appId: facebook_app_id, // Your app id
			        cookie: true, // enable cookies to allow the server to access the session
			        xfbml: false, // disable xfbml improves the page load time
			        version: 'v2.5', // use version 2.4
			        status: true // Check for user login status right away
			    });
			    FB.getLoginStatus(function(response) {
			        //console.log('getLoginStatus', response);
			        loginCheck(response);
			    });
			};
    		}
	    });
	}
	function get_social_media_view_tour_location(tour_id, location_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/social_media/'+tour_id+'/'+location_id,
	    success: function(data){
	    	$('div #social_media').empty();
        	$('div #social_media').html(data);
    		}
	    });
	}
	function get_chat_members_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/chat_members/'+tour_id,
	    success: function(data){
	    	$('div #chat_members').empty();
        	$('div #chat_members').html(data);
    		}
	    });
	}
	function get_road_map_tour_view(tour_id)
	{

		$.ajax({
	    url:base_url+'the_total_tour/roadtour/'+tour_id,
	    success: function(data){
	    	$('div #road_map_tour').empty();
        		$('div #road_map_tour').html(data);
        		initMap();
    		}
	    });
	}
	function get_book_show_tour_view(tour_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/bookashow/'+tour_id,
	    success: function(data){
	    	console.log(data);
	    	$('div #book_show').empty();
        	$('div #book_show').html(data);
    		}
	    });
	}
	function get_book_show_tour_view_location(tour_id, location_id)
	{
		$.ajax({
	    url:base_url+'the_total_tour/bookashow/'+tour_id+'/'+location_id,
	    success: function(data){
	    	$('div #book_show').empty();
        	$('div #book_show').html(data);
    		}
	    });
	}
	
updateClock();
function updateClock() {
	var currentTime = new Date()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()

	if (minutes < 10)
	minutes = "0" + minutes

	var suffix = "AM";
	if (hours >= 12) {
	suffix = "PM";
	hours = hours - 12;
	}
	if (hours == 0) {
	hours = 12;
	}

	var clockTime = hours + ":" + minutes + " " + suffix;   
    
    $('.clock').html(clockTime);
    setTimeout(updateClock,"20000");
};
function checkForTour(item)
{
	
	var http = new XMLHttpRequest();
    http.open('HEAD', item.href, false);
    http.send();
    http.status!=404;
	if(http.status == 404)
	{
		$('.errorDiv').show();
		$('.errorDiv').html("Please add tour in order to access other tour modules").fadeIn( "3000");
		return false;
	}
	else
		return true;
}
checkNoTour();

	$('.previewBtn').click(function(){
	$('#msgBook').val($('#message_booking').val());
	if($('#date_booking_from').val() !="" && $('#date_booking_to').val()!="")
		var dateVal = $('#date_booking_from').val() +" to  "+$('#date_booking_to').val();
	else
		var dateVal = "";
	$('#date').html(dateVal);
	$('#previewEPK').modal('show');
});
	$(document).ready(function() {
        $('#previewEPK').on('click','.epk-tpl_box_scroll ul li', function (){
            $( ".epk-tpl_box_scroll ul li" ).each(function() {
                $(this).removeClass("selected");
                $(this).addClass( "" );
            });
            $(this).addClass( "selected" );
            var tpl_vl = $(this).find('.hidden-val').val();
            $( "#tpl_email" ).val(tpl_vl);
        });
        $('.epk-tpl_box_scroll ul li a').click(function(e) {
          $('#preview img').attr('src', $(this).attr('data-img-url'));
        }); 
        
	})
	  var $url = "<?php echo base_url(); ?>";
</script>

<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url()?>assets/js/detail_pages/artists/showgigs_booking.js"></script>
<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/find_locations.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/ttt/social.js"></script>

<script src="<?php echo base_url(); ?>assets/js/detail_pages/ttt/roadtour.js"></script>

<script>
(function($){
        $(window).load(function(){
            $("#previewEPK .modal-body").mCustomScrollbar();
            $("#preview .modal-body").mCustomScrollbar();
            $(".table_scroll").mCustomScrollbar({theme:"rounded-dots"});
        });
    })(jQuery);
    $('#date_booking_from').datepicker(); 
    $('#date_booking_to').datepicker();
</script>
