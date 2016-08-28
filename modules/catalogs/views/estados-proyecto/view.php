<?php

use yii\widgets\DetailView;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\EstadosProyecto */
?>
<div class="estados-proyecto-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'IdEstadoProyecto',
            'EstadoProyecto',
            [
                'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                'label'=> 'EstadoRegistro',
            ],  
        ],
    ]) ?>

</div>
