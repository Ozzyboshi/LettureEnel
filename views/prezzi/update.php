<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prezzi */

$this->title = 'Update Prezzi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prezzis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prezzi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
