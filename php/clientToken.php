<?php
require_once './braintree/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('vz4w3hhw7r8q6d3p');
Braintree_Configuration::publicKey('vjgm6b2rk39s9bts');
Braintree_Configuration::privateKey('90bd5dbc9ae104d5ce064e680eb775ee');
echo($clientToken = Braintree_ClientToken::generate());
?>