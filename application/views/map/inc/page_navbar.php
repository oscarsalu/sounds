<div class="navbar-wrapper">
    <div class="container">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span style="background-color: #fff;" class="icon-bar"></span>
                    <span style="background-color: #fff;" class="icon-bar"></span>
                    <span style="background-color: #fff;" class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url()?>assets/logos/logo-07.png" height="35px" alt=""></a>
                    
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#" class="">Home</a></li>
                        <?php
                        if (!empty($U_map)) {
                            ?>
                            <li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url('map/settingwitdget')?>">Setting Enbed Code</a></li>
                                    <li><a href="#">Add New</a></li>
                                </ul>
                            </li>
                            <?php
                            if ($U_map['level'] <= 3) {
                                ?>
                                <li class=" dropdown"><a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Affiliates <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('map/manager_affiliates')?>">Manager Affiliates</a></li>
                                    </ul>
                                </li>
                                <?php

                            } ?>
                            <?php

                        }?>
                        <li class=" down"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stats <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Change Time Entry</a></li>
                                <li><a href="#">Report</a></li>
                            </ul>
                        </li>  
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <?php
                        if (!empty($U_map)) {
                            ?>
                            <li class=" dropdown"><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $U_map['first_name']?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Change Password</a></li>
                                    <li><a href="<?php echo base_url('map/profile')?>">My Profile</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="<?php echo base_url('map/logout')?>">Logout</a></li>
                            <?php

                        } else {
                            ?>
                            <li class=""><a href="<?php echo base_url('map/login')?>">Login</a></li>
                            <?php

                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
	