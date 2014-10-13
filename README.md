Visit [Smartcoin](https://smartcoin.com.br/) to request an account.

Getting Started
===============

Sample usage:

```php
Smartcoin::api_key('pk_test_3ac0794848c339');
Smartcoin::api_secret('sk_test_8bec997b7a0ea1');
//Credit Card Charge
$card_params = array('number' => 4242424242424242,
              'exp_month' => 11,
              'exp_year' => 2017,
              'cvc' => 111);
$token = Token::create($card_params);
$charge_params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'card' => $token->id
        );
$charge = Charge::create($charge_params);
echo $charge->to_json();
//Bank Slip Charge
$charge_params = array(
          'amount' => 1000,
          'currency' => 'brl',
          'type' => 'bank_slip'
        );
$charge = Charge::create($charge_params);
echo $charge->to_json();
```

Test
====

In order to run the tests you have to install
[SimpleTest](https://packagist.org/packages/simpletest/simpletest) via
[Composer](https://getcomposer.org/):

```
composer update --dev
```

To run test the suite:

```
php ./test/Smartcoin.php
```
