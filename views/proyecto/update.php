<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */

$this->title = Yii::t('app', 'Editar {modelClass}: ', [
    'modelClass' => 'Proyecto',
]) . $model->IdProyecto;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->IdProyecto, 'url' => ['view', 'id' => $model->IdProyecto]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="proyecto-update">
    <?php //echo Html::img('@web/uploads/'.$model->ArchivoAdjunto, ['width'=>'400px', 'height' =>'400px', 'align'=>'center']);?> 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
