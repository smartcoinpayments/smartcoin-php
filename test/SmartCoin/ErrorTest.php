<?php
    class Test_Smartcoin_Error extends UnitTestCase 
    {
      function test_create_error() {
        $errorMsg = '{"error: { "type": "error type", "message": "error message"}"}';
        $error = new \Smartcoin\Error('error',400,$errorMsg,json_decode($errorMsg,true));
        $this->assertEqual($error->get_http_status(),400);
        $this->assertEqual($error->get_http_body(),$errorMsg);
      }
    }
