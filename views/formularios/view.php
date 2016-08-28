<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Formularios */
?>
<div class="formularios-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdFormulario',
            'NombreFormulario',
            'Reglamentos',
            'DescripcionFormulario',
            [
                'value' => CrudHelper::getEstadosRegistroLabel($model->EstadoRegistro),
                'label'=> 'EstadoRegistro',
            ], 
        ],
    ]) ?>
    
    <?php
    if(isset($model->ArchivoAdjunto))
    {
        ?>
        <div class="col-md-12 col-sm-12">
            <?=Html::a('<i class="glyphicon glyphicon-download fa-2x"></i> '.$model->NombreAdjunto, ['uploads/'.$model->ArchivoAdjunto], ['target'=> '_blank'])?>
            <?=CrudHelper::getObjectTag(Url::home(true).'uploads/'.$model->ArchivoAdjunto, '100%', '400')?>
        </div>    
        <?php
    }
    ?>
</div>
