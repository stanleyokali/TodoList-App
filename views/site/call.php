<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'mobile_number')->textInput() ?>

    <?= Html::submitButton('Submit', ['class' => 'submit']) ?>
    
 <?php ActiveForm::end(); ?>
