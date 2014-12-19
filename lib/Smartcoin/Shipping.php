<?php
	namespace Smartcoin;

  class Shipping {
  	static $shipping_url_base = 'https://shipping.Smartcoin.com.br';
  	public static function calculator($params) {
  		return json_decode(self::curl_request('get', '/shipping_calculator/', $params)[0], true);
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

  	private static function curl_request($method, $url, array $params = NULL){
      $ch = curl_init();
      $method = strtolower($method);
      $url = self::$shipping_url_base.$url;
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