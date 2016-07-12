<?php

namespace Sitpac\FrontendBundle\Twig\Extension;



/**
 * Extensión propia de Twig con filtros y funciones útiles para
 * la aplicación
 */
class SitpacExtension extends \Twig_Extension
{


    public function getFunctions()
    {
        return array(
            'duracion' => new \Twig_Function_Method($this, 'duracion'),
            'cadenaMD5' => new \Twig_Function_Method($this, 'cadenaMD5'),
            'aleatorio' => new \Twig_Function_Method($this, 'aleatorio'),
        );
    }
    
    public function duracion($inicio, $fin)
    {
        
       $dias = (strtotime($inicio)-strtotime($fin))/86400;
       $dias = abs($dias); $dias = floor($dias);
        return $dias+1;
    }

    public function cadenaMD5($ApiKey, $merchantId, $referenceCode, $amount, $currency)
    {
        
       $strigToHash = $ApiKey."~".$merchantId."~".$referenceCode."~".$amount."~".$currency;
       $signature = md5($strigToHash);
       
        return $signature;
    }

    public function aleatorio($referencia)
    {
        
       $referencia = uniqid('sitpac-');
        return $referencia;
    }

    public function getName()
    {
        return 'sitpac';
    }
}
