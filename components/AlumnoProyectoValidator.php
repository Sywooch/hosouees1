<?php
namespace app\components;

use yii\validators\Validator;
use app\helpers\PersonaHelper;
use app\models\Horas;

class AlumnoProyectoValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        $persona = PersonaHelper::getPersonaById($model->IdPersona);

        // Se valida solo cuando es create
        if($persona->getHoras()->where(['IdProyecto'=>$model->IdProyecto])->exists() && $model->getIsNewRecord())
        {
            $this->addError($model, $attribute, 'El estudiante  '.$persona->NombreCompleto.' ya tiene un registro ligado al proyecto '.$model->idProyecto->NombreProyecto);
        }
    }
}