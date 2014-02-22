<?php
  namespace Navaska;

  class Object implements \ArrayAccess {
    protected $_values;

    public function __construct($params=null) {
      $this->_values = array();

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
    }

    public function __isset($k) {
      return isset($this->_values[$k]);
    }

    public function __unset($k) {
      unset($this->_values[$k]);
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