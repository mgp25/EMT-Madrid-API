# ![img](https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/EMT_Madrid_Logo.svg/41px-EMT_Madrid_Logo.svg.png) EMT Madrid API
PHP wrapper for EMT Madrid

![license](https://img.shields.io/badge/License-MIT-blue.svg)

> Composer package available.

## Requirements

- PHP 5.3 or higher
- cURL

## Donate

**Do you like this project? Support it by donating**
- ![Paypal](https://raw.githubusercontent.com/reek/anti-adblock-killer/gh-pages/images/paypal.png) Paypal: [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YNVNPLE45DNG6)
- ![btc](https://camo.githubusercontent.com/4bc31b03fc4026aa2f14e09c25c09b81e06d5e71/687474703a2f2f7777772e6d6f6e747265616c626974636f696e2e636f6d2f696d672f66617669636f6e2e69636f) Bitcoin: 1DCEpC9wYXeUGXS58qSsqKzyy7HLTTXNYe

## Usage

```php
<?php

require_once 'EMTMadrid.php';

$bus = new EMTMadrid();
$bus->getEstimatesIncident('680'); // numero de la parada || bus stop number
```

All functions returns Array objects.

More info. about the functions in the wiki.

## License
MIT
