<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\CrudHelper;
use yii\helpers\ArrayHelper;
use app\modules\catalogs\models\EstadosProyecto;

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
//        'attribute'=>'IdProyecto',
//    ],
    [
        'format' => 'html',    
        'value' => function ($data) {
            return Html::img(Yii::getAlias('@web').'/uploads/'. $data->ArchivoAdjunto, ['width'=>'250px', 'height'=>'250px', 'class'=>'img img-responsive img-thumbnail']);
        }
    ],               
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'NombreProyecto',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'HorasSolicitadas',
        'label' => 'Horas a otorgar'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Ubicacion',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'FechaIni',
        'label' => 'Fecha de inicio',
        'format' => ['date', 'php:m-d-Y']
    ], 
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'FechaFin',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdInstitucion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdPersonaAsesor',
    // ],
//    [
//         'class'=>'\kartik\grid\DataColumn',
//         'attribute'=>'NumeroPersonas',
//         'label' => 'Personas requeridas'
//    ],
//    [
//        'class' => '\kartik\grid\DataColumn',
//        'value' => function ($data) {
//            return $data->CuposDisponibles; // $data['name'] for array data, e.g. using SqlDataProvider.
//        },        
//        'label'=> 'Cupos disponibles' 
//    ],      
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idEstadoProyecto.EstadoProyecto',
        'label'=>'Estado del proyecto',
        'filter' => Html::activeDropDownList($searchModel, 'IdEstadoProyecto', ArrayHelper::map(EstadosProyecto::find()->asArray()->where(['EstadoRegistro' => '1'])->all(), 'IdEstadoProyecto', 'EstadoProyecto'),['class'=>'form-control','prompt' => 'Seleccione estado del proyecto']),
    ],                
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'template' => '{view} {detalle}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action === 'update') 
            {
                $url ='/proyecto/update?id='.$key;
                return $url;
            }
            

            return Url::to([$action,'id'=>$key]);
        },                
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
    
            'buttons' => [
                'detalle' => function ($url, $model) {
                    if(true){
                        return Html::a('<span class="glyphicon glyphicon-file"></span>',null,['class'=>'','id' => 'modal-open','onclick' => 
                            "$('#detalleModal').modal('show');
                            $.ajax({
                                url : '/proyecto/detalle-estudiante',
                                data : {'id' : $model->IdProyecto},
                                success  : function(data) {
                                    $('.modal-body').html(data);
                                    $('.modal-header').html('<h3 id=modalTitle>Detalle del proyecto  <b>$model->NombreProyecto</b></h3>');
                                }
                            });
                        "]);
                    }
                },
            ],
    ],

];   