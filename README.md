# ![img](https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/EMT_Madrid_Logo.svg/41px-EMT_Madrid_Logo.svg.png) EMT Madrid API [![Latest Stable Version](https://poser.pugx.org/mgp25/emtmadrid/v/stable)](https://packagist.org/packages/mgp25/emtmadrid) ![compatible](https://img.shields.io/badge/PHP%207-Compatible-brightgreen.svg) ![license](https://img.shields.io/badge/License-MIT-blue.svg)


**Do you like this project? Support it by donating**
- ![Paypal](https://raw.githubusercontent.com/reek/anti-adblock-killer/gh-pages/images/paypal.png) Paypal: [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=YNVNPLE45DNG6)
- ![btc](https://camo.githubusercontent.com/4bc31b03fc4026aa2f14e09c25c09b81e06d5e71/687474703a2f2f7777772e6d6f6e747265616c626974636f696e2e636f6d2f696d672f66617669636f6e2e69636f) Bitcoin: 1DCEpC9wYXeUGXS58qSsqKzyy7HLTTXNYe

----------
## Installation

### Using Composer

```sh
composer require mgp25/emtmadrid
```

```php
require __DIR__.'/../vendor/autoload.php';

$bus = new \EMTMadrid\EMTMadrid();
```

If you want to test new and possibly unstable code that is in the master branch, and which hasn't yet been released, then you can use master instead (at your own risk):

```sh
composer require mgp25/emtmadrid dev-master
```

### I don't have Composer

You can download it [here](https://getcomposer.org/download/).

## Examples

All examples can be found [here](https://github.com/mgp25/EMT-Madrid-API/tree/master/examples).

## Code of Conduct

This project adheres to the Contributor Covenant [code of conduct](CODE_OF_CONDUCT.md).
By participating, you are expected to uphold this code.
Please report any unacceptable behavior.

## License

The MIT License
