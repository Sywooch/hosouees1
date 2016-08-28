<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Universidad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="universidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombreCorto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Mision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Vision')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CorreoElectronico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Url')->textInput(['maxlength' => true]) ?>

    <?php // echo $form->field($model, 'Logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>    

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
