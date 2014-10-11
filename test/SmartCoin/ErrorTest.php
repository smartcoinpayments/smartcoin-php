<?php
    class Test_Smartcoin_Error extends UnitTestCase {
      function test_create_error() {
        $error_msg = '{"error: { "type": "error type", "message": "error message"}"}';
        $error = new \Smartcoin\Error('error',400,$error_msg,json_decode($error_msg,true));
        $this->assertEqual($error->get_http_status(),400);
        $this->assertEqual($error->get_http_body(),$error_msg);
      }
    }
?>