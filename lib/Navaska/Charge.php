<?php
  class Charge extends \Navaska\Object {
    public static function get_request_url() {
      return "/v1/charges/";
    }

    public static function create($params=null, $api_keys) {
      $url = self::get_request_url();
      $r = \Navaska\APIRequest::request('post',$url, $api_keys, $params);
      return new Charge(json_decode($r[0]),true);
    }

    public static function retrieve($id=null, $api_keys) {
      if($id==null)
        throw new InvalidArgumentException("Charge::retrieve has to have id");

      $url = self::get_request_url();
      $r = \Navaska\APIRequest::request('get',$url.$id, $api_keys);
      return new Charge(json_decode($r[0]),true);
    }
  }
?>