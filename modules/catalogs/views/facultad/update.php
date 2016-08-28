<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Facultad */
?>
<div class="facultad-update">

    <?= $this->render('_form', [
        'model' => $model,
        'universidades' => $universidades,
    ]) ?>

</div>
