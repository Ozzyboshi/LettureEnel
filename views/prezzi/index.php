<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prezzi contrattualizzati con ENEL al Kwh';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prezzi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crea nuovo prezzo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'datainiziovalidita',
            'datafinevalidita',
            'prezzofascia1',
            'prezzofascia2',
            'prezzofascia3',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
