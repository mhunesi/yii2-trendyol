Yii2 Trendyol
============
Yii2 Trendyol api client

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mhunesi/yii2-trendyol "*"
```

or add

```
"mhunesi/yii2-trendyol": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
'trendyol' => [
                'class' => \mhunesi\trendyol\Trendyol::class,
                'supplierId' => 'supplierId',
                'isTestStage' => true,
                'apiKey' => 'apiKey',
                'apiSecret' => 'apiSecret',
                'clientOptions' => [ //guzzle client options
                    'debug' => false
                ]
              ],

'i18n' => [
            'translations' => [
                'trendyol' => [
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@mhunesi/trendyol/messages',
                ],
            ],
          ]

```