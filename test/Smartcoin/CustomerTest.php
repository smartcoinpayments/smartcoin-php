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
  }
?>