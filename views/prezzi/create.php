<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prezzi */

$this->title = 'Create Prezzi';
$this->params['breadcrumbs'][] = ['label' => 'Prezzis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prezzi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
