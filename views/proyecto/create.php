<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */

$this->title = 'Crear un nuevo Proyecto';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-create">

    <h1><?php //echo Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

