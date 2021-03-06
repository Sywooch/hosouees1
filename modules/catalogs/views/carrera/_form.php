<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\Universidad;
use app\modules\catalogs\models\Facultad;
use kartik\depdrop\DepDrop;

$facultades = ArrayHelper::map(Facultad::find()->where(['IdUniversidad' => 1, 'EstadoRegistro'=>'1'])->all(), 'IdFacultad', 'Nombre');
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Carrera */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carrera-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'IdFacultad')->dropDownList($facultades, 
             ['prompt'=>'- Seleccione la Facultad -', 'id'=>'facultad-id'])->label('Facultad') ?>
    
    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombreCorto')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'CantidadHorasSociales')->textInput() ?>

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
