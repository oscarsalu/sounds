<div class="alert_gloabal">
    <?php if ($this->session->flashdata('message_msg')) {
    ?>
    <div class="alert alert-big alert-success alert-dismissable fade in">
        <h4><strong>Success!</strong></h4>
        <p> <?php echo $this->session->flashdata('message_msg')?></p>
    </div>
    <?php

}
    if ($this->session->flashdata('message_error')) {
        ?>
        <div class="alert alert-big alert-lightred alert-dismissable fade in">
            <h4><strong>Error!</strong></h4>
            <p> <?php echo $this->session->flashdata('message_error')?></p>
        </div>
        <?php

    }
    ?>
     
</div>

<div class="main_footer" style="position: relative;">
    <div class="ac-icon">
        <a class="click-ft" href="#" style="">
            <img class="chevron_up " src="<?php echo base_url(); ?>assets/icon/up-arrow.png" alt="Help" height="32" width="32">
            <img class="chevron_down hiden" src="<?php echo base_url(); ?>assets/icon/down-arrow.png" alt="Help" height="32" width="32">
        </a>
    </div>
    <footer class="footer wapper_footer" style="position: relative; z-index:5;">
        <div class="container top_footer">
            <div class="col-md-6 left_top_footer">
                &COPY;2016 By 99SOUND.COM INC. All Rights Reserved
            </div>
            <div class="col-md-6 right_top_footer">
                <a href="#" data-toggle="tooltip" data-placement="left" title="Linkedin" class="icon_social"><i class="fa fa-linkedin"></i></a>
                <a href="https://instagram.com/soundhousepromotions" data-toggle="tooltip" data-placement="left" title="Instagram" class="icon_social"><i class="fa fa-instagram"></i></a>
                <a href="https://www.youtube.com/channel/UCbx21T0l7_ttr26tZ9d2_Zw" data-toggle="tooltip" data-placement="left" title="Youtube" class="icon_social"><i class="fa fa-youtube"></i></a>
                <a href="https://plus.google.com/104993070863948605840" data-toggle="tooltip" data-placement="left" title="Google plus" class="icon_social"><i class="fa fa-google"></i></a>
                <a href="https://twitter.com/SoundHouseInc" data-toggle="tooltip" data-placement="left" title="Twitter" class="icon_social"><i class="fa fa-twitter"></i><!--<img src="<?php echo base_url() ?>assets/icon/tw.png" />--></a>
                <a href="https://www.facebook.com/99sounds" data-toggle="tooltip" data-placement="left" title="Facebook" class="icon_social"><i class="fa fa-facebook"></i><!--<img src="<?php echo base_url() ?>assets/icon/fb.png" />--></a>
                
            </div>
        </div>
        <div class="container" style="overflow: hidden;">
            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <h4 class="forstyle_header">Marketing</h4>
                    <ul class="list-unstyled list-footer">
                        <li><a href="<?=base_url('features/fan')?>" target="_blank">SoundHouse PR</a></li>
                        <li><a href="<?=base_url('features/artist')?>" target="_blank">Artist Email Campaign</a></li>
                        <li><a href="<?=base_url('features/fan')?>" target="_blank"> Connect With Fan (SM)</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <h4 class="forstyle_header">Tools</h4>
                    <ul class="list-unstyled list-footer">
                        <li><a href="<?=base_url('mds')?>">Sell Your Music</a></li>
                        <li><a href="<?=base_url('make_money')?>">Mobile App</a></li>
                        <li><a href="<?=base_url('gigs_events')?>">Gigs & Events</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <h4 class="forstyle_header">Support</h4>
                    <ul class="list-unstyled list-footer">
                        <li><a href="https://99sound.zendesk.com/hc/en-us/categories/202475728-Catalog">Frequently Asked Questions</a></li>
                        
                        <li><a href="<?=base_url('social_media')?>">Social Sync</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <h4 class="forstyle_header">Policies</h4>
                    <ul class="list-unstyled list-footer">
                        <li><a href="<?=base_url('footer/terms')?>">Terms & Conditions</a></li>
                        <li><a href="<?=base_url('footer/privacy-policy')?>">Pricacy Policy</a></li>
                        <li><a href="<?=base_url('footer/copyright')?>">Copyright</a></li>
                        <li><a href="<?=base_url('footer/refun')?>">Refund</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <h4 class="forstyle_header">99Sound.com</h4>
                    <ul class="list-unstyled list-footer">
                        <li><a href="<?=base_url('footer/our_team')?>">Our Team</a></li>
                        <li><a href="mailto:contact@admin.com?Subject=Contact" target="_top">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <h4 class="forstyle_header">Newsletter SignUp</h4>
                        <form role="form">
                          <div class="form-group input-group-sm">
                             <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                          </div>
                          <div class="form-group input-group-sm">
                             <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                          </div>
                          <button type="submit" class="btn btn-default btn-sm">Submit</button>
                        </form>
                </div>
                <div class="clearfix"></div>
                
            </div>
        </div>
        <div class="clearfix"></div>
    </footer>
</div>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Start of 99soundhelp Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(e){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("//assets.zendesk.com/embeddable_framework/main.js","99soundhelp.zendesk.com");
/*]]>*/</script>
<!-- End of 99soundhelp Zendesk Widget script -->
<!-- End of 99soundhelp Zendesk Widget script -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- Uses the built in easing capabilities added In jQuery 1.1 to offer multiple easing options -->
<!-- Mobile touch events for jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mobile.just-touch.js"></script>
<!-- mightySlider layers animation engine -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/tweenlite.js"></script>
<!-- Main slider JS script file -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mightyslider.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/backgroundVideo.js"></script>
<script src="<?php echo base_url()?>assets/js/chat/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/detail_pages/amp/footer.js"></script>
</body>
</html>