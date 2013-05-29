<?php

class GeneralController extends Controller
{
    
    public function visualizarArreglo($arreglo,$atributo)
        {
            $resultado = "";
            
            foreach($arreglo as $variable)
            {
                $resultado .= '- '.$variable->{$atributo}.'</br>';
            }
            
            return $resultado;
            
        }
        
}

?>
