<?php

// # Create Bulk Payout Sample
//
// This sample code demonstrate how you can create a synchronous payout sample, as documented here at:
// https://developer.paypal.com/docs/integration/direct/create-batch-payout/
// API used: /v1/payments/payouts

require_once __DIR__ . '/../bootstrap.php';

// Create a new instance of Payout object
$payouts = new \PayPal\Api\Payout();

$senderBatchHeader = new \PayPal\Api\PayoutSenderBatchHeader();
// ### NOTE:
// You can prevent duplicate batches from being processed. If you specify a `sender_batch_id` that was used in the last 30 days, the batch will not be processed. For items, you can specify a `sender_item_id`. If the value for the `sender_item_id` is a duplicate of a payout item that was processed in the last 30 days, the item will not be processed.
$clientId = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS';
$clientSecret = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $clientId,
        $clientSecret
    )
);

// Comment this line out and uncomment the PP_CONFIG_PATH
// 'define' block if you want to use static file
// based configuration

$apiContext->setConfig(
    array(
        'mode' => 'sandbox',
        'log.LogEnabled' => true,
        'log.FileName' => '../PayPal.log',
        'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
        'cache.enabled' => true,
        // 'http.CURLOPT_CONNECTTIMEOUT' => 30
        // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
    )
);
// #### Batch Header Instance
$senderBatchHeader->setSenderBatchId(uniqid())
    ->setEmailSubject("You have a payment");

// #### Sender Item
// Please note that if you are using single payout with sync mode, you can only pass one Item in the request
$ARR_sender = array();
foreach($G_Items->items as $row){
    $senderItem = new \PayPal\Api\PayoutItem();
    $senderItem->setRecipientType('Email')
        ->setNote('Payment for recent Music : '.$row->name)
        ->setReceiver('lynhmob@gmail.com')
        ->setSenderItemId($row->sku)
        ->setAmount(new \PayPal\Api\Currency('{
            "value":"'.$row->price.'",
            "currency":"USD"
        }'));
    $ARR_sender[] = $senderItem;
}
$payouts->setSenderBatchHeader($senderBatchHeader);
foreach($ARR_sender as $sender){
    $payouts->addItem($sender);
}
// For Sample Purposes Only.
$request = clone $payouts;

// ### Create Payout

try {
    $output = $payouts->create(null, $apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 	ResultPrinter::printError("Created Batch Payout", "Payout", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
/// ResultPrinter::printResult("Created Batch Payout", "Payout", $output->getBatchHeader()->getPayoutBatchId(), $request, $output);
//die;
return $output;
