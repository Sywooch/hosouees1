<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\ProyectoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'IdProyecto') ?>

    <?= $form->field($model, 'NombreProyecto') ?>

    <?= $form->field($model, 'HorasSolicitadas') ?>

    <?= $form->field($model, 'HorasSocialesXhora') ?>

    <?= $form->field($model, 'Ubicacion') ?>

    <?php // echo $form->field($model, 'FechaIni') ?>

    <?php // echo $form->field($model, 'FechaFin') ?>

    <?php // echo $form->field($model, 'IdInstitucion') ?>

    <?php // echo $form->field($model, 'IdEstadoProyecto') ?>

    <?php // echo $form->field($model, 'IdPersonaAsesor') ?>

    <?php // echo $form->field($model, 'NumeroPersonas') ?>

    <?php // echo $form->field($model, 'ArchivoAdjunto') ?>

    <?php // echo $form->field($model, 'NombreAdjunto') ?>

    <?php // echo $form->field($model, 'EstadoRegistro') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
