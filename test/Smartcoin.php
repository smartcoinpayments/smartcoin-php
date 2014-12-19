<?php

echo "Running Smartcoin PHP test suite.\n";

$hasDependency = @include_once(__DIR__ . '/../vendor/simpletest/simpletest/autorun.php');

if(!$hasDependency){
	echo "Missing Dependency: SimpleTest wasn't loaded.";
  exit(1);
}

require_once(__DIR__ . '/../vendor/autoload.php');

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All tests');

        $this->addFile(__DIR__ . '/Smartcoin/SmartcoinTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/ObjectTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/APIRequestTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/APIRequestErrorTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/TokenTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/ChargeTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/ErrorTest.php');
        $this->addFile(__DIR__ . '/Smartcoin/ShippingTest.php');
    }
}

