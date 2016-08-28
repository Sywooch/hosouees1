<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Proyecto */
?>
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
      <table class="table table-bordered table-hover">
        <tr>
            <th>Estudiante</th>
            <th>Carrera</th>
            <th>Horas sociales</th>
            <th>Proyecto Completado</th>
        </tr>
      <?php 
      foreach($model->horas as $hora)
      {
          ?>
            <tr>
                <td>
                    <?= Html::img('@web/uploads/'.$hora->idPersona->ArchivoAdjunto, ['width'=>'50px', 'height' =>'50px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?> 
                    <?= $hora->idPersona->CarnetEstudiante?> - <?= $hora->idPersona->NombreCompleto?>
                </td>
                <td><?= $hora->idPersona->idCarrera->Nombre?></td>
                <td><?= $hora->HorasRealizadas?></td>
                <td><?= ($hora->ProyectoCompleto == '1') ? 'SI' : 'NO'?></td>
            <b></b>              
            </tr>
          <?php
          
      }
      ?>      
    </table>   
  </div>
  <div id="asistencia" class="tab-pane fade">
    <h3>Registro de asistencia</h3>
    <iframe src="<?=Url::home(true)?>asistencia/?idProyecto=<?=$model->IdProyecto?>" seamless border="0" width="100%" height="700px" style="border: 0px;"></iframe>
  </div>    
  <div id="comunicacion" class="tab-pane fade">
    <h3>Menu 2</h3>
    <p>Some content in menu 2.</p>
  </div>    
</div>
<!--<script>
$('#myTabs a').click(function (e) {
  e.preventDefault()
  alert($(this).tab());
  $(this).tab('show')
})    
</script>-->