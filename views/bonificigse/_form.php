<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bonificigse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bonificigse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999/99/99',]); ?>

    <?= $form->field($model, 'causale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'importo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crea' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
