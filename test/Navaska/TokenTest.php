<?php
  class Test_Navaska_Token extends UnitTestCase {

    function test_create_and_retrieve_to_validate() {
      $api_keys = 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'name' => 'Arthur Granado');
      $c = \Navaska\Token::create($params, $api_keys);
      $r = \Navaska\Token::retrieve($c->id, $api_keys);
      $this->assertEqual($c->id,$r->id);
    }

  }
?>