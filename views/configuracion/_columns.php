<?php
use yii\helpers\Url;
use app\helpers\CrudHelper;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
//    [
//        'class' => 'kartik\grid\SerialColumn',
//        'width' => '30px',
//    ],
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'IdConfiguracion',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'CantidadHorasSociales',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'PesoMaximoAdjuntos',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'TextoBienvenida',
        'format'=> 'html'
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
        'template' => '{view} {update}',
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>[/*'role'=>'modal-remote',*/'title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eiminar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   