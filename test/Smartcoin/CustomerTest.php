<?php
  class Test_Smartcoin_Customer extends UnitTestCase {
    function test_create_customer(){
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $params = array("email" => "test@test.com");
      $cus = \Smartcoin\Customer::create($params);
      $this->assertNotNull($cus->id);
      $this->assertEqual($cus->email, $params['email']);
    }

  	function test_retrieve_customer() {
  		\Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $params = array("email" => "test@test.com");
      $cus = \Smartcoin\Customer::create($params);

      $c = \Smartcoin\Customer::retrieve($cus->id);
      $this->assertIsA($c,'\Smartcoin\Customer');
      $this->assertEqual($c->id, $cus->id);
  	}

    function test_update_customer_card_by_token() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $params = array('number' => 5454545454545454,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who');
      $tok = \Smartcoin\Token::create($params);

      $params = array("email" => "test@test.com");
      $cus = \Smartcoin\Customer::create($params);
      $cus->card = $tok->id;
      $cus->save();

      $cusUpdated = \Smartcoin\Customer::retrieve($cus->id);

      $this->assertEqual($cusUpdated->id, $cus->id);
      $this->assertEqual($cusUpdated->cards["data"][0]->last4, "5454");
      $this->assertEqual($cus->cards["data"][0]->last4, "5454");
    }

    function test_delete_customer(){
      $params = array("email" => "test@test.com");
      $cus = \Smartcoin\Customer::create($params);

      $cus_deleted = $cus->delete();
      $this->assertEqual($cus_deleted['id'], $cus->id);
      $this->assertTrue($cus_deleted['deleted']);
    }

  }
?>