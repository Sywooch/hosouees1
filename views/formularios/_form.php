<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Formularios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formularios-form">

    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
    ]); 

            echo $form->field($model, 'image')->widget(FileInput::classname(), [
                'options'=>['accept'=>'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
            text/plain, application/pdf, image/*'],
                'pluginOptions'=>['allowedFileExtensions'=>['jpg', 'gif', 'png', 'pdf', 'doc', 'docx', 'xls', 'txt']]
            ])->label('Archivo adjunto 1'); 
    ?>  

    <?= $form->field($model, 'NombreFormulario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Reglamentos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DescripcionFormulario')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
