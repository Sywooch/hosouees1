<?php

use yii\widgets\DetailView;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Configuracion */
$this->title = 'Configuración';
?>
<div class="configuracion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'IdConfiguracion',
            'CantidadHorasSociales',
            'PesoMaximoAdjuntos',
            [
                'attribute' => 'TextoBienvenida',
                'format' => 'html'
            ],
            [
                'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                'label'=> 'EstadoRegistro',
            ], 
        ],
    ]) ?>

</div>
