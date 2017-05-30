<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#ampModal" style="background: black none repeat scroll 0 0;
    border: medium none black;">AMP Parental Approval Form</button>-->
<div class="container" >
    <div class="row">
    
      <!-- Modal content-->
      <div class="col-md-10">
		   
          <div style="margin-top:50px;">
              
	Dear Sir/Madam, <br><br>

This agreement relates to a 99sound.com customer that you are considered to be legally responsible for because they are under the age of 18 and therefore cannot provide the legal consent.<br> <br>

In order for the person under 18 years of age to use the Artist Music Player via 99sound.com, you, as the parent or legal guardian of the customer need to complete this form. <br><br>

Please read this Parent Consent Agreement and 99sound.com standard terms and conditions, which can be found here <a href="https://99sound.com/terms_and_conditions">https://99sound.com/terms_and_conditions</a> and also as an attachment to this consent agreement. <br><br>

If you wish to give your consent, please complete and sign this parent consent agreement and then return via web-form or email to: support@99sound.com <br><br>

<form action="<?php echo base_url().'auth/amp_form_send'?>" name="mdsForm" method="post" id="ampForm" style="font-size: 15px">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
    <input type="hidden" name="user_id" value="<?php echo $user_data['id'];?>">
    
    <label style="display: block;float: left;width: 45%;">Name of parent and/or legal guardian:</label> 	
	
    <input type="text" name="parent_name" style="border-radius: 5px;padding: 7px;width: 50%;color: black;"><br><br>
	 <?php echo form_error('parent_name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
    
    <label style="display: block;float: left;width: 45%;">Address of parent and/or legal guardian:</label>  
	
    
    <textarea name="parent_address" style="border-radius: 5px;padding: 7px;width: 50%;color: black;"></textarea><br><br>
	 <?php echo form_error('parent_address', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
    
    <label style="display: block;float: left;width: 45%;">Telephone number of parent and/or legal guardian: </label>	
	<input type="text" name="parent_phone_no" style="border-radius: 5px;padding: 7px;width: 50%;color: black;"><br><br>
	 <?php echo form_error('parent_phone_no', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        
        <label style="display: block;float: left;width: 45%;">I am the lawful parent and/or legal guardian of:</label>	
        <input type="text" name="user_name" placeholder='99sound.com customer username' style="border-radius: 5px;padding: 7px;width: 50%;color: black;" value="<?php echo $user_data['firstname']." ".$user_data['lastname'];?>" disabled=""><br><br><br>
	
        <label style="display: block;float: left;width: 45%;">Date of birth of the 99sound.com Customer: </label>
        <input type="text" name="dob" style="border-radius: 5px;padding: 7px;width: 50%;color: black;" data-date-format="dd-mm-yyyy" class="dob"><br><br>
	 <?php echo form_error('dob', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        
        <label style="display: block;float: left;width: 45%;">Place of birth of the 99sound.com Customer: </label>
	<input type="text" name="place_birth" style="border-radius: 5px;padding: 7px;width: 50%;color: black;" ><br><br>
 <?php echo form_error('place_birth', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
        
        <input type="checkbox" name="agree">
By ticking this box, you are providing your consent and permission to the items numbered 1-2 below in relation to the 99sound.com Customer releasing and distributing musical works through the 99sound.com service: <br><br>

1. I acknowledge that I have read and understand 99sound.com Terms and Conditions and Privacy Policy that are on their website, and that 99sound.com and I will be bound by these terms and conditions. <br><br> 

2. I allow the 99sound.com Customer's name, and region to be displayed on the 99sound.com service. <br><br>
<?php echo form_error('agree', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
		<label style="display: block;float: left;">Full name and signature of parent and/or legal guardian:</label>	<br><br>
		<label style="display: block;float: left;width: 45%;">Name:</label>
		<input type="text" name="name"  style="border-radius: 5px;padding: 7px;width: 50%;color: black;"><br><br>
		<?php echo form_error('name', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                
                <label style="display: block;float: left;width: 45%;">Signature:</label>
		<input type="text" name="sign"  style="border-radius: 5px;padding: 7px;width: 50%;color: black;"><br><br>
		<?php echo form_error('sign', '<div class="strike-heading"><span><div class="error">', '</div></span></div>'); ?>
                
                <div style="margin: auto;text-align: center;width: 50%;">
		<input type="submit" name="send" Value="Send" style="font-weight: bold;padding: 4px;width: 40%; color: black;">
		<input type="button" name="clear" Value="Clear" style="font-weight: bold;padding: 4px;width: 40%; color: black;" onclick="javascript:document.getElementById('ampForm').reset();">
		</div>
</form>	
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
<script>
    $('.dob').datepicker();
    </script>