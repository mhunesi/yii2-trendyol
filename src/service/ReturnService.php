<?php

namespace mhunesi\trendyol\service;

use yii\base\Model;

class ReturnService extends BaseService
{
    /**
     * @param Model $model
     * @return ReturnService
     */
    public function getClaims(Model $model)
    {
        return $this->get("suppliers/{$this->api->supplierId}/claims", [
            'query' => $model->toArray()
        ]);
    }

    /**
     * @param $params
     * @return ReturnService
     */
    public function createClaim($params)
    {
        return $this->get("suppliers/{$this->api->supplierId}/claims/create", [
            'query' => $params
        ]);
    }

    /**
     * @return ReturnService
     */
    public function getClaimsIssueReasons()
    {
        return $this->get("claim-issue-reasons");
    }

    /**
     * @param $claimId
     * @param $params
     * @return ReturnService
     */
    public function approveClaim($claimId, $params)
    {
        return $this->put("claims/{$claimId}/items/approve", [
            'json' => $params
        ]);
    }

    /**
     * @param $claimId
     * @param $claimIssueReasonId
     * @param $claimItemIdList
     * @param $description
     * @return ReturnService
     */
    public function rejectClaim($claimId, $claimIssueReasonId, $claimItemIdList,$description)
    {
        return $this->post("claims/{$claimId}/issue?claimIssueReasonId={$claimIssueReasonId}&claimItemIdList={$claimItemIdList}&description={$description}");
    }
} 