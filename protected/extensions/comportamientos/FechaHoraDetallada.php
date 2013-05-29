<?php
class FechaHoraDetallada extends CActiveRecordBehavior
{
    public $campos;                 // String de campos separados por comas los cuales se les desea aplicar el formato
    public $tipo;        // detalle en fecha: 1-fecha sin tiempo, 2-fecha y tiempo

    public function afterFind($event)
    {
        $campos = explode(',', $this->campos);
        
        foreach($campos as $campo){
            if(isset($this->getOwner()->{trim($campo)})) {
                
                if($this->tipo=='1')
                    $this->getOwner()->{trim($campo)} = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long',false);
                    
                else 
                {   //Revisar un metodo mas optimo
                    $aux = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long',false);
                    $this->getOwner()->{trim($campo)} = $aux." ".date('h:i a', strtotime($this->getOwner()->{trim($campo)}));
                }
                    
            }
        
        }
        
        return true;
    }
}