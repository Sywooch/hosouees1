<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Persona */

$this->title = $model->IdPersona;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persona-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->IdPersona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->IdPersona], [
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
            'IdPersona',
            'Nombres',
            'Apellidos',
            'CarnetEstudiante',
            'CarnetEmpleado',
            'DUI',
            'NIT',
            'Direccion',
            'Telefono',
            'Sexo',
            'Cargo',
            'UserId',
            'TipoPersona',
            'ArchivoAdjunto',
            'NombreAdjunto',
            'EstadoRegistro',
        ],
    ]) ?>

</div>
