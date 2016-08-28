<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Facultad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="facultad-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'IdUniversidad')->dropDownList($universidades, 
             ['prompt'=>'- Seleccione la universidad -']) ?>
    
    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombreCorto')->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
