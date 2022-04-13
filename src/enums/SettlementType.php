<?php
/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2021 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 30.12.2021
 * @time: 12:08
 */

namespace mhunesi\trendyol\enums;

class SettlementType extends BaseEnum
{
    public const SALE = 'Sale';

    public const RETURN = 'Return';

    public const DISCOUNT = 'Discount';

    public const DISCOUNT_CANCEL = 'DiscountCancel';

    public const COUPON = 'Coupon';

    public const COUPON_CANCEL = 'CouponCancel';

    public const PROVISION_POSITIVE = 'ProvisionPositive';

    public const PROVISION_NEGATIVE = 'ProvisionNegative';

    public static $messageCategory = 'trendyol';

    public static $list = [
        self::SALE => self::SALE,
        self::RETURN => self::RETURN,
        self::DISCOUNT => self::DISCOUNT,
        self::DISCOUNT_CANCEL => self::DISCOUNT_CANCEL,
        self::COUPON => self::COUPON,
        self::COUPON_CANCEL => self::COUPON_CANCEL,
        self::PROVISION_POSITIVE => self::PROVISION_POSITIVE,
        self::PROVISION_NEGATIVE => self::PROVISION_NEGATIVE,
    ];

    public static $description = [
        self::SALE => 'Siparişlere ait satış kayıtlarını verir',
        self::RETURN => 'Siparişlere ait iade kayıtlarını verir',
        self::DISCOUNT => 'Tedarikçi tarafından karşılanan indirim tutarını gösterir.',
        self::DISCOUNT_CANCEL => 'Ürün iptal veya iade olduğunda atılan kayıttır. İndirim kaydının tersi olarak düşünülebilir',
        self::COUPON => 'Tedarikçi tarafından karşılanan kupon tutarını gösterir.',
        self::COUPON_CANCEL => 'Ürün iptal veya iade olduğunda atılan kayıttır. Kupon kaydının tersi olarak düşünülebilir',
        self::PROVISION_POSITIVE => 'Gramaj farkından dolayı oluşan tutarlar Provizyon kaydı olarak atılır. Sipariş iptal veya iade olduğunda birbirinin tersi olarak kayıt atılır.',
        self::PROVISION_NEGATIVE => 'Gramaj farkından dolayı oluşan tutarlar Provizyon kaydı olarak atılır. Sipariş iptal veya iade olduğunda birbirinin tersi olarak kayıt atılır.',
    ];

}