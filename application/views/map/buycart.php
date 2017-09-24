<!DOCTYPE HTML>
<html >
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Order Summary</title>
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
        <link rel="icon" href="<?php echo base_url(); ?>assets/icon/57.png">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
            <h1 class="text-center"><strong >You're Ordering a Total of  Song(s). </strong></h1>
            <table class="table table-striped" width="100%" align="center" cellpadding="5">
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4" style="background: #CCC"><strong>Album Name: <?php echo $data_playlist['name']?></strong></td>
				</tr>
                
				<tr>
					<td width="15%">
						<div align="center"><strong>Song Number </strong></div>
					</td>
					<td width="40%">
						<div align="left"><strong>Song Name</strong></div>
					</td>
                    <td width="30%">
						<div align="left"><strong>Album Name</strong></div>
					</td>
					<td width="15%%">
						<div align="center"><strong>Price </strong></div>
					</td>
				</tr>
                <?php
                    $i = 1;$Total = 0;
                    foreach ($data_songs as $row) {
                        ?>
                        <tr >
        					<td align="center"><?php echo $i;
                        ++$i; ?></td>
        					<td><?php echo $row['song_name']?></td>
                            <td><?php echo $row['name']?></td>
        					<td align="center"><?php echo $row['price'].' '.$row['currency'] ?></td>
        				</tr>
                        <?php
                        $Total += $row['price'];
                    }
                ?>
			
				<tr bgcolor="#CCCCCC">
					<td colspan="3" align="right"><strong>Album Total:</strong></td>
					<td align="center"><strong>&#36; <?php echo $Total." ".$row['currency'] ?></strong></td>
				</tr>
				<tr bgcolor="#999999">
					<td colspan="3" align="right"><strong>Purchase Total:</strong></td>
					<td align="center"><strong>&#36;  <?php echo $Total." ".$row['currency']?></strong></td>
				</tr>
			</table>
			<br />
			<div id="paypalPayment" >
				<form method="post" action="<?php echo base_url()?>map/payment_paypal" style="width: 200px;margin: 0 auto;" >
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
					<img src="<?php echo base_url()?>assets/images/paypal.png" alt="paypal" width="199" height="74" /><br />
                    <?php foreach ($data_songs as $row) {
    ?>
                        <input type="hidden" name="id_song[]" value="<?php echo $row['id']?>" />
                        <?php

}
                    ?>
                  
                    <input type="hidden" name="affiliateid" value="<?=$affiliateid?>" />
                    
                    
					<br />
					<input class="btn btn-primary" name="submit" type="submit" style="width: 200px;" value="Click Here To Process Order" />
				</form>
			</div>
		</div>
	</body>
</html>