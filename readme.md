
![Build](https://img.shields.io/badge/build-passing-brightgreen)
[![Total Downloads](https://img.shields.io/packagist/dt/evrenonur/numbertostring.svg)](https://packagist.org/packages/evrenonur/numbertostring)
# Sayıyı Metne Çevirme

Faturalarınız vb işleriniz için fatura tutarını 4 farklı para biriminde ['TL', 'EUR', 'USD', 'GBP'] metin olarak çevirebilirsiniz.





## Kurulum

```
composer require evrenonur/numbertostring
```


## Kullanım
```php
<?php


use Evrenonur\NumberToString;

require_once "vendor/autoload.php";
$num = new NumberToString();
//['TL', 'EUR', 'USD', 'GBP']
echo $num->numberToString("1230000.11", "TL");

```

## Örnek Çıktı
```text
Bir Milyon İki Yüz Otuz Bin Türk Lirası On Bir Kuruş
```




## Geri Bildirim

Herhangi bir geri bildiriminiz varsa, lütfen onur.evren.1999@gmail.com adresinden bana ulaşın.


## Lisans

[MIT](https://choosealicense.com/licenses/mit/)

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
