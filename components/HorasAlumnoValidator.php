<?php
namespace app\components;

use yii\validators\Validator;
use app\helpers\PersonaHelper;
use app\helpers\ConfiguracionHelper;
use app\models\Horas;

class HorasAlumnoValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $persona = PersonaHelper::getPersonaById($model->IdPersona);
        $conf = ConfiguracionHelper::getConfiguracion();
        $maximoHorasConfiguracion = $conf->CantidadHorasSociales;
        $maximoHorasCarrera = $persona->idCarrera->CantidadHorasSociales;
        $maximoHoras = (trim($maximoHorasCarrera) != '') ? $maximoHorasCarrera : $maximoHorasConfiguracion;
        $HorasOld = Horas::findOne(['IdPersona'=>$model->IdPersona, 'IdProyecto'=>$model->IdProyecto]);
        
        $cantidadHoras = $persona->getCantidadHorasSociales();
        if($HorasOld != FALSE) //Si es update
        {
           $total = $cantidadHoras - $HorasOld->HorasRealizadas + $model->HorasRealizadas; 
        }
        else //si es create
        {
            $total = $cantidadHoras + $model->HorasRealizadas;
        }
        
        if($total > $maximoHoras && $model->EstadoRegistro == '1')
        {
            $this->addError($model, $attribute, 'El estudiante no puede tener mas de '.$maximoHoras.' horas sociales, si suma las '.$model->HorasRealizadas.' horas, tendría en total: '.$total);
        }
    }
}