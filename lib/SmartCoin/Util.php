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
  }
 ?>