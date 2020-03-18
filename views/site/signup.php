<h1>Регистрация</h1>

<?php
use \yii\widgets\ActiveForm;
use \kartik\date;
?>


<?php
   $form = ActiveForm::begin(['class'=>'form-horizontal']);
?>

<?= $form->field($model, 'firstname')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model, 'surename')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model, 'email')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model, 'city')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model, 'date')->widget(\kartik\date\DatePicker::className(),[]) ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'confpassword')->passwordInput() ?>

<div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

<?php
    ActiveForm::end();
?>
