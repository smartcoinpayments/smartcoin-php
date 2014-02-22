<?php
  class Test_Navaska_Object extends UnitTestCase {
    public function test_normal_accessors() {
      $o = new \Navaska\Object();
      $o->foo = 'bar';
      $this->assertEqual($o->foo, 'bar');
      $this->assertTrue(isset($o->foo));
      unset($o->foo);
      $this->assertFalse(isset($o->foo));
    }

    public function test_keys() {
      $o = new \Navaska\Object();
      $o->foo = 'bar';
      $this->assertEqual($o->keys(), array('foo'));
    }

    public function test_array_accessors() {
      $o = new \Navaska\Object();
      $o['foo'] = 'bar';
      $this->assertEqual($o['foo'], 'bar');
      $this->assertTrue(isset($o['foo']));
      unset($o['foo']);
      $this->assertFalse(isset($o['foo']));
    }

    public function test_array_accessors_match_normal_accessors() {
      $o = new \Navaska\Object();
      $o->foo = 'bar';
      $this->assertEqual($o['foo'], 'bar');

      $o['bar'] = 'foo';
      $this->assertEqual($o->bar, 'foo');
    }
  }
?>