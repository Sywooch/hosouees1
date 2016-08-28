<?php

use yii\widgets\DetailView;
use app\helpers\CrudHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Horas */
?>
<div class="row">
    <div class="col-md-6 col-sm-4">
        <div class="well text-center">
            <?= Html::img('@web/uploads/'.$model->idPersona->ArchivoAdjunto, ['width'=>'400px', 'height' =>'400px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?> 
        </div> 
    </div>
    <div class="col-md-6 col-sm-8">
        <div class="horas-view">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'idProyecto.NombreProyecto',
                    [
                        'label' => 'Estudiante',
                        'value' => $model->idPersona->CarnetEstudiante.' - '.$model->idPersona->NombreCompleto
                    ],
                    'HorasRealizadas',
//                    'HorasRestantes',
                    [
                        'value' => CrudHelper::getSiNoLabel($model->ProyectoCompleto),
                        'label'=> 'Proyecto completado ?',
                        'format' => 'html'
                    ], 
        //            'ProyectosRealizados',
                    [
                        'value' => ($model->PersonaActiva == '1') ? 'SI' : 'NO',
                        'label'=> 'Persona activa',
                    ], 
        //            'IdUsuarioRegistro',
                    [
                        'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                        'label'=> 'EstadoRegistro',
                    ], 
                ],
            ]) ?>

        </div>        
    </div>
</div>

