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
//        [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'IdAsistencia',
//    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'IdProyecto',
//    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idPersona.NombreCompleto',
        'label'=>'Estudiante',
        'filter' => Html::activeDropDownList($searchModel, 'IdPersona', ArrayHelper::map($proyecto->idPersonas, 'IdPersona', 'NombreCompleto'),['class'=>'form-control','prompt' => 'Seleccione estudiante']),
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Fecha',
        'label' => 'Fecha',
        'format' => ['date', 'php:d-m-Y']        
    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'attribute' => 'Fecha',
//        'label'=>'Fecha',
//        'format' => ['date', 'php:m-d-Y'] ,
//        'filter' => DatePicker::widget([
//            'model' => $searchModel,
//            'attribute' => 'Fecha',
//            'dateFormat' => 'php:Y-m-d',
//            'options' => [
//                'class' => 'form-control',
//            ],
//        ]),
//    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'HoraEntrada',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'HoraSalida',
    ],    
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'HoraSalida',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'CantidadHoras',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Comentarios',
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
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key, 'idProyecto'=> $model->IdProyecto]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Está seguro?',
                          'data-confirm-message'=>'Está seguro de eliminar este registro ?'], 
    ],

];   