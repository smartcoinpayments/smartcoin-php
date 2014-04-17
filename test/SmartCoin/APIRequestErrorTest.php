<?php
    class Test_SmartCoin_APIRequestError extends UnitTestCase {
      function test_api_authentication_error() {
        try {
          Charge::create(array(), 'wrong_api_keys:');
        }catch(\SmartCoin\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }

      function test_api_authentication_error_whitout_api_key() {
        try {
          Charge::create(array(), null);
        }catch(\SmartCoin\InvalidArgumentException $e) {
          $this->assertEqual($e->message(),'No API Keys');
        }
      }

      function test_api_request_error() {
        $api_keys = 'pk_test_31242ce3126aaf:sk_test_96e251e1b27da3';
        try {
          Charge::create(array(), $api_keys);
        }catch(\SmartCoin\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }
    }
?>