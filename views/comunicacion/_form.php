<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
//use app\modules\catalogs\models\Persona;
//use yii\jui\DatePicker;
use kartik\widgets\FileInput;
use app\helpers\PersonaHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Comunicacion */
/* @var $form yii\widgets\ActiveForm */

$persona = PersonaHelper::getPersona();
?>

<div class="comunicacion-form">

    <?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
    ]); ?>

    <?= $form->field($model, 'IdPersonaRemitente')->hiddenInput(['value' => $persona->IdPersona])->label(false)?>

    <?php //echo $form->field($model, 'IdPersonaReceptor')->textInput() ?>

    <?= $form->field($model, 'Sujeto')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'Comentarios')->textArea(['rows' => '6','maxlength' => true]) ?>
    
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <?php
            echo $form->field($model, 'image1')->widget(FileInput::classname(), [
                'options'=>['accept'=>'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*'],
                'pluginOptions'=>['allowedFileExtensions'=>['jpg', 'gif', 'png', 'pdf', 'doc', 'docx', 'xls', 'txt']]
            ])->label('Archivo adjunto 1');       
            ?>            
        </div>
        <div class="col-md-6 col-sm-6">
            <?php  
            echo $form->field($model, 'image2')->widget(FileInput::classname(), [
                'options'=>['accept'=>'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*'],
                'pluginOptions'=>['allowedFileExtensions'=>['jpg', 'gif', 'png', 'pdf', 'doc', 'docx', 'xls', 'txt']]
            ])->label('Archivo adjunto 2');      
            ?>            
        </div>        
    </div>


    <?= $form->field($model, 'IdProyecto')->hiddenInput(['value'=> $idProyecto])->label(false) ?>
    
    <?= $form->field($model, 'IdPersonaRemitente')->hiddenInput(['value' => $persona->IdPersona])->label(false)?>

    <?= $form->field($model, 'IdUsuarioRegistro')->hiddenInput(['value' => Yii::$app->user->id])->label(false)?>

    <?= $form->field($model, 'EstadoRegistro')->hiddenInput(['value' => '1'])->label(false) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Enviar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
