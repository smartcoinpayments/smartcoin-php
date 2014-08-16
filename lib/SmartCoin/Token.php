<?php
  namespace SmartCoin;

  class Token extends \SmartCoin\Object {
    public static function get_request_url() {
      return "/v1/tokens/";
    }

    public static function create($params=null) {
      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('post',$url, \SmartCoin::get_api_key(), $params);
      return new Token(json_decode($r[0],true), \SmartCoin::get_api_key());
    }

    public static function retrieve($id=null) {
      if($id==null)
        throw new InvalidArgumentException("Token::retrieve has to have id");

      $url = self::get_request_url();
      $r = \SmartCoin\APIRequest::request('get',$url.$id, \SmartCoin::access_keys());
      return new Token(json_decode($r[0],true), \SmartCoin::access_keys());
    }
  }
?>