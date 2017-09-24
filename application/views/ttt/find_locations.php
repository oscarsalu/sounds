<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datepicker.min.css">

        <div class="col-md-12 remove_padding">
            <div class="col-md-12 right_padding  ttt_pack">
                  <?php if ($this->session->flashdata('email_sent')) {
    ?>
                                <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong>Success: </strong> <?php echo $this->session->flashdata('email_sent')?> ! @_@
                                </div>
                    <?php

} elseif ($this->session->flashdata('email_sent_err')) {
    ?>
                        <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Error!</strong> <?php echo $this->session->flashdata('email_sent_err'); ?>
                        </div>
                        <?php

}?> 
                <div class="row col-md-12 header_new_style" id="find_ttt2">
                   
                    <h2 class="tt text_caplock">Location</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding" style="margin-bottom: 25px;">
                          <html>
                              <head><?php echo $map['js']; ?></head>
                              <body><?php echo $map['html']; ?></body>
                        </html>
                    </div>
                    <div class="row text-center">
                            <form action="" method="post" style="padding-top:10px;" id="cont_promo">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <div class="searchform">
                                    <button class="btn btn-defaulf" onclick="view_location_modal('new','save_location()')" style="border-radius: 7px;">Find new Location</button>                                   
                                </div>
                            </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_detail_location_new" class="modal fade new_modal_style " role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" onclick="" class="close" data-dismiss="modal">&times;</button>
          <h4 class="tt modal-title">Find Location</h4>
          <span class="liner"></span>
        </div>
        <form id="form_tour_submit" action="<?php echo base_url('the_total_tour/find_locations/'.$check_member['tour_id'].'') ?>" method="post">
        
        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
        <input type="hidden" name="tour_id" class="tour_id_detail" />
        <input type="hidden" name="id_tour" value=" <?php echo $check_member['tour_id'];?>" />
        <div class="modal-body" id="form_content_data">
            <div class="form-group">
                <label class="form-input col-md-3" for="location_country" >Country</label>
                <div class="input-group col-md-8">
                    <select name="location_country"  class="form-control" id="location_country">
                        <option>--Select--</option>
                        <?php foreach ($countries as $country) {
    ?>
                            <option value="<?php echo $country['country']; ?>"><?php echo $country['country']; ?></option>
                        <?php 
}?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-input col-md-3" for="location_state" >State</label>
                <div class="input-group col-md-8">
                    <select name="location_state"  class="form-control" id="location_state">
                        <option>--Select--</option>                        
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-input col-md-3" for="location_city">City</label>
                <div class="input-group col-md-8">
                    <select name="location_city"  class="form-control"  id="location_city">
                        <option>--Select--</option>                        
                    </select>
                </div>
            </div>           
        </div>
        
        <div class="modal-footer searchform">
          <img src="<?php echo base_url() ?>dist/images/ajax-loader.gif" style="display:none" class='loading_img' />
          
          <input type="submit" class="btn btn-success excel-go" id="submit_form_find" value="Submit" name="submit_form_find"/>
        </div>
        </form> 
      </div>

    </div>
</div>
<script>

var base_url           = '<?php echo base_url() ?>';
var records_per_page   = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php echo base_url();?>assets/js/detail_pages/ttt/find_locations.js"></script>
<!--popup-->
<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Your Email</h4>
				</div>
				<div class="modal-body">
			          <form class="form-horizontal" action="<?php echo base_url()?>the_total_tour/find_locations/send_mail" method="post">
                       <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                          <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email to</label>
                            <div class="col-sm-10">
                              <!--<input type="email" class="form-control" id="email" name="email_from" placeholder="Your Email....." required/>-->
                              <input type="email" class="form-control" id="email_tos" name="email_tos" value=""/>
                              <input type="hidden" class="form-control" id="message" name="message" value="<?php echo 'Company:'.$this->session->userdata('company'); echo ' & Address:'.$this->session->userdata('address');?>"/>
                              <input type="hidden" name="id_tour" value=" <?php echo $check_member['tour_id'];?>" />
                             <input type="hidden" name="tour_id" value="<?php echo $check_member['tour_id'];?>" />
                            </div>
                          </div>      
                          <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="company" id="company" name="email_pass_from" />
                             
                            </div>
                          </div>    
                           <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email sent</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" id="mail_sent" name="mail_sent" placeholder="Email sent" required />
                             
                            </div>
                          </div>                                       
                          	<div class="modal-footer">
				               	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>					          
                                <input type="submit" class="btn btn-primary" name="sub_email" id="sub_email" value="Send mail" />
			            	</div>
                     </form>
			   	</div>			
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
<script>
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
