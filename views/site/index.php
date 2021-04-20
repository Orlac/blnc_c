<?php

use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */

$this->title = 'History';
?>
<div class="site-index">


    <div class="body-content">

        <div class="row">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => false,
                'columns' => [
                    [
                        'attribute' => 'user_id',
                        'value' => function($val){
                            return Html::a($val->user_id, ['/site/user', 'user_id' => $val->user_id]);
                            // Url::toRoute(['/site/user', 'user_id' => $val->user_id]);
                        },
                        'format' => 'html',
                    ],
                    'value',
                    'balance',
                    [
                        'attribute' => 'created_at',
                        'value' => function($val){
                            return (new \DateTime($val->created_at))->format('d.m.Y H:i:s');
                        },

                    ],
                ],
            ]); ?>
        </div>

    </div>
</div>

