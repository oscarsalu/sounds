<script>
var get_csrf_hash  ='<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php echo base_url(); ?>assets/js/detail_pages/amp/profile.js"></script>
<style>

.profile-edit {
    margin: 15px;
    padding-top:20px;
}
.pagetext-color {
    color: #ded8d8;
}
</style>
<script>
$(document).ready(function(){
    var value = <?php echo "'".$user_data['gender']."'";?>;
    if( value == 'male')
    {
        $('input:radio[name=gender][value=male]').prop("checked", true );
    }
    else{
        $('input:radio[name=gender][value=female]').prop("checked", true );
    }

    var genre = <?php echo $user_data['genre'];?>;
    var element = document.getElementById('genre');
    element.value = genre;

    var favorite_artist = <?php echo $user_data['fav_artist'];?>;
    var element_favorite_artist = document.getElementById('favorite_artist');
    element_favorite_artist.value = favorite_artist;
});

</script>
<div class="container">

    <div class="row">
        <div class="profile-edit ">
            <h1 class="pagetext-color">Edit Profile - Affiliate </h1>
            <hr />
            <div class="alert_panel">
                
            </div>
            <form class="form-horizontal profile " onsubmit="return false" role="form" action="<?php echo base_url('amper/edit_profile')?>" method="post">
            	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="col-md-6 col-sm-6">
                    
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">First Name:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" required="" name="first_name" value="<?php echo $user_data['firstname'] ?>"placeholder="First Name">
            			  <?php echo form_error('first_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Last Name:</label>
                    <div class="col-sm-9">
                      <input type="text" required="" name="last_name" value="<?php echo $user_data['lastname']  ?>" class="form-control" placeholder="Last Name">
            			     <?php echo form_error('last_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Paypal User ID:</label>
                    <div class="col-sm-9">
                      <input type="email" required="" name="email_paypal" value="<?php echo $U_map['paypal'] ?>" class="form-control" placeholder="Email Paypal">
            			 <?php echo form_error('email_paypal'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Phone:</label>
                    <div class="col-sm-9">
                      	<input type="input" name="phone" class="form-control " value="<?php echo $user_data['phone'] ?>" placeholder="Phone">
            			     <?php echo form_error('phone'); ?>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Address:</label>
                    <div class="col-sm-9">
                        <input type="input" name="address" class="form-control input-sm" value="<?php echo $user_data['address'] ?>" placeholder="Address">
                      	<?php echo form_error('address'); ?>
                    </div>
                </div>
            	<div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">City & State:</label>
                    <div class="col-sm-9">
                        <input type="input" name="city" class="form-control" value="<?php echo $user_data['city'] ?>" placeholder="City">
                      	<?php echo form_error('city'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Web Url:</label>
                    <div class="col-sm-9">
                        <input type="input" name="web_url" class="form-control" value="<?php echo $user_data['website'] ?>" placeholder="Website">
                      	<?php echo form_error('web_url'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Gender:</label>
                    <div class="col-sm-9">
                      <input type="radio" name="gender" value="male" class=" form-input" /> <label class="pagetext-color"> Male </label>  
                        <input type="radio" name="gender" value="female" class="form-input" /> <label class="pagetext-color"> Female </label>  
                          <?php echo form_error('first_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Favorite Genre:</label>
                    <div class="col-sm-9">
                     <!--  <input type="text" name="last_name" value="<?php echo $user_data['lastname']  ?>" class="form-control" placeholder="Favorite Genre">
                             <?php echo form_error('last_name'); ?> -->
                        <select class="form-control" name="genre" id="genre">
                                    <option value="">Genre</option>
                                    <?php 
                                    foreach ($genres as $key) {
                                        ($key['id'] == set_value(genre)) ? $select = 'selected' : $select = ''; ?><option <?=$select?> value="<?php echo $key['id'] ?>"><?php echo $key['name']?></option><?php 
                                    } 
                                    ?>
                        </select>     
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Favorite Artist:</label>
                    <div class="col-sm-9">
                      <!-- <input type="email"  name="email_paypal" value="<?php echo $U_map['paypal'] ?>" class="form-control" placeholder="Favorite Artist">
                         <?php echo form_error('email_paypal'); ?> -->
                         <select class="form-control" name="favorite_artist" id="favorite_artist">
                                    <option value="">Artists</option>
                                    <?php 
                                    foreach ($list_artist as $key) {
                                        ($key['id'] == set_value(favorite_artist)) ? $select = 'selected' : $select = ''; ?><option <?=$select?> value="<?php echo $key['id'] ?>"><?php echo $key['artist_name']?></option><?php 
                                    }
                                    ?>
                            </select>  
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6"> 
                
                <div class="form-group">
                    <label for="Facebook" class="col-sm-3 control-label pagetext-color">Facebook URL: </label>
                    <div class="col-sm-9">
                      <input type="text"  name="facebook_url" value="<?php echo $user_data['facebook_username'] ?>" class="form-control" placeholder="Facebook Url">
                         
                    </div>
                </div>
                <div class="form-group">
                    <label for="Youtube" class="col-sm-3 control-label pagetext-color">Youtube URL: </label>
                    <div class="col-sm-9">
                      <input type="text"  name="youtube_url" value="<?php echo $user_data['youtube_username'] ?>" class="form-control" placeholder="Youtube Url">
                         
                    </div>
                </div>
                <div class="form-group">
                    <label for="Google" class="col-sm-3 control-label pagetext-color">Twitter URL: </label>
                    <div class="col-sm-9">
                      <input type="text"  name="twitter_url" value="<?php echo $user_data['twitter_username'] ?>" class="form-control" placeholder="Twitter Url">
                         
                    </div>
                </div>

                <div class="form-group">
                    <label for="Instagram" class="col-sm-3 control-label pagetext-color">Instagram URL: </label>
                    <div class="col-sm-9">
                      <input type="text"  name="instagram_url" value="<?php echo $user_data['instagram_username'] ?>" class="form-control" placeholder="Instagram Url">
                         
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Favorite Artist:</label>
                    <div class="col-sm-9">
                      <!-- <input type="email"  name="email_paypal" value="<?php echo $U_map['paypal'] ?>" class="form-control" placeholder="Favorite Artist">
                         <?php echo form_error('email_paypal'); ?> -->
                         <select class="form-control" name="favorite_artist" id="favorite_artist">
                                    <option value="">Artists</option>
                                    <?php 
                                    foreach ($list_artist as $key) {
                                        ($key['id'] == set_value(favorite_artist)) ? $select = 'selected' : $select = ''; ?><option <?=$select?> value="<?php echo $key['id'] ?>"><?php echo $key['artist_name']?></option><?php 
                                    }
                                    ?>
                            </select>  
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Your Favorite Place:</label>
                    <div class="col-sm-9">
                        <input type="input" name="fav_place" class="form-control " value="<?php echo $user_data['fav_place'] ?>" placeholder="Your Favorite Place">
                             <?php echo form_error('fav_place'); ?>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Your best friend name:</label>
                    <div class="col-sm-9">
                        <input type="input" name="best_friend_name" class="form-control input-sm" value="<?php echo $user_data['best_friend_name'] ?>" placeholder="Your best friend name">
                        <?php echo form_error('best_friend_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Occupation:</label>
                    <div class="col-sm-9">
                        <input type="input" name="occupation" class="form-control" value="<?php echo $user_data['occupation'] ?>" placeholder="Occupation">
                        <?php echo form_error('occupation'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label pagetext-color">Age range:</label>
                    <div class="col-sm-9">
                        <input type="input" name="age_range" class="form-control" value="<?php echo $user_data['age_range'] ?>" placeholder="Age range">
                        <?php echo form_error('age_range'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <input type="submit" value="Update" class="btn btn-info ">
                 
            </div>
                
            </form>        
        </div>
    </div>
</div>
