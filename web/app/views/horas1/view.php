<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Horas */
?>
<div class="horas-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdPersona',
            'IdProyecto',
            'HorasRealizadas',
            'HorasRestantes',
            'ProyectoCompleto',
            'ProyectosRealizados',
            'PersonaActiva',
            'IdUsuarioRegistro',
            'EstadoRegistro',
        ],
    ]) ?>

</div>
