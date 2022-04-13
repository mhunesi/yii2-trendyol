<?php
namespace mhunesi\trendyol\service;

use yii\base\Exception;
use mhunesi\trendyol\models\request\OrderRequest;

class OrderService extends BaseService
{
    /**
     * @param $params
     * @return OrderService
     */
    public function create($params)
    {
        return $this->post('https://stageapi.trendyol.com/integration/oms/core',[
            'json' => $params
        ]);
    }

    /**
     * @param OrderRequest $orderRequest
     * @return OrderService
     * @throws Exception
     */
    public function orders(OrderRequest $orderRequest)
    {
        if(!$orderRequest->validate()){
            $this->status = false;
            $this->message = $orderRequest->getErrorSummary(true)[0] ?? '';
        }

        return $this->get("suppliers/{$this->api->supplierId}/orders",[
            'query' => $orderRequest->toArray()
        ]);
    }

    /**
     * @param $shipmentPackageId
     * @param $trackingNumber
     * @return OrderService
     */
    public function updateTrackingNumber($shipmentPackageId,$trackingNumber)
    {
        return $this->put("suppliers/{$this->api->supplierId}/{$shipmentPackageId}/update-tracking-number",[
            'json' => ['trackingNumber' => $trackingNumber]
        ]);
    }

    /**
     * Case: Picking
     * {
     *   "lines": [{
     *   "lineId": {lineId},
     *   "quantity": 3
     * }],
     * "params": {},
     * "status": "Picking"
     * }
     *
     *
     * Case: Invoiced
     * {
     *   "lines": [{
     *   "lineId": {lineId},
     *   "quantity": 3
     * }],
     * "params": {
     *   "invoiceNumber": "EME2018000025208"
     * },
     * "status": "Invoiced"
     * }
     *
     * @param $shipmentPackageId
     * @param $params
     * @return OrderService
     */
    public function updatePackageStatus($shipmentPackageId, $params)
    {
        return $this->put("suppliers/{$this->api->supplierId}/shipment-packages/{$shipmentPackageId}",[
            'json' => $params
        ]);
    }

    /**
     * Params
     * {
     *   "lines": [{
     *   "lineId": {lineId},
     *   "quantity": 0
     * }],
     * "reasonId": ReasonType Enum
     * }
     *
     * @param $shipmentPackageId
     * @param $params
     * @return OrderService
     */
    public function procurementFailures($shipmentPackageId, $params)
    {
        $domain = $this->api->isTestStage ? 'stageapi'  : 'api';

        return $this->put("https://{$domain}.trendyol.com/integration/oms/core/sellers/{$this->api->supplierId}/shipment-packages/{$shipmentPackageId}/items/unsupplied",[
            'json' => $params
        ]);
    }

    /**
     * @param $shipmentPackageId
     * @param $params
     * @return OrderService
     */
    public function splitOrderPackage($shipmentPackageId, $params)
    {
        return $this->post("suppliers/{$this->api->supplierId}/shipment-packages/{$shipmentPackageId}/split-packages",[
            'json' => $params
        ]);
    }

    /**
     * @param $shipmentPackageId
     * @param $cargoProvider
     * @return OrderService
     */
    public function changeCargoCompany($shipmentPackageId, $cargoProvider)
    {
        return $this->put("suppliers/{supplierId}/shipment-packages/{shipmentPackageId}/cargo-providers",[
            'json' => ['cargoProvider' => $cargoProvider]
        ]);
    }
}