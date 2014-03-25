<?php
  class Test_Navaska_Token extends UnitTestCase {

    function test_create_and_retrieve_to_validate() {
      $api_key = 'pk_test_d1331efc0f6fde:'
      $api_keys = 'pk_test_d1331efc0f6fde:sk_test_c1a09efd8eaa36';
      $params = array('number' => 4242424242424242,
                      'exp_month' => 11,
                      'exp_year' => 2017,
                      'name' => 'Arthur Granado');
      $c = \Navaska\Token::create($params, $api_key);
      $r = \Navaska\Token::retrieve($c->id, $api_keys);
      $this->assertEqual($c->id,$r->id);
    }

  }
?>