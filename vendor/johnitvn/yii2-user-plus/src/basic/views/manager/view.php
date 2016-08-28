<?php
use yii\widgets\DetailView;
use johnitvn\userplus\base\models\UserAccounts;
use yii\helpers\Html;


?>
<div class="user-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'login',
            'username',
            [
               'attribute'=>'administrator',               
               'value'=> $model['administrator']?"Si":"No",
               'label'=> 'Administrador',
            ],
            [
               'attribute'=>'creator',  
               'label'=> 'Creador',
               'format' => 'raw',
               'value'=> $model['creator']==-1?"Creado en consola":
                            $model['creator']==-2?"Usario creado por mi mismo":
                                Html::a(UserAccounts::findOne($model['creator'])->login,['/user/manager/view','id'=>UserAccounts::findOne($model['creator'])->id],["role"=>"modal-remote"])
            ],
            [
               'attribute'=>'creator_ip',               
               'label'=> 'IP creador',                
            ],         
            [
               'attribute'=>'blocked_at',
                'label'=> 'Fecha de bloqueo',
               'value'=> $model['blocked_at']==null?"No bloqueado":date("d/m/Y H:i:s",$model['blocked_at'])
            ],
            [
               'attribute'=>'confirmed_at',
               'label'=> 'Fecha de confirmación',
               'value'=>$model['confirmed_at']==null?'No confirmado':date("d/m/Y H:i:s",$model['confirmed_at'])
            ],
            [
               'attribute'=>'created_at',               
               'label'=> 'Fecha de creación',
               'value'=>date("d/m/Y H:i:s",$model['created_at'])
            ],
            [
               'attribute'=>'updated_at',               
               'label'=> 'Fecha de actualización',
               'value'=>$model['updated_at']==-1?\Yii::t("user","Never Update"):date("d/m/Y H:i:s",$model['updated_at'])
            ],
        ],
    ]) ?>

</div>
