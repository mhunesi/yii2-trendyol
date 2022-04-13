<?php

namespace mhunesi\trendyol\models\request;

use Yii;
use yii\base\Model;
use yii\behaviors\AttributesBehavior;
use mhunesi\trendyol\enums\OtherFinancialType;

class OtherFinancialRequest extends Model
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
     * Finansal işlem türüdür. SettlementType Enum
     * @var string
     */
    public $transactionType;

    public function attributeLabels()
    {
        return [
            'size' => Yii::t('trendyol','Size'),
            'page' => Yii::t('trendyol','Page'),
            'endDate' => Yii::t('trendyol','End Date'),
            'startDate' => Yii::t('trendyol','Start Date'),
            'transactionType' => Yii::t('trendyol','Transaction Type'),
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
            ['transactionType', 'in','range' => OtherFinancialType::getConstantsByName()]
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