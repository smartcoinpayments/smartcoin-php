<?php
  class Charge extends \SmartCoin\Object {
    public static function get_request_url() {
      return "/v1/charges/";
    }

    public static function create($params=null, $api_keys) {
      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('post',$url, $api_keys, $params);
      return new Charge(json_decode($r[0],true), $api_keys);
    }

    public static function retrieve($id=null, $api_keys) {
      if($id==null)
        throw new InvalidArgumentException("Charge::retrieve has to have id");

      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('get',$url.$id, $api_keys);
      return new Charge(json_decode($r[0],true), $api_keys);
    }

    public static function list_all($params=null, $api_keys) {
      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('get',$url, $api_keys, $params);
     return new \SmartCoin\Object_List(json_decode($r[0],true), $api_keys);
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