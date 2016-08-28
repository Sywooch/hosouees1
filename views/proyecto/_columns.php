<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\CrudHelper;
use yii\helpers\ArrayHelper;
use app\modules\catalogs\models\EstadosProyecto;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'IdProyecto',
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
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute'=>'EstadoRegistro',
        'value' => function ($data) {
            return CrudHelper::getEstadosRegistroLabel($data->EstadoRegistro); // $data['name'] for array data, e.g. using SqlDataProvider.
        },        
        'label'=> 'Estado Registro',
        'filter' => ['0' => 'Inactivo', '1' => 'Activo'],  
    ],    
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'FechaFin',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdInstitucion',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idEstadoProyecto.EstadoProyecto',
        'label'=>'Estado del proyecto',
        'filter' => Html::activeDropDownList($searchModel, 'IdEstadoProyecto', ArrayHelper::map(EstadosProyecto::find()->asArray()->where(['EstadoRegistro' => '1'])->all(), 'IdEstadoProyecto', 'EstadoProyecto'),['class'=>'form-control','prompt' => 'Seleccione estado del proyecto']),
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'IdPersonaAsesor',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'NumeroPersonas',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'EstadoRegistro',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'template' => '{view} {update} {delete}',
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
            if ($action === 'update') 
            {
                $url ='/proyecto/update?id='.$key;
                return $url;
            }
            

            return Url::to([$action,'id'=>$key]);
        },                
        'viewOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'View'),'data-toggle'=>'tooltip'],
        'updateOptions'=>[/*'role'=>'modal-remote',*/'title'=>Yii::t('app', 'Update'), 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>Yii::t('app', 'Delete'), 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>Yii::t('app','Are you sure?'),
                          'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')],
    
//            'template' => '{importdetail} {a} {2}',
//            'buttons' => [
//               'importdetail' => function ($url, $model) {
//                    $title = Yii::t('app', 'View Details');
//                    $icon = '<span class="glyphicon glyphicon-eye-open"></span>';
//                    $label = ArrayHelper::remove($options, 'label', ($icon));
//                    $label = ArrayHelper::remove($options, 'label', $icon . ' ' . $title);
//                    $url = Url::toRoute(['importdetail','DataRefreshItemDetailSearch']);
//
//                    return Html::a($label, $url, $options);
//                },
//            ],        
    ],

];   