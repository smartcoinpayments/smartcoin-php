<?php

echo "Running Smartcoin PHP test suite.\n";

$hasDependency = @include_once(dirname(__FILE__) . '/../vendor/simpletest/simpletest/autorun.php');

if(!$hasDependency){
	echo "Missing Dependency: SimpleTest wasn't loaded.";
  exit(1);
}

require_once(dirname(__FILE__) . '/../vendor/autoload.php');


require_once(dirname(__FILE__) . '/Smartcoin/SmartcoinTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ObjectTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/APIRequestTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/APIRequestErrorTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/TokenTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ChargeTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ErrorTest.php');
require_once(dirname(__FILE__) . '/Smartcoin/ShippingTest.php');
