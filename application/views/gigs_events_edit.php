<div class="container-fluid" style="margin-bottom: 200px;">
        <div class="row">            
            <div class="col-md-10 col-md-offset-1">
                <legend style="font-size: 50px;">Edit Events</legend>
            <?php $attributes = array('name' => 'editEvents', 'id' => 'editEvents', 'method' => 'post');?>
             <?php echo form_open('gigs_events/update/'.$rows[0]->event_id, $attributes);?>             
                <div class="row">                   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="event_desc">Event Title</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="event_title" name="event_title" value="<?php echo $rows[0]->event_title; ?>"/>                                
                            </div>            
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">    
                    <div class="form-group">
                      <label for="event_desc" class="col-md-2 control-label">Event Description</label>
                      <div class="col-md-6">
                          <div class="col-md-8">
                            <textarea class="form-control" rows="5" id="event_desc" name="event_desc"><?php echo $rows[0]->event_desc; ?></textarea>
                          </div>  
                      </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="posted_by">Post By</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="posted_by" name="posted_by" value="<?php echo $rows[0]->posted_by; ?>"/>                                
                            </div>            
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="posted_by">Event start date</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">                                
                                <input type='text' class="form-control" name="event_start_date" id="event_start_date" value="<?php echo $rows[0]->event_start_date; ?>"/>                                                                                                                           
                            </div>                                      
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="posted_by">Event end date</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">                                
                                <input type='text' class="form-control" name="event_end_date" id="event_end_date" value="<?php echo $rows[0]->event_end_date; ?>"/>                                                                                                                           
                            </div>                                      
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">    
                    <div class="form-group">
                      <label for="event_desc" class="col-md-2 control-label">Location</label>
                      <div class="col-md-6">
                          <div class="col-md-8">
                            <textarea class="form-control" rows="5" id="location" name="location"><?php echo $rows[0]->location; ?></textarea>
                          </div>  
                      </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">    
                    <div class="form-group">
                        <div class="col-md-2" style="margin-left: 30px;"></div>
                        <button type="submit" class="btn btn-primary" name="submit" value="edit_event">Update Event</button>
                    </div>
                </div>    
                <?php echo form_close(); ?>
            </div>        
        </div>   
                            
    </div>              
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/jquery-ui/jquery-ui.min.css">
    <script src="<?php echo base_url(); ?>assets/jquery-ui/external/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>  
    <script src="<?php echo base_url(); ?>assets/js/detail_pages/gigs_events/gigs_events_footer.js"></script>    
   