<script type="text/javascript" src="<?php echo base_url()?>assets/js/detail_pages/artists/managerpress.js"></script>
<div  style=" min-height: 100vh;" >
<div class="container-fluid fix-amp">
    <?php
      include('inc_side_menu/menu_artist.php')
    ?>
    <div class="side-body">
        <h2>Press Manager </h2>
        <hr />
        <div class="breadcrumb flat" style="    width: 100%">
        	<a href="<?php echo base_url()?>artist/profile">Profile</a>
        	<a class="active" href="#">Press Manager</a>
        </div>
        <section class="tile" style="padding: 0px;">

            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h3 class="custom-font"><strong>Edit Press Release</strong></h3>
                
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body">
                <a style="font-size: 1.2em;" href="#" class="link-effect link-effect-2" data-toggle="modal" data-target="#addpress"><span data-hover="Add New Press Release">Add New Press Release</span></a>
                
                <div class="table-responsive" id="press_item">
                    <table class="table table-custom" id="editable-usage">
                        <thead>
                        <tr>
                            <th style="width: 50%;">Quote</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Date On</th>
                            <th>Link</th>
                            <th class="no-sort">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        foreach ($listpress as $row) {
                            ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php echo $row['quote']?>
                                </td>
                                <td> <span class="text-capitalize"><?php echo $row['name']?></span></td>
                                <td> <span class="text-capitalize"><?php echo $row['author']?></span></td>
                                <td> <span class="text-capitalize"><?php echo $row['date_on']?></span></td> 
                                <td> <span class="text-capitalize"><?php echo $row['link']?></span></td>
                                
                                
                                <td class="actions">
                                    <a href="#" title="edit" data-toggle="modal" data-target="#editpress"  class="edit btn-edit text-primary text-uppercase text-strong text-sm mr-10 ">
                                        <input type="hidden" id ="id_" value="<?php echo $row['id']?>"/>
                                        <input type="hidden" id ="quote_" value="<?php echo $row['quote']?>"/>
                                        <input type="hidden" id ="name_" value="<?php echo $row['name']?>"/>
                                        <input type="hidden" id ="author_" value="<?php echo $row['author']?>"/>
                                        <input type="hidden" id ="date_on_" value="<?php echo $row['date_on']?>"/>
                                        <input type="hidden" id ="link_" value="<?php echo $row['link']?>"/>
                                        Edit
                                    </a>
                                    <a href="#" data-idpress="<?php echo $row['id']?>" class="delete text-danger text-uppercase text-strong text-sm btn-del">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php 
                        }
                        ?>
                        
                        </tbody>
                    </table>
                </div>
            </div>
            <?php echo $this->pagination->create_links(); ?>
        </section>  
	</div>
    </div>
</div>
<form id="form_delete" action="<?=base_url('artist/deletepress')?>" method="post">
<input type="hidden" name="id_press" id="delete_id" />
<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />

</form>

<!-- Modal press -->
<div class="modal fade" id="addpress" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/addnewpress'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Add Press Release</h4>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Quote*</label>
                        <div class="input-group col-md-8">
                            <textarea class="form-control" name="quote" rows="6" required ></textarea>
                             1000 characters remaining
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Publication Name*</label>
                        <div class="input-group col-md-8">
                            <input type="text"class="form-control" name="name" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Author</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="author" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Published On</label>
                        <div class="input-group col-md-8">
                            <input type="date" class="form-control" name="date_on" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Web Link (URL)</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="link" />
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>                  
            </form>           
        </div>
    </div>
</div>
<!-- Modal edit press -->
<div class="modal fade" id="editpress" tabindex="-1" role="dialog" aria-labelledby="myModalcomment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="<?php echo base_url().'artist/editpress'?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Add Press Release</h4>
                </div>            
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Quote*</label>
                        <div class="input-group col-md-8">
                            <input type="hidden" id="id" name="id" />
                            <textarea class="form-control" name="quote" id="quote"  rows="6" required ></textarea>
                             1000 characters remaining
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Publication Name*</label>
                        <div class="input-group col-md-8">
                            <input type="text"class="form-control" name="name" id="name" required />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Author</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="author" id="author" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Published On</label>
                        <div class="input-group col-md-8">
                            <input type="date" class="form-control" name="date_on" id="date_on" />
                        </div>
                    </div>
                    <div class="form-group">                        
                        <label class="form-input col-md-3">Web Link (URL)</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" name="link" id="link"/>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>                  
            </form>           
        </div>
    </div>
</div>