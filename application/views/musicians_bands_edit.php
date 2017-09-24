<div class="container-fluid" style="margin-bottom: 200px;">
        <div class="row">            
            <div class="col-md-10 col-md-offset-1">
                <legend style="font-size: 50px;">Edit Musicians & Bands</legend>
                <?php $attributes = array('name' => 'editmusicians', 'id' => 'editmusicians', 'method' => 'post');?>
                <?php echo form_open('musicians/update/'.$rows[0]->musicians_bands_id, $attributes);?>
                <div class="row">                   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="profession">Profession</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="profession" name="profession" value="<?php echo $rows[0]->profession; ?>"/>                                
                            </div>            
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">                   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="genre">Genre</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="genre" name="genre" value="<?php echo $rows[0]->genre; ?>"/>                                
                            </div>            
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>                                
                
                <div class="row">    
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="years_of_experiences">Years Of Experiences</label>
                      <div class="col-md-6">
                          <div class="col-md-8">
                            <textarea class="form-control" rows="5" id="years_of_experiences" name="years_of_experiences"><?php echo $rows[0]->years_of_experiences; ?></textarea>
                          </div>  
                      </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="instruments">Instruments</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="instruments" name="instruments" value="<?php echo $rows[0]->instruments; ?>"/>                                
                            </div>            
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">   
                    <div class="form-group">             
                        <label class="col-md-2 control-label" for="availabilities">Availabilities</label>          
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="availabilities" name="availabilities" value="<?php echo $rows[0]->availabilities; ?>"/>                                
                            </div>            
                        </div>
                    </div>                    
                </div>
                <div class="clearfix"></div>
                
                <div class="row">    
                    <div class="form-group">
                      <label for="location" class="col-md-2 control-label">Location</label>
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
                        <button type="submit" class="btn btn-primary" name="submit" value="update_musicians">Update Musicians & Bands</button>
                    </div>
                </div>    
                <?php echo form_close(); ?>
            </div>        
        </div>                   
             
    </div>              
    