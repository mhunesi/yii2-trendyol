<?php

use yii\db\Migration;

/**
 * Class m220407_061734_trendyol_finance
 */
class m220407_061734_trendyol_finance extends Migration
{
    public $tableName = '{{%trendyol_financial_transaction}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->string(50)->unique(),
            'transactionDate' => $this->dateTime(0),
            'barcode' => $this->string(),
            'transactionType' => $this->string(),
            'receiptId' => $this->string(),
            'description' => $this->string(),
            'debt' => $this->float(),
            'credit' => $this->float(),
            'commissionAmount' => $this->float(),
            'sellerRevenue' => $this->float(),
            'paymentPeriod' => $this->integer(),
            'commissionRate' => $this->integer(),
            'orderNumber' => $this->string(),
            'paymentOrderId' => $this->string(),
            'paymentDate' => $this->dateTime(0),
            'sellerId' => $this->integer(),
            'storeId' => $this->integer(),
            'storeName' => $this->string(),
            'storeAddress' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
