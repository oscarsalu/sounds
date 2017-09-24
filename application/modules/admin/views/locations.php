<script>
   $(document).ready(function() {           
      
        $('#list_location').on('click','.btn-del', function (){
            if(confirm("Are you sure you want to delete this location")){
                var id = $(this).find('.id_location').val();                
                $('#delete_id').val(id); 
                $('#form_delete').submit();
            }
        });
          $('#list_location').on('click','#edit_locations', function (){           
                var id = $(this).find('.id_location').val();                
                $('#edit_id').val(id); 
                 var company = $(this).find('.id_company').val();   
                 var phone = $(this).find('.id_phone').val(); 
                 var email = $(this).find('.id_email').val();
                 var city = $(this).find('.id_city').val();   
                 var contact = $(this).find('.id_contact').val(); 
                 var country = $(this).find('.id_country').val();  
                 $("#company").val(company);      
                 $("#phone").val(phone);          
                 $("#email").val(email);
                 $("#city").val(city);          
                 $("#contact").val(contact);
                 $("#country").val(country);
            
        });
        
    }) 
</script>
<div id="result" style="display: none;">edit success</div>
<div class="page-title">
 <div class="row description">
        <?php if($this->session->flashdata('message_success')){
        ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Success: </strong> <?php echo $this->session->flashdata('message_success')?> ! @_@
        </div>
        <?php
        }elseif($this->session->flashdata('message_error1')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message_error1');?>
            </div>
            <?php
        }?>
    </div>

    <div class="row"><div class="col-md-1"></div><div class="col-md-2"><h2>Locations</h2></div></div>
     <div class="row">
            <div class="col-md-1">
                
            </div>
           
            <div class="col-md-2">
                   <button type="button" class="btn btn-info" id="location_add_new" title="Add" style="margin-top: 0px;padding: 5px 20px;" data-toggle="modal" data-target="#add_location_new">Add</button>
            </div>
             <div class="col-md-2">
                 <button type="button" class="btn btn-success" id="location_add" title="Import" style="margin-top: 0px;padding: 5px 20px;" data-toggle="modal" data-target="#import_location">Import</button>
            </div>
            <div class="col-md-2">
                <form action="<?php echo base_url()?>admin/locations/create" method="post" id="" class="form-inline">                                                                 
                            <div class="form-group">
                                 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                 <input type="submit" class="btn btn-default" name="sub_create" id="sub_create" value="Create" />
                             </div>
                             
                             
                     </form>
            
            </div>
            <div class="col-md-5">
                   <form action="<?php echo base_url()?>admin/locations/search" method="post" id="form_search" class="form-inline">                                                                 
                            <div class="form-group">
                                
                                 <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                 <input type="text" class="form-control" id="search" name="search" placeholder="Search........" required>
                             </div>
                             <input type="submit" class="btn btn-default" name="sub_search" id="sub_search" value="Search" />
                             
                     </form>
                 
            </div>
             <?php if(isset($upload_data)){
      	             echo '<ul>';
      	             echo ' <li>Import success</li>';
      	             echo '<li>Link:'.$upload_data['file_path'].'</li>';
                     echo '<li>Name:'.$upload_data['file_name'].'</li>';
                     echo '<li>Name:'.$upload_data['file_size'].'KB</li>';
                     echo '</ul>';
         	}?>
      	
     </div>
  
    <span class="image_load"><img width="30px" src="<?php echo base_url().'assets/img/loader.gif'; ?>" /></span>
   
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            
            <div class="card-body table-responsive ">  
            <?php if(isset($results)){  ?>           
               <table class="table" id="list_location">
                    <tr>
                          <th>#</th>
                         <th>Company</th>
                         <th>Contact</th>
                         <th>Email</th>
                         <th>City</th>
                         <th>Country</th>
                         <th>Phone</th>
                         <th>Ations</th>
                    </tr>
                    <?php
                    if($results){
                        //var_dump($per_page);exit;
                    foreach($results as $i_key =>$locations){?>
                        <tr >
                            <td><?php echo $i_key+1;?></td>
                            <td><?php echo $locations->company; ?></td>
                            <td><?php echo $locations->contact; ?></td>
                             <td><?php echo $locations->email ; ?></td>
                            <td><?php echo $locations->city; ?></td>
                            <td><?php echo $locations->country; ?></td>
                            <td><?php echo $locations->phone; ?></td>
                            <td><div class="row" style="width: 100px;"><a class="btn btn btn-info" style="padding: 4px 6px;" title="Views" href="<?php echo base_url('admin/locations/list').'/'.$locations->id_location; ?>"><i class="fa fa-book"></i></a>
                            <a class="delete btn-del btn btn-primary btn-sm" title="Delete" style="padding: 4px 6px;" href="#">
                               <input type="hidden" class ="id_location" value="<?php echo $locations->id_location;?>"/>
                               <i class="fa fa-remove"></i>
                               </a>
                            <a data-toggle="modal" id="edit_locations" data-target="#edit_location"  class="btn btn-success" title="Edit" style="padding: 4px 6px;" href="#">
                                 <input type="hidden" class ="id_location" value="<?php echo $locations->id_location;?>"/>
                                 <input type="hidden" class ="id_company" value="<?php echo $locations->company; ?>"/>
                                 <input type="hidden" class ="id_contact" value=" <?php echo $locations->contact;?>"/>
                                 <input type="hidden" class ="id_email" value="<?php echo $locations->email ; ?>"/>
                                 <input type="hidden" class ="id_city" value="<?php echo $locations->city; ?>"/>
                                 <input type="hidden" class ="id_country" value="<?php echo $locations->country;?>"/>
                                 <input type="hidden" class ="id_phone" value="<?php echo $locations->phone; ?>"/>
                                <i class="fa fa-edit"></i>
                            </a>
                            </div></td>
                        </tr>
                    <?php
                       }
                        } ?>
                    
                </table><?php
                }?>
               
               
            </div>
             <ul class="pagination">
                <?php echo $links;?>
                </ul>
                 <form action="<?php echo base_url()?>admin/delete-location" method="post" id="form_delete">
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                    <input type="hidden" id ="delete_id" name="id" />
                 </form>
        </div>
    </div>
    
</div>






	<div class="modal fade" id="import_location">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">Import Excel</h4>
						</div>
						<div class="modal-body ">				
             
                                 <?php   //if(isset($error)){echo $error;}?> 
                                 <?php  echo form_open_multipart('admin/locations/do_upload');?>               
                                    <input  type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                       <input class="btn btn-default" type = "file" name = "file" size = "20" /> 
                                       <br /><br /> 
                                       <div class="row">
                                              <div class="col-md-6"><input type = "submit" value = "Import" class="btn btn-info" title="Import"/> </div>
                                              <div class="col-md-6"><button style="float: right;" type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
                                            
                                       </div>                                    
                                      	
                                  </form>                                 
						</div>
					
					</div>
	          </div>
</div>	
<!--******************edit ***************************-->
<!--modal edit-->
<div class="modal fade " id="edit_location">
    <div class="modal-body col-md-12">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'admin/edit-location'?>" method="post" id="form_edit">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
               <input type="hidden" id ="edit_id" name="location_id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Edit Location</h4>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Company*</label>
                        <div class="input-group col-md-8">
                           
                            <input type="text"class="form-control" id="company" name="company" required />
                        </div>
                    </div>
                     <div class="form-group">                        
                        <label class="form-input col-md-3">Contact*</label>
                        <div class="input-group col-md-8">
                            
                            <input type="text"class="form-control" id="contact" name="contact" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Email*</label>
                        <div class="input-group col-md-8">
                           
                            <input type="email"class="form-control" id="email" name="email" required/>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Phone*</label>
                        <div class="input-group col-md-8">
                            
                            <input type="text"class="form-control" id="phone" name="phone" required/>
                        </div>
                    </div>
                       
                    <div class="form-group">                        
                        <label class="form-input col-md-3">City*</label>
                        <div class="input-group col-md-8">
                            
                            <input type="text" class="form-control" id="city" name="city" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Country*</label>
                        <div class="input-group col-md-8">
                            
                           <input type="text"class="form-control" id="country" name="country" required />
                        </div>
                    </div>
                    
                    
                <div class="row modal-footer ">
                                <div class="col-md-3"></div>
                              <div class="col-md-8"><button type="submit" class="btn btn-success sbm_edit5" style="padding: 10px 25px; float:left;">Save</button></div>
          
                    
                </div>                  
            </form>           
        </div>
    </div>
   </div>

</div>






<div class="modal fade " id="add_location_new" >
    <div class="modal-body col-md-12">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'admin/add-location'?>" method="post" id="form_edit">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
               <input type="hidden" id ="edit_id" name="location_id" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Add Location</h4>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Company*</label>
                        <div class="input-group col-md-8">
                           
                            <input type="text"class="form-control" id="company" name="company" required />
                        </div>
                    </div>
                     <div class="form-group">                        
                        <label class="form-input col-md-3">Contact*</label>
                        <div class="input-group col-md-8">
                            
                            <input type="text"class="form-control" id="contact" name="contact" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Email*</label>
                        <div class="input-group col-md-8">
                           
                            <input type="email"class="form-control" id="email" name="email" required/>
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Phone*</label>
                        <div class="input-group col-md-8">
                            
                            <input type="text"class="form-control" id="phone" name="phone" required/>
                        </div>
                    </div>
                       
                    <div class="form-group">                        
                        <label class="form-input col-md-3">City*</label>
                        <div class="input-group col-md-8">
                            
                            <input type="text" class="form-control" id="city" name="city" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Country*</label>
                        <div class="input-group col-md-8">
                            
                           <input type="text"class="form-control" id="country" name="country" required />
                        </div>
                    </div>
                    
                    
                <div class="row modal-footer ">
                                <div class="col-md-3"></div>
                              <div class="col-md-8"><button type="submit" class="btn btn-success sbm_edit5" style="padding: 10px 25px; float:left;">Save</button></div>
          
                    
                </div>                  
            </form>           
        </div>
    </div>
</div>
</div>


