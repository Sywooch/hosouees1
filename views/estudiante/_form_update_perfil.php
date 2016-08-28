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
    ])->label('Reemplazar mi fotografía actual');    
    ?>  

    <?= $form->field($model, 'Direccion')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
