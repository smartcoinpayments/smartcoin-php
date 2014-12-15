<?php
  class Test_Smartcoin_Charge extends UnitTestCase {

    function test_create_and_retrieve_charge() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
      
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who');
      $token = \Smartcoin\Token::create($params);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = \Smartcoin\Charge::create($params);
      $r = \Smartcoin\Charge::retrieve($c->id);
      $this->assertEqual($c->id,$r->id);
      $this->assertEqual($c->card->type,'Visa');
      $this->assertEqual($c->card->id,$token->card->id);
      $this->assertNotNull($c->fees);
      $this->assertIsA($c->fees[0],'\Smartcoin\Fee');
      $this->assertEqual($c->fees[0]->type,'Smartcoin fee: flat');
      $this->assertIsA($c->installments[0],'\Smartcoin\Installment');
    }

    function test_create_charge_with_card_params(){
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $c = \Smartcoin\Charge::create(array(
        "amount" => 100,
        "currency" => "brl",
        "card" => array(
          "number" => "4242424242424242",
          "exp_month" => 10,
          "exp_year" => 15,
          "cvc" => "083"
        ),
        "description" => "Smartcoin charge test for example@test.com"
      ));

      $this->assertEqual($c->amount,100);
      $this->assertTrue($c->paid);
      $this->assertEqual($c->card->type,'Visa');
    }

    function test_create_bank_slip_charge_types() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
      
      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'type' => 'bank_slip'
        );

      $c = \Smartcoin\Charge::create($params);
      $r = \Smartcoin\Charge::retrieve($c->id);
      $this->assertNull($c->card);
      $this->assertNotNull($c->bank_slip);
    }

    function test_capture_charge() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who');
      $token = \Smartcoin\Token::create($params);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id,
          'capture' => 'false'
        );

      $c = \Smartcoin\Charge::create($params);
      $this->assertFalse($c->captured);
      $c->capture();
      $this->assertTrue($c->captured);
    }

    function test_refund_charge() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who');
      $token = \Smartcoin\Token::create($params);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = \Smartcoin\Charge::create($params);
      $this->assertFalse($c->refunded);
      $c->refund();
      $this->assertTrue($c->refunded);
      $this->assertEqual($c->amount,$c->refunds[0]->amount);
    }

    function test_list_all() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
      $params = array(
          'count' => 3
        );

      $l = \Smartcoin\Charge::list_all($params);
      $this->assertEqual($l->object,'list');
      $this->assertEqual(count($l->data),3);
    }

  }
?>
