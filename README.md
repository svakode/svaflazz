# Svaflazz 

This package will handle laravel integration to Digiflazz. Just provide the credentials and we will take care the rest.

Before using this package we highly recommend reading [the entire documentation on Digiflazz](https://developer.digiflazz.com/api/)

## Installation

Since we are using Guzzle 7.0, you need to make sure `guzzlehttp/guzzle` in your `composer.json` is at least `^7.0`.

You can install the package via composer:

```bash
composer require svakode/svaflazz
```

The service provider will automatically register itself.

You must publish the config file with:
```bash
php artisan vendor:publish --provider="Svakode\Svaflazz\SvaflazzServiceProvider"
```

This is the contents of the config file that will be published at `config/svaflazz.php`:

```php
return [
    /*
    * Digiflazz will require you to request username and key
    * these will be used for making a request to digiflazz
    */
    'username' => env('DIGIFLAZZ_USERNAME'),
    'key' => env('DIGIFLAZZ_KEY'),

    /*
    * Digiflazz Base URL
    */
    'base_url' => env('DIGIFLAZZ_BASE_URL', 'https://api.digiflazz.com/v1'),
];
```

## Usage

Digiflazz have several features which we supported, these features are:

#### Check Balance

This feature is for retrieving the balance of the user

```
Svaflazz::checkBalance();
```

#### Deposit

This feature is for creating a deposit ticket to Digiflazz, in this feature you need to provide us:

| Parameter   | Required    | Description |
| ----------- | ----------- | ----------- |
| amount      | yes         | Deposit amount|
| bank        | yes         | Bank name|
| owner_name  | yes         | Owner name for the bank account |

```
Svaflazz::deposit($amount, $bank, $owner_name);
```

#### Price List

This feature is for retrieving the price list in Digiflazz.

```
Svaflazz::priceList();
```

#### Topup

This feature is for doing a prepaid transaction in Digiflazz. you need to provide us

| Parameter     | Required    | Description |
| ------------  | ----------- | ----------- |
| buyer_sku_code| yes         | Product SKU|
| customer_no   | yes         | Customer number |
| ref_id        | yes         | Reference ID |
| msg           | no          | Transaction message |

```
Svaflazz::topup($buyer_sku_code, $customer_no, $ref_id);
```

#### Check Bill

This feature is for checking whether postpaid bill already issued in Digiflazz. you need to provide us

| Parameter     | Required    | Description |
| ------------  | ----------- | ----------- |
| buyer_sku_code| yes         | Product SKU|
| customer_no   | yes         | Customer number |
| ref_id        | yes         | Reference ID |

```
Svaflazz::checkBill($buyer_sku_code, $customer_no, $ref_id);
```

#### Pay Bill

This feature is for paying a postpaid bill in Digiflazz. you need to provide us

| Parameter     | Required    | Description |
| ------------  | ----------- | ----------- |
| buyer_sku_code| yes         | Product SKU|
| customer_no   | yes         | Customer number |
| ref_id        | yes         | Reference ID |

```
Svaflazz::payBill($buyer_sku_code, $customer_no, $ref_id);
```

#### Check Status Bill

This feature is for checking the payment status of a postpaid bill in Digiflazz. you need to provide us

| Parameter     | Required    | Description |
| ------------  | ----------- | ----------- |
| buyer_sku_code| yes         | Product SKU|
| customer_no   | yes         | Customer number |
| ref_id        | yes         | Reference ID |

```
Svaflazz::checkStatusBill($buyer_sku_code, $customer_no, $ref_id);
```

#### Inquiry PLN

This feature is for inquiring PLN bill in Digiflazz. you need to provide us

| Parameter     | Required    | Description |
| ------------  | ----------- | ----------- |
| customer_no   | yes         | Customer number |

```
Svaflazz::inquiryPLN($customer_no);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information about what has changed recently.

## Credits

- [Hansen Edrick Harianto](https://github.com/Fillirio)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
