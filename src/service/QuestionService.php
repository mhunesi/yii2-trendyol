<?php
namespace mhunesi\trendyol\service;

use yii\helpers\Json;
use mhunesi\trendyol\models\request\QuestionRequest;


class QuestionService extends BaseService
{
    /**
     * @return QuestionService
     */
    public function getQuestions(QuestionRequest $params)
    {
        return $this->get("suppliers/{$this->api->supplierId}/questions/filter",[
            'query' => $params->toArray()
        ]);
    }

    /**
     * @param $questionID
     * @param $answer
     * @return QuestionService
     */
    public function answerQuestion($questionID,$answer)
    {
        return $this->post("suppliers/{$this->api->supplierId}/questions/{$questionID}/answers",[
            'json' => ['text' => $answer]
        ]);
    }
}