<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */

?>
<div class="row">
    <div class="col-md-7 col-sm-12 text-center">
        <blockquote class="alert-info">
            <p>Al confirmar la reserva de cupo usted estar&iacute;a adquiriendo un compromiso y a la vez podr&iacute;a quitarle
                la oportunidad a otro estudiante, por favor realice esta acci&oacute;n solo si realmente est&aacute; interesado</p>
        </blockquote>              
    </div>
    <div class="col-md-5 col-sm-12 text-center">     
        <?= Html::img('@web/uploads/'.$persona->ArchivoAdjunto, ['width'=>'125px', 'height' =>'125px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?>         
        <br/>
        <button class="btn btn-success proyecto-apply" id="btnReservaCupo" data-idproyecto="<?=$model->IdProyecto?>" data-idpersona="<?=$persona->IdPersona?>">
            Confirmar la reserva de cupo
            <i class="glyphicon glyphicon-check"></i>
        </button>        
    </div>    
</div>   
<div  class="clearfix">
    <br/>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="well text-center">
            <?= Html::img('@web/uploads/'.$model->ArchivoAdjunto, ['width'=>'400px', 'height' =>'400px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?> 
        </div>        
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="proyecto-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
        //            'IdProyecto',
                    'NombreProyecto',
                    'Ubicacion',
                    'FechaIni:date',
                    'FechaFin:date',
                    [
                        'label' => 'Institución',
                        'attribute'=> 'idInstitucion.Nombre',
                    ],  
                    [
                        'label' => 'Número de estudiantes requeridos',
                        'attribute'=> 'NumeroPersonas',
                    ],
                    [
                        'label' => 'Número de cupos disponibles',
                        'attribute'=> 'CuposDisponibles',
                    ],            
                    [
                        'label' => 'Total de horas sociales que otorga<br/> al estudiante que finaliza',
                        'attribute'=> 'HorasSolicitadas',
                    ],
                    [
                        'label' => 'Cantidad de horas sociales por hora<br/> de asitencia',
                        'attribute'=> 'HorasSocialesXhora',
                    ],    
                ],
            ]) ?>
        </div>        
    </div>    
</div>

<script>
</script>
<?php
$this->registerJs("
    $('.proyecto-apply').click(function(){
        reservarCupo($(this).data('idproyecto'), $(this).data('idpersona'));
        return false;
    });
    ", \yii\web\View::POS_LOAD, 'reserva-js');
?>
<?php
$this->registerJsFile('@web/js/reservaCupo.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>