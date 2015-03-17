[![Build Status](https://travis-ci.org/smartcoinpayments/smartcoin-php.svg?branch=master)](https://travis-ci.org/smartcoinpayments/smartcoin-php)
[![Latest Stable Version](https://poser.pugx.org/smartcoin/smartcoin-php/v/stable.svg)](https://packagist.org/packages/smartcoin/smartcoin-php)
[![License](https://poser.pugx.org/smartcoin/smartcoin-php/license.svg)](https://packagist.org/packages/smartcoin/smartcoin-php)

Crie sua conta na <a href="https://smartcoin.com.br/" target="_blank">Smartcoin</a>.

Vamos fazer
===============

Exemplo de uso:

```php
\Smartcoin\Smartcoin::api_key('pk_test_407d1f51a61756');
\Smartcoin\Smartcoin::api_secret('sk_test_86e4486a0078b2');

//Credit Card Charge without token as card param
try {
  $charge = \Smartcoin\Charge::create(array(
    'amount' => 100,
    'currency' => 'brl',
    'card' => array(
      'number' => '4242424242424242',
      'exp_month' => 10,
      'exp_year' => 15,
      'cvc' => '083'
    ),
    'description' => 'Smartcoin charge test for example@test.com'
  ));
  echo $charge->to_json();  
}catch(\Smartcoin\Error $e){
  echo json_encode($e->get_json_body());
}

//Credit Card Charge with token as card param
try {
  $charge = \Smartcoin\Charge::create(array(
    'amount' => 100,
    'currency' => 'brl',
    'card' => 'tok_434343434343434343434',
    'description' => 'Smartcoin charge test for example@test.com'
  ));
  echo $charge->to_json();  
}catch(\Smartcoin\Error $e){
  echo json_encode($e->get_json_body());
}

//Bank Slip Charge
try {
  $charge = \Smartcoin\Charge::create(array(
    'amount' => 1000,
    'currency' => 'brl',
    'type' => 'bank_slip'
  ));
  echo $charge->to_json();
}catch(\Smartcoin\Error $e){
  echo json_encode($e->get_json_body());
}

//Create Subscription
try {
  $customer = \Smartcoin\Customer::create(array(
    'email' => 'test@examplo.com',
    "card" => array('number' => 5454545454545454,
                    'exp_month' => 11,
                    'exp_year' => 2017,
                    'cvc' => 111,
                    'name' => 'Doctor Who')
      ));

  $sub = $customer->subscriptions()->create(array(
    'plan' => 'silver'
  ));
  echo $sub->to_json();
}catch(\Smartcoin\Error $e){
  echo json_encode($e->get_json_body());
}

```
Veja os <a href="https://github.com/smartcoinpayments/smartcoin-php/blob/master/test/Smartcoin/ChargeTest.php" target="_blank">testes</a> para mais exemplos.

Teste
=====

Para instalar a suite de teste, execute o <a href="https://packagist.org/packages/simpletest/simpletest" target="_blank">SimpleTest</a> via <a href="https://getcomposer.org/" target="_blank">Composer</a>:

```
composer update --dev
```

Para executar o teste:

```
php ./test/Smartcoin.php
```
