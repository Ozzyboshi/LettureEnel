<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bonifici GSE';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonificigse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea nuovo bonifico GSE', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'causale',
            'importo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
