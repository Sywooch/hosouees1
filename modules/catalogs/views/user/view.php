<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\User */
?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'confirmation_token',
            'status',
            'superadmin',
            'created_at',
            'updated_at',
            'registration_ip',
            'bind_to_ip',
            'email:email',
            'email_confirmed:email',
        ],
    ]) ?>

</div>
