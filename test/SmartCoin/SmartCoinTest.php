<?php
	class Test_SmartCoin extends UnitTestCase {
		function test_should_get_empty_access_keys(){
			$this->assertEqual(SmartCoin::access_keys(),':');
		}

		function test_should_set_api_key(){
			SmartCoin::api_key('pk_test_1234q');
			SmartCoin::api_secret('');
			$this->assertEqual(SmartCoin::access_keys(),'pk_test_1234q:');
		}

		function test_should_set_api_secret(){
			SmartCoin::api_key('');
			SmartCoin::api_secret('sk_test_q4321');
			$this->assertEqual(SmartCoin::access_keys(),':sk_test_q4321');
		}

		function test_should_get_api_key() {
			SmartCoin::api_key('pk_test_1234q');
			$this->assertEqual(SmartCoin::get_api_key(),'pk_test_1234q:');
		}
	}
?>