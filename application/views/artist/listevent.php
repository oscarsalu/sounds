<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">
<div class="" style="min-height: 100vh;">
    <div class="container-fluid fix-amp">
    <?php
      include('inc_side_menu/menu_artist.php')
    ?>
    <div class="side-body">
        <h2>Gigs Event Manager</h2>
        <hr />
        <div class="breadcrumb flat" style="    width: 100%">
        	<a href="<?php echo base_url()?>artist/profile">Profile</a>
        	<a class="active" href="#">Gigs & Event Manager</a>
        </div>
        <section class="tile" style="padding: 0px;">
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h3 class="custom-font"><strong>Editable</strong> Gigs Event</h3>
            </div>
            <!-- tile body -->
            <div class="tile-body">
                <a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#addmember"><span></span></a>
                <div class="form-group pull-right">
                    <input type="text" class="search form-control" placeholder="Search Key">
                </div>
                <div class="table-responsive" id="member_item">
                    <table class="table table-custom results" id="event_mn">
                        <thead>
                        <tr>
                              <th class="center">Title</th>
                              <th class="center">Description</th>
                              <th class="center">Posted By</th>
                              <th class="center">Start Date</th>
                              <th class="center">End Date</th>
                              <th class="center">Location</th>
                              <th class="center">Post Date</th>
                              <th class="no-sort">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) {
    ?>    
                                <tr>
                                    <td class="center"><?php echo $row['event_title']; ?></td>
                                    <td class="center">
                                        <?php 
                                              echo custom_echo_html($row['event_desc'], 50); ?>
                                    </td>
                                    <td class="center"><?php echo $row['posted_by']; ?></td>
                                    <td class="center"><?php echo $row['event_start_date']; ?></td>
                                    <td class="center"><?php echo $row['event_end_date']; ?></td>
                                    <td class="center"><?php echo $row['location']; ?></td>
                                    <td class="center"><?php echo $row['post_date']; ?></td>
                                    <td class="center">                                                        
                                        <a class="btn-edit btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#editevent">
                                            <span style="display: none;"></span><i class="glyphicon glyphicon-pencil"></i>
                                            <input type="hidden" class="event_id" value="<?php echo $row['event_id']; ?>"/>
                                            <input type="hidden" class="event_title" value="<?php echo $row['event_title']?>"/>
                                            <div style="display: none;"><?php echo $row['event_desc']?></div>
                                            <input type="hidden" class="posted_by" value="<?php echo $row['posted_by']?>"/>
                                            <input type="hidden" class="event_start_date" value="<?php echo $row['event_start_date']?>"/>
                                            <input type="hidden" class="event_end_date" value="<?php echo $row['event_end_date']?>"/>
                                            <input type="hidden" class="location" value="<?php echo $row['location']?>"/>
                                            <input type="hidden" class="banner" value="<?php echo $row['event_banner']?>"/>
                                            <input type="hidden" class="cats" value="<?php echo $row['categories']?>"/>
                                         </a>
                                        <a onclick="return confirmDialog();" class="btn btn-danger btn-sm " href="#">
                                            <i class="glyphicon glyphicon-remove"></i>
                                            <input type="hidden" id ="id_delete" value="<?php echo $row['event_id']?>"/>                                      
                                        </a>                                        
                                    </td>
                                </tr>                
                            <?php 
}
                            ?>    
                        </tbody>
                    </table>
                    <?php echo $this->pagination->create_links(); ?>
                </div>
            </div>
            <!-- /tile header -->
        </section>
    </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/jquery-ui/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>assets/jquery-ui/external/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>

<!-- Modal edit event -->
<div class="modal fade" id="editevent" tabindex="-1" role="dialog" aria-labelledby="myModalEvent" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">  
            <form action="" method="post" name="editEvents" id="editEvents">                    
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Edit Event</h4>
                </div>            
             <div class="modal-body">   
                                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_desc">Categories*</label>
                    <div class="input-group col-md-8">
                        <select class="form-control " name="categories" id="cate" required="" >
                            <option value="">-- Choose category --</option>
                            <option value="1">Rock</option>
                            <option value="2">Dance</option>
                            <option value="3">Pop</option>
                            <option value="4">R&B</option>
                            <option value="5">DJ</option>
                            <option value="6">Children</option>
                            <option value="7">Festivals</option>
                            <option value="8">Punk and Hardcore</option>
                            <option value="9">Staff Picks</option>                                                        
                        </select> 
                    </div>
                </div>            
                
                <div class="form-group">                    
                    <label class="form-input col-md-3" for="event_desc">Choose a Banner File</label>
                    <div class="input-group col-md-8">
                        <input type="file" class="form-control" name="event_banner" id="event_banner"/>
                    </div>
                </div>
                                                                                                                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_desc">Event Title*</label>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" name="event_title" id="title" value="" required="" />
                    </div>
                </div>                                                               
                
                <div class="form-group">                        
                    <label class="form-input col-md-3">Event Description*</label>
                    <div class="input-group col-md-8">
                        <textarea class="form-control" rows="5" id="description" name="event_desc"></textarea>
                        <span id="er-des"></span>                       
                    </div>
                </div>                                            
                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="posted_by">Post By*</label>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" name="posted_by" id="post_by" value="" required="" />  
                    </div>
                </div>
                                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_start_date">Event start date*</label>
                    <div class="input-group col-md-8">
                        <input type='text' class="form-control" name="event_start_date" id="event_start_date" required="" />
                    </div>
                </div>
                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="event_end_date">Event end date*</label>
                    <div class="input-group col-md-8">
                        <input type='text' class="form-control"   name="event_end_date" id="event_end_date" required="" />  
                    </div>
                </div>                                                                                                                            
                
                <div class="form-group">                        
                    <label class="form-input col-md-3" for="location">Location*</label>
                    <div class="input-group col-md-8">
                        <input type="text" class="form-control" id="loca" name="location" value="" required="" />  
                    </div>
                </div>                                                                                
                                 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit" id="update_event" value="create_event">Update Event</button>
                </div>                  
              </div>
        </form>  
    </div>
</div>
</div>
<script type="text/javascript">
    var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
    var page_url                  = '<?php echo base_url(); ?>'; 
</script>


<script src="<?php echo base_url(); ?>assets/js/editor/nicEdit.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery-ui/external/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/managerevent.js"></script>