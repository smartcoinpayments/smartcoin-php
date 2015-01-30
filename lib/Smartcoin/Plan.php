<?php
namespace Smartcoin;

  class Plan extends \Smartcoin\Object {
  	public static function get_request_url() {
      return "/v1/plans/";
    }

  	public static function create($params=null){
  		$url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('post',$url, \Smartcoin\Smartcoin::access_keys(), $params);
      return new Plan(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());
  	}

  	public static function retrieve($id=null) {
  		$url = self::get_request_url();
  		$r = \Smartcoin\APIRequest::request('get',$url.$id, \Smartcoin\Smartcoin::access_keys());
      return new Plan(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());
  	}

  	public function save() {
  		$url = self::get_request_url();
      $params = $this->serializeParamenters();
      $r = \Smartcoin\APIRequest::request('post',$url.$this->id, \Smartcoin\Smartcoin::access_keys(), $params);
      $this->refresh_object(json_decode($r[0],true),$this->api_keys);
  	}

  	public function delete() {
  		$url = self::get_request_url();
      $r = \Smartcoin\APIRequest::request('delete',$url.$this->id, \Smartcoin\Smartcoin::access_keys());
      $this->refresh_object(json_decode($r[0],true),$this->api_keys);
      return json_decode($r[0],true); 
  	}
  }

?>