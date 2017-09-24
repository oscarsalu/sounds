<center>
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="border-collapse:collapse;background-color:#f0f0f0;height:100%;width:100%;margin:0;padding:0">
		<tbody>
			<tr>
				<td align="center" valign="top" style="height:100%;width:100%;margin:0;padding:0">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
						<tbody>
							<tr>
								<td align="center" valign="top">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
										<tbody>
											<tr>
												<td height="20"><span style="font-size:9px;color:#f0f0f0">2016 99sound, Inc. All rights reserved</span></td>
											</tr>
											<tr>
												<td align="center" height="40"><a href="<?= base_url()?>" title="99Sound" target="_blank"><img src="<?= base_url('assets/logos/logo-07.png')?>" alt="99sound" height="50" width="116" border="0" style="border:0;border-style:none;text-decoration:none" class="CToWUd"></a></td>
											</tr>
											<tr>
												<td height="20"><span></span></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top" style="background-color:#fff">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;margin:0 auto;width:600px">
										<tbody>
											<tr>
												<td align="center" valign="top" style="color:#333;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:normal;line-height:170%;padding:30px;text-align:left">
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
														<tbody>
															<tr>
																<td align="center" style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
																	<h1 style="color:#333;display:block;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:25px;font-weight:bold;line-height:130%;margin:0 0 15px;padding:0">Featured / Premium Artists has Expires</h1>
																	<p style="line-height:170%;margin:15px 0;padding:0">This email has been sent as a request to Our Featured / Premium Artists has Expires.</p>
																</td>
															</tr>
															<tr>
																<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
																	<hr style="background-color:#fff;border:0;border-bottom:1px dashed #ccc;color:#fff;min-height:1px;margin:20px 0;padding:0">
															     </td>
                                                            </tr>
                                                            <tr>
																<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
																    <strong>Hello <?php echo $user['firstname'].' '.$user['lastname'] ?>,<br /></strong>
                                                                    <p>You had bought package Featured / Premium Artists in <?php if ($pack['pack'] == 1) {
    echo $pack['pack'].' week';
} else {
    echo $pack['pack'].'weeks';
}?> has expires </p>
                                                                    <p><?php echo 'Start date: '.date('H:i:s m/d/Y', strtotime($pack['start_day']));?></p>
                                                                    <p><?php echo 'Expires date: '.date('H:i:s m/d/Y', strtotime($pack['end_day']));?></p>
															     </td>
                                                            </tr>	
															<tr>
																<td align="center" style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif">
																	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
																		<tbody>
																			<tr>
																				<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;padding:20px 0;text-align:center">
																					<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;display:inline-block">
																						<tbody>
																							<tr>
																								<td style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;background-color:#ff4a00;padding:8px 20px;border-radius:3px">
                                                                                                <a href="<?=base_url('subscriptions/featured')?>" style="color:#fff;font-family:&quot;Open Sans&quot;,&quot;HelveticaNeue-Light&quot;,&quot;Helvetica Neue Light&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:300;line-height:180%;text-decoration:none" target="_blank">Go to extension package!</a></td>
																							</tr>
																						</tbody>
																					</table>
																				</td>
																			</tr>
																		</tbody>
																	</table>
																	<p style="line-height:170%;margin:15px 0;padding:0"><em>Thank you for using 99Sound!</em></p>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" valign="top" style="padding:20px 0">
									<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
										<tbody>
											<tr>
												<td align="center" valign="top" style="color:#999;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:13px;font-weight:normal;line-height:170%;padding:8px 0"><span style="color:#999;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:13px;font-weight:normal;line-height:170%">© 2016 99sound, Inc. All rights reserved.</span><br><a href="#1955122268_" style="font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:13px;font-weight:normal;line-height:100%;text-decoration:none;color:#999"><span style="color:#999;font-family:&quot;Open Sans&quot;,Helvetica,Arial,sans-serif;font-size:13px;font-weight:normal;line-height:170%">  Sunnyvale, CA</span></a></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</center>
