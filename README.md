# FlexPay PHP Client

A simple PHP client for interacting with the FlexPay API.

## Installation

Use Composer to install the package:

```bash
composer require tresor/flexpay-php-php
```

## Usage

```php
$clients = new \Tresor\Flexpay\FlexPayClient(
    'client',
    'apikey',
    'baseUrl',
);

$data = new \Tresor\Flexpay\Data\PaymentData(
    'merchant',
    'reference',
    'customer',
    'amount',
    Tresor\Flexpay\Data\Currency::USD,
    'description'
);

$request = $clients->process($data->toJson())

```

### Step 5: Publish
