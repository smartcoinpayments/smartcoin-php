<?php
  class Test_SmartCoin_Object extends UnitTestCase {
    public function test_normal_accessors() {
      $o = new \SmartCoin\Object();
      $o->foo = 'bar';
      $this->assertEqual($o->foo, 'bar');
      $this->assertTrue(isset($o->foo));
      unset($o->foo);
      $this->assertFalse(isset($o->foo));
    }

    public function test_keys() {
      $o = new \SmartCoin\Object();
      $o->foo = 'bar';
      $this->assertEqual($o->keys(), array('foo'));
    }

    public function test_array_accessors() {
      $o = new \SmartCoin\Object();
      $o['foo'] = 'bar';
      $this->assertEqual($o['foo'], 'bar');
      $this->assertTrue(isset($o['foo']));
      unset($o['foo']);
      $this->assertFalse(isset($o['foo']));
    }

    public function test_array_accessors_match_normal_accessors() {
      $o = new \SmartCoin\Object();
      $o->foo = 'bar';
      $this->assertEqual($o['foo'], 'bar');

      $o['bar'] = 'foo';
      $this->assertEqual($o->bar, 'foo');
    }

    public function test_to_array(){
      $o1 = new \SmartCoin\Object();
      $o1->foo = 'bar';

      $o2 = new \SmartCoin\Object();
      $o2->foo_2 = 'bar_2';

      $o1->o2 = $o2;

      $array = $o1->to_array();

      $this->assertEqual($array['foo'],$o1->foo);
      $this->assertEqual($array['o2']['foo_2'],'bar_2');
    }

    public function test_to_array_with_complex_object(){
      SmartCoin::api_key('pk_test_3ac0794848c339');
      SmartCoin::api_secret('sk_test_8bec997b7a0ea1');
      $api_key = 'pk_test_3ac0794848c339:';
      $api_keys = 'pk_test_3ac0794848c339:sk_test_8bec997b7a0ea1';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'cvc' => 111,
                      'name' => 'Arthur Granado');
      $token = \SmartCoin\Token::create($params);

      $params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );

      $c = Charge::create($params, $api_keys);
      $charge_array = $c->to_array();

      $this->assertEqual($charge_array['amount'],$c->amount);
      $this->assertEqual($charge_array['card']['id'],$c->card->id);
      $this->assertNotNull($charge_array['card']['id']);
      $this->assertEqual($charge_array['fees'][0]['amount'],$c->fees[0]->amount);
      $this->assertNotNull($charge_array['fees'][0]);
    }

    public function test_to_string(){
      $o1 = new \SmartCoin\Object();
      $o1->foo = 'bar';

      $o2 = new \SmartCoin\Object();
      $o2->foo_2 = 'bar_2';

      $o1->o2 = $o2;

      $str = $o1->to_string();
      $this->assertEqual($str,'{"foo":"bar","o2":{"foo_2":"bar_2"}}');
    }

    public function test_to_json(){
      $o1 = new \SmartCoin\Object();
      $o1->foo = 'bar';

      $o2 = new \SmartCoin\Object();
      $o2->foo_2 = 'bar_2';

      $o1->o2 = $o2;

      $json = $o1->to_json();
      $this->assertEqual($json,'{"foo":"bar","o2":{"foo_2":"bar_2"}}');
    }

    public function test_to_json_with_object_array(){
      $o1 = new \SmartCoin\Object();
      $o1->foo = 'bar';

      $o2 = new \SmartCoin\Object();
      $o2->foo_2 = 'bar_2';

      $o3 = new \SmartCoin\Object();
      $o3->foo_3 = 'bar_3';
      $o4 = new \SmartCoin\Object();
      $o4->foo_4 = 'bar_4';
      $a2 = array($o3,$o4);

      $o1->o2 = $o2;
      $o1->a = $a2;

      $json = $o1->to_json();
      $this->assertEqual($json,'{"foo":"bar","o2":{"foo_2":"bar_2"},"a":[{"foo_3":"bar_3"},{"foo_4":"bar_4"}]}');
    }
  }
?>
