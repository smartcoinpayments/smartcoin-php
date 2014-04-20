<?php
  class Test_SmartCoin_Token extends UnitTestCase {

    function test_create_and_retrieve_to_validate() {
      $api_key = 'pk_test_a38f9ea83777a0:';
      $api_keys = 'pk_test_a38f9ea83777a0:sk_test_daae6279b9e639';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $c = \SmartCoin\Token::create($params, $api_key);
      $r = \SmartCoin\Token::retrieve($c->id, $api_keys);
      $this->assertEqual($c->id,$r->id);
    }

  }
?>