<?php
  class Test_Navaska_APIRequest extends UnitTestCase {
    function test_create_post_request() {
      $url = "http://localhost:3000/v1/tokens";
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'name' => 'Arthur Granado');
      $r = \Navaska\APIRequest::request('post', $url, 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47', $params);
      $this->assertNotNull($r[0]);
      $this->assertEqual(200,$r[1]);
      $this->assertPattern("/{\"id\":\"tok_(.*)\",\"livemode\":false,\"created\":(\d+),\"used\":false,\"object\":\"token\",\"type\":\"card\",\"card\":{\"id\":\"card_(.*)\",\"object\":\"card\",\"last4\":\"4242\",\"type\":\"Visa\",\"exp_month\":11,\"exp_year\":2017,\"fingerprint\":\"8535531490d032bf2268c1b4e708655c0287e07017ea19ae79e704c831b27fa6\",\"country\":\"BR\",\"name\":\"Arthur Granado\",\"address_line1\":null,\"address_line2\":null,\"address_city\":null,\"address_state\":null,\"address_cep\":null,\"address_country\":null}}/i",
                          $r[0]);

    }

    function test_create_get_request() {
      $url = "http://localhost:3000/v1/tokens/tok_3eacc2b1ce9627";
      $r = \Navaska\APIRequest::request('get', $url, 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47');
      $this->assertNotNull($r[0]);
      $this->assertEqual(200,$r[1]);
      $this->assertPattern("/{\"id\":\"tok_(.*)\",\"livemode\":false,\"created\":(\d+),\"used\":false,\"object\":\"token\",\"type\":\"card\",\"card\":{\"id\":\"card_(.*)\",\"object\":\"card\",\"last4\":\"4242\",\"type\":\"Visa\",\"exp_month\":11,\"exp_year\":2017,\"fingerprint\":\"8535531490d032bf2268c1b4e708655c0287e07017ea19ae79e704c831b27fa6\",\"country\":\"BR\",\"name\":\"Arthur Granado\",\"address_line1\":null,\"address_line2\":null,\"address_city\":null,\"address_state\":null,\"address_cep\":null,\"address_country\":null}}/i",
                          $r[0]);

    }

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