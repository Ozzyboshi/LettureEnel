<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Letture */

$this->title = 'Crea nuova lettura';
$this->params['breadcrumbs'][] = ['label' => 'Letture', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letture-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
