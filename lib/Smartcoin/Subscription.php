<?php
namespace Smartcoin;
	
  class Subscription extends \Smartcoin\Object {
  	protected $customer;

  	public static function get_request_url($customer) {
      return "/v1/customers/{$customer}/subscriptions/";
    }

  	public function __construct($customer=null) {
  		$this->customer = $customer;
  		parent::__construct(array(), \Smartcoin\Smartcoin::access_keys());
  	}

  	public function create($params) {
  		if($this->customer==null)
        throw new InvalidArgumentException("Subscription::create has to have customer id");

  		$url = self::get_request_url($this->customer);
      $r = \Smartcoin\APIRequest::request('post',$url, \Smartcoin\Smartcoin::access_keys(), $params);
      $this->refresh_object(json_decode($r[0],true),\Smartcoin\Smartcoin::access_keys());
      return $this;
  	}

    public function retrieve($id) {
      if($this->customer==null)
        throw new InvalidArgumentException("Subscription::create has to have customer id");

      $url = self::get_request_url($this->customer);
      $r = \Smartcoin\APIRequest::request('get',$url.$id, \Smartcoin\Smartcoin::access_keys());
      $this->refresh_object(json_decode($r[0],true),\Smartcoin\Smartcoin::access_keys());
      return $this; 
    }

    public function delete() {
      $url = self::get_request_url($this->customer);
      $r = \Smartcoin\APIRequest::request('delete',$url.$this->id, \Smartcoin\Smartcoin::access_keys());
      $this->refresh_object(json_decode($r[0],true),$this->api_keys);
      return json_decode($r[0],true); 
    }

    public function list_all() {
      if($this->customer==null)
        throw new InvalidArgumentException("Subscription::create has to have customer id");

      $url = self::get_request_url($this->customer);
      $r = \Smartcoin\APIRequest::request('get',$url, \Smartcoin\Smartcoin::access_keys());
      $this->refresh_object(json_decode($r[0],true),\Smartcoin\Smartcoin::access_keys());
      return $this;  
    }
  }

?>