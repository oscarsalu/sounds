<!--#55688A--->
<div class="col-md-12 remove_padding" style="min-height: 600px;">
            <div class="col-md-4 right_padding  ttt_pack" id="rm_pd">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">Location</h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                        <hr/>
                        <div class="form-group">                        
                            <label class="form-input col-md-3">LOCATON: </label>
                            <div class="input-group col-md-8">
                                <select class="selectlocations">
                                        <?php foreach ($locations as $location) {
    ?>
                                        <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';
} ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                    
                                       <?php 
} ?>
                                </select>
                                <hr/>
                            </div>
                            
                        </div>
                        <hr/>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-8 left_padding  ttt_pack">
                <div class="row col-md-12 header_new_style">
                    <h2 class="tt text_caplock">Venues Book </h2>
                    <span class="liner_landing"></span>
                    <div class="col-md-12 remove_padding">
                    <div class="table-responsive">
                        <table class="table" id="list_book">
                            <tbody>
                                 <tr>
                                    <th>Email</th>
                                    <th>Expected Draw</th>
                                    <th>Message</th>
                                    <th>Contact</th>
                                    <th>Date From - DateTo </th>
                                    <th >Action</th>
                                </tr>
                                  <?php 
                                  if (isset($book_venues)) {
                                      foreach ($book_venues as $book) {
                                          ?>
                                          <tr>
                                           <td style="width: 190px;"><?php echo $book['email_from']; ?></td>
                                           <td><?php echo $book['expected_draw']; ?></td>
                                           <td><?php echo $book['message']; ?></td>
                                           <td><?php echo $book['contact_info']; ?></td>
                                           <td style="width: 177px;"><?php echo $book['date_from'].' + to + '.$book['date_to']; ?></td>
                                           <td style="width: 140px;">
                                             <?php
                                               if ($book['confirmation'] != '1' && $book['confirmation'] != '2') {
                                                   ?>
                                                <button class="btn btn-default"  title="Accept" id="accept" >
                                                   <i class="fa fa-check"></i>
                                                   <input type="hidden" class ="id_book" value="<?php echo $book['id']; ?>"/>
                                                   <input type="hidden" class ="id_books" value="1"/>
                                               </button>
                                               <button class="btn btn-primary" title="Unbearable" id="delete_unset">
                                                  <i class="fa fa-times"></i>
                                                  <input type="hidden" class ="id_book_unset" value="<?php echo $book['id']; ?>"/>
                                                  <input type="hidden" class ="id_books_unset" value="2"/>
                                               </button>
                                               <button class="btn btn-danger" title="Delete" id="delete_booke">
                                                      <i class="fa fa-trash-o"></i>
                                                      <input type="hidden" class ="id_book_delete" value="<?php echo $book['id']; ?>"/>
                                                </button>
                                             <?php 
                                               }
                                          if ($book['confirmation'] == '2') {
                                              ?>
                                                    <button class="btn btn-warning"  title="Unbearable"  disabled="disabled" >
                                                     <i class="fa fa-ban"></i>
                                                    </button>
                                                    <button class="btn btn-danger" title="Delete" id="delete_booke">
                                                      <i class="fa fa-trash-o"></i>
                                                      <input type="hidden" class ="id_book_delete" value="<?php echo $book['id']; ?>"/>
                                                    </button>
                                              <?php 
                                          }
                                          if ($book['confirmation'] == '1') {
                                              ?>
                                                    <button class="btn btn-info"  title="Accept">
                                                      <i class="fa fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-danger" title="Delete" id="delete_booke">
                                                      <i class="fa fa-trash-o"></i>
                                                      <input type="hidden" class ="id_book_delete" value="<?php echo $book['id']; ?>"/>
                                                    </button>
                                              <?php 
                                          } ?>
                                              
                                           </td>
                                           </tr>
                                       <?php 
                                      }
                                  }
                                  ?>               
                          </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<form action="<?php echo base_url()?>the_total_tour/bookashow_update" method="post" id="form_update_id">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" id ="update_id" name="update_id" />
                <input type="hidden" id ="tour_id" name="tour_id" value="<?php echo $tour_id; ?>" />
                <input type="hidden" id ="tour_id_status" name="tour_id_status"/>
</form>  
<form action="<?php echo base_url()?>the_total_tour/bookashow_delete" method="post" id="form_delete_id">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" id ="delete_id_book" name="delete_id_book" />
                <input type="hidden" id ="tour_id" name="tour_id" value="<?php echo $tour_id; ?>" />
</form>       
<script type="text/javascript">
        $(".selectlocations").change(function(){
            location_id = $(this).val();
            <?php
            if ($this->uri->segment(5)) {
                ?>
                location.href = "<?php echo base_url('the_total_tour/bookashow/').'/'.$tour_id.'/'; ?>"+location_id+'/'+<?php echo $this->uri->segment(5); ?>;
            <?php 
            } else {
                ?>
                location.href = "<?php echo base_url('the_total_tour/bookashow/').'/'.$tour_id.'/'; ?>"+location_id;
            <?php 
            }
            ?> 
         });
       
        $('#list_book').on('click','#accept', function(){
            if(confirm("Are you sure you want to accept this venues books")){
                var id = $(this).find('.id_book').val();  
                var id_status = $(this).find('.id_books').val();              
                $('#update_id').val(id); 
                $('#tour_id_status').val(id_status); 
                $('#form_update_id').submit();
            }
        });
        $('#list_book').on('click','#delete_unset', function(){
            if(confirm("Are you sure you want to unbearable this venues books")){
                var id = $(this).find('.id_book_unset').val();                
                $('#update_id').val(id); 
                var id_status = $(this).find('.id_books_unset').val();
                $('#tour_id_status').val(id_status); 
                $('#form_update_id').submit();
            }
        });
        $('#list_book').on('click','#delete_booke', function(){
            if(confirm("Are you sure you want to delete this venues books")){
                var id = $(this).find('.id_book_delete').val();                
                $('#delete_id_book').val(id);
                $('#form_delete_id').submit();
            }
        });
</script>
