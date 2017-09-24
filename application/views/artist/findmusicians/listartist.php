<link rel="stylesheet" type="text/css" href="<?php base_url() ?>assets/css/styletai.css" />   
    <div id="msearch">
        <div class="container">
            
            <div class="top-search">
                <div class="up">
                    <h1>Your Search Produced 500 Results</h1>
                </div>
                <div class="bel" style="color: #000;">
                    <form>
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                        <div class="row">
                            <div class="col-md-3">
                            <div class="form-group">
                                <label>I'm Looking For:</label>
                                <select class="form-control" >
                                    <option>Musicians</option>
                                    <option>Bands</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search Area:</label>
                                <input type="text" name="" value="" class="form-control" placeholder="ZIP code or Location" />
                            </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                               <div class="radio">
                                  <label><input type="radio" name="optradio">Location</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="optradio">Activity Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary">SEARCH</button> 
                        </div>
                        </div>
                        
                        
                            
                    </form>
                </div>
            </div><!-- end top-search -->
            
            <div class="result">
                <div class="row">
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="as">
                            <a href="http://localhost/__begin/gigs/mresult.php">
                            <img src="images/m5.jpg" class="img-responsive"/>
                            <div class  ="des text-center">
                                <h4>SINCLAIR</h4>
                                <h5>TORONTO</h5>
                            </div>
                            </a>
                            <div class="ge">
                                <span class="glyphicon glyphicon-music" style="text-align: center;"></span>Acoustic, Classic Rock, Other, Rock <br />
                                <span class="glyphicon glyphicon-map-marker" style="text-align: center;"></span>Silicon Valley, California,94594
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="as">
                            <a href="#">
                            <img src="images/m5.jpg" class="img-responsive"/>
                            <div class  ="des text-center">
                                <h4>SINCLAIR</h4>
                                <h5>TORONTO</h5>
                            </div>
                            </a>
                            <div class="ge">
                                <span class="glyphicon glyphicon-music" style="text-align: center;"></span>Acoustic, Classic Rock, Other, Rock <br />
                                <span class="glyphicon glyphicon-map-marker" style="text-align: center;"></span>Silicon Valley, California,94594
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="as">
                            <a href="#">
                            <img src="images/m5.jpg" class="img-responsive"/>
                            <div class  ="des text-center">
                                <h4>SINCLAIR</h4>
                                <h5>TORONTO</h5>
                            </div>
                            </a>
                            <div class="ge">
                                <span class="glyphicon glyphicon-music" style="text-align: center;"></span>Acoustic, Classic Rock, Other, Rock <br />
                                <span class="glyphicon glyphicon-map-marker" style="text-align: center;"></span>Silicon Valley, California,94594
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="as">
                            <a href="#">
                            <img src="images/m5.jpg" class="img-responsive"/>
                            <div class  ="des text-center">
                                <h4>SINCLAIR</h4>
                                <h5>TORONTO</h5>
                            </div>
                            </a>
                            <div class="ge">
                                <span class="glyphicon glyphicon-music" style="text-align: center;"></span>Acoustic, Classic Rock, Other, Rock <br />
                                <span class="glyphicon glyphicon-map-marker" style="text-align: center;"></span>Silicon Valley, California,94594
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagi text-center">
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li>
                                <a href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div><!--end result-->
            
        </div>