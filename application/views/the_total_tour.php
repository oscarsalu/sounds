<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel='stylesheet' href='<?php echo base_url() ?>assets/dist/fullcalendar/lib/cupertino/jquery-ui.min.css' />
<link href="<?php echo base_url('assets/css/ttt_styles.css');?>" rel="stylesheet" />

<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dist/viewer.css">
<script src="<?php echo base_url()?>assets/css/dist/viewer.js"></script>
<script src="<?php echo base_url()?>assets/css/dist/js/main.js"></script>


<?php $params_data = $this->uri->segment(2); ?>
<div class="wrap-ttt remove_padding target0" >
    <div class="col-md-12">
        <div class="col-md-12 remove_padding">
            <div class="col-md-12 remove_padding  ttt_pack">
				<div class="col-md-6 col-md-offset-3 errorDiv"></div>
                <div class="row col-md-12 header_new_style mj-box">
                    <!--<span class="liner_landing"></span>-->
                    <div class="col-md-12 remove_padding searchform_new">
                        <a class="btn btn-actvie m_menu" href="<?php echo base_url('the_total_tour');?>">Home tour</a>
                        <a class="btn members_link m_menu <?php if ($params_data == 'members') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Manager Member</a>
                        <a class="btn caculate_link m_menu<?php if ($params_data == 'caculate') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Manager Calculate</a>
                        <a class="btn event_link m_menu <?php if ($params_data == 'event') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Manager Event</a>
                        <a class="btn schedules_link m_menu<?php if ($params_data == 'schedules') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Daily Schedules</a>
                        <a class="btn find_locations_link m_menu<?php if ($params_data == 'find_locations') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Find locations</a>
                        <a class="btn social_media_link m_menu<?php if ($params_data == 'social_media') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Social media</a>
                        <a class="btn chat_members_link m_menu<?php if ($params_data == 'chat_members') {
    echo 'btn-actvie';
} ?>" href="" onclick="return checkForTour(this)">Chat Member</a>
                        <a class="btn roadtour_link m_menu<?php if ($params_data == 'roadtour') {
    echo 'btn-actvie';
} ?>" href="<?php echo base_url('the_total_tour/roadtour');?>" onclick="return checkForTour(this)">Road map tour</a>

                    </div>
					
                </div>
            </div>
        </div>


        <div class="col-md-12 remove_padding">
		     <!-- First Frame -->
		     <div id="mj_scal" class="col-md-3 right_padding  ttt_pack right_ttt1 ">
			   <div class="row col-md-12 header_new_style mj-box">
                    <h2 class="tt text_caplock ">Weekly Schedules</h2>
					 <!--<div class="form-group">                        
                            <label class="form-input col-md-6">LOCATON: </label>
                            <div class="col-md-6">
                                <select id='mj_op' class="selectlocation" style="width:100%;">
                                    <?php /*?><?php ?><?php foreach ($locations as $location) {
    ?>
                                        <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';
} ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                    <?php 
} ?><?php ?><?php */?>
                                </select>
                            </div>
                            
                        </div>-->
                    <!--<span class="liner_landing"></span>-->
                    <div class="col-md-12 remove_padding" style="margin:10px 0px;">
                        <div id="calendar"></div>
                    </div>                
               </div>   
            </div>
		   		
		     <!-- Second Frame -->
            <div class="col-md-3 right_padding  ttt_pack right_ttt1">
                <div class="row col-md-12 header_new_style mj-box">				
                   <!-- First Box -->
                   <div class="col-md-12 remove_padding">					
					<h2 class="tt text_caplock" about="/content_homes1_tittle_new1_71/">
                        <span property="content" id= "content_homes1_tittle_new1_71">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_71_s>', 'Map');
                            ?>
                        </span>
                    </h2>
                    				
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
                    </div><!-- End first box -->               
			</div>      
		</div><!-- End Second Frame -->
	         
			 <!-- Third Frame -->
            <div class="col-md-3 left_padding ttt_pack left_ttt mj-box">
                <div class="row col-md-12 header_new_style tourAddDiv">				
				  <!-- Start First Box -->
				   <div class="row">                  
                    <h2 class="tt text_caplock" about="/content_homes1_tittle_new1_73/">
                        <span property="content" id= "content_homes1_tittle_new1_73">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_73_s>', 'Destinations');
                            ?>
                        </span>
                    </h2>
                    <!--<span class="liner_landing"></span>-->
                    <div class="col-md-12 remove_padding">
                         <div class="row description">
                                <?php if ($this->session->flashdata('success_add')) {
    ?>
                                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                                    <strong>Success: </strong> <?php echo $this->session->flashdata('success_add')?> 
                                </div>
                                <?php

} elseif ($this->session->flashdata('error_add')) {
    ?>
                                    <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                                        <strong>Error!</strong> <?php echo $this->session->flashdata('error_add'); ?>
                                    </div>
                                    <?php

}?>
                         </div>
                        <div class="panel-body panel-destination recipe remove_padding">
                            <form action="javascript:void(0);" method="post">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <div class="searchform col-xs-12">
                                    <button class="btn btn-defaulf" onclick="view_tour_modal('new')">Add new Tour</button>
                                </div>
                                <div class="searchform row">                                
                                     <div class="col-md-6"><label id="label-tour">List tours: </label> </div>      
                                     <div class="col-md-6 tours">                                                                          
                                        <select class="" id="tours" onchange="get_location($(this).val()); my_scal($(this).val());">
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
								 <div class="searchform row detele_edit">
								   <div class="col-md-6">
                                       <input type="submit" value="Delete" id="delete_tour_d" onclick="delete_tour()" class="btn btn-danger btn-xs mj" />
									</div>
									<div class="col-md-6">
                                        <input type="submit" value="Edit" id="edit_tour_e" name="edit" class="btn btn-default btn-default-custom btn-xs mj" onclick="view_tour_modal('edit')" />                                  </div> 
									
								  </div>
                              
                                </div>
                            </form>
                           <span class="liner_landing_ttt"></span>
                            <form action="" method="post" style="padding-top:10px;" id="cont_promo">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <div class="searchform col-xs-12">
                                    <button class="btn btn-defaulf left_find" onclick="view_location_modal('new','save_location()')" >Find new Location</button>
                                    <button class="btn btn-defaulf" onclick="view_create_location_modal('new','save_location()')" >Add new Location</button>
                                </div>
                                <div class="searchform row detele_edit2">
                                     <div class="col-md-6"><label id="label-tour">List Locations: </label></div> 
                                     <div class="col-md-6 tours"> <select id="location_all" onchange="create_map();change_location(this.value)" class="location_all">
                                        <option value="">Location</option>
                                           </select>
                                     </div>
                                     <div class="row detele_edit">
									    <div class="searchform col-xs-6">
                                         <input type="submit" value="Delete" id="delete_ttt" onclick="delete_location()" class="btn btn-danger btn-xs mj" />
										</div>
										<div class="searchform col-xs-6">
                                          <input type="submit" value="Edit" id="delete_ttt" onclick="view_location_modal('edit','save_location()')" class="btn btn-default btn-default-custom btn-xs mj" />        </div>
                                     </div>
                                </div>
                                <span class="liner_landing_ttt"></span>
                                <div class="searchform searchform_new">
                                   <h4 class=""><label>List Contact/Promoter</label></h4>
                                   
                                   <div class="showlisr_member">
                                        
                                   </div>
                                </div>
                                <div class="searchform searchform_new">
                                   <a href="<?php echo base_url('the_total_tour/members').'/'.$user_data['id'] ?>" class="linkmenumember">Manager member</a>
                                </div>
                            </form>
                         </div>
						 
				</div>
				  <!-- End First Box -->
				  	
				  <!-- Start Second Box -->
				  <div class="row">                    
                    <h2 class="tt text_caplock" about="/content_homes1_tittle_new1_74/">
                        <span property="content" id= "content_homes1_tittle_new1_74">
                            <?php
                                echo $this->M_text->getdatavalue('<_scontent_homes1_tittle_new1_74_s>', 'Detail tour');
                            ?>
                        </span>
                    </h2>
                    <!--<span class="liner_landing"></span>-->
                    <div class="col-md-12 remove_padding tab_detailtour ">
                        
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="glyphicon glyphicon-asterisk"></span> Description
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="col-md-12 remove_padding searchform">
                                            <div class="show_des"></div>
                                            <button class="btn btn-defaulf tour_des mj_width searchform" data-toggle="modal" data-target="#uploadvideo">Add</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <span class="glyphicon glyphicon-home"></span> Hotels
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="col-md-12 remove_padding searchform">
                                            <div class="show_hotels">
                                            </div>
                                            <button class="btn btn-defaulf tour_tour_hotels mj_width searchform" onclick="add_detail_tour($(this),0,'Add','hotels')" value="Add" >Add</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <span class="glyphicon glyphicon-road"></span> Transport
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <div class="col-md-12 remove_padding searchform">
                                            <div class="show_transport">
                                            </div>
                                            <button class="btn btn-defaulf tour_tour_transport mj_width searchform" onclick="add_detail_tour($(this),0,'Add','transport')" value="Add" >Add</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingfour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                        <span class="glyphicon glyphicon-plane"></span> Flight
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                                    <div class="panel-body">
                                        <div class="col-md-12 remove_padding searchform">
                                            <div class="show_flight">
                                            </div>
                                            <button class="btn btn-defaulf tour_tour_flight mj_width searchform" onclick="add_detail_tour($(this),0,'Add','flight')" value="Add" >Add</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingfive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                        <span class="glyphicon glyphicon-user"></span> Contacts
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                                    <div class="panel-body">
                                        <div class="col-md-12 remove_padding searchform">
                                            <div class="detail_contact">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
				  <!-- End Second Box -->					
		      </div> 
         </div><!-- End Third Frame -->
			  
			  
			 <!-- Fourth Frame -->
			<div class="col-md-3 left_padding  ttt_pack right_ttt1 ">
                <!-- first Box-->
                <div class="row mj-box"> 
				   <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sub_div1" aria-expanded="false">               
                    <h2 class="tt text_caplock" about="/content_homes1_tittle_new1_73/">
					    Schedules
                        <!--<span property="content" id= "content_homes1_tittle_new1_73">
							Schedules
                        </span>-->
						<i class="glyphicon glyphicon-chevron-right" style="float:left;"></i>
                    </h2>
					</a>
                    <!--<span class="liner_landing"></span>-->
                    <div id="sub_div1" class="col-md-12 remove_padding panel-collapse collapse">
                        <div class="col-md-12 remove_padding searchform searchform_new">
                            <a href="<?php echo base_url('the_total_tour/schedules').'/'.$user_data['id'] ?>" class="linkschedules">Manager schedules</a>
                            <div class="clearfix"></div>
                        </div>
                        <table class="table daily_schedules mj_tbl">
                            
                        </table>
                    </div>
					
					
					<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#sub_div2" aria-expanded="false">             
                     <h2 class="tt text_caplock" about="/content_homes1_tittle_new1_71/">
					   Event
                        <!--<span property="content" id= "content_homes1_tittle_new1_71">
							Event
                        </span>-->
						<i class="glyphicon glyphicon-chevron-right" style="float:left;"></i>
                    </h2>
					</a>
                    <!--<span class="liner_landing"></span>-->
                    <div id="sub_div2" class="col-md-12 remove_padding panel-collapse collapse">
                        <div class="col-md-12 remove_padding searchform searchform_new">
                            <a href="<?php echo base_url('the_total_tour/caculate').'/'.$user_data['id'] ?>" class="linkevent">Manager event</a>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-md-12 remove_padding">
                            <table class="table table_events mj_tbl">
                        
                            </table>
                        </div>
                    </div>			
                </div><!-- End first Box-->
				<div class="row mj-box"> 
					<h2 class="tt text_caplock" about="/content_homes1_tittle_new1_71/">
						<span id="content_homes1_tittle_new1_71" property="content"> Local Time </span>
					</h2>
					<div style="text-align:center">
						System <span class="clock"></span>
					</div>
				</div>
				<div class="row mj-box"> 
					<h2 class="tt text_caplock" about="/content_homes1_tittle_new1_71/">
						<div id="content_homes1_tittle_new1_71" class="weatherSpan">Weather Forecast</div>
					</h2>
					<div class="weatherCls">
					</div>
				</div>
            </div><!-- End Fourth Frame -->
			
        </div>
    </div>
</div>


<link href="<?php echo base_url('assets/dist/css/map-styles.css');?>" rel="stylesheet" />
<script src="<?php echo base_url('assets/dist/js/alertify.min.js');?>"></script>
<!-- css for full calender start-->

<link href='<?php echo base_url() ?>assets/dist/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/dist/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href='<?php echo base_url() ?>assets/dist/css/alertify.default.css' rel='stylesheet' />
<link href='<?php echo base_url() ?>assets/dist/css/alertify.core.css' rel='stylesheet' />

   
<!-- added on Feb-22-2016 start -->
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


<!-- added on Feb-22-2016 start -->
<div id="uploadvideo" class="modal fade new_modal_style " role="dialog">
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
            <label class="form-input col-md-3" for="event_desc">Description</label>
            <div class="input-group col-md-8">
                <textarea class="form-control" rows="10" cols="60" id="event_desc_tour" name="event_desc" ></textarea>
                <span id="er-des"></span>
            </div>
        </div>
        <div class="modal-footer searchform">
          <img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
          </button>
          <input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
        </div>
        </form> 
      </div>

    </div>
</div>


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
                        <input type="hidden" name="get_location" value="get_location" />
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
        <div class="modal-body" id="form_content_data">
            
        </div>
        <div class="modal-footer searchform">
          <img src="<?php echo base_url() ?>assets/images/ajax-loading.gif" style="display:none" class='loading_img' />
          </button>

          <input type="submit" class="btn btn-success excel-go" id="submit_form" value="Submit" />
          
        </div>
        </form> 
      </div>

    </div>
</div>

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
                                     <input type="date" class="form-control" id="date_booking_from" name="date_booking_from" /> <br/>                                  
                                     <br /><label for="date_booking_to">To</label>  
                                     <input type="date" class="form-control" id="date_booking_to" name="date_booking_to" />
                               </div>                            
                          </div> 
                          <input type="hidden" name="email_book" id="email_book">
                          <input type="hidden" name="company_book" id="company_book>                        
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
							</textarea>
						</div>
					</div>
					
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>                                
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



<script type="text/javascript">
var intervalId;
var base_url = "<?php echo base_url() ?>";
//console.log(base_url);
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
<script src="<?php base_url() ?>assets/js/detail_pages/ttt/the_total_tour.js"></script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=<?php echo $apikey;?>"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
<script src="<?php echo base_url('assets/dist/js/bootstrap-datepicker.min.js');?>"></script>

<script src="<?php echo base_url('assets/dist/js/jquery.geocomplete.min.js');?>"></script>
<script src="<?php echo base_url(); ?>assets/js/editor/nicEdit.js" type="text/javascript">
</script>



<script src='<?php echo base_url() ?>assets/dist/fullcalendar/lib/moment.min.js'></script>
<script src='<?php echo base_url() ?>assets/dist/fullcalendar/fullcalendar.min.js'></script>
<script src="<?php echo base_url(); ?>assets/js/editor/nicEdit.js" type="text/javascript"></script>

<!--<script>
        "use strict";
        $(function() {
          // Code for docs demos
          function createColorpickers() {
            
            $(function(){
                $('.colorpicker').colorpicker();
                
            });
          }
          createColorpickers();
        });
        $('.colorpicker').on('hidePicker', function(event){
            setTimeout(function(){
                finish_change();
            }, 0);
        });

    </script>-->
	
	<!--<script>
bkLib.onDomLoaded(function() {
new nicEditor({fullPanel : true,iconsPath : base_url+'assets/js/editor/nicEditorIcons.gif'}).panelInstance('event_desc');
$('.nicEdit-panelContain').parent().width('380px');
$('.nicEdit-panelContain').parent().next().width('380px');	
$('.nicEdit-main').parent().width('378px');
$('.nicEdit-main').css('height','100px');
$('.nicEdit-main').css('width','370px');        
});
</script>-->

<script type="text/javascript"> 
function conf_del(msg){ 
    if(confirm(msg))
        return true;  
    else
        return false;
}
function event_info(msg){
    alertify.alert(msg);
}
$(".delete_data").click(function(){
    if(conf_del("Are you sure delete!")){
        $('#form-modal-event').find("#form_event_submit").find(".type_event").val("delete");
        $('#form-modal-event').find('#form_event_submit').submit();
    }
});
function create_event(type,start, end,id){
    
    var tmp = '';
    if(type=='edit'){
        $('#form-modal-event').find('.modal-header').find('h4').html('Edit Schedules');
        $('#form-modal-event').find('.modal-footer').find('#form_event_submit').attr('value','Edit Schedules');
        //$('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_id").val($("#location_all").val());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_name").val($('.selectlocation :selected').text());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#start_event_id").val(start);
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#end_event_id").val(end);
        $('#form-modal-event').find("#form_event_submit").find(".type_event").val("edit");
        $('#form-modal-event').find("#form_event_submit").find(".event_id").val(id);
        $('#form-modal-event').find("#form_event_submit").find(".delete_data").css("display","inline");
        
        $.ajax({
          url:'<?php echo base_url('more_ttt/get_schedule') ?>',
          data: { id: id,'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
          type:'POST',
          dataType:'json',
          success: function(data){
            $('#form-modal-event').find("#form_event_submit").find("#event_title").val(data.data.des);
            $('#form-modal-event').find("#form_event_submit").find(".color_front").val(data.data.color);
            
          }
        });
        
    }else if(type=='new'){
        $('#form-modal-event').find("#form_event_submit").find(".delete_data").css("display","none");
        $('#form-modal-event').find('.modal-header').find('h4').html('Add Schedules');
        $('#form-modal-event').find('.modal-footer').find('#form_event_submit').attr('value','Add Schedules');
        //$('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_id").val($("#location_all").val());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#location_event_name").val($('.selectlocation :selected').text());
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#start_event_id").val(start);
        $('#form-modal-event').find("#form_event_submit").find('.modal-body').find("#end_event_id").val(end);
        $('#form-modal-event').find("#form_event_submit").find(".type_event").val("add");
        $('#form-modal-event').find("#form_event_submit").find(".nicEdit-main").html("");
        
        $('#form-modal-event').find("#form_event_submit").find("#event_title").val("");
        $('#form-modal-event').find("#form_event_submit").find("#event_desc").val("");
    }
    
    $('#form-modal-event').modal('show');
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
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url()?>assets/js/detail_pages/artists/showgigs_booking.js"></script>
<script>
    (function($){
        $(window).load(function(){
            $("#previewEPK .modal-body").mCustomScrollbar();
            $("#preview .modal-body").mCustomScrollbar();
        });
    })(jQuery);
    $('#date_booking_from').datepicker({
        format: "yyyy-mm-dd "
    }); 
    $('#date_booking_to').datepicker({
        format: "yyyy-mm-dd "
    });
</script>
