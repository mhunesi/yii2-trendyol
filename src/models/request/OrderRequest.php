<?php
/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 12.04.2022
 * @time: 16:04
 */

namespace mhunesi\trendyol\models\request;

use mhunesi\trendyol\enums\OrderStatus;
use mhunesi\trendyol\enums\OtherFinancialType;
use yii\base\Model;
use yii\behaviors\AttributesBehavior;

class OrderRequest extends Model
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => AttributesBehavior::class,
                'attributes' => [
                    'startDate' => [
                        self::EVENT_AFTER_VALIDATE => [$this, 'dateConvert'],
                    ],
                    'endDate' => [
                        self::EVENT_AFTER_VALIDATE => [$this, 'dateConvert'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Belirli bir tarihten sonraki işlem kayıtlarını getirir. Timestamp milisecond olarak gönderilmelidir.
     * @var int
     */
    public $startDate;

    /**
     * Belirli bir tarihten sonraki işlem kayıtlarını getirir. Timestamp milisecond olarak gönderilmelidir.
     * @var int
     */
    public $endDate;

    /**
     * Sadece belirtilen sayfadaki bilgileri döndürür
     * @var int
     */
    public $page = 0;

    /**
     * Bir sayfada listelenecek maksimum adeti belirtir.
     */
    public $size = 500;

    /**
     * Sadece belirli bir sipariş numarası verilerek o siparişin bilgilerini getirir
     * @var string
     */
    public $orderNumber;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $orderByField;

    /**
     * @var string
     */
    public $orderByDirection;

    /**
     * @var string
     */
    public $shipmentPackageIds;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status' => Yii::t('trendyol','Order Status'),
            'size' => Yii::t('trendyol','Size'),
            'page' => Yii::t('trendyol','Page'),
            'endDate' => Yii::t('trendyol','End Date'),
            'startDate' => Yii::t('trendyol','Start Date'),
            'orderNumber' => Yii::t('trendyol','Order Number'),
            'orderByField' => Yii::t('trendyol','Order By Field'),
            'orderByDirection' => Yii::t('trendyol','Order By Direction'),
            'shipmentPackageIds' => Yii::t('trendyol','Shipment Package Id'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page', 'size'], 'number'],
            [['startDate', 'endDate'],'datetime','format' => 'Y-m-d'],
            [['startDate', 'endDate','transactionType'], 'required'],
            ['transactionType', 'in','range' => OrderStatus::getConstantsByName()],
            [['orderByField','status','orderNumber','orderByDirection','shipmentPackageIds'],'string'],
            ['orderByDirection','in','range' => ['ASC','DESC']],
        ];
    }

    public function dateConvert($event,$attribute)
    {
        if($this->$attribute){
            return strtotime($this->$attribute) * 1000;
        }

        return $this->$attribute;
    }
}