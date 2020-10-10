<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// nothing to add here, this just helps build your form 
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'artist')->textInput() ?>

    <?= $form->field($model, 'album')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= Html::submitButton('Submit', ['class' => 'submit']) ?>
    
 <?php ActiveForm::end(); ?>

 
