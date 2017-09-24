<?php
foreach ($artists as $row) {
    ?>
    <div class="col-xs-4 col-sm-3 col-md-2 event2 newstyle_event" style="z-index:1;">
        <input class="song" type="hidden" value="https://d1oc632jh12ao7.cloudfront.net/uploads/<?=$row['id']?>/audio/<?=$row['filename']?>"/>
    	<a class="item" data-gal="photo" href="<?=base_url($this->M_user->get_home_page($row['id']))?>" title="<?=$this->M_user->get_name($row['id'])?>" rel="bookmark">
    		<figure class="effect-bubba"><img width="100%" src="<?=$this->M_user->get_avata($row['id'])?>" class="attachment-type_cover wp-post-image" alt="<?=$this->M_user->get_name($row['id'])?>">
    			<figcaption>
    				<h2><?=$this->M_user->get_name($row['id'])?></h2>
    				<p><?=$this->M_user->get_genre_name($row['genre'])?>, US</p>
    			</figcaption>
    		</figure>
    	</a>
    </div>
    <?php

}
?>