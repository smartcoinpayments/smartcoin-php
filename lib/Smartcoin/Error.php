<?php
  namespace Smartcoin;
  class Error extends \Exception {

    public function __construct($message=null, $http_status=null, $http_body=null, $json_body=null) {
      parent::__construct($message);
      $this->http_status = $http_status;
      $this->http_body = $http_body;
      $this->json_body = $json_body;
    }

    public function get_http_status() {
      return $this->http_status;
    }

    public function get_http_body() {
      return $this->http_body;
    }

    public function get_json_body() {
      return $this->json_body;
    }
  }

  class AuthenticationError extends Error {

  }

  class RequestError extends Error {

  }

  class InvalidArgumentException extends \Exception {
    public function __construct($message=null) {
      $this->message = $message;
    }

    public function message() {
      return $this->message;
    }
  }
?>