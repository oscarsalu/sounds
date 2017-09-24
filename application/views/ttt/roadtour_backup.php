
<div class="col-md-12 remove_padding" >
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
    <div class="col-md-8 remove_padding load_google_map">
        <div id="floating-panel">
          <strong>Start:</strong>
          <select id="start">
            <?php foreach ($locations as $location) {
    ?>
				<option value="<?php echo $location['location'] ?>"><?php echo $location['location'] ?></option>
			<?php 
} ?>
            
          </select>
          <strong>End:</strong>
          <select id="end">
            <?php foreach ($locations as $location) {
    ?>
				<option value="<?php echo $location['location'] ?>"><?php echo $location['location'] ?></option>
			<?php 
} ?>
          </select>
        </div>
        <div id="map"></div>
    </div>
    <div class="col-md-4 remove_padding load_google_map_left">
        <form id="demo_sent" method="post" action="<?php echo base_url(); ?>">
             <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <div id="right-panel">
              
              
            
            </div>
        </form><!--end form sent mail--->
          
    </div>
</div>
<!--https://www.google.com/maps/dir/+locai+//-->
<!--modal sent epk-->
<div class="modal fade" id="modal_sent_epk">
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
								<h1 style="color:#333;display:block;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:25px;font-weight:bold;line-height:130%;margin:0 0 15px;padding:0"> Sent email epk</h1>
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
<!--end modal sent epk--->    
<script>
  var $records_per_page         = '<?php echo $this->security->get_csrf_hash(); ?>';
  var $url                      = "<?php echo base_url(); ?>";
  var tour                       ="<?php echo $tour_id; ?>";
</script>

<script src="<?php echo base_url(); ?>assets/js/detail_pages/ttt/roadtour.js"></script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJvpLZ60bn_tarrmdSp10I9wjuoJKjT70&callback=initMap">

</script>
