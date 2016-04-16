<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lettures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letture-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Letture', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'data',
            'consumofascia1',
            'consumofascia2',
            'consumofascia3',
            'produzionefascia1',
            'produzionefascia2',
            'produzionefascia3',
            'immissionefascia1',
            'immissionefascia2',
            'immissionefascia3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
