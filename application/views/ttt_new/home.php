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
                            	<div class="col-md-8 col-sm-6 tours"> <select id="location_all" onchange="create_map();change_location(this.value)" class="location_all">
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