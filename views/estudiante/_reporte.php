<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\helpers\CrudHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\catalogs\models\Persona */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="well text-center">
            <?= Html::img('@web/uploads/'.$estudiante->ArchivoAdjunto, ['width'=>'100px', 'height' =>'100px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?>
            <span class="text-center text-info"><?=$estudiante->CarnetEstudiante?> <?=$estudiante->NombreCompleto?></span>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 well">
        <hr/>
        <?php
        $horas= $estudiante->getHoras()->where(['EstadoRegistro' => '1'])->orderBy('IdProyecto')->all();
        ?>
        <table class="table table-bordered table-condensed text-center">
            <thead>
                <tr class="alert alert-info">
                    <th colspan="2">Proyecto</th>
                    <th>Horas Sociales</th>
                    <th>Asistencia</th>
                </tr>
            </thead>
            <?php
            $sumaHoras = 0;
            foreach($horas as $h)
            {
                $p = $h->idProyecto;
                $sumaHoras += $h->HorasRealizadas;
                ?>
                <tr>
                    <td>
                        <?= Html::img('@web/uploads/'.$p->ArchivoAdjunto, ['width'=>'100px', 'height' =>'100px', 'align'=>'center', 'class'=> 'img img-responsive img-thumbnail']);?>
                    </td>
                    <td><?=$p->NombreProyecto;?></td>
                    <td><?=$h->HorasRealizadas;?></td>
                    <td>
                        <?php
                        $asistencia = $p->getAsistenciasPersona($estudiante->IdPersona);
                        ?>
                        <table style="width: 100%" border='0'>
                            <tr>
                                <th>Fecha</th>
                                <th>Cantidad de horas</th>
                                <th>Comentario</th>
                            </tr>
                        <?php
                        foreach($asistencia as $a)
                        {
                            ?>
                            <tr>
                                <td><?=$a->Fecha?></td>
                                <td><?=$a->CantidadHoras?></td>
                                <td><?=$a->Comentarios?></td>
                            </tr>
                            <?php
                        }                        
                        ?>
                        </table>
                    </td>
                </tr>
                <?php
            }
            ?>   
            <tfoot>
                <tr>
                    <td colspan="2"><b>Total de horas</b></td>
                    <td><?=$sumaHoras?></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>        
    </div>
</div>    
