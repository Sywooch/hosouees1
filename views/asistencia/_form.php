<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use \app\modules\catalogs\models\Proyecto;
use kartik\date\DatePicker as KDatePicker;
use kartik\widgets\TimePicker;

$proyecto = Proyecto::findOne(['IdProyecto' => $idProyecto]);
if(! isset($proyecto))
{
    die('Proyecto no existente');
}

$personas = ArrayHelper::map($proyecto->idPersonas, 'IdPersona', 'NombreCompleto');

/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-form">

    <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'IdProyecto')->hiddenInput(['value' => $idProyecto])->label(false) ?>    
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <?= $form->field($model, 'IdPersona')->dropDownList($personas, 
                     ['prompt'=>'- Seleccione el estudiante -', 'id'=>'estudiante-id'])->label('Estudiante') ?>    

            <?php
            echo $form->field($model, 'Fecha')->input('date');
        //    echo $form->field($model, 'Fecha')->widget(KDatePicker::classname(), [
        //       'options' => ['placeholder' => 'Fecha de asistencia ...', ''],
        //       'pluginOptions' => [
        //           'autoclose'=>true,
        //           'format' => 'yyyy/mm/dd'
        //       ]
        //   ]); 


            ?>      
            <?php
            echo $form->field($model, 'HoraEntrada')->input('time');
        //    echo $form->field($model, 'HoraEntrada')->widget(TimePicker::classname(), []);
            ?>

            <?php
            echo $form->field($model, 'HoraSalida')->input('time');
        //    echo $form->field($model, 'HoraSalida')->widget(TimePicker::classname(), []);
            ?>             
        </div>  
        <div class="col-md-6 col-sm-6">   

            <?= $form->field($model, 'CantidadHoras')->textInput() ?>

            <?= $form->field($model, 'Comentarios')->textarea(['maxlength' => true]) ?>

            <?= $form->field($model, 'IdUsuarioRegistro')->hiddenInput(['value' => Yii::$app->user->id])->label(false)?>

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
<?php
//$this->registerCss(".datepicker{z-index:1151 !important;}");
?>