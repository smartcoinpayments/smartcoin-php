<?php
  class Test_SmartCoin_Charge extends UnitTestCase {

    function test_create_and_retrieve_charge() {
      $api_key = 'pk_test_3ac0794848c339:';
      $api_keys = 'pk_test_3ac0794848c339:sk_test_8bec997b7a0ea1';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $token = \SmartCoin\Token::create($params, $api_key);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = Charge::create($params, $api_keys);
      $r = Charge::retrieve($c->id, $api_keys);
      $this->assertEqual($c->id,$r->id);
      $this->assertEqual($c->card->type,'Visa');
      $this->assertEqual($c->card->id,$token->card->id);
      $this->assertNotNull($c->fees);
      $this->assertIsA($c->fees[0],'Fee');
      $this->assertEqual($c->fees[0]->type,'SmartCoin fee: flat');
      $this->assertIsA($c->installments[0],'Installment');
    }

    function test_capture_charge() {
      $api_key = 'pk_test_3ac0794848c339:';
      $api_keys = 'pk_test_3ac0794848c339:sk_test_8bec997b7a0ea1';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $token = \SmartCoin\Token::create($params, $api_keys);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id,
          'capture' => 'false'
        );

      $c = Charge::create($params, $api_keys);
      $this->assertFalse($c->captured);
      $c->capture();
      $this->assertTrue($c->captured);
    }

    function test_refund_charge() {
      $api_key = 'pk_test_3ac0794848c339:';
      $api_keys = 'pk_test_3ac0794848c339:sk_test_8bec997b7a0ea1';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $token = \SmartCoin\Token::create($params, $api_key);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = Charge::create($params, $api_keys);
      $this->assertFalse($c->refunded);
      $c->refund();
      $this->assertTrue($c->refunded);
      $this->assertEqual($c->amount,$c->refunds[0]->amount);
    }

    function test_list_all() {
      $api_keys = 'pk_test_3ac0794848c339:sk_test_8bec997b7a0ea1';
      $params = array(
          'count' => 3
        );

      $l = Charge::list_all($params, $api_keys);
      $this->assertEqual($l->object,'list');
      $this->assertEqual(count($l->data),3);
    }

  }
?>