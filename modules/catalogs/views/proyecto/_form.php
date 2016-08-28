<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\EstadosProyecto;
use app\modules\catalogs\models\Institucion;
use app\modules\catalogs\models\Persona;
use yii\jui\DatePicker;
$estadosProyecto = ArrayHelper::map(EstadosProyecto::find()->where(['EstadoRegistro' => '1'])->all(), 'IdEstadoProyecto', 'EstadoProyecto');
$instituciones = ArrayHelper::map(Institucion::find()->where(['EstadoRegistro' => '1'])->all(), 'IdInstitucion', 'Nombre');
$asesores = ArrayHelper::map(Persona::find()->where(['EstadoRegistro' => '1', 'TipoPersona !=' => 'ES'])->all(), 'IdPersona', 'NombreCompleto');

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Ubicacion')->textInput(['maxlength' => true]) ?>  
    
    <?= $form->field($model, 'FechaIni')->widget(\yii\jui\DatePicker::classname(), [
       //'language' => 'ru',
       'dateFormat' => 'yyyy-MM-dd',
   ])->label('Fecha de inicio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') ?> 
    
    <?= $form->field($model, 'FechaFin')->widget(\yii\jui\DatePicker::classname(), [
       //'language' => 'ru',
       'dateFormat' => 'yyyy-MM-dd',
   ])->label('Fecha de finalización') ?>      
    
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

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
