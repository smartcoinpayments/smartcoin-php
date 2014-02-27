<?php
    class Test_Navaska_APIRequestError extends UnitTestCase {
      function test_api_authentication_error() {
        try {
          Charge::create(array(), 'wrong_api_keys');
        }catch(\Navaska\AuthenticationError $e) {
          $this->assertEqual($e->get_http_status(),401);
        }
      }

      function test_api_authentication_error_whitout_api_key() {
        try {
          Charge::create(array(), null);
        }catch(\Navaska\InvalidArgumentException $e) {
          $this->assertEqual($e->message(),'No API Keys');
        }
      }

      function test_api_request_error() {
        $api_keys = 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47';
        try {
          Charge::create(array(), $api_keys);
        }catch(\Navaska\RequestError $e) {
          $this->assertEqual($e->get_http_status(),400);
        }
      }
    }
?>