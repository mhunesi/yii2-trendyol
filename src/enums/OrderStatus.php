<?php
/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 12.04.2022
 * @time: 16:11
 */

namespace mhunesi\trendyol\enums;

class OrderStatus extends BaseEnum
{
    public const CREATED = 'Created';

    public const PICKING = 'Picking';

    public const INVOICED = 'Invoiced';

    public const SHIPPED = 'Shipped';

    public const CANCELLED = 'Cancelled';

    public const DELIVERED = 'Delivered';

    public const UN_DELIVERED = 'UnDelivered';

    public const RETURNED = 'Returned';

    public const REPACK = 'Repack';

    public const UN_PACKED = 'UnPacked';

    public const UN_SUPPLIED = 'UnSupplied';

    public const AT_COLLECTION_POINT = 'AtCollectionPoint';

    public static $messageCategory = 'trendyol';

    public static $list = [
        self::CREATED => self::CREATED,
        self::PICKING => self::PICKING,
        self::INVOICED => self::INVOICED,
        self::SHIPPED => self::SHIPPED,
        self::CANCELLED => self::CANCELLED,
        self::DELIVERED => self::DELIVERED,
        self::UN_DELIVERED => self::UN_DELIVERED,
        self::RETURNED => self::RETURNED,
        self::REPACK => self::REPACK,
        self::UN_PACKED => self::UN_PACKED,
        self::UN_SUPPLIED => self::UN_SUPPLIED,
        self::AT_COLLECTION_POINT => self::AT_COLLECTION_POINT,
    ];

    public static $description = [
        self::CREATED => 'Müşterinin trendyol.com üzerinde siparişi oluşturduktan sonra ödeme onayından bekleyen siparişler için bu statü dönmektedir. (Bu statüdeki siparişler "Created" statüsüne geçene kadar herhangi bir işlem yapmamanız gerekmektedir. Sadece stok güncellemeleri için bu statüyü kullanabilirsiniz.)',
        self::PICKING => 'Sipariş gönderime hazır statüsünde olduğu zaman dönmektedir.',
        self::INVOICED => 'Sizin tarafınızdan iletilebilecek bir statüdür. Siparişi toplamaya başladığınız zaman veya paketi hazırlamaya başladığınız zaman iletebilirsiniz.',
        self::SHIPPED => 'Siparişin faturasını kestiğiniz zaman bize iletebileceğiniz statüdür.',
        self::CANCELLED => 'İptal edilen siparişlerdir.',
        self::DELIVERED => 'Teslim edilen siparişlerdir.',
        self::UN_DELIVERED => 'Sipariş müşteriye ulaştırılamadığı zaman dönen bilgisidir.',
        self::RETURNED => 'İade edilen siparişlerdir.',
        self::REPACK => 'Yeniden paketlendiğini ifade eder.',
        self::UN_PACKED => 'Paketlenmemiş',
        self::UN_SUPPLIED => 'Tedarik Edilemeyen',
        self::AT_COLLECTION_POINT => 'Ürün ilgili PUDO teslimat noktasındadır. Müşterinin PUDO noktasına giderek teslim alması beklenmektedir.',
    ];
}