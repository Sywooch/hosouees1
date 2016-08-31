<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use yii\helpers\ArrayHelper;
use app\modules\catalogs\models\Persona;

$personas = ArrayHelper::map(Persona::find()->where(['EstadoRegistro' => '1', 'TipoPersona'=>'ES', 'Elegible' => '1'])->all(), 'IdPersona', 'NombreCompleto');

/* @var $this yii\web\View */
/* @var $model app\models\Horas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horas-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'IdPersona')->hiddenInput(['value' => $model->IdPersona])->label(false) ?>

            <?= $form->field($model, 'HorasRealizadas')->textInput() ?>

            <?= $form->field($model, 'HorasRestantes')->textInput() ?>

            <?= $form->field($model, 'ProyectoCompleto')->dropDownList(CrudHelper::getSiNo(), 
             ['prompt'=>'- Seleccione si el estudiante ha completado el proyecto-']) ?>             
        </div>
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'IdProyecto')->hiddenInput(['value' => $model->IdProyecto])->label(false) ?>
            
            <?= $form->field($model, 'PersonaActiva')->dropDownList(CrudHelper::getSiNo(), 
                     ['prompt'=>'- Seleccione si el estudiante sigue activo en el proyecto-']) ?>      

            <?= $form->field($model, 'IdUsuarioRegistro')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

            <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
                     ['prompt'=>'- Seleccione el estado del registro-']) ?>            
        </div>        
    </div>   
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
