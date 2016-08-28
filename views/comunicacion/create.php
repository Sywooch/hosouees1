<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comunicacion */

?>
<div class="comunicacion-create">
    <?= $this->render('_form', [
        'model' => $model,
        'idProyecto' => $idProyecto,
    ]) ?>
</div>
