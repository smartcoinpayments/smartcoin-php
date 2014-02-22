<?php
  namespace Navaska;

  class APIRequest {
    public static $api_base = 'http://localhost:3000';

    public static function request($method=null, $url=null, $api_keys=null, $params=null){
      if($method == NULL)
        throw new InvalidArgumentException("APIRequest::request has to have method");

      if($url == NULL)
        throw new InvalidArgumentException("APIRequest::request has to have url");

      if($api_keys == NULL)
        throw new InvalidArgumentException("APIRequest::request has to have api_keys");

      return self::curl_request($method, $url, $api_keys, $params);
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
      else{
        $opts[CURLOPT_POST] = 1;
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