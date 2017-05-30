<style>
.ctn-edit-blogs{
    float: left;
}
.ctn-edit-blogs:hover{
    cursor: pointer;
}
.ctn-edit-blogs div{
    display: none;
}
.delete{
    margin-left: 5px;
    float:left;
}
.ver{
    vertical-align: middle!important;
}
</style>
<ol class="breadcrumb">
  <li><a href="<?=base_url('admin/manager_chat')?>">Manager Chat Channel</a></li>
  <li class="active">Read Details Message Spam</li>
</ol>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Read Details Message Spam </div> .
                    <h4>Channel <?=$message_current->channel?></h4>                   
                </div>
            </div>
            <div class="card-body" >
                <style>
                    .list-unstyled{
                        max-height: 500px;
                        overflow-y: auto;
                    }
                    .list-unstyled li{
                        padding: 5px;
                    }
                    .list-unstyled li.active{
                        background: rgba(255, 0, 0, 0.25);
                    }
                </style>
                <ul class="list-unstyled" id="inbox">
                    <?php
                    $i=1;
                    foreach($message_before as $message){
                        if($i==1){
                            ?>
                            <li class="text-center" id="more_before" ><a id="load_ajax_more_before" data-id="<?=$message->id?>" href="#">Load More...</a></li>
                            <?php
                        }$i++;
                        ?>
                        <li>
                            <div class="media">
                                <div class="media-left thumb thumb-sm">
                                    <img class="media-object img-circle" width="50px" src="<?=$this->M_user->get_avata($message->user_id)?>"/>
                                </div>
    
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="text-strong"><?=$this->M_user->get_name($message->user_id)?></span>
                                        <small class="text-muted pull-right"><?=date('h:i:s d.m.Y',$message->time)?></small>
                                    </p>
                                    <small class="text-muted message"><?=$message->messages?></small>
                                </div>
    
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="active">
                        <div class="media">
                            <div class="media-left thumb thumb-sm">
                                <img class="media-object img-circle" width="50px" src="<?=$this->M_user->get_avata($message_current->user_id)?>"/>
                            </div>

                            <div class="media-body">
                                <p class="media-heading">
                                    <span class="text-strong"><?=$this->M_user->get_name($message_current->user_id)?></span>
                                    <small class="text-muted pull-right"><?=date('h:i:s d.m.Y',$message_current->time)?></small>
                                </p>
                                <small class="text-muted message"><?=$message_current->messages?></small>
                            </div>

                        </div>
                    </li>
                    <?php
                    foreach($message_last as $message){
                        ?>
                        <li>
                            <div class="media">
                                <div class="media-left thumb thumb-sm">
                                    <img class="media-object img-circle" width="50px" src="<?=$this->M_user->get_avata($message->user_id)?>"/>
                                </div>
    
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="text-strong"><?=$this->M_user->get_name($message->user_id)?></span>
                                        <small class="text-muted pull-right"><?=date('h:i:s d.m.Y',$message->time)?></small>
                                    </p>
                                    <small class="text-muted message"><?=$message->messages?></small>
                                </div>
    
                            </div>
                        </li>
                        <?php
                        if(end($message_last)==$message){
                            ?>
                            <li class="text-center" id="more_last"><a  id="load_ajax_more_last" data-id="<?=$message->id?>" href="#">Load More...</a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>  
                <a class="btn btn-primary" href="<?=base_url('admin/manager_chat')?>">Back To Manager Chat</a> 
            </div>
        </div>            
    </div>
</div>

<!-- Modal take down -->
<div class="modal fade " id="modaltake_down" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Notifications Delete Message For User</h4>                
            </div>
            <form action="<?=base_url('admin/manager_chat/delete_mesage')?>" method="post">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input type="hidden" name="id_chat" id="id_chat_mesage" />
                <div class="modal-body">
                    <div class="form-group">                        
                        <label class="form-input">Message Notifications</label>
                        <div class="input-group" style="width: 100%;">                                                        
                            <textarea class="form-control"  id="intro" name="message" rows="3" required="">Your message in Chat Channel had negative content! if also recidivism more thrice We will ban your account.
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>       
                    <button type="submit" class="btn btn btn-primary update_" name="type_submit" value="update">Delete Mesage</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$('.btn-blocked').click(function(){ 
    $("#id_chat_mesage").val($(this).attr('data-blog'));
 });

 $('.btn-accept').click(function(e){ 
    if(!confirm("Are you sure you want to accept this message chat?")){
        e.preventDefault(); 
    }
 });
 $('#load_ajax_more_last').click(function(e){ 
    e.preventDefault(); 
    $id = $(this).attr('data-id');
    $url = "<?php echo base_url();?>";
     $.ajax({             
        url: $url+"admin/manager_chat/load_message_last",
        type: "post",
        data: { 
            "id_chat":$id,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",               
        success:function(response){
            $.each(response , function (index, value){
              $("#more_last").before(print(value)); 
              $('#load_ajax_more_last').attr('data-id',value.id);
            });                                                                                                  
        }
    }); 
 });
 $('#load_ajax_more_before').click(function(e){ 
    e.preventDefault(); 
    $id = $(this).attr('data-id');
    $url = "<?php echo base_url();?>";
     $.ajax({             
        url: $url+"admin/manager_chat/load_message_before",
        type: "post",
        data: { 
            "id_chat":$id,
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "json",               
        success:function(response){
            $.each(response , function (index, value){
                $("#more_before").after(print(value)); 
                $('#load_ajax_more_before').attr('data-id',value.id);
            });                                                                                                 
        }
    }); 
 });
 function print(data){
    var res = '<li>'+
            '<div class="media">'+
                '<div class="media-left thumb thumb-sm">'+
                    '<img class="media-object img-circle" width="50px" src="'+data.avata+'"/>'+
                '</div>'+

                '<div class="media-body">'+
                    '<p class="media-heading">'+
                        '<span class="text-strong">'+data.name+'</span>'+
                        '<small class="text-muted pull-right">'+data.date+'</small>'+
                    '</p>'+
                    '<small class="text-muted message">'+data.messages+'</small>'+
                '</div>'+
            '</div>'+
        '</li>';
    return res;
 }
    
</script>
