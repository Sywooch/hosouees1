<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;
use app\helpers\PersonaHelper;
$persona = PersonaHelper::getPersona();
/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Persona */
?>
<div class="row">
    <div class="col-md-5 col-sm-5 col-xs-5 col-xs-offset-0">
        <div class="well text-center">
            <div class="alert alert-info">Estudiante</div>
            <?= Html::img('@web/uploads/'.$estudiante->ArchivoAdjunto, ['width'=>'100px', 'height' =>'100px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?>
            <br/>
            <small><b>Carnet: </b></small> <?=$estudiante->CarnetEstudiante?>
            <br/>
            <small><b>Nombre: </b></small><?=$estudiante->NombreCompleto?>
            <br/>
            <small><b>Carrera:</b></small> <?=$estudiante->idCarrera->Nombre?>
        </div>
    </div>
    <div class="col-md-5 col-sm-5 col-xs-6">
        <div class="well text-center">
            <div class="alert alert-info">Proyecto</div>
            <?= Html::img('@web/uploads/'.$p->ArchivoAdjunto, ['width'=>'100px', 'height' =>'100px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?>
            <br/>
            <small><b>Nombre del proyecto: </b></small> <?=$p->NombreProyecto;?>
            <br/>
            <small><b>Asesor:</b></small> <?=$p->idPersonaAsesor->NombreCompleto?>
            <br/>
            <small><b>Ubicación:</b></small> <?=$p->Ubicacion?>
            <br/>
            <small><b>Institucion:</b></small> <?=$p->idInstitucion->Nombre?> 
            <br/>
            <small><b>Horas otorgadas:</b></small> <?=$horas->HorasRealizadas;?>            
            
        </div>
    </div>    
    <div class="col-md-12 col-sm-12 col-xs-12 well">
        <hr/>
        <h3>Asistencia</h3>
        <table class="table table-bordered table-condensed text-center">
            <thead>
                <tr class="alert alert-info">
                    <th>Fecha</th>
                    <th>Hora de entrada</th>
                    <th>Hora de salida</th>
                    <th>Cantidad de horas</th>
                    <th>Comentarios</th>
                </tr>
            </thead>

            <tr>
                <td></td>
                <td>
                    <?php
                    $asistencia = $p->getAsistenciasPersona($estudiante->IdPersona);
                    foreach($asistencia as $a)
                    {
                        ?>
                        <tr>
                            <td>
                                <?php
                                Yii::$app->formatter->locale = 'es';
                                echo Yii::$app->formatter->asDate($a->Fecha); // output: January 1, 2014
                                ?>
                            </td>
                            <td><?=$a->HoraEntrada?></td>
                            <td><?=$a->HoraSalida?></td>
                            <td><?=$a->CantidadHoras?></td>
                            <td><?=$a->Comentarios?></td>
                        </tr>
                        <?php
                    }                        
                    ?>
                    </table>
                </td>
            </tr>
        </table>    
    </div>
    <table style="width: 100%; text-align: center; margin-top: 50px">
        <tr>
            <td style="width: 50%">
                __________________________
                <br>
                <?=$p->idPersonaAsesor->NombreCompleto?>
            </td>
            <td style="width: 50%">
                __________________________
                <br>
                <?=$estudiante->NombreCompleto?> 
            </td>
        </tr>
    </table>    
</div>    
