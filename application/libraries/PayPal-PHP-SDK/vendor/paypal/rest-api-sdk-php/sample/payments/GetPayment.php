<?php
// # GetPaymentSample
// This sample code demonstrate how you can
// retrieve a list of all Payment resources
// you've created using the Payments API.
// Note various query parameters that you can
// use to filter, and paginate through the
// payments list.
// API used: GET /v1/payments/payments

/** @var Payment $createdPayment */
require_once __DIR__ . '/../bootstrap.php';
use PayPal\Api\Payment;

$paymentId = $_GET['paymentId'];

// ### Retrieve payment
// Retrieve the payment object by calling the
// static `get` method
// on the Payment class by passing a valid
// Payment ID
// (See bootstrap.php for more on `ApiContext`)
try {
    $payment = Payment::get($paymentId, $apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 	ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
// ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);
return(json_decode($payment->toJSON(128)));
