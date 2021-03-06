<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui.min.js"></script>
<style>
   
</style>
<link href="<?php echo base_url(); ?>assets/amp/css/settingwitdget.css" rel="stylesheet" />
<script>
    color_schemes = {
    "admin_new_style_black":{
        "scheme_name": "Style Black",
        "background_color": "rgba(31,30,30,0.35)",
        "color_time_loaded": "#000000",
        "color_track_front": "#000000",
        "color_font": "#FFFFFF",
        "affiliatetext": "To Become An Affiliate",
        "ordertext": "CLICK HERE TO ORDER"
    },
    "admin_classic_red":{
        "scheme_name": "Style Red",
        "background_color": "rgba(240,4,18,0.16)",
        "color_time_loaded": "#e32855",
        "color_track_front": "#ffffff",
        "color_font": "#FFFFFF",
        "affiliatetext": "To Become An Affiliate",
        "ordertext": "CLICK HERE TO ORDER"
    },
    "admin_classic_blue":{
        "scheme_name": "Style Blue",
        "background_color": "rgba(88,163,217,0.16)",
        "color_time_loaded": "#17c7ed",
        "color_track_front": "#006699",
        "color_font": "#FFFFFF",
        "affiliatetext": "To Become An Affiliate",
        "ordertext": "CLICK HERE TO ORDER"
    },
    "classic_red":{
        "scheme_name": "Style Classic Red",
        "background_color": "rgba(20,1,1,0.16)",
        "color_time_loaded": "#9E0000",
        "color_track_front": "#9E0000",
        "color_font": "#FFFFFF",
        "affiliatetext": "To Become An Affiliate",
        "ordertext": "CLICK HERE TO ORDER"
    },
    "classic_blue":{
        "scheme_name": "Style Classic Blue",
        "background_color": "rgba(20,1,1,0.16)",
        "color_time_loaded": "#006699",
        "color_track_front": "#006699",
        "color_font": "#FFFFFF",
        "affiliatetext": "To Become An Affiliate",
        "ordertext": "CLICK HERE TO ORDER"
    } 
};
<?php
if (!empty($U_map['option_widget'])) {
    ?>
    obj_data = <?= $U_map['option_widget']?>;
    color_schemes.custome = {
        "scheme_name":obj_data.scheme_name,
        "background_color":obj_data.background_color,
        "color_time_loaded":obj_data.color_time_loaded,
        "color_track_front":obj_data.color_track_front,
        "color_font":obj_data.color_font,
        "affiliatetext":obj_data.affiliatetext,
        "ordertext":obj_data.ordertext
    };
    json_albums_id = {
        "playlistUserId":obj_data.playlistUserId,
        "playlistAlbumIds":obj_data.playlistAlbumIds,
        "autostart":obj_data.autostart,
    };
    <?php

} else {
    ?>
    color_schemes.custome = color_schemes.admin_new_style_black;
    json_albums_id = {
        "playlistUserId":'',
        "playlistAlbumIds":'',
        "autostart":'',
    };
    <?php

}
?>
    $Map = jQuery.noConflict();
    $Map().ready(function() {

        //code to disable text area  code for player
        document.getElementById("playerCode").disabled = true;

        // $('body').attr('style','overflow-y:visible');
        //$('body').css('overflow-y','visible');
           

        set_scheme = eval($Map('#color_scheme').val()); // taking
        set_color_scheme(set_scheme);
        set_playlist(json_albums_id.playlistAlbumIds);
        //$Map('li#'+$Map('#result_albums').val()+' > input').attr('checked', true); // to check checkbox which is inside <li> with the ID equal to 
        $Map(function() {
            $Map("#option_albums ul").sortable({ 
                opacity: 0.8, 
                cursor: 'move',
                axis: 'y',
                forcePlaceholderSize: true,
                update: function(event, ui) {
                    change_albums();
                }
            });
        });
        
    });
    function copy_txt()
    {
        copyTextToClipboard( $Map('#playerCode').val());
        alert('html embed code has been successfully copied to your clipboard.');
    }
    function savestyle()
    {
        var autostart = false;
        if ($Map("#autoplay").is(':checked')) {
            autostart = true;
        }
        Json_option = {
            "scheme_name":          "Style Custome",
            "background_color":     $Map('#background_color').val(),
            "color_time_loaded":    $Map('#color_time_loaded').val(),
            "color_track_front":    $Map('#color_track_front').val(),
            "color_font":           $Map('#color_font').val(),
            "affiliatetext":        $Map('#affiliatetext').val(),
            "ordertext":            $Map('#ordertext').val(),
            "playlistAlbumIds":     $Map('#result_albums').val(),
            "autostart":            autostart,
        };
        color_schemes.custome = Json_option;
        console.log(Json_option);
        Post_option(Json_option);
        alert('Successfully save your change options.');
    }
    // START color scheme block
    function set_color_scheme(color_scheme)
    {
        $Map('#ordertext').val(color_scheme.ordertext);
        $Map('#affiliatetext').val(color_scheme.affiliatetext);
        $Map('#background_color').val(color_scheme.background_color);
        $Map('#color_time_loaded').val(color_scheme.color_time_loaded);
        $Map('#color_track_front').val(color_scheme.color_track_front);
        $Map('#color_font').val(color_scheme.color_font);
    }
    function set_playlist(selected){ 
        array = selected.split(',');
        $(".input_album").each(function (i) {
            if(inArray($(this).val(), array)) {
                $(this).prop('checked', true);
                $(this).attr('checked', true);
            }else{
                //console.log($(this).val());
                $(this).prop('checked', false);
                $(this).attr('checked', false);
            }
        });
        $Map("#result_albums").val(json_albums_id.playlistAlbumIds);
        finish_change();
    }
    function inArray(needle, haystack) {
        var length = haystack.length;
        for(var i = 0; i < length; i++) {
            if(haystack[i] == needle) return true;
        }
        return false;
    }
    function change_color_scheme(color_scheme)
    {
        color_scheme = eval(color_scheme);
        set_color_scheme(color_scheme);
        finish_change();
    }
    // END color scheme block
    // START album block
    function change_album()// for single album choice
    {
        $Map("#result_albums").val($Map("#play_list").val());
        
    }
    function change_albums() // for multiple albums choice
    {
        var selected=new Array();
        i = 0;
        $Map(".input_album:checked").each(function (i) {
            
                selected[i] = this.value;
                i++;
                
            
            
        });
        selected = selected.join(',');
        $Map("#result_albums").val(selected);
    }

    function finish_change()
    {
        var autostart = false;
        if ($Map("#autoplay").is(':checked')) {
            autostart = true;
        }
        var background_color = $Map('#background_color').val(),
            color_time_loaded = $Map('#color_time_loaded').val(),
            color_track_front = $Map('#color_track_front').val(),
            color_font = $Map('#color_font').val(),
            affiliatetext = $Map('#affiliatetext').val(),
            ordertext =  $Map('#ordertext').val(),
            playlistAlbumIds =  $Map('#result_albums').val(),
            playlistUserId = <?=$Id_artist?>;
            var affiliateId = '<?php echo $U_map['affiliate_id']?>';
            load_data_options(playlistAlbumIds,playlistUserId,affiliateId,background_color,color_track_front,color_font,color_time_loaded,ordertext,affiliatetext);
        
        // AMP_Load_data(affiliateId);
    }
    
    function Post_option(Json_option){
        $.post( "<?php echo base_url()?>amper/post_option_widget", { 
            data: Json_option,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            }).done(function( datatest ) {
        });
    };
    
    function copyTextToClipboard(text) {
      var textArea = document.createElement("textarea");
      textArea.style.position = 'fixed';
      textArea.style.top = 0;
      textArea.style.left = 0;
      textArea.style.width = '2em';
      textArea.style.height = '2em';
      textArea.style.padding = 0;
      textArea.style.border = 'none';
      textArea.style.outline = 'none';
      textArea.style.boxShadow = 'none';
      textArea.style.background = 'transparent';
      textArea.value = text;
      document.body.appendChild(textArea);
      textArea.select();
      try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Copying text command was ' + msg);
      } catch (err) {
        console.log('Oops, unable to copy');
      }
      document.body.removeChild(textArea);
    }
</script>



<link href="<?php echo base_url(); ?>assets/css/amper_style.css" rel="stylesheet" />
<div class="container-fluid">
    <section class=" full-width header_new_style" style="border: 1px solid #454545;margin-bottom: 10px; padding: 20px;overflow: hidden;">
    <?php if($user_data['role'] == '2') {
        ?>
        <h4 class="tt text_caplock">Music Player-Embed your Code</h4>
        <?php } else {?>
        <h4 class="tt text_caplock">Music Player Attributes & Embedding Code</h4>
        
        <?php }?>
        <span class="liner"></span>
        <div class="row col-md-12 col-sm-12">
            <div class="col-md-5">
                                 <h2>Select Player Options</h2>
                                <div class="form-group">
                                    <label >Select Style</label>
                                    <select name="color_scheme" class="form-control" name="style" id="color_scheme" onchange="change_color_scheme(this.value);">
                            			<option value="color_schemes.custome">Style Custom</option>
                                        <option value="color_schemes.admin_new_style_black">* Default Black</option>
                                        <option value="color_schemes.admin_classic_red">* Style Red</option>
                                        <option value="color_schemes.admin_classic_blue">* Style Blue</option>
                                        <option value="color_schemes.classic_red">Style Classic Red</option>
                                        <option value="color_schemes.classic_blue">Style Classic Blue</option>
                                    </select>
                                    
                                </div>
                                <table>
                                	<tbody>
                                        <tr>
                                            <td colspan="2">
                                                <div style="text-align: left">
                                                    <h4>Options Used Player </h4>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                    		<td width="50%" align="center">
                                        		<div align="center" id="color_picker" >			
                                        			<div>
                                        				<div style="float:left; text-align:left;"> Time Loaded Color:</div>
                                        				<div style="float:left;">
                                                            <div class="input-group colorpicker" id="timeloadedcolor">
                                                                <input id="color_time_loaded" type="text" name="color_time_loaded" value="" class="form-control" onchange="finish_change();"/>
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        <div style="clear:both;"></div>
                                        			</div>
                                        			<div>
                                        				<div style="float:left; text-align:left;">Current Track Color:</div>
                                        				<div style="float:left;">
                                                            <div class="input-group colorpicker">
                                                                <input id="color_track_front" type="text" name="color_track_front" value="" class="form-control" onchange="finish_change();"/>
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        </div>
                                        				<div style="clear:both;"></div>
                                        			</div>	
                                                    <div>
                                        				<div style="text-align:left;">Text Order:</div>
                                        				<div style="float:left;">
                                                             <div class="input-group">
                                                                <input type="text" class="form-control" id="ordertext" name="ordertext" value="" onchange="finish_change();">
                                                             </div>
                                                         </div>
                                                        
                                        				<div style="clear:both;"></div>
                                        			</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="50%" align="center">
                                                <div align="center" id="color_picker" >	
                                                    
                                                    <div>
                                        				<div style="float:left;  text-align:left;"><em>Background Color:*</em></div>
                                        				<div style="float:left;">
                                                            <div class="input-group colorpicker" id="backgroundcolorchange">
                                                                <input id="background_color" type="text" name="background_color" value="" class="form-control" onchange="finish_change();"/>
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        </div>
                                        				<div style="clear:both;"></div>
                                        			</div>
                                                    <div>
                                        				<div style="  text-align:left;">Font Color:</div>
                                        				<div style="float:left;">
                                                            <div class="input-group colorpicker">
                                                                <input id="color_font" type="text" name="color_font" value="" class="form-control" onchange="finish_change();"/>
                                                                <span class="input-group-addon"><i></i></span>
                                                            </div>
                                                        </div>
                                        				<div style="clear:both;"></div>
                                        			</div>
                                        			<div>
                                        				<div style="text-align:left;">Affiliate Text:</div>
                                                        <div style="float:left;">
                                                            <div class="input-group">
                                                                <input type="text"  class="form-control" id="affiliatetext" name="affiliatetext" value="" onchange="finish_change();">
                                                            </div>
                                                        </div>
                                        				<div style="clear:both;"></div>
                                        			</div>
                                        		</div>
                                        	</td>
                                        </tr>
                                	</tbody>
                                </table>
                                
                                <div class="select-palylist">
                                    <div id="singlePlayList" style="display: none;">
                            			<select name="play_list" id="play_list" onChange="change_album();">
                                            <?php 
                                            foreach ($Playlist as $row) {
                                                ?>
                                                <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                                <?php

                                            }
                                            ?>
                        				</select>
                            		</div>
                            		<div id="option_albums">
                            			<h4>Playlist Order:</h4> (Drag and Drop to change order)	
                            			<ul>
                                            <?php 
                                            foreach ($Playlist as $row) {
                                                ?>
                                                <li id="<?= $row['id']?>">
                                                    <input type="checkbox" class="input_album" value="<?= $row['id']?>" onClick="change_albums();"/>
                                                    <strong class="text-capitalize"><?= $row['name'] ?> </strong> 
                                                </li>
                                                <?php

                                            }
                                            ?>
                            			</ul>
                            		</div>
                            		<input type="hidden" name="result_albums" id="result_albums" value="">
                            		<div style="padding-top: 8px; text-align: center">
                                        <button class="btn btn-primary" onclick="savestyle()">Save-Custom Style</button>
                                        <button class="btn btn-success" onclick="finish_change()">Refresh Player with Playlist Changes</button>
                            		</div>
                                </div>
                            </div>

                            <!-- start of media player -->
            <div class="col-md-7">
                <script>var base_url="<?php echo base_url();?>";</script>
                <div align="center" style=" height: 400px;" class="wcustomhtml" >
                    <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">	</div>
                </div>
                <!-- Nav tabs -->
                <div align="center" style="margin-top: 90px;">
                    <button class="button_new js-copy-bob-btn"  onclick="copy_txt();"><span class="tt text_caplock">Copy code to clipboard </span></button>
                    <!--<ul class="nav nav-tabs" role="tablist">
                      <li class="active"><a href="#html" role="tab" data-toggle="tab">Iframe</a></li>
                    </ul>-->
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane active" id="home">
                        <textarea name="playerCode" class="text_bio" id="playerCode" cols="90%" rows="7"><?=htmlentities('<iframe id="iframe_amp" src="'.base_url().'amp/embed/'.$U_map['affiliate_id'].'" frameborder="0" scrolling="no" width="100%" height="500px"></iframe>')?></textarea>
                      </div>
                    </div>    
                </div>
            </div>
        </div>
        <!-- END SLIDER -->
    </section>
</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/map/js/bootstrap-colorpicker.min.js"></script>
    <script>
        "use strict";
             
        $(function() {

          // Code for docs demos
          function createColorpickers() {
            
            $(function(){
                $('.colorpicker').colorpicker();
                
            });

            // code for increase saturationn
            $(function(){
                $('#timeloadedcolor').colorpicker().on('showPicker', function(e) {
                     e.color.setSaturation(0.8);

                    });
            });
            $(function(){
                $('#backgroundcolorchange').colorpicker().on('showPicker', function(e) {
                    e.color.setSaturation(0.7);

                    });
            });
            
          }
          createColorpickers();
        });
        $('.colorpicker').on('hidePicker', function(event){
            setTimeout(function(){
                finish_change();
            }, 0);
        });

    </script>
