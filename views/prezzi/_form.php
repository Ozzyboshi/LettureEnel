<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prezzi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prezzi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'datainiziovalidita')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999/99/99',]); ?>

    <?= $form->field($model, 'datafinevalidita')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999/99/99',]); ?>

    <?= $form->field($model, 'prezzofascia1')->textInput() ?>

    <?= $form->field($model, 'prezzofascia2')->textInput() ?>

    <?= $form->field($model, 'prezzofascia3')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crea' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
