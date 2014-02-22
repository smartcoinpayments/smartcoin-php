<?php
  class Test_Navaska_Charge extends UnitTestCase {

    function test_create_and_retrieve_charge() {
      $api_keys = 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'name' => 'Arthur Granado');
      $token = \Navaska\Token::create($params, $api_keys);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = Charge::create($params, $api_keys);
      $r = Charge::retrieve($c->id, $api_keys);
      $this->assertEqual($c->id,$r->id);
      $this->assertEqual($c->card['id'],$token->card['id']);
    }

    function test_capture_charge() {
      $api_keys = 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'name' => 'Arthur Granado');
      $token = \Navaska\Token::create($params, $api_keys);

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
      $api_keys = 'pk_test_0208ca9d84d92a:sk_test_62a57820440d47';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'name' => 'Arthur Granado');
      $token = \Navaska\Token::create($params, $api_keys);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = Charge::create($params, $api_keys);
      $this->assertFalse($c->refunded);
      $c->refund();
      $this->assertTrue($c->refunded);
    }

  }
?>