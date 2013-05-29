<?php
class NumeroPuntoFlotante extends CActiveRecordBehavior
{
    public $campos;                 // String de campos separados por comas los cuales se les desea aplicar el formato
    public $separador = '.';        // Separador de miles
    
    public function beforeValidate($event)
    {
        $campos = explode(',', $this->campos);
        foreach($campos as $campo){
            if(isset($this->getOwner()->{trim($campo)}))
                $this->getOwner()->{trim($campo)} = str_replace('.', '', $this->getOwner()->{trim($campo)}); //Sustituye los . por vacio
                $this->getOwner()->{trim($campo)} = str_replace(',', '.', $this->getOwner()->{trim($campo)}); //cambia las , por .
        }
        
    }

    public function afterFind($event)
    {
        
        $separador_dec = ($this->separador != '.')? '.' : ',';
        $campos = explode(',', $this->campos);
        foreach($campos as $campo)
            $this->getOwner()->{trim($campo)} = number_format($this->getOwner()->{trim($campo)},4,',','.');
        
        return true;
    }
}