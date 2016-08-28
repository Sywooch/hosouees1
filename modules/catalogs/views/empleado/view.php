<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Persona */
?>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="well text-center">
            <?= Html::img('@web/uploads/'.$model->ArchivoAdjunto, ['width'=>'400px', 'height' =>'400px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?> 
        </div> 
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="persona-view">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
        //            'IdPersona',
                    [
                        'value' => CrudHelper::getTipoPersonaLabel($model->TipoPersona),
                        'label'=> 'Tipo de Persona',
                    ],             
                    'Nombres',
                    'Apellidos',
        //            'CarnetEstudiante',
                    'CarnetEmpleado',
                    'DUI',
                    'NIT',
                    'Direccion',
                    [
                        'value' => CrudHelper::getSexoLabel($model->Sexo),
                        'label'=> 'Sexo',
                    ],     
        //            'Cargo',
                    [
                        'attribute' =>'user.username',
                        'label' => 'Nombre de usuario'
                    ],

                    [
                        'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                        'label'=> 'EstadoRegistro',
                    ], 
                ],
            ]) ?>
        </div>        
    </div>
</div>    

<script>
//    alert('hosouees');
$(function(){
//    $('.modal-footer').remove();
})
</script>
