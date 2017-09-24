<meta name ="viewport" content="initial-scale=1.0, user-scalable=no" />
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
<script type="text/javascript">
		var centreGot = false;        
</script>
<script src="<?php echo base_url('assets/js/statCharts/jquery.sparkline.min.js');?>"></script>
<?php echo $map['js']; ?>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/showgigs_next1.js"></script>
<link href="<?php echo base_url('assets/css/ttt_styles.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/css/showmap_styles.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/css/artist_showgig.css');?>" rel="stylesheet" /> 
<div class="wrap-ttt remove_padding" id="a1" >
    <div class="col-md-12" id="a2">
        <div class="col-md-12 remove_padding" id="a3">
            <div class="col-md-12 right_padding  ttt_pack" id="a4">
                <div class="row col-md-12 header_new_style" id="a5">
                    <h2 class="tt text_caplock">Map</h2>
                    <span class="liner_landing"></span>   
                    <div> <?php echo $map['html']; ?></div>
                    <div class="col-md-12 remove_padding" id="a6">
                        <div class="bottom_map" >
                             <div class="remove_padding" style="margin: 0;">
                             <div class="remove_padding">  
                               <div class="container s">
                      <div class="row">
                          <div class="panel panel-danger">
                            <div class="panel-heading">
                               <a href="<?php echo base_url('artist/showgigs')?>">Current location</a>
                            </div>
                            <div class="panel-body">
                             <form id = "search" method="get" accept-charset="utf-8"  action="<?php echo base_url('artist/showgigs')?>">
                                 <div class="row">
                                      <div class="col-md-6">
                                           <span class="lab" >Search location:</span>
                                           <input id="pac-input" name="pac-input" value="<?php echo $this->session->userdata('data_show_location');?>" type="text" placeholder="Search Box" />
                                       </div>
                                       <div class="col-md-6">
                                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" id="csrf" />
                                            <input type="hidden"  name="la" id="la" value="<?php echo $posi['la'] ?>" />
                                            <input type="hidden"  name="lo" id="lo" value="<?php echo $posi['lo'] ?>" />
                                            <div class="float_left" style="margin-right: 120px;">
                                               <span class="lab" > Distance:</span>
                                                
                                                <input type="text" name="a" id="a" value="<?php echo $ra ?>" class="float_left" style="width: 100px;"/><span class="lab" >Km</span>
                                            </div> 
                                       </div>
                                 </div>
                                 <div class="row">
                                        <a class='advanced clear' >Advanced Options</a>
                                 </div>
                                 <div class="row" id="advancedOptions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <span class="squaredThree">
                                                                	<input type="checkbox" value="None" id="ckSimilar" name="ckSimilar" />
                                                                	<label for="ckSimilar"></label>
                                                    </span> 
                                                    <span class="" style="margin-left: 20px;">Similar venus</span>
                                                    <div onmouseover="document.getElementById('tt1').style.display='block'" onmouseout="document.getElementById('tt1').style.display='none'" class="questionMark">
<div id="tt1" class="toolTip toolTipSim">
                                                    If you have had success playing at a venue enter that venue here and Gig Finder will locate some similar venues that will be a good fit for your band. Or if you know a venue you want to play, but can't seem to get in, try entering it here and we'll suggest some similar ones to try.
                                                    
                                                    </div></div>
                                                    <br />
                                                    <select name="similar" id="similar" onchange="get_location($(this).val());" style="width: 150px;margin-top: 12px;">
                                                              <option value="new_event">Newsby</option>    
                                                              <option value="sort_time">Sort by time</option>  
                                                    </select>
                                            </div>
                                            <div class="col-md-6">
                                                    <span class="squaredThree">
                                                            	<input type="checkbox" value="None" id="ckGenges" name="ckGenges" />
                                                            	<label for="ckGenges"></label>
                                                    </span> <span style="margin-left: 20px;">Genres</span><br />
                                                    <div onmouseover="document.getElementById('genPop').style.display='block'" onmouseout="document.getElementById('genPop').style.display='none'" class="questionMarkGen">
<div id="genPop" class="toolTip toolTipGen">
                                                    Looking for a Jazz Club? Select the genre for your band and we'll only include venues that identify themselves by that genre, or where artists of that genre have played recently
                                                    
                                                    </div></div>
                                                    <select id="genres" name="genres" onchange="get_location($(this).val());" style="width: 150px;margin-top: 12px;">
                                                            <?php if (count($genres) > 0) {
    $count = count($genres); ?>
                                            			    <?php 
                                                                    $i = 0;
    foreach ($genres as $g) {
        ?>
                                                                    <option value="<?php echo  $g['id']; ?>"><?php echo strtoupper($g['name']); ?></option>
                                            						  
                                                                <?php 
                                                                ++$i;
    } ?>
                                                                <?php 
} ?>
                                                          
                                                   </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <span class="squaredThree">
                                                            	<input type="checkbox" value="None" id="ckWhere" name="ckWhere" />
                                                            	<label for="ckWhere"></label>
                                            </span> <span style="margin-left: 20px;">Where this artist has played</span><br />
                                             <div onmouseover="document.getElementById('arPop').style.display='block'" onmouseout="document.getElementById('arPop').style.display='none'" class="questionMarkAr">
<div id="arPop" class="toolTip toolTipAr">
                                                    Looking for a Jazz Club? Select the genre for your band and we'll only include venues that identify themselves by that genre, or where artists of that genre have played recently
                                                    
                                                    </div></div>
                                            <input type="text" placeholder="Enter artist name" name = "aName" style="width: 150px;margin-top: 12px;"/>
                                          </div>
                                          <div class="col-md-6">
                                                 
                                          </div>
                                        </div>
                                 </div>
                            </div>
                            <div class="panel-footer"><input type="submit" value="Press For Data"></div>
                          </div>
                      </div>
                    </div><br><br>
                            </div>
                          
                <script type='text/javascript'>
                    $(document).ready(function () {
                        $('#advancedOptions').hide();
                        $('.advanced').click(function() {
                            if ($('#advancedOptions').is(':hidden')) {
                                 $('#advancedOptions').slideDown();
                            } else {
                                 $('#advancedOptions').slideUp();
                            }
                        });
                    });
                </script>

                            
                            
                            
                            <!-----star---------- -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/star/css/star-rating.css">
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=<?php //echo $apikey;?>" type="text/javascript"></script> -->
    
    <script src="<?php echo base_url(); ?>assets/star/js/star-rating.js" type="text/javascript"></script>
                            <!---------------------->                            
            <h2 class="tt text_caplock" style="padding-left: 50px;">Venues | <span>Showing <?php echo count($events);?> Venues</span></h2>
            <span class="liner_landing"></span>            
            <div class="row" style="margin-bottom:20px;">
				<select name="sortVenue" id="similar" class="pull-right" onchange="this.form.submit();">
					<option value="">Sort Venue</option>  
					<option value="rating" <?php if($sort=="rating") echo "selected";?>>Rating</option>    
					<option value="seating" <?php if($sort=="seating") echo "selected";?>>Seating Capacity</option>  
					<option value="nma" <?php if($sort=="nma") echo "selected";?>>Name(A-Z)</option>
					<option value="nmd" <?php if($sort=="nmd") echo "selected";?>>Name(Z-A)</option>   
				</select>
            </div> 
            
			</form>
		</div>
                      
            <div class="row">
                  <div class="row description">
                            <?php if ($this->session->flashdata('message_success')) {
    ?>
                            <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                                <strong>Success: </strong> <?php echo $this->session->flashdata('message_success')?> 
                            </div>
                            <?php

} elseif ($this->session->flashdata('message_error1')) {
    ?>
                                <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">�</span></button>
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('message_error1'); ?>
                                </div>
                                <?php

}?>
                        </div>
                <div class="col-md-12" id="showgigs">
                          <div class="alert alert-warning  fade in not_oke" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Info !</strong> You have already voted.
                         </div>
                         <div class="alert alert-success fade in oke" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> Thank you rate this event.
                         </div>   
                    <?php if (count($events) > 0) {
    $i = 0;
    $userId = $this->session->userdata('loged_in');
    foreach ($events as $e) {
        ?>
                        <div class="jumbotron" >
                            <?php if (!empty($e['event_banner'])) {
    $url_image = base_url().'uploads/'.$e['user_id'].'/photo/banner_events/'.$e['event_banner'];
} else {
    $url_image = base_url().'assets/images/icon/manager_git_event.png';
} ?>
                            <div class=" col-md-2">
                                <img width="150px" src="<?php echo $url_image; ?>" />
                            </div>   
                            <div class=" col-md-10 remove_padding">                      
                                  <div class="col-md-5 remove_padding">
                                    <div class="container text-left remove_padding">
                                       <div class="row">                                                                                    
                                          <b><a href="<?=base_url('gigs_events/read/'.strtolower(str_replace(' ', '-', $e['event_title'])).'-'.$e['event_id'])?>"><?php echo ucfirst($e['event_title']); ?></a></b>
                                          <div class="row">
                                          <?php 

                                            if (!empty($e['address'])) {
                                                $address = $e['address'].', ';
                                            } else {
                                                $address = '';
                                            }
        if (!empty($e['city'])) {
            $city = $e['city'].', ';
        } else {
            $city = '';
        }
        if (!empty($e['state'])) {
            $state = $e['state'].', ';
        } else {
            $state = '';
        } ?>
                                            <p class="fa fa-map-marker p_star">
                                                <?php echo ucfirst($address.$city.$state.$e['country']); ?> - <?php echo ucfirst($e['distance']); ?>km | <?php echo ucfirst($e['capacity']); ?> Capacity<br />
                                                Genres:<?php 
                                                $tam = $this->Events_model->get_genres($e['categories']);
                                                //var_dump($tam);
                                                echo ucfirst($tam['0']['name']); ?><br />
                                                Start: <?php echo date('m/d/Y', strtotime($e['event_start_date'])); ?>. To: <?php echo date('m/d/Y', strtotime($e['event_end_date'])); ?>
                                            </p>   
                                                                                
                                          </div>
                                         
                                             <?php 
                                                $sum_start = $this->M_tour->check_user_event_star($e['event_id'], $userId);
        if ($sum_start == 'no') {
            echo ' <div class="row star_top ">';
            echo '<div col-md-1></div>';
            echo ' <div class="col-md-10" id="sum_star">                                                       <b class="btn btn-warning">'.round($e['sum_star'], 3).'</b><input id="star_'.$e['event_id'].'" name="input-3" value="'.$e['sum_star'].'" class="rating-loading" data-size="xs" >';

            if ($this->M_tour->rate_star($e['event_id']) != false) {
                echo '<p>'.$this->M_tour->rate_star($e['event_id']).'- Reviews</p>';
            }
            echo  '</div>';
            echo '<div col-md-1></div>';
            echo '</div>';
            ?>
                                                                <?php 
                                                       
        }
        if ($sum_start == 'oke') {
            echo ' <div class="row" star_top>';
            echo '<div col-md-1></div>';
            echo ' <div class="col-md-10 " id="sum_star">
            <b class="btn btn-warning">'.round($e['sum_star'], 3).'</b> <input id="star_'.$e['event_id'].'" name="input-3" value="" class="rating-loading" data-size="xs">';
            if ($this->M_tour->rate_star($e['event_id']) != false) {
                echo '<p>'.$this->M_tour->rate_star($e['event_id']).'- Reviews</p>';
            }
            echo  '</div>';
            echo '<div col-md-1></div>';
            echo '</div>';
        } ?>                                  
                                                                   </div>   

                                           <script>
                                                    $(document).on('ready', function(){
					$('#star_<?php echo $e['event_id']; ?>').rating({'showCaption':false, 'stars':'5', 'min':'0', 'max':'5', 'step':'0.5', 'size':'xs'});
																		
                                                    });
			$('#star_<?php echo $e['event_id']; ?>').on('rating.change', function (event, value, caption) {
				var rate_id = $(this).prop('id');
				 //console.log(rate_id);
				var pure_id = rate_id.substring(6);
				var id_ok = $(this).find('#input-2ba').val();                
				$('#star_oke').val(value); 
				alert("You have voted - "+value+' -star');
				console.log(pure_id);
				
				
			  $.ajax({
				url: "<?php echo base_url(''); ?>artist/showgigs/star",
				type: "post",
				data: {
					'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo  $this->security->get_csrf_hash();?>',
					'star_oke': value,
					'user':<?php echo $userId; ?>,
					'rate':1,
					'event_star':<?php echo $e['event_id']; ?>,
					'tour_star':<?php echo $e['tour_id']; ?>,
					'location_star':<?php echo $e['location_id']; ?>,
					
				},
				success: function(data)
				{
					console.log(data);
				}
		    });  
        });
                                           </script>                             
                                     </div>
                                  </div>
                                                <?php //echo $user_data['id'];?>                     
                                     <?php 
                                        $show = $this->M_tour->m_show_comment_venues($e['event_id']);
        if (isset($show)) {
            if ($show != false) {
                echo '<div class="col-md-5" >';
                echo '<div class="container panel panel-info commenttings" id="comment_star_'.$e['event_id'].'">';
                foreach ($show as $data) {
                    $name = $this->M_tour->name_show($data['user_id']);
                    if ($name != false) {
                        echo '<div class="list-group-item comment_height" id="dele_'.$data['id'].'">';
                        if ($data['user_id'] === $user_data['id']) {
                            echo '<button type="button" class="close"  data-toggle="modal"  data-target="#modal_delete_comment" id="delete_comment" title="delete">&times;<input type="hidden" class="event_delete" value="'.$e['event_id'].'" />';
                            echo '<input type="hidden" class="user_delete" value="'.$data['user_id'].'" />';
                            echo '<input type="hidden" class="id_delete" value="'.$data['id'].'" /></button>';
                        }
                        echo '<img src="'.$this->M_user->get_avata($data['user_id']).'" class="thumbnail img_left" alt="Avatar"/>';

                        foreach ($name as $n) {
                            echo '<a href="'.base_url().$n['lastname'].'" title="'.$n['lastname'].'"><h3 class="list-group-item-heading">'.$n['lastname'].'</h3></a>';
                        }
                        echo '<p class="list-group-item-text">'.htmlentities($data['info_venues']).'</p>';
                        echo '</div>';
                    }
                }
                echo  '</div>';
                echo  '</div>';
            } else {
                echo '<div class="col-md-5">';
                echo '<div class="col-md-12 panel panel-info commenttings" id="comment_star_'.$e['event_id'].'" style="display:none;">';
                echo '</div>';
                echo '</div>';
            }
        } ?>                 
                                  <div class="col-md-2">
                                   <div class="container text-center"> 
                                          <div class="alert alert-success" style="display: none;" id="success_rate_inser">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong><br/>Thank you.
                                           </div>   
                                           <div class="alert alert-success" style="display: none;" id="success_sending">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong><br/>Sending successfully.
                                           </div> 
                                           <div class="alert alert-warning" style="display: none;" id="erorr_delete">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Warning!</strong><br/>You can't delete.
                                           </div>
                                           <div class="alert alert-success" style="display: none;" id="success_dele">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Success!</strong><br/>Delete successfully.
                                           </div>                                      
                                        <button data-toggle="modal"  data-target="#rate_venue"  type="button" id="button_comment_rate" class="btn btn-success excel-go" >Rate Venue
                                                   <?php 
                                                           if (!empty($e['event_id'])) {
                                                               $event = $e['event_id'];
                                                           } else {
                                                               $event = '';
                                                           }
        echo '<input type="hidden" class ="event_rate" name="event" value="'.$event.'">';
        if (!empty($e['tour_id'])) {
            $tour = $e['tour_id'];
        } else {
            $tour = '';
        }
        echo '<input type="hidden" class ="tour_rate" name="tour" value="'.$tour.'">';
        if (!empty($e['location_id'])) {
            $location = $e['location_id'];
        } else {
            $location = '';
        }
        echo '<input type="hidden" class ="location_rate" name="location" value="'.$location.'">'; ?>
                                        </button>                             
                                        <button data-toggle="modal"  data-target="#statsModal"  type="button" id="button_stat" class="btn btn-success excel-go" >Stats </button>                                
                                        <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo base_url('artist/allblogs').'/'.$e['user_id'] ?>'">View Blog</button>
                                                                       
                                        <button id="submit_booking_request" data-toggle="modal"  data-target="#booking_request" type="button" class="btn btn-info">Book Show
                                                     <?php 
                                                           if (!empty($e['tour_id'])) {
                                                               $tour = $e['tour_id'];
                                                           } else {
                                                               $tour = '';
                                                           }
        echo '<input type="hidden" class ="tour_booking" name="tour_booking" value="'.$tour.'">';
        if (!empty($e['location_id'])) {
            $location = $e['location_id'];
        } else {
            $location = '';
        }
        echo '<input type="hidden" class ="location_booking" name="location_booking" value="'.$location.'">';
        if (!empty($e['user_id'])) {
            $user = $e['user_id'];
        } else {
            $user = '';
        }
        echo '<input type="hidden" class ="user_booking" name="user_booking" value="'.$user.'">'; ?>
                                        </button>
                                    </div>
                                  </div>
                                   </div>                      
                                     </div>
                				     <?php 
    } ?> <?php 
} ?>
                                </div> 
                            </div>                                
                         </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>


<!-- bootrap js -->
<!--end modal star-->
<div id="add_detail_event" class="modal fade new_modal_style " role="dialog">
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
<!--model stat-->
<div class="modal fade" id="add_stats">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Rate state</h4>
			</div>
			<div class="modal-body">
				<div class="page-header text-center">
                        <div class="row star">
                              <?php 
                                if (!empty($e['address'])) {
                                    $address = $e['address'].', ';
                                } else {
                                    $address = '';
                                }
                                if (!empty($e['city'])) {
                                    $city = $e['city'].', ';
                                } else {
                                    $city = '';
                                }
                                if (!empty($e['state'])) {
                                    $state = $e['state'].', ';
                                } else {
                                    $state = '';
                                }
                                 echo '<b class="fa fa-map-marker">'.ucfirst($address.$city.$state.$e['country']).'</b>';
                              ?>
                                 
                          </div>                     
                        <form action="<?php echo base_url(''); ?>artist/showgigs/star" method="post">                            
                            <br/>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <input id="input-2ba">                           
                            <input type="hidden" id="star_oke" name="star_oke" value="0"/>
                            <br />   
                                  <input type="hidden" id="user" name="user" value="<?php echo $user_data['id'];?>"/>
                                  <input type="hidden" id="rate" name="rate" value="1"/>                                
                                  <input type="hidden" id="event_star" name="event_star"/>
                                  <input type="hidden" id="tour_star" name="tour_comment"/>
                                  <input type="hidden" id="location_star" name="location_star"/>
                           	 <div class="modal-footer">
				                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  				  <button type="button" class="btn btn-primary submit_star">Rate</button>
 			                 </div>                
                        </form>
                  </div>
		 	</div>
		</div>
	</div>
</div>   

<!-- modal rate_venue -->
<div class="modal fade" id="rate_venue">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Rate Venue</h4>
			</div>
			<div class="modal-body">
                <div class="alert alert-danger" style="display: none;" id="error_rate">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Danger!</strong>  Please hit at least 13 characters and is the maximum of 500 characters.
              </div>
               <div class="alert alert-danger" style="display: none;" id="error_rate_inser">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Danger!</strong>  Please hit at least 13 characters and is the maximum of 500 characters.
              </div>             
				<form action="<?php echo base_url(''); ?>/artist/showgigs/rate_venue" method="post">
                   <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                   <div class="form-group">
                      <label for="comment">Comment:</label>                                        
                      <textarea class="form-control" rows="5" id="comment_rate" name="comment_rate" placeholder="What do you think about this event...? " required></textarea>                    
                      <input type="hidden" id ="user_comment" name="user_comment" value="<?php echo $user_data['id'];?>"/>                      
                      <input type="hidden" id="event_comment" name="event_comment"/>
                      <input type="hidden" id="tour_comment" name="tour_comment"/>
                      <input type="hidden" id="location_comment" name="location_comment"/>
                    </div>   
                   	<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-primary" id="submit_comment_rate">Post Comment</button>
        			</div>
                </form>
			</div>		
		</div>
	</div>
</div>
<!--end modal rate_venue-->
<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
<!--modal booking request-->
<div class="modal fade" id="booking_request">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Booking Request</h4>
			</div>
			<div class="modal-body">
                <!--  <div class="list-group-item list-group-item-warning" style="margin-bottom: 20px;">
                        <p>Sending from a @yahoo address may result in your Press Kit bouncing or being <br />
                         delivered to the user's Junk folder. This is due to a recent technical change of the <br />
                         Yahoo DMARC setting.
                        </p>    
                        <a href="http://www.pcworld.com/article/2141120/yahoo-email-antispoofing-policy-breaks-mailing-lists.html">Read More ></a>
                   </div>-->
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
<!-- venue info-->
<div class="modal fade" id="venue_info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Venue Info</h4>
                <input type="hidden" id="event_info" name="event_info"/>
                <input type="hidden" id="val_title" name="val_title"/>
                <input type="hidden" id="val_location" name="val_location"/>
                <input type="hidden" id="val_start" name="val_start"/>
                <input type="hidden" id="val_end" name="val_end"/>
            </div>
            <div class="modal-body" id="info_venues_show">
                  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div>
<!--end venue info-->
<!-- EPK preview modal start-->
<!-- venue info-->
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
<!--end venue info-->
<!-- EPK preview modal end-->
<!--delete comment-->

 <div class="modal fade" id="modal_delete_comment" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"> VENUES</h3>
        </div>
        <div class="modal-body">
                <form action="<?php echo base_url()?>artist/showgigs/delete" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input type="hidden" id ="event_delete" name="event_delete" />
                    <input type="hidden" id ="user_delete" name="user_delete" />                            
                    <input type="hidden" id ="id_delete" name="id_delete" />
                    <input type="hidden" id ="user_dele" name="user_dele" value="<?php echo $user_data['id'];?>"/>
                    <h3>Are you sure you want to delete this comment..?</h3> 
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-info" id="button_delete_comment">Delete</button>
                   </div>                          		
                 </form>
        </div>        
      </div>
    </div>
  </div>
</div>



<!-- modal rate_venue -->
<div class="modal fade" id="statsModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" style="text-align:center">Venue Stats</h4>
			</div>
			<div class="modal-body">
                <div id="sparkline" style="text-align:center"></div>		
			</div>		
		</div>
	</div>
</div>


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





<!--end delete comment-->
<script>
  var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
  var $url                      = "<?php echo base_url(); ?>";
  var image                     = '<?php echo $this->M_user->get_avata($user_data['id'])?>'; 
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/showgigs.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/showgigs2.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/showgigs_booking.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/showgigs_booking_next.js"></script> 
<script>
$("#sparkline").sparkline([1,1,2], {
    type: 'pie',
    width: '200px',
    height: '200px',    
    tooltipFormat: '{{offset:offset}} ({{percent.1}}%)',
    tooltipValueLookups: {
        'offset': {
            0: 'Bad',
            1: 'Better',
            2: 'Good'
      
    }
    }
    });

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
</script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.mCustomScrollbar.css">
<script src="<?php echo base_url()?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url('assets/dist/js/bootstrap-datepicker.min.js');?>"></script>
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
