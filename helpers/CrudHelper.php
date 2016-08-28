<?php
namespace app\helpers;
class CrudHelper
{
    const ACTIVE = '1';
    const INACTIVE = '0';     
    public static function getEstadosRegistro() 
    {
        return array (self::ACTIVE=>'Activo',self::INACTIVE=>'Inactivo');
    }
     
    public static function getEstadosRegistroLabel($estadoRegistro) {
      if ($estadoRegistro==self::ACTIVE) {
        return 'Activo';
      } else {
        return 'Inactivo';        
      }
    } 

    const ESTUDIANTE = 'ES';
    const EMPLEADO = 'EM';
    const EXTERNO = 'EX';
    
    public static function getTipoPersona() 
    {
        return array (self::ESTUDIANTE=>'Estudiante', self::EMPLEADO=>'Empleado', self::EXTERNO=>'Empleado');
    }
     
    public static function getTipoPersonaLabel($tipoPersona) {
      if ($tipoPersona==self::ESTUDIANTE) {
        return 'Estudiante';
      } elseif($tipoPersona==self::EMPLEADO) {
        return 'Empleado';        
      }
      elseif($tipoPersona==self::EXTERNO){
        return 'Externo';   
      }
    } 

    const MASCULINO = 'M';
    const FEMENINO = 'F';
    
    public static function getSexo() 
    {
        return array (self::MASCULINO=>'Masculino', self::FEMENINO=>'Femenino');
    }
     
    public static function getSexoLabel($sexo) {
      if ($sexo==self::MASCULINO) {
        return 'Masculino';
      } elseif($sexo==self::FEMENINO) {
        return 'Femenino';        
      }
    }    
    
    const SI = '1';
    const NO = '0';
    
    public static function getSiNo() 
    {
        return array (self::SI=>'SI', self::NO=>'NO');
    }
     
    public static function getSiNoLabel($val) {
      if ($val==self::SI) {
        return '<span class="glyphicon glyphicon-ok text-success"> SI</span>';
        
      } elseif($val==self::NO) {
        return '<span class="glyphicon glyphicon-remove text-danger"> NO</span>';        
      }
    }        
    
    public static function getObjectTag($url, $width, $height) 
    {
        return '<object width="'.$width.'" height="'.$height.'" data="'.$url.'"></object>';
    }    
}