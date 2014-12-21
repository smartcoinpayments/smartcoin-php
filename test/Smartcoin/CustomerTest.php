<?php
  class Test_Smartcoin_Customer extends UnitTestCase {
  	function test_retrieve_customer() {
  		\Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $customer_id = 'cus_4635424330874882485';
      $c = \Smartcoin\Customer::retrieve($customer_id);
      $this->assertIsA($c,'\Smartcoin\Customer');
      $this->assertEqual($c->id, $customer_id);
  	}

    function test_update_customer_card_by_token() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $params = array('number' => 5454545454545454,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who');
      $token = \Smartcoin\Token::create($params);

      $customer_id = 'cus_4635424330874882485';
      $customer = \Smartcoin\Customer::retrieve($customer_id);
      
      $customer->update_card(array("card" => $token->id));
      $customerUpdated = \Smartcoin\Customer::retrieve($customer_id);

      $this->assertEqual($customerUpdated->id, $customer_id);
      $this->assertEqual($customerUpdated->cards["data"][0]->last4, "5454");
    }
  }
?>