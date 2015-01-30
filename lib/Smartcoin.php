<?php
  namespace Smartcoin;

  require(dirname(__FILE__) . '/Smartcoin/Object.php');
  require(dirname(__FILE__) . '/Smartcoin/APIRequest.php');
  require(dirname(__FILE__) . '/Smartcoin/Smartcoin_Object.php');
  require(dirname(__FILE__) . '/Smartcoin/Token.php');
  require(dirname(__FILE__) . '/Smartcoin/Card.php');
  require(dirname(__FILE__) . '/Smartcoin/Refund.php');
  require(dirname(__FILE__) . '/Smartcoin/Fee.php');
  require(dirname(__FILE__) . '/Smartcoin/Installment.php');
  require(dirname(__FILE__) . '/Smartcoin/Charge.php');
  require(dirname(__FILE__) . '/Smartcoin/Object_List.php');
  require(dirname(__FILE__) . '/Smartcoin/Error.php');
  require(dirname(__FILE__) . '/Smartcoin/Util.php');
  require(dirname(__FILE__) . '/Smartcoin/Shipping.php');
  require(dirname(__FILE__) . '/Smartcoin/Customer.php');
  require(dirname(__FILE__) . '/Smartcoin/Plan.php');
  require(dirname(__FILE__) . '/Smartcoin/Subscription.php');

class Smartcoin {
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