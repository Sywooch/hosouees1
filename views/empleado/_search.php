<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\PersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdPersona') ?>

    <?= $form->field($model, 'Nombres') ?>

    <?= $form->field($model, 'Apellidos') ?>

    <?= $form->field($model, 'CarnetEstudiante') ?>

    <?= $form->field($model, 'CarnetEmpleado') ?>

    <?php // echo $form->field($model, 'DUI') ?>

    <?php // echo $form->field($model, 'NIT') ?>

    <?php // echo $form->field($model, 'Direccion') ?>

    <?php // echo $form->field($model, 'Telefono') ?>

    <?php // echo $form->field($model, 'Sexo') ?>

    <?php // echo $form->field($model, 'Cargo') ?>

    <?php // echo $form->field($model, 'UserId') ?>

    <?php // echo $form->field($model, 'TipoPersona') ?>

    <?php // echo $form->field($model, 'ArchivoAdjunto') ?>

    <?php // echo $form->field($model, 'NombreAdjunto') ?>

    <?php // echo $form->field($model, 'EstadoRegistro') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
