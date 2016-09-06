<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */

?>
<div class="row">
    <div class="col-md-6 col-sm-12 text-center">
        <blockquote class="alert-info">
            <p>Su cupo ya ha sido reservado para formar parte del proyecto de horas sociales
            <h4><?= $model->NombreProyecto?></h4>
            </p>
        </blockquote> 
        <div class="well text-center">
            <?= Html::img('@web/uploads/'.$model->ArchivoAdjunto, ['width'=>'400px', 'height' =>'400px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?> 
        </div>            
    </div>
    <div class="col-md-6 col-sm-12 text-center">
        <div class="proyecto-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
        //            'IdProyecto',
                    'NombreProyecto',
                    'Ubicacion',
                    'FechaIni:date',
                    'FechaFin:date',
                    [
                        'label' => 'Institución',
                        'attribute'=> 'idInstitucion.Nombre',
                    ],  
                    [
                        'label' => 'Número de estudiantes requeridos',
                        'attribute'=> 'NumeroPersonas',
                    ],
                    [
                        'label' => 'Número de cupos disponibles',
                        'attribute'=> 'CuposDisponibles',
                    ],            
                    [
                        'label' => 'Total de horas sociales que otorga<br/> al estudiante que finaliza',
                        'attribute'=> 'HorasSolicitadas',
                    ],
                    [
                        'label' => 'Cantidad de horas sociales por hora<br/> de asitencia',
                        'attribute'=> 'HorasSocialesXhora',
                    ],    
                    [
                        'label' => 'Asesor',
                        'attribute'=> 'idPersonaAsesor.NombreCompleto',
                    ],                     
                ],
            ]) ?>
        </div>            
    </div> 
</div>   
