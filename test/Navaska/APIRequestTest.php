<?php
  class Test_Navaska_APIRequest extends UnitTestCase {
    function test_encode_params(){
      $params = array('foo' => 'a', 'bar' => 'lorin', 'foz' => 1, 'baz' => null);
      $enc = \Navaska\APIRequest::encode($params);
      $this->assertEqual($enc,'foo=a&bar=lorin&foz=1');
    }

    function test_encode_complex_params(){
      $params = array('foo' => 'a', 'what' =>  array('bar' => 'lorin', 'foz' => 1), 'baz' => null);
      $enc = \Navaska\APIRequest::encode($params);
      $this->assertEqual($enc,'foo=a&what%5Bbar%5D=lorin&what%5Bfoz%5D=1');
    }

  }
?>