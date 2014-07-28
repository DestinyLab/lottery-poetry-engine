# Lottery-Poetry-Engine

[![Build Status](https://travis-ci.org/DestinyLab/lottery-poetry-engine.svg)](https://travis-ci.org/DestinyLab/lottery-poetry-engine)

Lottery-Poetry-Engine is the engine of lottery poetry.

## Requirement

 - PHP >=5.4

## Installing via Composer

The recommended way to install Lottery-Poetry-Engine is through Composer.

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, update your project's composer.json file to include Lottery-Poetry-Engine:

```json
{
    "require": {
        "destinylab/lottery-poetry-engine": "dev-master"
    }
}
```

## Usage

```php
<?php

require_once 'vendor/autoload.php';

$suit = new DestinyLab\LotteryPoetry\Suit([__DIR__.'/resources/'], 'yml');
$suit->get(1);
$suit->total();
$suit->getList();

$engine = new DestinyLab\LotteryPoetry\Engine($suit);

// get contents
$engine->draw();

// get only key
$engine->draw(true);
```

## License

MIT