<div id="find-a-show">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="location-container">
                    <form class="form-horizontal text-left">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="form-group">
                            <label for="Location" class="col-sm-6 control-label" style="text-align: left;">Location :</label>
                            <div class="col-sm-4">
                                <label for="Location" class="control-label">CANADA</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Location" class="col-sm-4 control-label" style="text-align: left;">Radius :</label>
                            <div class="col-sm-8">
                                <div class="col-sm-4 rad"><input type="text" class="form-control" id="radius" value="25"></div>
                                <h5 class="col-sm-2">KM</h5>
                            </div>
                        </div>
                        
                            <button class="btn btn-primary">FIND A SHOW</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                
                <div class="map-container">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d54928.25530774263!2d-79.37151877244594!3d43.652104349203896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1460170743675" width="832" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                
                    </div>

                    <div class="qty">
                        <h1>3 PLACES</h1>
                    </div>


                    <div class="row">
                        <div class="col-xs-12 col-sm-10">  
                            <h3>MacLAREN PUB</h3>
                            <h4>123 ABC XYZ, LA, CA</h4>
                            <h4>Artist: Taylor Swift, Linkin Park, Maroon 5</h4>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button class="btn btn-primary">BOOKING</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-10">  
                            <h3>MacLAREN PUB</h3>
                            <h4>123 ABC XYZ, LA, CA</h4>
                            <h4>Artist: Taylor Swift, Linkin Park, Maroon 5</h4>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button class="btn btn-primary">BOOKING</button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-10">  
                            <h3>MacLAREN PUB</h3>
                            <h4>123 ABC XYZ, LA, CA</h4>
                            <h4>Artist: Taylor Swift, Linkin Park, Maroon 5</h4>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                            <button class="btn btn-primary">BOOKING</button>
                        </div>
                    </div>  
                        
                </div><!-- end map-container-->
            </div>      
        </div>
    </div>
</div>