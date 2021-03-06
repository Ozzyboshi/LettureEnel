<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Letture */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Letture', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Aggiorna', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
