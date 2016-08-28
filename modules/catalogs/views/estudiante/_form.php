<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CarnetEstudiante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CarnetEmpleado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NIT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Sexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserId')->textInput() ?>

    <?= $form->field($model, 'TipoPersona')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ArchivoAdjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombreAdjunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoRegistro')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
