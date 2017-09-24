<!-- Modal ChangeLayout -->
<div class="modal fade" id="chooseLayout" tabindex="-1" role="dialog" aria-labelledby="myModalbg" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalbg">Change Layout</h4>
                </div>            
                <div class="modal-body row">
                    <div class="form-group col-xs-12">
                        <span>Desired template change will be seen upon selecting View Profile as Fan</span>
                    </div>                                        
                    <?php
                    for ($i = 1;$i <= 6;++$i) {
                        ?>
                        <div class="type-landing col-md-4 col-sm-6">
                            <div class="frame-ld center" >
                                <div class="caption text-center">Template <?php echo $i?></div>
                                <a href="#" id="value_tpl">
                                    <input type="hidden" class="hidden-val" value="<?php echo $i?>" />
                                    <img  class="<?php if ($type_tpl == $i) {
    echo 'secelted';
} ?>" id="img-1" height="120" width="100" src="<?php echo base_url()?>assets/images/landing_page/template<?php echo $i; ?>.png"/>
                                </a>
                            </div> 
                            <div class="action">
                                <input type="hidden" class="hidden-img" value="<?php echo base_url()?>assets/images/landing_page/template<?php echo $i; ?>.png" />
                                <a href="#" class="btn btn-default btn-xs btn-preview" data-toggle="modal" data-target="#preview-tpl">PreView</a>
                            </div>                                 
                        </div>                        
                        <?php

                    }
                    ?>                                                                          
                </div>
                <div class="modal-footer">                    
                    <input type="hidden" id="change_tpl" name="template_landing"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="change_lay">Change</button>                       
                </div> 
                
            <script type="text/javascript"> 
                  var url = "<?php echo base_url(); ?>";                    
                 
            </script>   
            <script src="<?php base_url() ?>assets/js/detail_pages/musicians_bands.js"></script>                                         
        </div>
    </div>  
</div>
<div class="modal fade " id="preview-tpl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>            
        </div>
        <div class="modal-body">
            <img src="" id="prev" />
        </div>   
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>