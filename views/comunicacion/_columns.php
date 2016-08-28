<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\helpers\CrudHelper;

return [
//    [
//        'class' => 'kartik\grid\CheckboxColumn',
//        'width' => '20px',
//    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'IdComunicacion',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idPersonaRemitente.NombreCompleto',
        'label'=>'Remitente',
        'filter' => Html::activeDropDownList($searchModel, 'IdPersonaRemitente', ArrayHelper::map($proyecto->idPersonas, 'IdPersona', 'NombreCompleto'),['class'=>'form-control','prompt' => 'Seleccione remitente']),
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'idPersonaReceptor.NombreCompleto',
//        'label'=>'Receptor',
//        'filter' => Html::activeDropDownList($searchModel, 'IdPersonaReceptor', ArrayHelper::map($proyecto->idPersonas, 'IdPersona', 'NombreCompleto'),['class'=>'form-control','prompt' => 'Todos']),
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Sujeto',
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Comentarios',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'FechaHora',
        'format' => ['date', 'php:d/m/Y H:i:s']
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'NombreAdjunto1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'RutaAdjunto1',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'NombreAdjunto2',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'RutaAdjunto2',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdProyecto',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdUsuarioRegistro',
    // ],
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
        'template' => '{view}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   