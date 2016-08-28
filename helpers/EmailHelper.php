<?php
namespace app\helpers;
use app\modules\catalogs\models\Proyecto;

class EmailHelper
{
    public static function sendEmailReservaCupo($proyecto, $persona) 
    {
        $emailAsesor = isset($proyecto->idPersonaAsesor->user->login) ? $proyecto->idPersonaAsesor->user->login : false ;
        
        if($emailAsesor !== false)
        {
            $msg= 'Reserva de cupo para el proyecto '.$proyecto->NombreProyecto. ' por parte del estudiante : '.$persona->CarnetEstudiante. ' : '.$persona->NombreCompleto;
            \Yii::$app->mailer->compose()
                  ->setFrom(\Yii::$app->params['adminEmail'])
                  ->setTo($emailAsesor)
                  ->setSubject('Reserva de cupo para proyecto de horas sociales')
                  ->setTextBody($msg)
                  ->setHtmlBody($msg)
                  ->send();             
        }
  
    }    
        
}