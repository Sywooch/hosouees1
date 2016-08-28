<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\helpers\CrudHelper;

$this->title = 'Descarga de formularios';

?>
<div class="row">
    <div class="col-md-10 col-md-offset-1 well">
        <table class="table table-bordered table-condensed table-striped" border='1'>
            <thead>
                <tr class="alert alert-info">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Reglamento</th>
                    <th>Descargar</th>
                </tr>
            </thead>
        <?php
        foreach($forms as $f)
        {
            ?>
                <tr>
                    <td><?=$f->IdFormulario?></td>
                    <td><?=$f->NombreFormulario?></td>
                    <td><?=$f->DescripcionFormulario?></td>
                    <td><?=$f->Reglamentos?></td>
                    <td><?=Html::a('<i class="glyphicon glyphicon-download fa-2x"></i> '.$f->NombreAdjunto, ['uploads/'.$f->ArchivoAdjunto], ['target'=> '_blank'])?></td>
                </tr>   

            <?php
        }
        ?>
        </table>       
</div>
