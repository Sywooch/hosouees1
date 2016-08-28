<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */
?>
<a class="pull-right" href="javascript:void(0)" id="ARefresh"><i class="glyphicon glyphicon-refresh fa-2x"></i></a>
<ul class="nav nav-tabs" id="myTabs1">
  <li class="active"><a data-toggle="tab" href="#gral">Informaci&oacute;n general</a></li>
  <li><a data-toggle="tab" href="#estudiantes">Estudiantes activos</a></li>
  <li><a data-toggle="tab" href="#horasobtenidas">Horas sociales obtenidas</a></li>
  <li><a data-toggle="tab" href="#asistencia">Asistencia</a></li>
  <li><a data-toggle="tab" href="#comunicacion">Comunicaci&oacute;n</a></li>
</ul>

<div class="tab-content">
  <div id="gral" class="tab-pane fade in active">
      <h3>Informaci&oacute;n general</h3>
    <?= $this->render('view', [
        'model' => $model,
    ]) ?>
  </div>
  <div id="estudiantes" class="tab-pane fade">
    <ul class="list-group">
      <?php 
      foreach($model->idPersonasActivas as $estudiante)
      {
          ?>
            <li class="list-group-item">
            <?= Html::img('@web/uploads/'.$estudiante->ArchivoAdjunto, ['width'=>'150px', 'height' =>'150px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?> 
            <b><?= $estudiante->CarnetEstudiante?></b> <?= $estudiante->NombreCompleto?> 
            <span class="badge badge-info"><?= $estudiante->idCarrera->Nombre?></span>   
            
            </li>
          <?php
          
      }
      ?>      
    </ul>      

  </div>
  <div id="horasobtenidas" class="tab-pane fade">
    <h3>Registro de horas</h3>
    <iframe src="<?=Url::home(true)?>horas/?idProyecto=<?=$model->IdProyecto?>" seamless border="0" width="100%" height="700px" style="border: 0px;"></iframe>  
  </div>
  <div id="asistencia" class="tab-pane fade">
    <h3>Registro de asistencia</h3>
    <iframe src="<?=Url::home(true)?>asistencia/?idProyecto=<?=$model->IdProyecto?>" seamless border="0" width="100%" height="700px" style="border: 0px;"></iframe>
  </div>    
  <div id="comunicacion" class="tab-pane fade">
    <h3>Menajes sobre el proyecto</h3>
    <iframe src="<?=Url::home(true)?>comunicacion/?idProyecto=<?=$model->IdProyecto?>" seamless border="0" width="100%" height="700px" style="border: 0px;"></iframe>
  </div>    
</div>
<script>
$(function(){
    $('#ARefresh').on('click', function(){
        $('.modal-body').fadeOut().load('/proyecto/detalle-asesor?id=<?=$model->IdProyecto?>', function(){
            $('.modal-body').fadeIn();
        });
    })
})
//$('#myTabs a').click(function (e) {
//  e.preventDefault()
//  alert($(this).tab());
//  $(this).tab('show')
//})    
</script>