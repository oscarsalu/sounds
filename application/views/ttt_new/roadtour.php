<script type="text/javascript">
    $('#waypoints').tokenize({
         newElements: false,
         displayDropdownOnFocus: true
     });
    $('#email_id').tokenize({
         newElements: false,
         displayDropdownOnFocus: true
    });
</script>
<div class="container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> <h2 class="tt text_caplock">Road Map Tour</h2></h2>
                    
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <form id="form_itinerary_submit_data"  method="post">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <input type="hidden" id="tour_id" name="tour_id" value="<?php echo $tour_id; ?>"  />
                        <table class="table">
                            <tr>
                                <td><strong>Start Point:</strong></td>
                                <td><select name="start_point" id="start_point" class="new-select-box">
                                <?php
                                foreach ($locations as $location) {
                                ?>
                                    <option value="<?php echo $location['location'] ?>"><?php echo $location['location'] ?></option>
                                <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td><strong>Way Points:</strong></td>
                                <td><select id="waypoints" name="waypoints[]" class="" multiple="multiple">
                                <?php
                                foreach ($locations as $location) {
                                ?>
                                    <option value="<?php echo $location['location'] ?>"><?php echo $location['location'] ?></option>
                                <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td><strong>End Point:</strong></td>
                                <td><select id="end_point" name="end_point" class="new-select-box">
                                <?php
                                foreach ($locations as $location) {
                                ?>
                                    <option value="<?php echo $location['location'] ?>"><?php echo $location['location'] ?></option>
                                <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center"> <hr>
                                <a class="btn btn-info" id="submit_itinerary">Search</a><hr></td>
                                
                            </tr>
                            <tr>
                                <td><strong>Emails</strong></td>
                                <td><select id="email_id" name="email_id[]" class="" multiple="multiple">
                                <?php
                                foreach ($emailIds as $emailId) {
                                ?>
                                    <option value="<?php echo $emailId['email'] ?>"><?php echo $emailId['email'] ?></option>
                                <?php } ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center searchform">
                                    <button class="btn btn-info" type="button" onclick="save_itinerary1()" id="save_itinerary">Save & Send Email</button>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="maproadtour"></div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="x_panel tile overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Direction</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="demo_sent" method="post" action="<?php echo base_url(); ?>">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div id="right-panel"></div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript">
    
</script>

<!--https://www.google.com/maps/dir/+locai+//-->
<!--modal sent epk-->
<div class="modal fade" id="modal_sent_roadmap">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">99sound.com</h4>
             </div>
             <div class="modal-body">
               <div class="panel panel-success">
                 <table style="margin: 10px;">
                  <tbody>
                         <tr>
							<td align="center" style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
								<h1 style="color:#333;display:block;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:25px;font-weight:bold;line-height:130%;margin:0 0 15px;padding:0"> Sent Road Tour Map</h1>
								<p style="line-height:170%;margin:15px 0;padding:0">This email has been sent as a request to tour</p>
							</td>
						</tr>
						<tr>
							<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
								<hr style="background-color:#fff;border:0;border-bottom:1px dashed #ccc;color:#fff;min-height:1px;margin:20px 0;padding:0">
						     </td>
                        </tr>
                        <tr>
							<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
							    <strong>Tour: <?php echo strtoupper($tour['tour']); ?>,<br /></strong>
                               
						     </td>
                        </tr>
                          <tr>
							<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
							    <strong>Artist: <?php echo ucfirst($name_artist['artist_name']);?><br /></strong>
                                
						     </td>
                        </tr>
                        <tr>
							<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
							    <strong>Describe: <?php echo $tour['des']; ?>,<br /></strong>
                                
						     </td>
                        </tr>	
                         <tr>
    						<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
    						    <strong>Member:<b style="color: #6464E4;"> <?php 
                                if (isset($show_list_member)) {
                                    echo $show_list_member;
                                }
                                ?>.</b><br /></strong>
                                
    					     </td>
                        </tr>
                        <tr>
								<td align="center" style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
										<tbody>
											<tr>
												<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;padding:20px 0;text-align:center">
													<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;display:inline-block">
														<tbody>
                                                            <tr>
                                                             <td><h1 style="color:#333;display:block;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:23px;font-weight:bold;line-height:130%;margin:0 0 15px;padding:0">Please access the link below for instructions on road</h1></td>
                                                            </tr>
															<tr>
																<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;background-color:#ff4a00;padding:8px 20px;border-radius:3px">
                                                                <a href="https://www.google.com/maps/dir///" style="color:#fff;font-family:&quot;Open Sans&quot;,&quot;HelveticaNeue-Light&quot;,&quot;Helvetica Neue Light&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:25px;font-weight:300;line-height:180%;text-decoration:none" target="_blank">Go to https://www.google.com/maps/dir/</a></td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
									<p style="line-height:170%;margin:15px 0;padding:0"><em>Thank you for using 99Sound!</em></p>
								</td>
							</tr>
                  </tbody>
                 </table>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <button type="button" onclick="sent_mail_epk_tour()" class="btn btn-primary">Sent email EPK</button>
             </div>
         </div>
     </div>
 </div>


<script>
  var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
  var $url                      = "<?php echo base_url(); ?>";
  var tour                      = "<?php echo $tour_id; ?>";
</script>

