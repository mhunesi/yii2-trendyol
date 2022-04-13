<?php
/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 13.04.2022
 * @time: 11:31
 */

namespace mhunesi\trendyol\enums;

class ReasonType extends BaseEnum
{
    public const OUT_OF_STOCK = 500;

    public const DEFECTIVE_PRODUCT = 501;

    public const INCORRECT_PRICE = 502;

    public const INTEGRATION_ERROR = 504;

    public const BULK_PURCHASE = 505;

    public const FORCE_MAJEURE = 506;

    public static $messageCategory = 'trendyol';

    protected static $list = [
        self::OUT_OF_STOCK => 'Out Of Stock',
        self::DEFECTIVE_PRODUCT => 'Defective Product',
        self::INCORRECT_PRICE => 'Incorrect Price',
        self::INTEGRATION_ERROR => 'Integration Error',
        self::BULK_PURCHASE => 'Bulk Purchase',
        self::FORCE_MAJEURE => 'Force Majeure',
    ];

}