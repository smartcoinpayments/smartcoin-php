<?php
  namespace Smartcoin;

  class Object implements \ArrayAccess {
    protected $api_keys;
    protected $_values;
    protected $_unsavedValues;

    public function __construct($params=null, $api_keys=null) {
      $this->_values = array();
      $this->_unsavedValues = array();

      $this->refresh_object($params,$api_keys);

      if($api_keys) {
        $this->api_keys = $api_keys;
      }
    }

    public function refresh_object($params=null,$api_keys=null) {
      if($params) {
        foreach($params as $key => $value) {
          if(is_array($value) && array_key_exists('object',$value)) {
            $klass = self::get_object_by_type($value['object']);
            $this->_values[$key] = new $klass($value, $api_keys);
          }
          else {
            if(is_array($value)) {
              $list = array();
              foreach ($value as $array) {
                $klass = self::get_object_by_type($array['object']);
                $list[] = new $klass($array, $api_keys);
              }
              $this->_values[$key] = $list;
            }
            else {
              $this->_values[$key] = $value;
              unset($this->_unsavedValues[$key]);
            }
          }
        }
      }
    }

    public static function get_object_by_type($type) {
      $object_type = "\Smartcoin\Smartcoin_Object";
      switch ($type) {
        case 'token':
            $object_type = '\Smartcoin\Token';
            break;
        case 'card':
            $object_type = '\Smartcoin\Card';
            break;
        case 'charge':
            $object_type = '\Smartcoin\Charge';
            break;
        case 'refund':
            $object_type = '\Smartcoin\Refund';
            break;
        case 'fee':
            $object_type = '\Smartcoin\Fee';
            break;
        case 'installment':
            $object_type = '\Smartcoin\Installment';
            break;
        case 'customer':
            $object_type = '\Smartcoin\Customer';
            break;
        case 'plan':
            $object_type = '\Smartcoin\Plan';
            break;
        case 'subscription':
            $object_type = '\Smartcoin\Subscription';
            break;
      }
      return $object_type;
    }

    public function serializeParamenters(){
      $result = array();
      foreach ($this->_unsavedValues as $k => $v) {
        if($this->_unsavedValues[$k]) {
          $result[$k] = $this->_values[$k];  
        }
        
      }
      return $result;
    }

    public function to_string(){
      return $this->to_json();
    }
    
    public function to_json(){
      return json_encode($this->to_array());
    }

    //wrap method to get the Object values array not formatted
    public function to_array(){
      $results = array();

      foreach ($this->_values as $k => $v) {
        if($v instanceof Object){
          $results[$k] = $v->to_array();
        }else if(is_array($v)){
          $results_2 = array();
          foreach ($v as $v2) {
            $results_2[] = $v2->to_array();
          }
          $results[$k] = $results_2;
        }else{
          $results[$k] = $v;
        }
      }

      return $results;
    }

    // Standard accessor magic methods
    public function __set($k, $v) {
      if ($v === ""){
        throw new InvalidArgumentException(
          'You cannot set \''.$k.'\'to an empty string. '
          .'We interpret empty strings as NULL in requests. '
          .'You may set obj->'.$k.' = NULL to delete the property');
      }
      $this->_values[$k] = $v;
      $this->_unsavedValues[$k] = true;
    }

    public function __isset($k) {
      return isset($this->_values[$k]);
    }

    public function __unset($k) {
      unset($this->_values[$k]);
      unset($this->_unsavedValues[$k]);
    }

    public function __get($k) {
      if (array_key_exists($k, $this->_values)) {
        return $this->_values[$k];
      }
      return null;
    }

    // ArrayAccess methods
    public function offsetSet($k, $v) {
      $this->$k = $v;
    }

    public function offsetExists($k) {
      return array_key_exists($k, $this->_values);
    }

    public function offsetUnset($k) {
      unset($this->$k);
    }

    public function offsetGet($k) {
      return array_key_exists($k, $this->_values) ? $this->_values[$k] : null;
    }

    public function keys() {
      return array_keys($this->_values);
    }
  }
?>
