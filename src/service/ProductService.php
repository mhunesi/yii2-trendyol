<?php
namespace mhunesi\trendyol\service;

use yii\helpers\Json;
use mhunesi\trendyol\config\Endpoints;
use mhunesi\trendyol\models\requestmodels\CreateUpdateRequestProductModel;


class ProductService extends BaseService
{
    /**
     * @param $page
     * @param $size
     * @return ProductService
     */
    public function products($page = 1,$size = 25)
    {
        return $this->get("suppliers/{$this->api->supplierId}/products",[
            'query' => [
                'page' => $page,
                'size' => $size
            ]
        ]);
    }    
    /**
     * productTransfer
     *
     * @param  CreateUpdateRequestProductModel $productRequest
     * @param  bool $isUpdate
     * @return TrendyolBaseResponseModel
     */
    public function productTransfer(CreateUpdateRequestProductModel $productRequest,$isUpdate=false)
    {
        //TODO: if(!$orderRequest->validate()) throw new \Exception($orderRequest->errors);
        $endpoint  = $this->getUrl(Endpoints::version."/".Endpoints::createProducts);
        $method = $isUpdate?"PUT":"POST";
        $payload = ['body'=> Json::encode($productRequest)];        
        return $this->request($method,$endpoint,$payload);
    }
    
    /**
     * checkBatchRequest
     *
     * @param  int $batchRequestId
     * @return TrendyolBaseResponseModel
     */
    public function checkBatchRequest($batchRequestId)
    {
        $endpoint  = $this->getUrl(str_replace("@batchRequestId",$batchRequestId,Endpoints::checkBatchRequest));
        return $this->request("GET",$endpoint);
    }    
    /**
     * listTrendyolCategories
     *
     * @return TrendyolBaseResponseModel
     */
    public function listTrendyolCategories()
    {
        $endpoint  = $this->getUrlWithoutSuppliers(Endpoints::categoryList);
        return $this->request("GET",$endpoint);
    }    
    /**
     * listTrendyolAttributes
     *
     * @param  int $categoriID
     * @return TrendyolBaseResponseModel
     */
    public function listTrendyolAttributes($categoriID)
    {
        $endpoint  = $this->getUrlWithoutSuppliers(str_replace("@categoriId",$categoriID,Endpoints::attributeList));
        return $this->request("GET",$endpoint);        
    }    
    /**
     * listTrendyolBrands
     *
     * @return TrendyolBaseResponseModel
     */
    public function listTrendyolBrands()
    {
        $endpoint  = $this->getUrlWithoutSuppliers(Endpoints::brands);
        return $this->request("GET",$endpoint);        
    }    
    /**
     * listProviders
     *
     * @return TrendyolBaseResponseModel
     */
    public function listProviders()
    {
        $endpoint  = $this->getUrlWithoutSuppliers(Endpoints::shipmentProviderList);
        return $this->request("GET",$endpoint);        
    }
    
    /**
     * getAddressesList
     *
     * @return TrendyolBaseResponseModel
     */
    public function getAddressesList()
    {
        $endpoint  = $this->getUrl(Endpoints::addresses);
        return $this->request("GET",$endpoint);
    }
    
    /**
     * updateStockAndPriceTransfer
     *
     * @param  array $listOfStockAndPriceItems
     * @return TrendyolBaseResponseModel
     */
    public function updateStockAndPriceTransfer($listOfStockAndPriceItems)
    {
        $endpoint  = $this->getUrl(Endpoints::priceAndInventory);
        $payload = ['body'=> Json::encode(["items"=>$listOfStockAndPriceItems])];        
        return $this->request("POST",$endpoint,$payload);
    }
    

/** #endregion Product  Proccess*/
}