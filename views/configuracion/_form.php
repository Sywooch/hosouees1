<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\Configuracion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuracion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CantidadHorasSociales')->textInput() ?>

    <?= $form->field($model, 'PesoMaximoAdjuntos')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'TextoBienvenida')->widget(TinyMce::className(), [
        'options' => ['rows' => 16],
        'language' => 'es',
        'clientOptions' => [
            'plugins' => [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor emoticons ",
        ]
    ]);?>    
    
    <?= $form->field($model, 'TextoBienvenidaNoElegible')->widget(TinyMce::className(), [
        'options' => ['rows' => 16],
        'language' => 'es',
        'clientOptions' => [
            'plugins' => [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern imagetools"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor emoticons ",
        ]
    ]);?>        

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>


  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
