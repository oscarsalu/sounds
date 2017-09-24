<?php

use Aws\S3\S3Client;
use Aws\CloudFront\CloudFrontClient;
require FCPATH.'vendor/autoload.php';
$config = require(FCPATH.'vendor/aws/aws-sdk-php/src/Aws/app/config.php');
$s3 = S3Client::factory(array(
    'key' => $config['s3']['key'],
    'secret' => $config['s3']['secret'],));
$cloudfront = CloudFrontClient::factory(
    array(
        'private_key'   =>  'pk-APKAI2F5WQXQE6QZNLRQ',
        'key_pair_id'   =>  'APKAI2F5WQXQE6QZNLRQ',
    )
);
    
?>