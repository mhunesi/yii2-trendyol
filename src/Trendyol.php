<?php

namespace mhunesi\trendyol;

use Yii;
use GuzzleHttp\Client;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use mhunesi\trendyol\service\FinanceService;
use mhunesi\trendyol\service\LabelService;
use mhunesi\trendyol\service\OrderService;
use mhunesi\trendyol\service\ProductService;
use mhunesi\trendyol\service\QuestionService;
use mhunesi\trendyol\service\ReturnService;


/**
 * @property-read ProductService $product
 * @property-read OrderService $order
 * @property-read ReturnService $return
 * @property-read QuestionService $question
 * @property-read FinanceService $finance
 * @property-read LabelService $label
 */
class Trendyol extends Component
{
    /**
     * @var string
     */
    public $apiKey;

    /**
     * @var string
     */
    public $apiSecret;

    /**
     * @var string
     */
    public $supplierId;

    /**
     * @var boolean
     */
    public $isTestStage;

    /**
     * @var bool
     */
    public $log = true;
    /**
     * @var bool
     */
    public $logTarget = [
        'class' => '\yii\log\FileTarget',
        'logFile' => '@runtime/logs/trendyol.log',
        'categories' => ['mhunesi\trendyol\*'],
        'logVars' => [],
    ];

    public $clientOptions = [];

    /**
     * @var Client|array
     */
    public $client;

    /** @var string */
    public $base_uri = null;

    /**
     * @var array
     */
    private $services = [
        'product' => 'mhunesi\trendyol\service\ProductService',
        'order' => 'mhunesi\trendyol\service\OrderService',
        'return' => 'mhunesi\trendyol\service\ReturnService',
        'question' => 'mhunesi\trendyol\service\QuestionService',
        'finance' => 'mhunesi\trendyol\service\FinanceService',
        'label' => 'mhunesi\trendyol\service\LabelService',
    ];

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->initClient();

        if (!empty($this->logTarget)) {
            Yii::$app->getLog()->targets['trendyol'] = Yii::createObject($this->logTarget);
        }
    }

    public function initClient()
    {
        $baseUri = $this->base_uri ?? ($this->isTestStage ? "https://stageapi.trendyol.com/stagesapigw/" : "https://api.trendyol.com/sapigw/");

        $clientOptions = [
            'base_uri' => $baseUri,
            'auth' => [$this->apiKey,$this->apiSecret],
            'headers'=>[
                "User-Agent"=> $this->apiKey." - "."SelfIntegration",
                "Content-Type" => "application/json",
                "Accept" => "application/json"
            ]
        ];

        $this->client = new Client(ArrayHelper::merge($this->clientOptions,$clientOptions));
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->services)) {
            if (!is_object($this->services[$name])) {
                $this->services[$name] = Yii::createObject([
                    'class' => $this->services[$name],
                    'client' => $this->client,
                    'api' => $this,
                ]);
            }
            return $this->services[$name];
        }
        return parent::__get($name);
    }

    /**
     * @param string|array $message
     * @param string $category
     */
    public function log($message, string $category = 'mhunesi\trendyol'): void
    {
        if($this->log){
            Yii::info($message, $category);
        }
    }
}
