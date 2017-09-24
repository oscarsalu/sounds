<div class="container">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"><i class="fa fa-tasks"></i> Location</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                   <table class="table">
                        <tr>
                            <td><label> LOCATON: </label></td>
                            <td>
                                <select class="selectshowlocations">
                                        <?php foreach ($locations as $location) {
    ?>
                                        <option <?php if ($location_id == $location['location_id']) {
    echo 'selected="selected"';$location_name = $location['location'];
} ?> value="<?php echo $location['location_id'] ?>"><?php echo $location['location'] ?></option>
                                    
                                       <?php 
} ?>
                                </select>
                                
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="weatherEventSpan text-center"></div>
                                <br>
                                <div class="weatherEventCls"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12">
            <div class="x_panel tile  overflow_hidden">
                <div class="x_title">
                    <h2 class="tt text_caplock"> Venues Book</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content table-responsive">
                <?php 
                        if (isset($book_venues) && $book_venues !== "No Requests yet") 
                        {
                            ?>
                    <table class="table " id="list_book">
                        <tbody>
                            <tr>
                                <th>Email</th>
                                <th>Expected Draw</th>
                                <th>Message</th>
                                <th>Contact</th>
                                <th width="10%">Date From - DateTo </th>
                                <th >Action</th>
                            </tr>
                            <?php 
                                  foreach ($book_venues as $book) {
                                  ?>
                            <tr>
                                <td ><?php echo $book['email_from']; ?></td>
                                <td><?php echo $book['expected_draw']; ?></td>
                                <td><?php echo $book['message']; ?></td>
                                <td><?php echo $book['contact_info']; ?></td>
                                <td ><?php echo $book['date_from'].' + to + '.$book['date_to']; ?></td>
                                <td>
                                    <table class="table">
                                        <?php
                                       if ($book['confirmation'] != '1' && $book['confirmation'] != '2') {
                                           ?>
                                            <tr>
                                                <td>
                                                    <button class="btn btn-xs"  title="Accept" id="accept" ><i class="fa fa-check"></i>
                                                        <input type="hidden" class ="id_book" value="<?php echo $book['id']; ?>"/>
                                                        <input type="hidden" class ="id_books" value="1"/>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-xs" title="Unbearable" id="delete_unset"><i class="fa fa-times"></i>
                                                        <input type="hidden" class ="id_book_unset" value="<?php echo $book['id']; ?>"/>
                                                        <input type="hidden" class ="id_books_unset" value="2"/>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-xs" title="Delete" id="delete_booke"><i class="fa fa-trash-o"></i>
                                                        <input type="hidden" class ="id_book_delete" value="<?php echo $book['id']; ?>"/>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            if ($book['confirmation'] == '2') {
                                            ?>  
                                            <tr>
                                                <td>
                                                    <button class="btn btn-warning"  title="Unbearable"  disabled="disabled" ><i class="fa fa-ban"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" title="Delete" id="delete_booke"><i class="fa fa-trash-o"></i>
                                                        <input type="hidden" class ="id_book_delete" value="<?php echo $book['id']; ?>"/>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                                if ($book['confirmation'] == '1') {
                                            ?>
                                            <tr>
                                                <td>
                                                    <button class="btn btn-info"  title="Accept"><i class="fa fa-check"></i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" title="Delete" id="delete_booke"><i class="fa fa-trash-o"></i>
                                                        <input type="hidden" class ="id_book_delete" value="<?php echo $book['id']; ?>"/>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </td>
                                </tr>
                                       <?php 
                                      }
                                 
                                  
                                  ?>               
                          </tbody>
                    </table>
                    <?php
                     }
                    else{
                        ?>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center"><?php echo $book_venues;?></div>
                        </div>

                        
                        
                        <?php
                      }
                      ?>
                </div>
            </div>
        </div>
        <form action="<?php echo base_url()?>the_total_tour/bookashow_update" method="post" id="form_update_id">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" id ="update_id" name="update_id" />
            <input type="hidden" id ="tour_id" name="tour_id" value="<?php echo $tour_id; ?>" />
            <input type="hidden" id ="tour_id_status" name="tour_id_status"/>
        </form>  
        <form method="post" id="form_delete_id">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" id ="delete_id_book" name="delete_id_book" />
            <input type="hidden" id ="tour_id" name="tour_id" value="<?php echo $tour_id; ?>" />
        </form>  
    </div>
</div>

     
<script type="text/javascript">
        var tour_id = <?php echo $tour_id; ?>;
        var locations_id = $(".selectshowlocations option:selected").val();
        $('#list_book').on('click','#accept', function(){
            if(confirm("Are you sure you want to accept this venues books")){
                var id = $(this).find('.id_book').val();  
                var id_status = $(this).find('.id_books').val();              
                $('#update_id').val(id); 
                $('#tour_id_status').val(id_status); 
                // $('#form_update_id').submit();
                accept_booking();
            }
        });
        $('#list_book').on('click','#delete_unset', function(){
            if(confirm("Are you sure you want to unbearable this venues books")){
                var id = $(this).find('.id_book_unset').val();                
                $('#update_id').val(id); 
                var id_status = $(this).find('.id_books_unset').val();
                $('#tour_id_status').val(id_status); 
                // $('#form_update_id').submit();
                accept_booking();
            }
        });
        $('#list_book').on('click','#delete_booke', function(){
            if(confirm("Are you sure you want to delete this venues books")){
                var id = $(this).find('.id_book_delete').val();                
                $('#delete_id_book').val(id);
                delete_booking();
                // $('#form_delete_id').submit();
            }
        });

        function delete_booking()
        {
             var post_data = $("#form_delete_id").serialize();
             $.ajax({
                 url: $url + "the_total_tour/bookashow_delete",
                 type: 'POST',
                 data: post_data,
                 dataType: 'json',
                 success: function(data) {
                    get_book_show_tour_view(tour_id);
                 }
             });
        }

        function accept_booking()
        {
            var post_data = $("#form_update_id").serialize();
             $.ajax({
                 url: $url + "the_total_tour/bookashow_update",
                 type: 'POST',
                 data: post_data,
                 dataType: 'json',
                 success: function(data) {
                    console.log(data);
                    get_book_show_tour_view(tour_id);
                 }
             });
        }
        
</script>
