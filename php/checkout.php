<?php

require_once './braintree/lib/Braintree.php';
include '../admin/php/database.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('vz4w3hhw7r8q6d3p');
Braintree_Configuration::publicKey('vjgm6b2rk39s9bts');
Braintree_Configuration::privateKey('90bd5dbc9ae104d5ce064e680eb775ee');

$result = Braintree_Transaction::sale([
    "amount" => "10.00",
    "paymentMethodNonce" => 'fake-valid-nonce',
    'options' => [
        'submitForSettlement' => True
    ]
]);
$ticketCount = $_POST["ticketCount"];
$shoeSize = $_POST["shoeSize"];
$id = $_POST["raffleId"];
$fname = "Simon";
$lname = "Dorvil";
$email="test@paypal.com";
//var_dump($result->transaction->customer->email);
if ($result->success) {
  //print_r("Success ID: " . $result->transaction->id);
  for($i=0;$i<$ticketCount;$i++){
      $db = new database();
      $ct=$db->enterTicket($id,$shoeSize,$fname,$lname,$email);
      echo true;
  }
} else {
    echo false;
  //print_r("Error Message: " . $result->message);
}
?>