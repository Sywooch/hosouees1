<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\EstadosProyecto;
use app\modules\catalogs\models\Institucion;
use app\modules\catalogs\models\Persona;
//use yii\jui\DatePicker;
use kartik\widgets\FileInput;
use kartik\date\DatePicker as KDatePicker;

$estadosProyecto = ArrayHelper::map(EstadosProyecto::find()->where(['EstadoRegistro' => '1'])->all(), 'IdEstadoProyecto', 'EstadoProyecto');
$instituciones = ArrayHelper::map(Institucion::find()->where(['EstadoRegistro' => '1'])->all(), 'IdInstitucion', 'Nombre');;
$asesores = ArrayHelper::map(Persona::find()->where(['EstadoRegistro' => '1'])->andWhere("TipoPersona != 'ES'")->all(), 'IdPersona', 'NombreCompleto');

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
    ]); 
    
//    echo $form->field($model, 'NombreAdjunto');
    
    // your fileinput widget for single file upload
    echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options'=>['accept'=>'image/*'],
        'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]
    ]);    
    ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Ubicacion')->textInput(['maxlength' => true]) ?>  
    
    <?php
        echo $form->field($model, 'FechaIni')->widget(KDatePicker::classname(), [
           'options' => ['placeholder' => 'Fecho de inicio ...'],
           'pluginOptions' => [
               'autoclose'=>true,
               'format' => 'yyyy/mm/dd'
           ]
       ]); 
        
        echo $form->field($model, 'FechaFin')->widget(KDatePicker::classname(), [
           'options' => ['placeholder' => 'Fecho de finalización ...'],
           'pluginOptions' => [
               'autoclose'=>true,
               'format' => 'yyyy/mm/dd'
           ]
       ]);        
    ?>    
    
    <?= $form->field($model, 'IdInstitucion')->dropDownList($instituciones, 
             ['prompt'=>'- Seleccione la institución -', 'id'=>'idInstitucion-id'])->label('Institución') ?>      

    <?= $form->field($model, 'NumeroPersonas')->textInput()->label('Número de estudiantes requeridos')?>    
    
    <?= $form->field($model, 'HorasSolicitadas')->textInput()->label('Total de horas sociales que otorga al estudiante que finaliza') ?>
    
    <?= $form->field($model, 'HorasSocialesXhora')->textInput()->label('Cantidad de horas sociales por hora de asitencia') ?>          

    <?= $form->field($model, 'IdPersonaAsesor')->dropDownList($asesores, 
             ['prompt'=>'- Seleccione el asesor del proyecto -', 'id'=>'IdPersonaAsesor-id'])->label('Asesor') ?> 

    <?= $form->field($model, 'IdEstadoProyecto')->dropDownList($estadosProyecto, 
             ['prompt'=>'- Seleccione el estado del proyecto -', 'id'=>'estadoProyecto-id'])->label('Estado del proyecto') ?>     
    
    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>