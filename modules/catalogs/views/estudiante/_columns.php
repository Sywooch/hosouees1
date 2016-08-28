<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\helpers\CrudHelper;
use app\modules\catalogs\models\Carrera;

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
        'attribute'=>'CarnetEstudiante',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idCarrera.Nombre',
        'label'=>'Carrera',
        'filter' => Html::activeDropDownList($searchModel, 'IdCarrera', ArrayHelper::map(Carrera::find()->asArray()->where(['EstadoRegistro' => '1'])->all(), 'IdCarrera', 'Nombre'),['class'=>'form-control','prompt' => 'Seleccione carrera']),
    ],    
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Nombres',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Apellidos',
    ],
//    [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'CarnetEmpleado',
//    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'DUI',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'NIT',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Direccion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Telefono',
    // ],
     [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Sexo',
        'value' => function ($data) {
            return CrudHelper::getSexoLabel($data->Sexo); // $data['name'] for array data, e.g. using SqlDataProvider.
        },        
        'label'=> 'Sexo',
        'filter' => ['M' => 'Masculino', 'F' => 'Femenino'],           
     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'Cargo',
    // ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'attribute'=>'user.username',
         'label' => 'Usuario'
     ],
//     [
//        'class'=>'\kartik\grid\DataColumn',
//        'attribute'=>'TipoPersona',
//        'value' => function ($data) {
//            return CrudHelper::getTipoPersonaLabel($data->TipoPersona); // $data['name'] for array data, e.g. using SqlDataProvider.
//        },        
//        'label'=> 'Tipo de persona',
//        'filter' => ['ES' => 'Estudiante', 'EM' => 'Empleado', 'EX' => 'Externo'],           
//     ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ArchivoAdjunto',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'NombreAdjunto',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute'=>'Elegible',
        'value' => function ($data) {
            return CrudHelper::getSiNoLabel($data->Elegible); // $data['name'] for array data, e.g. using SqlDataProvider.
        },        
        'label'=> 'Elegible',
        'format' => 'html',
        'filter' => ['0' => 'NO', '1' => 'SI'],  
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
        'template' => '{view} {update} {delete}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action === 'update') 
            {
                $url ='/estudiante/update?id='.$key;
                return $url;
            }
            

            return Url::to([$action,'id'=>$key]);
        }, 
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>[/*'role'=>'modal-remote',*/'title'=>'Editar', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Está seguro?',
                          'data-confirm-message'=>'Está seguro de eliminar este alumno?'], 
    ],

];   