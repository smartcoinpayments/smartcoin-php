<?php
  class Test_SmartCoin_Token extends UnitTestCase {

    function test_create_and_retrieve_to_validate() {
      SmartCoin::api_key('pk_test_3ac0794848c339');
      SmartCoin::api_secret('sk_test_8bec997b7a0ea1');

      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $c = \SmartCoin\Token::create($params);
      $r = \SmartCoin\Token::retrieve($c->id);
      $this->assertEqual($c->id,$r->id);
    }

  }
?>