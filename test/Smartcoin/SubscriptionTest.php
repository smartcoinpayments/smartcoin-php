<?php
  class Test_Smartcoin_Subscription extends UnitTestCase {
    static function randomString() {
      $chars = "abcdefghijklmnopqrstuvwxyz";
      $str = "";
      for ($i = 0; $i < 10; $i++) {
        $str .= $chars[rand(0, strlen($chars)-1)];
      }
      return $str;
    }

    function setUp() {
      \Smartcoin\Smartcoin::api_key('pk_test_3ac0794848c339');
      \Smartcoin\Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
    }

  	function test_create_subscripion() {
      $cus_params = array(
        "email" => "test@test.com",
        "card" => array('number' => 5454545454545454,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who')
        );
      $cus = \Smartcoin\Customer::create($cus_params);

      $pl_params = array(
        'id' => ('plan_test' . self::randomString()),
        'amount' => 1000,
        'currency' => 'brl',
        'interval' => 'month',
        'name' => 'Plan Test'
      );
      $pl = \Smartcoin\Plan::create($pl_params);

      $this->assertIsA($cus->subscriptions(),'\Smartcoin\Subscription');
      $sub = $cus->subscriptions()->create(array('plan' => $pl_params['id']));
      $this->assertEqual($sub->plan->id, $pl_params['id']);
      $this->assertEqual($sub->customer, $cus->id);
      $this->assertEqual($sub->status, 'active');
  	}

    function test_retrive_subscription() {
      $cus_params = array(
        "email" => "test@test.com",
        "card" => array('number' => 5454545454545454,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who')
        );
      $cus = \Smartcoin\Customer::create($cus_params);

      $pl_params = array(
        'id' => ('plan_test' . self::randomString()),
        'amount' => 1000,
        'currency' => 'brl',
        'interval' => 'month',
        'name' => 'Plan Test'
      );
      $pl = \Smartcoin\Plan::create($pl_params);

      $sub = $cus->subscriptions()->create(array('plan' => $pl_params['id']));
      $sub_retrived = $cus->subscriptions()->retrieve($sub->id);
      $this->assertEqual($sub->id, $sub_retrived->id);
      $this->assertNotNull($sub_retrived->current_period_start);
      $this->assertNotNull($sub_retrived->current_period_end);
      $this->assertEqual($sub_retrived->plan->id, $pl_params['id']);
      $this->assertEqual($sub_retrived->plan->amount, $pl_params['amount']);
    }

    function test_retrive_subscription_from_customer() {
      $cus_params = array(
        "email" => "test@test.com",
        "card" => array('number' => 5454545454545454,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who')
        );
      $cus = \Smartcoin\Customer::create($cus_params);

      $pl_params = array(
        'id' => ('plan_test' . self::randomString()),
        'amount' => 1000,
        'currency' => 'brl',
        'interval' => 'month',
        'name' => 'Plan Test'
      );
      $pl = \Smartcoin\Plan::create($pl_params);
      $sub = $cus->subscriptions()->create(array('plan' => $pl_params['id']));

      $subscriptions = $cus->subscriptions()->list_all();
      $subscription = (sizeof($subscriptions) == 1) ? $subscriptions->data[0] : NULL;
      $this->assertEqual($sub->id, $subscription->id);
      $this->assertNotNull($subscription->current_period_start);
      $this->assertNotNull($subscription->current_period_end);
      $this->assertEqual($subscription->plan->id, $pl_params['id']);
      $this->assertEqual($subscription->plan->amount, $pl_params['amount']);
    }

    function test_list_subscriptions() {
      $cus = \Smartcoin\Customer::retrieve("test@test.com");
      $list = $cus->subscriptions()->list_all();

      $this->assertEqual($list->object,'list');
      $this->assertNotEqual(count($list->data),0);
      $this->assertIsA($list->data[0],'\Smartcoin\Subscription');
    }

    function test_cancel_subscriptions() {
      $cus_params = array(
        "email" => "test@test.com",
        "card" => array('number' => 5454545454545454,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Doctor Who')
        );
      $cus = \Smartcoin\Customer::create($cus_params);

      $pl_params = array(
        'id' => ('plan_test' . self::randomString()),
        'amount' => 1000,
        'currency' => 'brl',
        'interval' => 'month',
        'name' => 'Plan Test'
      );
      $pl = \Smartcoin\Plan::create($pl_params);

      $sub = $cus->subscriptions()->create(array('plan' => $pl_params['id']));
      $sub->delete();
      $this->assertEqual($sub->status, 'canceled');
    }

  }
?>