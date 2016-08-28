<?php

use yii\widgets\DetailView;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Facultad */
?>
<div class="facultad-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'idUniversidad.Nombre',
                'label'=> 'Universidad',
            ],
//            'IdFacultad',
            'Nombre',
            'Descripcion',
            'NombreCorto',
            [
                'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                'label'=> 'EstadoRegistro',
            ],            
        ],
    ]) ?>

</div>
