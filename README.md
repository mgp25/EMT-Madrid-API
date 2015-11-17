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
// esta es la unica funcion que a mi me sirve que es la que te dice
// cuantos minutos queden para que lleguen las linea/s a la parada
```

All functions returns Array objects.

More info. about the functions in the wiki.

## NOTE

`idClient` and `keyPass` are not required as i extracted them from the app. By default this will be used:

```php
  const IDCLIENT  = 'EMT.SERVICIOS.IPHONE.2.0';
  const PASSKEY   = 'DC352ADB-F31D-41E5-9B95-CCE11B7921F4';
```

But you if you have already your data, you can set it too:

```php
$bus = new EMTMadrid($idClient, $keyPass);
```

## License

The MIT License

Copyright (c) 2015-2016 mgp25

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
