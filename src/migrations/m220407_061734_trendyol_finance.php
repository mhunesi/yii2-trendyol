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
            'id' => $this->primaryKey()->unsigned(),
            'transactionDate' => $this->integer(),
            'barcode' => $this->string(),
            'transactionType' => $this->string(),
            'receiptId' => $this->string(),
            'description' => $this->string(),
            'debt' => $this->float(),
            'credit' => $this->float(),
            'paymentPeriod' => $this->integer(),
            'commissionRate' => $this->integer(),
            'orderNumber' => $this->string(),
            'paymentOrderId' => $this->string(),
            'paymentDate' => $this->integer(),
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
