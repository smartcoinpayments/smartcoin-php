<?php
namespace Smartcoin;

class Subscription extends \Smartcoin\Object
{
    protected $customer;

    public static function get_request_url($customer)
    {
        return "/v1/customers/{$customer}/subscriptions/";
    }

    public function __construct($params = null)
    {
        $this->customer = $params;
      if(is_array($params))
        $this->customer = $params['customer'];
      else
        $params = array();

      parent::__construct($params, \Smartcoin\Smartcoin::access_keys());
    }

    public function create($params) {
        if (empty($this->customer)) {
            throw new InvalidArgumentException("Subscription::create has to have customer id");
        }

        $url = self::get_request_url($this->customer);
        $r = \Smartcoin\APIRequest::request('post',$url, \Smartcoin\Smartcoin::access_keys(), $params);
        $this->refresh_object(json_decode($r[0],true),\Smartcoin\Smartcoin::access_keys());
        return $this;
    }

    public function retrieve($id)
    {
        if (empty($this->customer)) {
            throw new InvalidArgumentException("Subscription::create has to have customer id");
        }

        $url = self::get_request_url($this->customer);
        $r = \Smartcoin\APIRequest::request('get',$url.$id, \Smartcoin\Smartcoin::access_keys());
        $this->refresh_object(json_decode($r[0],true),\Smartcoin\Smartcoin::access_keys());
        return $this;
    }
    
    public function list_all()
    {
        if (empty($this->customer)) {
            throw new InvalidArgumentException("Subscription::create has to have customer id");
        }

        $url = self::get_request_url($this->customer);
        $r = \Smartcoin\APIRequest::request('get',$url, \Smartcoin\Smartcoin::access_keys());
        return new \Smartcoin\SmartList(json_decode($r[0],true), \Smartcoin\Smartcoin::access_keys());  
    }

    public function delete()
    {
        $url = self::get_request_url($this->customer);
        $r = \Smartcoin\APIRequest::request('delete',$url.$this->id, \Smartcoin\Smartcoin::access_keys());
        $this->refresh_object(json_decode($r[0],true),$this->api_keys);
        return json_decode($r[0],true);
    }
}
