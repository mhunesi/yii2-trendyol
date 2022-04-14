<?php

namespace mhunesi\trendyol\commands;

use Yii;
use yii\helpers\Console;
use yii\helpers\ArrayHelper;
use mhunesi\trendyol\enums\SettlementType;
use mhunesi\trendyol\enums\OtherFinancialType;
use mhunesi\trendyol\models\request\SettlementRequest;
use mhunesi\trendyol\models\request\OtherFinancialRequest;

/**
 * (developer comment)
 *
 * @link http://www.mustafaunesi.com.tr/
 * @copyright Copyright (c) 2022 Polimorf IO
 * @product PhpStorm.
 * @author : Mustafa Hayri ÜNEŞİ <mhunesi@gmail.com>
 * @date: 14.04.2022
 * @time: 08:38
 */
class TrendyolController extends \yii\console\Controller
{
    public function actionSettlement($startDate = null, $endDate = null)
    {
        if (!$startDate) {
            $startDate = new \DateTime();
            $startDate = $startDate->modify('-1 days')->format('Y-m-d');
        }

        if (!$endDate) {
            $endDate = new \DateTime();
            $endDate = $endDate->format('Y-m-d');
        }

        foreach (SettlementType::$list as $k => $item) {
            $result = $this->saveSettlementData($startDate, $endDate, $k);
        }

        Console::output("Settlement OK. {$startDate} {$endDate}");
    }

    private function saveSettlementData($startDate, $endDate, $settlementType)
    {

        $page = 0;
        Console::output("Sayfa: {$page} siparişler çekiliyor.. ($settlementType)");

        $result = Yii::$app->trendyol->finance->settlements(new SettlementRequest([
            'transactionType' => $settlementType,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => 500,
            'page' => $page
        ]));

        if ($result->status && ($data = $result->toArray()) && $data['content']) {

            Yii::$app->db->createCommand()->delete('trendyol_financial_transaction', [
                'and',
                ['between', 'transactionDate', $startDate, $endDate],
                ['=', 'transactionType', $settlementType]
            ])->execute();

            while ($data['totalPages'] > $page + 1) {
                $page++;
                Console::output("Sayfa: {$page} siparişler çekiliyor..");

                $result2 = Yii::$app->trendyol->finance->settlements(new SettlementRequest([
                    'transactionType' => $settlementType,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'size' => 500,
                    'page' => $page,
                ]));

                if ($result2->status) {
                    $data['content'] = ArrayHelper::merge($data['content'], $result2->toArray()['content']);
                }
            }

            $data['content'] = array_map(function ($e) use ($settlementType) {
                $e['transactionType'] = $settlementType;
                $e['transactionDate'] = date('Y-m-d H:i:s', (int)($e['transactionDate'] / 1000));
                $e['paymentDate'] = date('Y-m-d H:i:s', (int)($e['paymentDate'] / 1000));
                return $e;
            }, $data['content']);

            Yii::$app->db->createCommand()->batchInsert('trendyol_financial_transaction',
                array_keys($data['content'][0]), $data['content'])->execute();

            return $data;
        }

        //throw new \yii\console\Exception($result->getMessage());
    }

    public function actionOtherFinancials($startDate = null, $endDate = null)
    {
        if (!$startDate) {
            $startDate = new \DateTime();
            $startDate = $startDate->modify('-1 days')->format('Y-m-d');
        }

        if (!$endDate) {
            $endDate = new \DateTime();
            $endDate = $endDate->format('Y-m-d');
        }

        foreach (OtherFinancialType::$list as $k => $item) {
            $result = $this->saveOtherFinancials($startDate, $endDate, $k);
        }

        Console::output("Settlement OK. {$startDate} {$endDate}");
    }

    private function saveOtherFinancials($startDate, $endDate, $otherFinancialType)
    {

        $page = 0;
        Console::output("Sayfa: {$page} siparişler çekiliyor.. ($otherFinancialType)");

        $result = Yii::$app->trendyol->finance->otherFinancials(new OtherFinancialRequest([
            'transactionType' => $otherFinancialType,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => 500,
            'page' => $page
        ]));

        if ($result->status && ($data = $result->toArray()) && $data['content']) {

            Yii::$app->db->createCommand()->delete('trendyol_financial_transaction', [
                'and',
                ['between', 'transactionDate', $startDate, $endDate],
                ['=', 'transactionType', $otherFinancialType]
            ])->execute();

            while ($data['totalPages'] > $page + 1) {
                $page++;
                Console::output("Sayfa: {$page} siparişler çekiliyor..");

                $result2 = Yii::$app->trendyol->finance->otherFinancials(new SettlementRequest([
                    'transactionType' => $otherFinancialType,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                    'size' => 500,
                    'page' => $page,
                ]));

                if ($result2->status) {
                    $data['content'] = ArrayHelper::merge($data['content'], $result2->toArray()['content']);
                }
            }

            $data['content'] = array_map(function ($e) use ($otherFinancialType) {
                $e['transactionType'] = $otherFinancialType;
                $e['transactionDate'] = date('Y-m-d H:i:s', (int)($e['transactionDate'] / 1000));
                $e['paymentDate'] = date('Y-m-d H:i:s', (int)($e['paymentDate'] / 1000));
                return $e;
            }, $data['content']);

            Yii::$app->db->createCommand()->batchInsert('trendyol_financial_transaction',
                array_keys($data['content'][0]), $data['content'])->execute();

            return $data;
        }

        //throw new \yii\console\Exception($result->getMessage());
    }
}