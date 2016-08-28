<?php

use yii\widgets\DetailView;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Carrera */
?>
<div class="carrera-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdCarrera',
            [
                'attribute'=>'idFacultad.idUniversidad.Nombre',
                'label'=> 'Universidad'
            ], 
            [
                'attribute'=>'idFacultad.Nombre',
                'label'=> 'Facultad'
            ],            
            'Nombre',
            'NombreCorto',
            [
                'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                'label'=> 'Estado del Registro',
            ],  
        ],
    ]) ?>

</div>
