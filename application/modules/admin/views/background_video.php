<link href="<?php echo base_url(); ?>assets/map/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<style>
    .colorpicker:before{
        display: none;
    }
</style>
<div class="page-title">
    <span class="title">Manager Background Video</span>
    <div class="description">     
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Change video backgrounds</div>                    
                </div>
            </div>
            <div class="card-body" style="padding: 25px 5px;">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">All video background</div>
                    <div class="panel-body">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="page_name" name="page_name" placeholder=""/>                                                                                     
                        </div>                                              
                            <button type="button" class="btn btn-primary" id="add_page" style="margin-top: 0px;">Add New Page</button>                        
                    </div>
                    <!-- Table -->
                    <table class="table">
                        <thead>
                            <tr style="font-size: 15px;">
                                <th>#</th>
                                <th>Page Name</th>
                                <th>Video 1</th>
                                <th>Video 2</th>
                                <th>Video 3</th>
                                <th>Video 4</th>
                                <th>Video 5</th>                                                                                                                        
                            </tr>
                        </thead>
                        <tbody id="load_data">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
<!-- Modal -->
<div class="modal fade" id="modalEditVideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Videos</h4>
            </div>
            <div class="modal-body" style="padding-left: 0px;padding-right: 0px;">  
                <div class="card-body no-padding">
                    <form class="form-horizontal" action="<?php echo base_url('admin/video/change-video'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="click_type">
                            <li role="presentation" class="active"><a href="#upload" id="info_" aria-controls="info" role="tab" data-toggle="tab">Upload Video</a></li>
                            <li role="presentation"><a href="#color" id="newpass_" aria-controls="newpass" role="tab" data-toggle="tab">Background Color</a></li>                            
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="upload">                                
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Upload Video</label>
                                    <div class="col-sm-8">                                                        
                                        <input type="file" class="form-control" id="background_video" name="" />                             
                                    </div>
                                </div> 
                            </div>
                            <div role="tabpanel" class="tab-pane" id="color">
                                <div class="form-group" id="color_picker">
                                    <label for="" class="col-sm-4 control-label">Background Color</label>
                                    <div class="input-group col-sm-7 colorpicker">
                                        <input id="background_color" type="text" name="background_color" value="rgba(247,14,42,0.74)" class="form-control"/>
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>    
                            </div>
                            <input type="hidden" id="idv" name="idv" value="" />
                            <input type="hidden" id="name_page" name="name_page" value="" />
                            <input type="hidden" id="video_name" name="video_name" value=""/>
                    </div>  
                </div>                                                                                                                                                                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save">Save changes</button>
                </div>   
            </form>         
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#add_page').click(function(){
         $page_name = $('#page_name').val(); 
         //alert($page_name);
         $url = "<?php echo base_url(); ?>";
         $.ajax({
            url: $url+"admin/video/add_page",
            type: "post",
            data: {
                "page_name":$page_name,
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
            },
            dataType: "text",               
            success:function(response){                     
                 load_data();                                                                                    
            }
        });    
    });
    
    load_data();    
    function load_data()
    {        
        $url = "<?php echo base_url(); ?>";
        $.ajax({
            url: $url+"admin/video/loaddata",
            type: "get",
            data: "",
            dataType: "text",               
            success:function(response){    
                $('#load_data').html(response);                                                                                  
            }
        });   
    }
    
    $('#load_data').on('click','.edit_video',function(){        
        $id = $(this).find('#id_video').val();           
        $page_ = $(this).find('#name_p').val();   
        $name_video = $(this).find('#name_video').val();                
                            
        $('#background_video').attr('name',$name_video);
        $('#video_name').val($name_video);                 
        $('#idv').val($id);
        $('#name_page').val($page_);                
    });      
    
    $('.save').click(function(){
        if($('#background_video').val() != ""){
            return true;
        }else{                  
            var matches = $('#background_video_url').val().match(/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/);
            if (matches) {                
                return true;
            } else {
                $('#er').show();
                return false;
            }
        }
        
    });
    $('#er').hide();
</script>        
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-2.0.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/map/js/bootstrap-colorpicker.min.js"></script>
<script>
    $(function(){
        $('.colorpicker').colorpicker();
    });    
</script>  