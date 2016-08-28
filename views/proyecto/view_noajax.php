<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */

$this->title = $model->IdProyecto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->IdProyecto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->IdProyecto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdProyecto',
            'NombreProyecto',
            'HorasSolicitadas',
            'HorasSocialesXhora',
            'Ubicacion',
            'FechaIni',
            'FechaFin',
            'IdInstitucion',
            'IdEstadoProyecto',
            'IdPersonaAsesor',
            'NumeroPersonas',
            'ArchivoAdjunto',
            'NombreAdjunto',
            'EstadoRegistro',
        ],
    ]) ?>

</div>
