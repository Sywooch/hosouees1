<?php

use yii\widgets\DetailView;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */
?>
<div class="asistencia-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'IdAsistencia',
            'idProyecto.NombreProyecto',
            [
                'attribute' => 'idPersona.NombreCompleto',
                'label' => 'Estudiante'
            ],
            'Fecha:date',
            'HoraEntrada:time',
            'HoraSalida:time',
            'CantidadHoras',
            'Comentarios',
//            'IdUsuarioRegistro',
            [
                'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                'label'=> 'EstadoRegistro',
            ], 
        ],
    ]) ?>

</div>
