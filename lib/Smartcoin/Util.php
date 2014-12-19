<?php
  namespace Smartcoin;

  abstract class Util {

  	protected static $types = array(
        'token'            => 'Token',
        'card'             => 'Card',
        'charge'           => 'Charge',
        'refund'           => 'Refund',
        'fee'			         => 'Fee',
        'subscription'     => 'Subscription',
      );

		public static function get_smart_coin_object($object_type_name) {
		  $object_type = 'Object';

		  if(Util::$types[$object_type_name] != null) {
		    $object_type = Util::$types[$object_type_name];
		  }

		  return $object_type;
		}

    public static function convert_Smartcoin_object_to_array($Smartcoin_object){
      $results = array();
      foreach ($Smartcoin_object->_values as $key => $value) {
    //     if ($value instanceof Smartcoin_Object) {
    //       $results[$key] = $value->__toArray(true);
    //     } else if (is_array($value)) {
    //       $results[$key] = self::convert_Smartcoin_object_to_array($value);
    //     } else {
          $results[$key] = $value;
    //     }
      }
      return $results;
    }
  }
 ?>
