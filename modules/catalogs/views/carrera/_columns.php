<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\Universidad;
use app\modules\catalogs\models\Facultad;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'IdCarrera',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idFacultad.idUniversidad.Nombre',
        'label'=>'Universidad',
//        'filter' => Html::activeDropDownList($searchModel, 'IdUniversidad', ArrayHelper::map(Universidad::find()->asArray()->all(), 'IdUniversidad', 'Nombre'),['class'=>'form-control','prompt' => 'Seleccione universidad']),        
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idFacultad.Nombre',
        'label'=> 'Facultad',
//        'filter' => Html::activeDropDownList($searchModel, 'IdFacultad', ArrayHelper::map(Facultad::find()->asArray()->all(), 'IdFacultad', 'Nombre'),['class'=>'form-control','prompt' => 'Seleccione facultad']),        
        
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'NombreCorto',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute'=>'EstadoRegistro',
        'value' => function ($data) {
            return CrudHelper::getEstadosRegistroLabel($data->EstadoRegistro); // $data['name'] for array data, e.g. using SqlDataProvider.
        },        
        'label'=> 'Estado Registro',
        'filter' => ['0' => 'Inactivo', '1' => 'Activo'],  
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')],
    ],

];   