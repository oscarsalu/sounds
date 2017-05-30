<?php foreach($worldwide_artists as $worldwide_artist){ ?>
    <div class="col-md-3 col-sm-4 col-xs-6">
        <div class="item_list">
            <div class="view view-ninth">
                <img class="first-slide" src="<?php echo $this->M_user->get_avata($worldwide_artist["id"])  ?>" alt="<?php echo $worldwide_artist["artist_name"]; ?>" />
                
                <p><?php echo $worldwide_artist["genre_name"]; ?> Artist</p>
                <h2><a href="<?php echo  base_url() ?><?php echo $worldwide_artist["home_page"]; ?>"><?php echo $worldwide_artist["artist_name"]; ?></a></h2>
                <div class="mask mask-1"></div>
                <div class="mask mask-2"></div>
                <div class="content">
                    <div class="button-wrapper">
    					<a href="<?php echo  base_url() ?><?php echo $worldwide_artist["home_page"]; ?>" class="a-btn">
    						<span class="a-btn-text"><?php echo $worldwide_artist["artist_name"]; ?></span> 
    						<span class="a-btn-slide-text">View Detail</span>
    						<span class="a-btn-icon-right"><i class="fa fa-chain-broken" style="margin-top: 11px;"></i></span>
    					</a>
    				</div>
                    <?php echo $this->M_audio_song->get_shortcode_AMP($worldwide_artist["id"])?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>