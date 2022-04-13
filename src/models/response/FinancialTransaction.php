<?php

namespace mhunesi\trendyol\models\response;

/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 7.04.2022
 * @time: 09:09
 */
class FinancialTransaction extends \yii\base\Model
{
    public $id;
    public $transactionDate;
    public $barcode;
    public $transactionType;
    public $receiptId;
    public $description;
    public $debt;
    public $credit;
    public $paymentPeriod;
    public $commissionRate;
    public $orderNumber;
    public $paymentOrderId;
    public $paymentDate;
    public $sellerId;
    public $storeId;
    public $storeName;
    public $storeAddress;
}