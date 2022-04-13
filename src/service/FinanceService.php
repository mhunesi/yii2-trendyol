<?php

namespace mhunesi\trendyol\service;

use mhunesi\trendyol\config\Endpoints;
use mhunesi\trendyol\models\basemodels\TrendyolBaseResponseModel;
use mhunesi\trendyol\models\request\OtherFinancialRequest;
use mhunesi\trendyol\models\request\SettlementRequest;

class FinanceService extends BaseService
{
    public function init()
    {
        $subdomain = $this->api->isTestStage ? 'stageapi' : 'api';

        $this->api->base_uri = "https://{$subdomain}.trendyol.com/integration/finance/che/sellers/";

        $this->api->initClient();

        $this->client = $this->api->client;
    }

    /**
     * @param SettlementRequest $model
     * @return $this
     */
    public function settlements(SettlementRequest $model): FinanceService
    {
        if (!$model->validate()) {
            $this->status = false;
            $this->message = $model->getErrorSummary(true)[0] ?? '';
            return $this;
        }

        return $this->get("{$this->api->supplierId}/settlements", [
            'query' => $model->toArray()
        ]);
    }

    /**
     * @param OtherFinancialRequest $model
     * @return $this
     */
    public function otherFinancials(OtherFinancialRequest $model): FinanceService
    {
        if (!$model->validate()) {
            $this->status = false;
            $this->message = $model->getErrorSummary(true)[0] ?? '';
            return $this;
        }

        return $this->get("{$this->api->supplierId}/otherfinancials", [
            'query' => $model->toArray()
        ]);
    }
}