<?php

namespace app\controllers;

use Yii;
use app\models\WeatherForm;
use nizsheanez\jsonRpc\Client;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $history = Yii::$app->apiClient->send('balance.history', [
            'limit' => Yii::$app->request->get('per-page', 50),
            'page' => Yii::$app->request->get('page'),
        ]);
        $dataProvider = new ArrayDataProvider([
            'models' => $history->items,
            'pagination' => [
                'totalCount' => $history->_meta->totalCount,
                'page' => $history->_meta->currentPage - 1,
                'pageSize' => $history->_meta->perPage,
            ] ,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUser($user_id)
    {
        $history = Yii::$app->apiClient->send('balance.history', [
            'limit' => Yii::$app->request->get('per-page', 50),
            'page' => Yii::$app->request->get('page'),
            'user_id' => $user_id,
        ]);
        $balance = Yii::$app->apiClient->send('balance.user-balance', [
            'user_id' => $user_id
        ]);
        $dataProvider = new ArrayDataProvider([
            'models' => $history->items,
            'pagination' => [
                'totalCount' => $history->_meta->totalCount,
                'page' => $history->_meta->currentPage - 1,
                'pageSize' => $history->_meta->perPage,
            ] ,
        ]);
        
        return $this->render('user', [
            'dataProvider' => $dataProvider,
            'balance' => $balance,
            'user_id' => $user_id,
        ]);
    }

}
