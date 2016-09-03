<?php
use yii\helpers\Html;

$this->title = 'Misión, Visión y Valores de la UEES'
?>
<div class="row well">
    <div class="col-md-12 celda">
        <?= Html::img('@web/img/top_visionmision.png', ['alt'=>'some', 'class'=>'img img-responsive', 'style'=>'width:100%']);?> 
    </div>
</div>
<div class="row well">
    <div class="col-md-12 celda">
        <p><strong class="text text-info"> MISIÓN </strong></p><br>
        “Formar profesionales con excelencia académica, conscientes del servicio a sus semejantes y con una ética cristiana basada en las sagradas escrituras para responder a las necesidades y cambios de la sociedad”. </p>
    </div>
    <div class="col-md-12 celda">
        <p><strong class="text text-info"> VISIÓN </strong></p><br>
        “Ser la institución de educación superior, líder regional por su excelencia académica e innovación científica y tecnológica; reconocida por su naturaleza y práctica cristiana.” </p>                     
        
    </div>
    <div class="col-md-12 celda">
        <p><strong class="text text-info"> VALORES </strong></p>
        <ul>
            <li>1- Integridad </li>
            <li>2- Excelencia </li>
            <li>3- Compromiso </li>
            <li>4- Solidaridad </li>
            <li>5- Servicio </li>             
        </ul>        
    </div>   
</div>
<style>
    .celda{
        border: 0px black dashed;
        padding: 20px;
    }
</style>