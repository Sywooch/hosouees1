<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Institucion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institucion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Siglas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SitioWeb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>   

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
