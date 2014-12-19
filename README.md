[![Build Status](https://travis-ci.org/smartcoinpayments/smartcoin-php.svg?branch=master)](https://travis-ci.org/smartcoinpayments/smartcoin-php)

Visit [Smartcoin](https://smartcoin.com.br/) to request an account.

Vamos fazer
===============

Exemplo de uso:

```php
Smartcoin::api_key('pk_test_407d1f51a61756');
Smartcoin::api_secret('sk_test_86e4486a0078b2');

//Credit Card Charge
$charge = Charge::create(array(
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

//Bank Slip Charge
$charge = Charge::create(array(
  'amount' => 1000,
  'currency' => 'brl',
  'type' => 'bank_slip'
));
echo $charge->to_json();
```
Veja os [testes](https://github.com/smartcoinpayments/smartcoin-php/blob/master/test/SmartCoin/ChargeTest.php) para mais exemplos.

Teste
=====

Para executar os teste da suite de teste, instale [SimpleTest](https://packagist.org/packages/simpletest/simpletest) via
[Composer](https://getcomposer.org/):

```
composer update --dev
```

To run test the suite:

```
php ./test/Smartcoin.php
```
