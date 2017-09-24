
<div style="background-color: #fff;min-height: 100vh;">
    <div class="container-fluid fix-amp">
    <?php
      include('inc_side_menu/menu_artist.php')
    ?>
    <div class="side-body">
        <h2>Comment Manager</h2>
        <hr />
        <div class="breadcrumb flat" style="    width: 100%">
        	<a href="<?php echo base_url()?>artist/profile">Profile</a>
        	<a class="active" href="#">Comments Manager</a>
        </div>
        <section class="tile" style="padding: 0px;">
        <!-- tile header -->
        <div class="tile-header dvd dvd-btm">
            <h3 class="custom-font"><strong>Editable</strong> Comments</h3>
        </div>
        <!-- /tile header -->
        <!-- tile body -->
        <div class="tile-body">
            <div class="table-responsive" id="member_item">
                <table class="table table-custom" id="editable-usage">
                    <thead>
                    <tr>
                        <td>Avatar</td>
                        <th class="col-md-2">User Name</th>
                        <th >Comment</th>
                        <th class="no-sort">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) {
    if (!empty($comments)) {
        if (empty($comment['comment_id'])) {
            ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <img width="35" height="35" class="img-responsive" src="<?php echo $this->M_user->get_avata($comment['user_id']) ?>" />
                                        </td>
                                        <td>
                                            <span style="font-size: 20px;">
                                                <a href="<?php echo $this->M_user->get_homepage($comment['user_id']) ?>"><?php echo $this->M_user->get_name($comment['user_id']) ?></a>
                                            </span>
                                        </td>
                                        <td>
                                            <span><?php echo $comment['comment']; ?></span>
                                        </td>
                                        <td class="actions">
                                            <a href="<?php echo base_url().'artist/delete-comment/'.$comment['id']; ?>" class="delete text-danger text-uppercase text-strong text-sm btn-del">Remove</a>
                                        </td>
                                    </tr>
                                    <?php

        } else {
            $cm = $this->db->select('*,comments.id')
                                        ->from('comments')
                                        ->where('comments.comment_id', $comment['comment_id'])
                                        ->get()->result_array(); ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <img width="35" height="35" style="min-height: 100px;" src="<?php echo $this->M_user->get_avata($cm[0]['user_id']) ?>" />
                                        </td>
                                        <td>
                                            <span style="font-size: 20px;">
                                                <a href="<?php echo$this->M_user->get_homepage($cm[0]['user_id']) ?>"><?php echo $this->M_user->get_name($cm[0]['user_id']) ?></a>
                                            </span>
                                        </td>
                                        <td>
                                            <span><?php echo $cm[0]['comment']; ?></span>
                                        </td>
                                        <td class="actions">
                                            <a href="<?php echo base_url().'artist/delete-comment/'.$cm[0]['id']; ?>" class="delete text-danger text-uppercase text-strong text-sm btn-del">Remove</a>
                                        </td>
                                    </tr>
                                <?php 
        }
    }
}?>
                    </tbody>
                </table>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
        <!-- /tile body -->
    </section>
    </div>
    </div>
</div>