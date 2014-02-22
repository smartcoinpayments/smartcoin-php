<?php
  namespace Navaska;

  class Token extends \Navaska\Object {

    public static function create($params=null, $api_keys) {
      $r = \Navaska\APIRequest::request('post','/v1/tokens', $api_keys, $params);
      return new Token(json_decode($r[0]),true);
    }

    public static function retrieve($id=null, $api_keys) {
      if($id==null)
        throw new InvalidArgumentException("Token::retrieve has to have id");

      $r = \Navaska\APIRequest::request('get','/v1/tokens/'.$id, $api_keys);
      return new Token(json_decode($r[0]),true);
    }
  }
?>