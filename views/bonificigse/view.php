<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bonificigse */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bonifici GSE', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonificigse-view">

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
            'causale',
            'importo',
        ],
    ]) ?>

</div>
