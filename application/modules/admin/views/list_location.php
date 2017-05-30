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
<div class="page-title">
    <span class="title">Manager Premium payment</span>
    <div class="description">
        <?php if($this->session->flashdata('message_success')){
        ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> <?php echo $this->session->flashdata('message_success')?>
        </div>
        <?php
        }elseif($this->session->flashdata('message_error')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message_error')?>
            </div>
            <?php
        }?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title"><a class="btn btn-default" href="<?php echo base_url('admin/locations') ?>">Back List</a>
                    
                    </div>                    
                </div>
            </div>
             <div class="card-body table-responsive ">  
            <?php if(isset($list_location)){?>              
                <table class="table" id="list_location">
                    <tr>
                         
                         <th>Company</th>
                         <th>Contact</th>
                         <th>Email</th>
                         <th>Street1</th>                          
                         <th>City</th>
                         <th>Country</th>
                         <th>Phone</th>
                         <th>Action</th>
                    </tr>
                    <?php foreach($list_location as $locations){?>
                        <tr >
                            <td><?php echo $locations['company']; ?></td>
                            <td><?php echo $locations['contact']; ?></td>
                            <td><?php echo $locations['email'] ; ?></td>
                            <td><?php echo $locations['street1'] ; ?></td>                            
                            <td><?php echo $locations['city']; ?></td>
                            <td><?php echo $locations['country']; ?></td>
                            <td><?php echo $locations['phone']; ?></td>
                             <td>
                                   <a data-toggle="modal" id="edit_locations" data-target="#edit_location"  class="btn btn-success" title="Edit" style="padding: 4px 6px;" href="#">
                                 <input type="hidden" class ="id_location" value="<?php echo $locations['id_location'];?>"/>
                                 <input type="hidden" class ="id_company" value="<?php echo $locations['company']; ?>"/>
                                 <input type="hidden" class ="id_contact" value=" <?php echo $locations['contact'];?>"/>
                                 <input type="hidden" class ="id_email" value="<?php echo $locations['email'] ; ?>"/>
                                 <input type="hidden" class ="id_city" value="<?php echo $locations['city']; ?>"/>
                                 <input type="hidden" class ="id_country" value="<?php echo $locations['country'];?>"/>
                                 <input type="hidden" class ="id_phone" value="<?php echo $locations['phone']; ?>"/>
                                <i class="fa fa-edit"></i>
                            </a>
                             </td>
                        </tr>
                    <?php
                         } ?>
                    
                </table><?php
                }?>                             
            </div>            
        </div>
    </div>
</div>











<div class="modal fade " id="edit_location" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
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

