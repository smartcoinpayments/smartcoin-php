<?php
  namespace Smartcoin;

  class APIRequest {
    public static $api_base = 'https://api.smartcoin.com.br';

    public static function request($method=null, $url=null, $api_keys=null, $params=null){
      if($method == NULL)
        throw new InvalidArgumentException("APIRequest::request has to have method");

      if($url == NULL)
        throw new InvalidArgumentException("APIRequest::request has to have url");

      if($api_keys == NULL)
        throw new InvalidArgumentException("No API Keys");

      $response = self::curl_request($method, $url, $api_keys, $params);
      $body = $response[0];
      $code = $response[1];
      if($code < 200 || $code >= 300){
        self::handler_error($code, $body, $response);
      }
      return $response;
    }

    public static function handler_error($code, $body, $response){
      $json = json_decode($response[0],true);
      switch ($code) {
        case 400:
        case 404:
          $error = $json['error'];
          throw new \Smartcoin\RequestError($error['message'], $code, $body, $json);
        case 401:
          throw new \Smartcoin\AuthenticationError($response[0], $code, $body, $json);
        case 402:
          $error = $response['error'];
          throw new \Smartcoin\Error($error['message'], $code, $body, $json);
        default:
          throw new \Smartcoin\Error($response[0], $code, $body, $json);
      }
    }

    public static function encode($arr, $prefix=null) {
      if (!is_array($arr))
        return $arr;

      $r = array();
      foreach ($arr as $k => $v) {
        if (is_null($v))
          continue;

        if ($prefix && $k && !is_int($k))
          $k = $prefix."[".$k."]";
        else if ($prefix)
          $k = $prefix."[]";

        if (is_array($v)) {
          $r[] = self::encode($v, $k, true);
        } else {
          $r[] = urlencode($k)."=".urlencode($v);
        }
      }

      return implode("&", $r);
    }

    private static function curl_request($method, $url, $api_keys, array $params = NULL){
      $ch = curl_init();
      $method = strtolower($method);
      $url = self::$api_base.$url;
      $opts = array();

      if($method == 'get') {
        if($params != NULL){
          $encoded_params = self::encode($params);
          $url = "${url}?${encoded_params}";
        }
        $opts[CURLOPT_HTTPGET] = 1;
      }

      
      if($method == 'post'){
        $opts[CURLOPT_POST] = 1;
        $opts[CURLOPT_POSTFIELDS] = self::encode($params);
      }

      if($method == 'delete'){
        $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        $opts[CURLOPT_POSTFIELDS] = self::encode($params);
      }

      $opts[CURLOPT_URL] = $url;
      $opts[CURLOPT_USERPWD] = $api_keys;
      $opts[CURLOPT_HEADER] = 0;
      $opts[CURLOPT_RETURNTRANSFER] = true;
      $opts[CURLOPT_CONNECTTIMEOUT] = 30;
      $opts[CURLOPT_TIMEOUT] = 80;

      curl_setopt_array($ch, $opts);
      if( !$rbody = curl_exec($ch)) {
        trigger_error(curl_error($ch));
      }

      $rcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);

      return array($rbody, $rcode);
    }
  }

?>