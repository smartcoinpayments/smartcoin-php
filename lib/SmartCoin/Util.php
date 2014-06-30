<?php
  namespace SmartCoin;

  abstract class Util {

  	protected static $types = array(
        'token'   => 'Token',
        'card'    => 'Card',
        'charge'  => 'Charge',
        'refund'  => 'Refund',
        'fee'			=> 'Fee'
      );

		public static function get_smart_coin_object($object_type_name) {
		  $object_type = 'Object';

		  if(Util::$types[$object_type_name] != null) {
		    $object_type = Util::$types[$object_type_name];
		  }

		  return $object_type;
		}

    public static function convert_smartcoin_object_to_array($smartcoin_object){
      $results = array();
      foreach ($smartcoin_object->_values as $key => $value) {
    //     if ($value instanceof SmartCoin_Object) {
    //       $results[$key] = $value->__toArray(true);
    //     } else if (is_array($value)) {
    //       $results[$key] = self::convert_smartcoin_object_to_array($value);
    //     } else {
          $results[$key] = $value;
    //     }
      }
      return $results;
    }
  }
 ?>
