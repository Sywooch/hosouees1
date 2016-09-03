<?php
use \yii\helpers\Html;
use \yii\bootstrap\Button;
use \app\helpers\PersonaHelper;
use \app\helpers\ConfiguracionHelper;
$configuracion = ConfiguracionHelper::getConfiguracion();
/* @var $this yii\web\View */
$this->title = 'Bienvenido al Sistema de gestión de Horas Sociales de la UEES';
$persona = PersonaHelper::getPersona();
//echo $persona->getCantidadHorasSociales();
?>
<div class="site-index">
    <?php 
    if($persona->Elegible == '0' && $persona->TipoPersona == 'ES')
    {
        echo $configuracion->TextoBienvenidaNoElegible;
    }
    else
    {
        echo $configuracion->TextoBienvenida;
    }
    ?>
</div>
<script>
//    alert('hosouees');
</script>


