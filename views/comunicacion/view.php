<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Comunicacion */

?>
<div class="comunicacion-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'IdComunicacion',
            [
                'attribute' => 'idProyecto.NombreProyecto',
                'label' =>'Proyecto'
            ],            
            [
                'attribute' => 'idPersonaRemitente.NombreCompleto',
                'label' =>'Remitente'
            ],
            'Sujeto',
            'Comentarios',
            [
                'attribute' => 'FechaHora',
                'format' => ['date', 'php:d/m/Y H:i:s']
            ],
//            'IdUsuarioRegistro',
//            'EstadoRegistro',
        ],
    ]) ?>

</div>
<hr/>
<div class="row well">
    <h3 class="text-center text-info">Adjuntos</h3>
    <?php
    if(isset($model->RutaAdjunto1))
    {
        ?>
        <div class="col-md-6 col-sm-12">
            <?=Html::a('<i class="glyphicon glyphicon-download fa-2x"></i> '.$model->NombreAdjunto1, ['uploads/'.$model->RutaAdjunto1], ['target'=> '_blank'])?>
            <?=CrudHelper::getObjectTag(Url::home(true).'uploads/'.$model->RutaAdjunto1, '100%', '400')?>
        </div>    
        <?php
    }
    ?>
    <?php
    if(isset($model->RutaAdjunto2))
    {
        ?>
        <div class="col-md-6 col-sm-12">
            <?=Html::a('<i class="glyphicon glyphicon-download glyphicon-2x fa-2x"></i>'.$model->NombreAdjunto2, ['uploads/'.$model->RutaAdjunto2], ['target'=> '_blank'])?>
            <?=CrudHelper::getObjectTag(Url::home(true).'uploads/'.$model->RutaAdjunto2, '100%', '400')?>
        </div>    
        <?php
    }
    ?>
</div>

