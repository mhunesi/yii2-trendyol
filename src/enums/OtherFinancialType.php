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

class OtherFinancialType extends BaseEnum
{
    public const CASH_ADVANCE = 'CashAdvance';

    public const WIRE_TRANSFER = 'WireTransfer';

    public const INCOMING_TRANSFER = 'IncomingTransfer';

    public const RETURN_INVOICE = 'ReturnInvoice';

    public const COMMISSION_AGREEMENT_INVOICE = 'CommissionAgreementInvoice';

    public const PAYMENT_ORDER = 'PaymentOrder';

    public const DEDUCTION_INVOICES = 'DeductionInvoices';

    public static $messageCategory = 'trendyol';

    public static $list = [
        self::CASH_ADVANCE => self::CASH_ADVANCE,
        self::WIRE_TRANSFER => self::WIRE_TRANSFER,
        self::INCOMING_TRANSFER => self::INCOMING_TRANSFER,
        self::RETURN_INVOICE => self::RETURN_INVOICE,
        self::COMMISSION_AGREEMENT_INVOICE => self::COMMISSION_AGREEMENT_INVOICE,
        self::PAYMENT_ORDER => self::PAYMENT_ORDER,
        self::DEDUCTION_INVOICES => self::DEDUCTION_INVOICES,
    ];


    public static $description = [
        self::CASH_ADVANCE => 'Vadesi henüz gelmemiş hakedişler için erken ödeme alındığında atılan kayıttır.',
        self::WIRE_TRANSFER => 'Trendyol ile Tedarikçi arasında yapılan virman için atılan kayıttır.',
        self::INCOMING_TRANSFER => 'Borçlu durumundaki tedarikçiden, Trendyola yapılan ödemeler için atılan kayıttır',
        self::RETURN_INVOICE => 'Tedarikçiden Trendyola kesilen iade faturalarıdır. Bakiyeyi + olarak etkiler.',
        self::COMMISSION_AGREEMENT_INVOICE => 'Tedarikçinin mahsuplaşma yapılacak alacağı olmadığı durumda, iade gelen ürünler için tedarikçiden alınan komisyon mutabakat faturasıdır.',
        self::PAYMENT_ORDER => 'Vadesi gelen işlemlerden hesaplanarak tedarikçiye yapılan hakediş ödemesidir',
        self::DEDUCTION_INVOICES => 'Trendyol tarafından sağlanan hizmetler için tedarikçiye kesilen faturadır.',
    ];

}