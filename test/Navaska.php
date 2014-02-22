<?php

echo "Running Navaska PHP test suit.\n";

$has_dependency = @include_once(dirname(__FILE__) . '/../vendor/simpletest/simpletest/autorun.php');

if(!$has_dependency){
  echo "Missing Dependency: SimpleTest wasn't loaded.";
  exit(1);
}

require_once(dirname(__FILE__) . '/../lib/Navaska.php');

class Test_Navaska extends UnitTestCase {

  function test_create_token(){
    // $url = "http://localhost:3000/v1/tokens";
    // $params = array('number' => 4242424242424242,
    //                 'exp_month' => 11,
    //                 'exp_year' => 2017,
    //                 'name' => 'Arthur Granado');
    // $this->assertPattern("/{\"id\":\"tok_(.*)\",\"livemode\":false,\"created\":(\d+),\"used\":false,\"object\":\"token\",\"type\":\"card\",\"card\":{\"id\":\"card_(.*)\",\"object\":\"card\",\"last4\":\"4242\",\"type\":\"Visa\",\"exp_month\":11,\"exp_year\":2017,\"fingerprint\":\"8535531490d032bf2268c1b4e708655c0287e07017ea19ae79e704c831b27fa6\",\"country\":\"BR\",\"name\":\"Arthur Granado\",\"address_line1\":null,\"address_line2\":null,\"address_city\":null,\"address_state\":null,\"address_cep\":null,\"address_country\":null}}/i",
    //         curl_post($url,'pk_test_0208ca9d84d92a','sk_test_62a57820440d47',$params));
  }

  function test_create_token_with_params(){
    // $params = array('number' => 4242424242424242,
    //                 'exp_month' => 11,
    //                 'exp_year' => 2017,
    //                 'name' => 'Arthur Granado');
    // $token = Token::create($params);
    // $this->assertEqual($token->number,    4242424242424242);
    // $this->assertEqual($token->exp_month, 11);
    // $this->assertEqual($token->exp_year,  2017);
    // $this->assertEqual($token->name,      'Arthur Granado');
  }

}

class Token extends \Navaska\Object {

  protected $values;

  public function __construct($params=NULL) {
    $this->values = array();

    if($params) {
      foreach($params as $key => $value) {
        $this->values[$key] = $value;
      }
    }
  }

  public static function create($params=NULL){
    return new Token($params);
  }
}

require_once(dirname(__FILE__) . '/Navaska/ObjectTest.php');
require_once(dirname(__FILE__) . '/Navaska/APIRequestTest.php');

?>