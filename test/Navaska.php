<?php

echo "Running Navaska PHP test suit.\n";

$has_dependency = @include_once(dirname(__FILE__) . '/../vendor/simpletest/simpletest/autorun.php');

if(!$has_dependency){
  echo "Missing Dependency: SimpleTest wasn't loaded.";
  exit(1);
}

require_once(dirname(__FILE__) . '/../lib/Navaska.php');


require_once(dirname(__FILE__) . '/Navaska/ObjectTest.php');
require_once(dirname(__FILE__) . '/Navaska/APIRequestTest.php');
require_once(dirname(__FILE__) . '/Navaska/APIRequestErrorTest.php');
require_once(dirname(__FILE__) . '/Navaska/TokenTest.php');
require_once(dirname(__FILE__) . '/Navaska/ChargeTest.php');
require_once(dirname(__FILE__) . '/Navaska/ErrorTest.php');

?>