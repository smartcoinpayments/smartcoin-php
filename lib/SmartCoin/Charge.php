<?php
  class Charge extends \SmartCoin\Object {
    public static function get_request_url() {
      return "/v1/charges/";
    }

    public static function create($params=null) {
      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('post',$url, \SmartCoin::access_keys(), $params);
      return new Charge(json_decode($r[0],true), \SmartCoin::access_keys());
    }

    public static function retrieve($id=null) {
      if($id==null)
        throw new InvalidArgumentException("Charge::retrieve has to have id");

      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('get',$url.$id, \SmartCoin::access_keys());
      return new Charge(json_decode($r[0],true), \SmartCoin::access_keys());
    }

    public static function list_all($params=null) {
      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('get',$url, \SmartCoin::access_keys(), $params);
     return new \SmartCoin\Object_List(json_decode($r[0],true), \SmartCoin::access_keys());
    }

    public function capture($params=null) {
      $url = self::get_request_url() . $this->id . '/capture';
      $r = \SmartCoin\APIRequest::request('post',$url, $this->api_keys, $params);
      $this->reflesh_object(json_decode($r[0],true),$this->api_keys);
    }

    public function refund($params=null) {
      $url = self::get_request_url() . $this->id . '/refund';
      $r = \SmartCoin\APIRequest::request('post',$url, $this->api_keys, $params);
      $this->reflesh_object(json_decode($r[0],true),$this->api_keys);
    }
  }
?>