<?php
namespace Smartcoin;

  class Charge extends \Smartcoin\Object {
    public static function get_request_url() {
      return "/v1/charges/";
    }

    public static function create($params=null) {
      $url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('post',$url, \Smartcoin\Smartcoin::access_keys(), $params);
      return new Charge(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());
    }

    public static function retrieve($id=null) {
      if($id==null)
        throw new InvalidArgumentException("Charge::retrieve has to have id");

      $url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('get',$url.$id, \Smartcoin\Smartcoin::access_keys());
      return new Charge(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());
    }

    public static function list_all($params=null) {
      $url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('get',$url, \Smartcoin\Smartcoin::access_keys(), $params);
     return new \Smartcoin\Object_List(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());
    }

    public function capture($params=null) {
      $url = self::get_request_url() . $this->id . '/capture';
      $r = \Smartcoin\APIRequest::request('post',$url, $this->api_keys, $params);
      $this->refresh_object(json_decode($r[0],true),$this->api_keys);
    }

    public function refund($params=null) {
      $url = self::get_request_url() . $this->id . '/refund';
      $r = \Smartcoin\APIRequest::request('post',$url, $this->api_keys, $params);
      $this->refresh_object(json_decode($r[0],true),$this->api_keys);
    }

    public function save() {
      $params = array('description' => $this->description);
      $url = self::get_request_url() . $this->id;
      $r = \Smartcoin\APIRequest::request('post',$url, $this->api_keys, $params);
      $this->refresh_object(json_decode($r[0],true),$this->api_keys); 
    }
  }
?>