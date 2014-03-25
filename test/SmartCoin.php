<?php

echo "Running SmartCoin PHP test suit.\n";

$has_dependency = @include_once(dirname(__FILE__) . '/../vendor/simpletest/simpletest/autorun.php');

if(!$has_dependency){
  echo "Missing Dependency: SimpleTest wasn't loaded.";
  exit(1);
}

require_once(dirname(__FILE__) . '/../lib/SmartCoin.php');


require_once(dirname(__FILE__) . '/SmartCoin/ObjectTest.php');
require_once(dirname(__FILE__) . '/SmartCoin/APIRequestTest.php');
require_once(dirname(__FILE__) . '/SmartCoin/APIRequestErrorTest.php');
require_once(dirname(__FILE__) . '/SmartCoin/TokenTest.php');
require_once(dirname(__FILE__) . '/SmartCoin/ChargeTest.php');
require_once(dirname(__FILE__) . '/SmartCoin/ErrorTest.php');

?>