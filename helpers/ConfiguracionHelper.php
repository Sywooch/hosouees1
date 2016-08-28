<?php
namespace app\helpers;
use app\models\Configuracion;

class ConfiguracionHelper
{
    public static function getConfiguracion() 
    {
        return Configuracion::findOne(['EstadoRegistro' => '1']);
    }      
}