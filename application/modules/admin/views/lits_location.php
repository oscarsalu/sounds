<div class="page-title">
    <span class="title">Manager Premium payment</span>
    <div class="description">
        <?php if($this->session->flashdata('message_success')){
        ?>
        <div class="col-sm-6 col-sm-offset-3 alert alert-success alert-dismissible" role="alert" id="del_suc" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <strong>Well done!</strong> <?php echo $this->session->flashdata('message_success')?>
        </div>
        <?php
        }elseif($this->session->flashdata('message_error')){
            ?>
            <div class="col-sm-6 col-sm-offset-3 alert alert-danger alert-dismissible" role="alert" id="lock_suc" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Error!</strong> <?php echo $this->session->flashdata('message_error')?>
            </div>
            <?php
        }?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title"><a class="btn btn-default" href="<?php echo base_url('admin/premium') ?>">Back List</a>
                        > <?php echo $worldwide_artists[0]['firstname'] . ' ' . $worldwide_artists[0]['lastname'];?>
                    </div>                    
                </div>
            </div>
            <div class="card-body">                
                <table class="table">
                    <tr>
                       <th>User</th>
                        <th>Pack</th>
                        <th>Start day</th>
                        <th>Expires day</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach($worldwide_artists as $worldwide_artist){?>
                        <tr <?php if($worldwide_artist['active'] == 0){echo 'style="color: red;"';}?> >
                            <td><a href="<?php echo base_url('admin/premium').'/'.$worldwide_artist['user_id']; ?>"><?php echo $worldwide_artist['firstname'] . ' '. $worldwide_artist['lastname'];?></a></td>
                            <td><?php if($worldwide_artist['pack'] == 1){echo $worldwide_artist['pack'].' Week';}else{echo $worldwide_artist['pack'].' Weeks';} ?></td>
                            <td><?php echo date("H:i:s m/d/Y",strtotime($worldwide_artist['start_day'])); ?></td>
                            <td><?php echo date("H:i:s m/d/Y",strtotime($worldwide_artist['end_day'])); ?></td>
                            <td><?php echo $worldwide_artist['money'] . ' $'; ?></td>
                            <td><?php if($worldwide_artist['active'] == 0){echo 'Expires';}else{echo 'Active';} ?></td>
                        </tr>
                    <?php
                        } ?>
                    
                </table>
            </div>
        </div>
    </div>
</div>
