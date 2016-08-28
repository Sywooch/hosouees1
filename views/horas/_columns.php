<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\helpers\CrudHelper;
use yii\jui\DatePicker;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idPersona.NombreCompleto',
        'label'=>'Estudiante',
        'filter' => Html::activeDropDownList($searchModel, 'IdPersona', ArrayHelper::map($proyecto->idPersonas, 'IdPersona', 'NombreCompleto'),['class'=>'form-control','prompt' => 'Seleccione estudiante']),
    ], 
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'IdProyecto',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'HorasRealizadas',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'HorasRestantes',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ProyectoCompleto',
        'format' => 'html',
        'value' => function ($data) {
            return CrudHelper::getSiNoLabel($data->ProyectoCompleto);
        },             
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ProyectosRealizados',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'PersonaActiva',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdUsuarioRegistro',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'EstadoRegistro',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' =>'{view} {update}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'IdPersona'=> $model->IdPersona, 'IdProyecto'=> $model->IdProyecto]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
//        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
//                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                          'data-request-method'=>'post',
//                          'data-toggle'=>'tooltip',
//                          'data-confirm-title'=>'Are you sure?',
//                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   