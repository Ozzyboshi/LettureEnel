<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Letture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letture-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'data')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9999/99/99',]); ?>

    <?= $form->field($model, 'consumofascia1')->textInput() ?>

    <?= $form->field($model, 'consumofascia2')->textInput() ?>

    <?= $form->field($model, 'consumofascia3')->textInput() ?>

    <?= $form->field($model, 'produzionefascia1')->textInput() ?>

    <?= $form->field($model, 'produzionefascia2')->textInput() ?>

    <?= $form->field($model, 'produzionefascia3')->textInput() ?>

    <?= $form->field($model, 'immissionefascia1')->textInput() ?>

    <?= $form->field($model, 'immissionefascia2')->textInput() ?>

    <?= $form->field($model, 'immissionefascia3')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crea' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
