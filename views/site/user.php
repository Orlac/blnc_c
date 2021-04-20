<?php

use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */

$this->title = 'User balance ' . $user_id;
$this->params['breadcrumbs'][] = [
    'label' => 'All history', 
    'url' => ['index']];
?>
<div class="site-index">

    <h1>UserId <?=$user_id?>: <?=$balance?> </h1>

    <div class="body-content">

        <div class="row">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => false,
                'columns' => [
                    'value',
                    'balance',
                    [
                        'attribute' => 'created_at',
                        'value' => function($val){
                            return (new \DateTime($val->created_at))->format('d.m.Y H:i:s');
                        }
                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>

