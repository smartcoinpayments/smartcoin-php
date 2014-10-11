<?php
    class Test_Smartcoin_APIRequestError extends UnitTestCase {
      function test_api_authentication_error() {
        Smartcoin::api_key('wrong_api_keys');
        Smartcoin::api_secret('');
        try {
          Charge::create(array());
        }catch(\Smartcoin\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }

      function test_api_authentication_error_whitout_api_key() {
        Smartcoin::api_key(NULL);
        Smartcoin::api_secret(NULL);
        try {
          Charge::create(array());
        }catch(\Smartcoin\InvalidArgumentException $e) {
          $this->assertEqual($e->message(),'No API Keys');
        }
      }

      function test_api_request_error() {
        Smartcoin::api_key('pk_test_3ac0794848c339');
        Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
        try {
          Charge::create(array());
        }catch(\Smartcoin\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }
    }
?>