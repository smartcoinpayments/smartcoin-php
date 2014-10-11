<?php

echo "Running Smartcoin PHP test suit.\n";

$has_dependency = @include_once(dirname(__FILE__) . '/../vendor/simpletest/simpletest/autorun.php');

if(!$has_dependency){
  echo "Missing Dependency: SimpleTest wasn't loaded.";
  exit(1);
}

require_once(dirname(__FILE__) . '/../lib/Smartcoin.php');


require_once(dirname(__FILE__) . '/Smartcoin/SmartcoinTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ObjectTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/APIRequestTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/APIRequestErrorTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/TokenTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ChargeTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ErrorTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ShippingTest.php');

?>
