<?php
namespace Smartcoin;

  class Token extends \Smartcoin\Object {
    public static function get_request_url() {
      return "/v1/tokens/";
    }

    public static function create($params=null) {
      $url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('post',$url, \Smartcoin\Smartcoin::get_api_key(), $params);
      return new Token(json_decode($r[0],true), \Smartcoin\Smartcoin::get_api_key());
    }

    public static function retrieve($id=null) {
      if($id==null)
        throw new InvalidArgumentException("Token::retrieve has to have id");

      $url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('get',$url.$id, \Smartcoin\Smartcoin::access_keys());
      return new Token(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());
    }
  }
?>