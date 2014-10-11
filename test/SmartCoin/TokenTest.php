<?php
  class Test_Smartcoin_Token extends UnitTestCase {

    function test_create_and_retrieve_to_validate() {
      Smartcoin::api_key('pk_test_3ac0794848c339');
      Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $c = \Smartcoin\Token::create($params);
      $r = \Smartcoin\Token::retrieve($c->id);
      $this->assertEqual($c->id,$r->id);
    }

  }
?>