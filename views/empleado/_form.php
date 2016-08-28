<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\UserAccounts;
use kartik\widgets\FileInput;
$usuarios = ArrayHelper::map(UserAccounts::find()->all(), 'id', 'username');

/* @var $model app\modules\catalogs\models\Persona */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="persona-form">
    
    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
    ]); 

    echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options'=>['accept'=>'image/*'],
        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]
    ]);    
    ?>  
            
    <?= $form->field($model, 'Sexo')->dropDownList(CrudHelper::getSexo(), 
             ['prompt'=>'- Seleccione el sexo-']) ?>    
    
    <?= $form->field($model, 'TipoPersona')->hiddenInput(['maxlength' => true, 'value'=>  'EM'])->label(false) ?>
        
    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CarnetEmpleado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DUI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NIT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'Cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserId')->dropDownList($usuarios, 
             ['prompt'=>'- Seleccione el usuario -', 'id'=>'UserId-id'])->label('Usuario') ?>      

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
