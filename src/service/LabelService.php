<?php

namespace mhunesi\trendyol\service;


class LabelService extends BaseService
{
    /**
     * @param $boxQuantity
     * @return LabelService
     */
    public function createLabel($trackingNumber, $boxQuantity)
    {
        return $this->post("/suppliers/{$this->api->supplierId}/common-label/{$trackingNumber}?format=ZPL", [
            'json' => [
                'boxQuantity' => $boxQuantity
            ]
        ]);
    }

    /**
     * @param $trackingNumber
     * @return LabelService
     */
    public function getLabel($trackingNumber)
    {
        return $this->get("/suppliers/{$this->api->supplierId}/common-label/v2/{$trackingNumber}");
    }
}