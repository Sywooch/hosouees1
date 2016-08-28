<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Horas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IdPersona')->textInput() ?>

    <?= $form->field($model, 'IdProyecto')->textInput() ?>

    <?= $form->field($model, 'HorasRealizadas')->textInput() ?>

    <?= $form->field($model, 'HorasRestantes')->textInput() ?>

    <?= $form->field($model, 'ProyectoCompleto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ProyectosRealizados')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PersonaActiva')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdUsuarioRegistro')->textInput() ?>

    <?= $form->field($model, 'EstadoRegistro')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
