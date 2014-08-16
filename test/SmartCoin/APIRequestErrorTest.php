<?php
    class Test_SmartCoin_APIRequestError extends UnitTestCase {
      function test_api_authentication_error() {
        SmartCoin::api_key('wrong_api_keys');
        SmartCoin::api_secret('');
        try {
          Charge::create(array());
        }catch(\SmartCoin\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }

      function test_api_authentication_error_whitout_api_key() {
        SmartCoin::api_key(NULL);
        SmartCoin::api_secret(NULL);
        try {
          Charge::create(array());
        }catch(\SmartCoin\InvalidArgumentException $e) {
          $this->assertEqual($e->message(),'No API Keys');
        }
      }

      function test_api_request_error() {
        SmartCoin::api_key('pk_test_3ac0794848c339');
        SmartCoin::api_secret('sk_test_8bec997b7a0ea1');
        try {
          Charge::create(array());
        }catch(\SmartCoin\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }
    }
?>