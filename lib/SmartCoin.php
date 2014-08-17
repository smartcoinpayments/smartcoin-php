<?php
  require(dirname(__FILE__) . '/SmartCoin/Object.php');
  require(dirname(__FILE__) . '/SmartCoin/APIRequest.php');
  require(dirname(__FILE__) . '/SmartCoin/SmartCoin_Object.php');
  require(dirname(__FILE__) . '/SmartCoin/Token.php');
  require(dirname(__FILE__) . '/SmartCoin/Card.php');
  require(dirname(__FILE__) . '/SmartCoin/Refund.php');
  require(dirname(__FILE__) . '/SmartCoin/Fee.php');
  require(dirname(__FILE__) . '/SmartCoin/Installment.php');
  require(dirname(__FILE__) . '/SmartCoin/Charge.php');
  require(dirname(__FILE__) . '/SmartCoin/Object_List.php');
  require(dirname(__FILE__) . '/SmartCoin/Error.php');
  require(dirname(__FILE__) . '/SmartCoin/Util.php');
  require(dirname(__FILE__) . '/SmartCoin/Shipping.php');

class SmartCoin {
  static $api_key = '';
  static $api_secret = '';

  public static function access_keys(){
    if(self::$api_key === NULL && self::$api_secret === NULL){
      return NULL;
    }
    return self::$api_key . ':' . self::$api_secret;
  } 

  public static function api_key($api_key) {
    self::$api_key = $api_key;
  }

  public static function api_secret($api_secret) {
    self::$api_secret = $api_secret;
  }

  public static function get_api_key() {
    return self::$api_key . ':';
  }
}