<?php
	class Test_Smartcoin_Plan extends UnitTestCase {

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

		function test_create_plan(){
			$params = array(
				'id' => ('plan_test' . self::randomString()),
				'amount' => 1000,
				'currency' => 'brl',
				'interval' => 'month',
				'name' => 'Plan Test'
			);

			$pl = \Smartcoin\Plan::create($params);
			
      $this->assertEqual($pl->id, $params['id']);
      $this->assertEqual($pl->amount, $params['amount']);
      $this->assertEqual($pl->currency, $params['currency']);
      $this->assertEqual($pl->name, $params['name']);
      $this->assertNotNull($pl->created);

      $deleted_pl = $pl->delete();
      $this->assertEqual($deleted_pl['id'], $pl->id);
      $this->assertTrue($deleted_pl['deleted']);
		}

		function test_retreive_plan() {
      $params = array(
				'id' => ('plan_test' . self::randomString()),
				'amount' => 1000,
				'currency' => 'brl',
				'interval' => 'month',
				'name' => 'Plan Test'
			);

			$pl = \Smartcoin\Plan::create($params);

      $pl = \Smartcoin\Plan::retrieve($params['id']);
      $this->assertIsA($pl,'\Smartcoin\Plan');
      $this->assertEqual($pl->id, $params['id']);
      $pl->delete();
		}

		function test_update_plan() {
      $params = array(
				'id' => ('plan_test' . self::randomString()),
				'amount' => 1000,
				'currency' => 'brl',
				'interval' => 'month',
				'name' => 'Plan Test'
			);

			$pl = \Smartcoin\Plan::create($params);

			$pl->name = "New name";
			$pl->save();
			$updated_pl = \Smartcoin\Plan::retrieve($params['id']);
			$this->assertEqual($pl->name, "New name");
			$this->assertEqual($updated_pl->name, "New name");
			$this->assertEqual($pl->name, $updated_pl->name);
			$pl->delete();
		}

	}
?>