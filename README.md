Visit [Smartcoin](https://smartcoin.com.br/) to request an account.

Vamos fazer
===============

Exemplo de uso:

```php
Smartcoin::api_key('pk_test_3ac0794848c339');
Smartcoin::api_secret('sk_test_8bec997b7a0ea1');

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
