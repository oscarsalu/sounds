<link href="<?php echo base_url('assets/css/artist_showgig.css');?>" rel="stylesheet" /> 
<script src="<?php echo base_url(); ?>assets/js/detail_pages/gigs_events/read_event_header.js"></script>
                     
                        <!-----star---------- -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/star/css/star-rating.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>    
<script src="<?php echo base_url(); ?>assets/star/js/star-rating.js" type="text/javascript"></script>
                        <!----------success------------>   
<div class="wrap" id="read_event" >
            <?php
            if (isset($events)) {
                ?>
                            <div class="container">
                            <br /> 
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="panel panel-success">
                                    <div class="row panel-heading">
                                        <div class="col-md-10"><h1 class="text-center text-capitalize"><?php echo ucfirst($events->event_title); ?></h1></div>
                                        <div class="col-md-2 sm_share">
                                                <div style=" top: -4px;" class="fb-like" data-href="<?php echo base_url('gigs_events/'.$current_title)?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                                    				<a style="padding: 0 5px;" href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo base_url('gigs_events/'.$current_title)?>">Tweet</a>
                                    				<script>
                                    					!function(d,s,id){
                                    					    var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
                                    					    if(!d.getElementById(id)){
                                    					        js=d.createElement(s);
                                    					        js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
                                    					        fjs.parentNode.insertBefore(js,fjs);
                                    					    }
                                    					}(document, 'script', 'twitter-wjs');
                                    				</script>
                                    				<a data-pin-do="buttonBookmark" href="//www.pinterest.com/pin/create/button/" >
                                    				<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
                                    				<g:plusone data-size="standard " data-annotation="bubble"  ></g:plusone>
                                    				<!-- Please call pinit.js only once per page -->
                                    				<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
                                      </div>
                                    </div>
                                    <div class="panel-body" style="min-height: 150px;">
                                          <div class="row">
                                             </div><img src="<?=base_url('uploads/'.$events->user_id.'/photo/banner_events/'.$events->event_banner)?>" class="img-responsive" style="width:100%" alt="Image">
                                          </div>
                                          <div class="well" style="margin-bottom: 0;">
                                              <div class="row">
                                                <p>
                                                 Description:<?php echo ucfirst($events->event_desc); ?>
                                                </p>
                                              </div>
                                               <div class="row">
                                                    <p>
                                                     Categories:<?php 
                                                         $id = $events->categories;
                $check = $this->Events_model->Categories($id);
                                                        // var_dump($check);exit;
                                                         if (isset($check)) {
                                                             foreach ($check  as $c_s) {
                                                                 echo $c_s['name'];
                                                             }
                                                         } ?>
                                                    </p>
                                               </div> 
                                              <div class="row">
                                                 <p>Start Date:<?=$events->event_start_date?>     </p>
                                              </div>
                                               <div class="row">
                                                 <p>End Date:<?=$events->event_end_date?>     </p>
                                              </div>
                                              <div class="row">
                                                 <p>Capacity:<?=$events->capacity?> </p>
                                              </div>
                                              <div class="row">
                                                 <p>Location:<?php echo ucfirst($events->location); ?>     </p>
                                              </div>
                                              <!--star-->
                                              <div class="row">
                                                 <?php 
                                                    echo '<div col-md-1></div>';
                echo ' <div class="col-md-10 " id="sum_star">
                                                              <b class="btn btn-warning">'.round($events->sum_star, 3).'</b> <input id="input_'.$events->event_id.'" name="input-3" value="'.$events->sum_star.'" class="rating-loading" data-size="xs">';
                if ($this->M_tour->rate_star($events->event_id) != false) {
                    echo '<p style="margin-top: 15px;">'.$this->M_tour->rate_star($events->event_id).'- Reviews</p>';
                }
                echo  '</div>';
                echo '<div col-md-1></div>'; ?>
                                                  <script>
                                                    $(document).on('ready', function(){
                                                        $('#input_<?php echo $events->event_id; ?>').rating({displayOnly: true, step: 0.5});                                                         
                                                    });
                                                </script>  
                                              </div>
                                              <div class="row">
                                                <?php
                                                if ($this->M_tour->check_user_event_star($events->event_id, $user_data['id']) == 'oke') {
                                                    echo ' <div class="col-md-3">
                                                       <button type="button" id="button_star_rate" class="btn btn-default add_stats" data-toggle="modal" data-target="#add_stats" style="margin-right: 5px;">STAR';

                                                    echo      '</button>';
                                                    echo   '</div>';
                                                } ?>
                                                <div class="col-md-3">                                    
                                                                      <button type="button" class="btn btn-default" onclick="window.location.href = '<?php echo base_url('artist/allblogs').'/'.$events->user_id ?>'">Artist Blog</button>
                                                </div> 
                                              </div>
                                              <!--end star-->
                                          </div>
                                        <div class="panel-footer">
                                                <div class="row" id="comment_star_<?php echo $events->event_id?>">
                                                     <div class="row text-left"><h1 class="list-group-item list-group-item-success">Comment</h1></div>
                                                     <?php 
                                                      if (isset($comment)) {
                                                          foreach ($comment as $data) {
                                                              $name = $this->M_tour->name_show($data['user_id']);
                                                              if ($name != false) {
                                                                  echo '<div class="list-group-item comment_height" id="dele_'.$data['id'].'">';
                                                                  if ($data['user_id'] === $user_data['id']) {
                                                                      echo '<button type="button" class="close" style="padding: 10px;" id="delete_comment_read" data-toggle="modal"  data-target="#modal_delete_comment_event" title="Delete">&times;';
                                                                      echo '<input type="hidden" class="id_delete" value="'.$data['id'].'" />';
                                                                      echo '</button>';
                                                                  }
                                                                  echo '<img src="'.$this->M_user->get_avata($data['user_id']).'" class="thumbnail img_left" alt="Avatar"/>';

                                                                  foreach ($name as $n) {
                                                                      echo '<a href="'.base_url().$n['lastname'].'" title="'.$n['lastname'].'"><h3 class="list-group-item-heading">'.ucfirst($n['lastname']).'</h3></a>';
                                                                  }
                                                                  echo '<p class="text-overflow list-group-item-text">'.htmlentities($data['info_venues']).'</p>';
                                                                  echo '</div>';
                                                              }
                                                          }
                                                      } ?>
                                                </div>
                                               <div class="alert alert-danger" style="display: none;" id="error_rate">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Danger!</strong>  Please hit at least 13 characters and is the maximum of 500 characters.
                                              </div>
                                               <div class="alert alert-danger" style="display: none;" id="error_rate_inser">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Danger!</strong>  Please hit at least 13 characters and is the maximum of 500 characters.
                                              </div>             
                                			  <?php
                                              if (isset($user_data['id'])) {
                                                  ?>
                                                <form action="<?php echo base_url(''); ?>/artist/showgigs/rate_venue" method="post">
                                                	<input type="hidden" name="<?=$this->security->get_csrf_token_name(); ?>" value="<?=$this->security->get_csrf_hash(); ?>" />
                                                	<div class="form-group">
                                                		<label for="comment"></label>                                        
                                                		<textarea class="form-control" rows="5" id="comment_rate" name="comment_rate" placeholder="What do you think about this event...? " required></textarea>                    
                                                		<input type="hidden" id ="user_comment" name="user_comment" value="<?php echo $user_data['id']; ?>"/>                      
                                                		<input type="hidden" id="event_comment" name="event_comment" value="<?php echo $events->event_id; ?>"/>
                                                		<input type="hidden" id="tour_comment" name="tour_comment" value="<?php echo $events->tour_id; ?>"/>
                                                		<input type="hidden" id="location_comment" name="location_comment" value="<?=$events->location_id?>"/>
                                                	</div>
                                                	<div class="form-group">  
                                                		<a class="btn btn-warning" href="<?=base_url('gigs_events')?>">Previous</a>  
                                                		<button type="button" class="btn btn-primary" id="submit_comment_rate_read" style="float: right;">Post Comment</button>
                                                	</div>
                                                </form>
                                                <?php

                                              } ?>  
                                         </div>  
                                     </div>
                                  </div>
                                </div>
                              </div>
                <?php

            } else {
                ?>
                <div style="min-height: 580px;" class="list-group-item list-group-item-warning">
                   <br /><br />
                <h1 class="text-center text-capitalize">Not Found Data Event </h1>
                <p class="text-center"><a class="btn btn-danger" href="<?=base_url('gigs_events')?>">Previous</a></p>
                
                </div>
                
                <?php

            }
            ?>
</div>
<!--delete comment-->
<!--delete comment-->
 <div class="modal fade" id="modal_delete_comment_event" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"> VENUES</h3>
        </div>
        <div class="modal-body">
                <form action="<?php echo base_url()?>gigs_events/read_delete" method="post">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                     <input type="hidden" id="delete_id_read" name="delete_id_read"/>
                    <h3>Are you sure you want to delete this comment..?</h3> 
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-info" id="button_delete_comment_event">Delete</button>
                   </div>                          		
                 </form>
        </div>        
      </div>
    </div>
  </div>
</div>
<!--add star--->
<div class="modal fade" id="add_stats">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Rate state</h4>
			</div>
			<div class="modal-body">
				<div class="page-header text-center">
                        <h1 class="text-center text-capitalize"><?php echo ucfirst($events->event_title);?></h1>
                        <form action="<?php echo base_url(''); ?>artist/showgigs/star" method="post">                            
                            <br/>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <input id="input-2ba">                           
                            <input type="hidden" id="star_oke" name="star_oke" value="0"/>
                            <br />   
                                  <input type="hidden" id="user" name="user" value="<?php echo $user_data['id'];?>"/>
                                  <input type="hidden" id="rate" name="rate" value="1"/> 
                                   <?php 
                                   if (!empty($events->event_id)) {
                                       $event = $events->event_id;
                                   } else {
                                       $event = '';
                                   }
                                        echo '<input type="hidden" id ="event_star" name="event_star" value="'.$event.'">';
                                   if (!empty($events->tour_id)) {
                                       $tour = $events->tour_id;
                                   } else {
                                       $tour = '';
                                   }
                                        echo '<input type="hidden" id ="tour_star" name="tour_comment" value="'.$tour.'">';
                                   if (!empty($events->location_id)) {
                                       $location = $events->location_id;
                                   } else {
                                       $location = '';
                                   }
                                        echo '<input type="hidden" id ="location_star" name="location_star" value="'.$location.'">';
                                  ?>
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
<!--end star-->
<script>
  var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
  var $url                      = "<?php echo base_url(); ?>";
  var image                     = '<?php echo $this->M_user->get_avata($user_data['id'])?>'; 
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/gigs_events/read_event.js"></script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/artists/showgigs.js"></script>
