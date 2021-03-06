<?php
	class Test_Smartcoin extends UnitTestCase {
		function test_should_get_empty_access_keys(){
			$this->assertEqual(\Smartcoin\Smartcoin::access_keys(),':');
		}

		function test_should_set_api_key(){
			\Smartcoin\Smartcoin::api_key('pk_test_1234q');
			\Smartcoin\Smartcoin::api_secret('');
			$this->assertEqual(\Smartcoin\Smartcoin::access_keys(),'pk_test_1234q:');
		}

		function test_should_set_api_secret(){
			\Smartcoin\Smartcoin::api_key('');
			\Smartcoin\Smartcoin::api_secret('sk_test_q4321');
			$this->assertEqual(\Smartcoin\Smartcoin::access_keys(),':sk_test_q4321');
		}

		function test_should_get_api_key() {
			\Smartcoin\Smartcoin::api_key('pk_test_1234q');
			$this->assertEqual(\Smartcoin\Smartcoin::get_api_key(),'pk_test_1234q:');
		}
	}
