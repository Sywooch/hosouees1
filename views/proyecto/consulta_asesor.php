<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\catalogs\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Proyectos de Horas Sociales Asesorados');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="proyecto-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns_consulta_asesor.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'id'=>'btnRefreshConsultaProyectos', 'title'=>'Refrescar']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'hover' => true,
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Listado de Proyectos',
                'before'=>'<em>* '.Yii::t('app','Resize table columns just like a spreadsheet by dragging the column edges.').'</em>',
//                'after'=>BulkButtonWidget::widget([
//                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; '.Yii::t('app', 'Delete all'),
//                                ["bulk-delete"] ,
//                                [
//                                    "class"=>"btn btn-danger btn-xs",
//                                    'role'=>'modal-remote-bulk',
//                                    'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
//                                    'data-request-method'=>'post',
//                                    'data-confirm-title'=>Yii::t('app','Are you sure?'),
//                                    'data-confirm-message'=>Yii::t('app','Are you sure want to delete this item?')
//                                ]),
//                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"=>"detalleModal",
    "size" => 'modal-lg',
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

<?php Modal::begin([
    "id"=>"ajaxCrubModal",
    "size" => 'modal-lg',
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>


