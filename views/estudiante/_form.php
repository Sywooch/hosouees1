<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\UserAccounts;
use app\modules\catalogs\models\Carrera;
use kartik\widgets\FileInput;
$usuarios = ArrayHelper::map(UserAccounts::find()->where(['administrator' => '0'])->all(), 'id', 'username');
$carreras = ArrayHelper::map(Carrera::find()->where(['EstadoRegistro' => '1'])->all(), 'IdCarrera', 'Nombre');

/* @var $model app\modules\catalogs\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">
    
    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
    ]); 

//    echo $form->field($model, 'TipoPersona')->dropDownList(CrudHelper::getTipoPersona(), 
//             ['prompt'=>'- Seleccione el tipo de persona-']);
    // your fileinput widget for single file upload
    echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options'=>['accept'=>'image/*'],
        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]
    ]);    
    ?>  
    <?= $form->field($model, 'IdCarrera')->dropDownList($carreras, 
             ['prompt'=>'- Seleccione la carrera -', 'id'=>'IdCarrera-id'])->label('Carrera') ?>
            
    <?= $form->field($model, 'Sexo')->dropDownList(CrudHelper::getSexo(), 
             ['prompt'=>'- Seleccione el sexo-']) ?>    
    
    <?= $form->field($model, 'TipoPersona')->hiddenInput(['maxlength' => true, 'value'=>  'ES'])->label(false) ?>
        
    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CarnetEstudiante')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'CarnetEmpleado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NIT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Elegible')->dropDownList(CrudHelper::getSiNo(), 
             ['prompt'=>'- Seleccione si es elegible para horas sociales-']) ?>  
    

    <?= $form->field($model, 'UserId')->dropDownList($usuarios, 
             ['prompt'=>'- Seleccione el usuario -', 'id'=>'UserId-id'])->label('Usuario') ?>      

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
