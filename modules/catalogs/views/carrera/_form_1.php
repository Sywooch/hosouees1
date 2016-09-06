<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\Universidad;
use kartik\depdrop\DepDrop;

$universidades = ArrayHelper::map(Universidad::find()->all(), 'IdUniversidad', 'Nombre');
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Carrera */
/* @var $form yii\widgets\ActiveForm */
$model->IdUniversidad = isset($model->idFacultad) ? $model->idFacultad->idUniversidad->IdUniversidad : '' ;
$dataFac = isset($model->idFacultad) ? [$model->idFacultad->IdFacultad => $model->idFacultad->Nombre] : [];
?>

<div class="carrera-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'IdUniversidad')->dropDownList($universidades, 
             ['prompt'=>'- Seleccione la universidad -', 'id'=>'universidad-id'])->label('Universidad') ?>
    
    <?= $form->field($model, 'IdFacultad')->widget(DepDrop::classname(), [
        'data'=> $dataFac,
        'options'=>['id'=>'facultad-id'],
        'pluginOptions'=>[
            'depends'=>['universidad-id'],
            'placeholder'=>'Seleccione la Facultad',
            'url'=>Url::to(['/catalogs/facultad/get-facultades'])
        ]
    ]); ?>
    
    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombreCorto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoRegistro')->dropDownList(CrudHelper::getEstadosRegistro(), 
             ['prompt'=>'- Seleccione el estado del registro-']) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
