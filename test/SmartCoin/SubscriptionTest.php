<?php
  class Test_Smartcoin_Subscription extends UnitTestCase {
  	function test_create_subscripion() {
  		\Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

      $customer_id = 'cus_4635424330874882485';
      $c = \Smartcoin\Customer::retrieve($customer_id);
      $this->assertIsA($c->subscriptions(),'\Smartcoin\Subscription');
      $s = $c->subscriptions()->create(array('plan' => 'gold_2'));
      $this->assertEqual($s->plan->id, 'gold_2');
      // $this->assertEqual($s->start, time());
      // $this->assertEqual($s->current_period_start, time());
      // $this->assertEqual($s->current_period_start, strtotime('+30 days', time()));
      // $this->assertEqual($s->status, 'active');
  	}
  }
?>