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
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'IdFormulario',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'NombreFormulario',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Reglamentos',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'DescripcionFormulario',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'ArchivoAdjunto',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'NombreAdjunto',
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
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>[/*'role'=>'modal-remote',*/'title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Está seguro?',
                          'data-confirm-message'=>'Está seguro de eliminar este formulario?'], 
    ],

];   