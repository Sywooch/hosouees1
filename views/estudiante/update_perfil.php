<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Persona */

$this->title = Yii::t('app', 'Actualizar mi perfil: ', [
    'modelClass' => 'Persona',
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personas'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->IdPersona, 'url' => ['view', 'id' => $model->IdPersona]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="persona-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form_update_perfil', [
        'model' => $model,
    ]) ?>

</div>
