<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Horas */

?>
<div class="horas-create">
    <?= $this->render('_form_create', [
        'model' => $model,
        'idProyecto' => $idProyecto
    ]) ?>
</div>
