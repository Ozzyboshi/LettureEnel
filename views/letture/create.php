<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Letture */

$this->title = 'Create Letture';
$this->params['breadcrumbs'][] = ['label' => 'Lettures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letture-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
