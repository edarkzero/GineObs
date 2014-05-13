<?php
class FechaHoraDetallada extends CActiveRecordBehavior
{
    public $campos;                 // String de campos separados por comas los cuales se les desea aplicar el formato
    public $tipo;        // detalle en fecha: 1-fecha sin tiempo, 2-fecha y tiempo

    public function beforeValidate($event)
    {
        $campos = explode(',', $this->campos);

        foreach($campos as $campo){
            if(isset($this->getOwner()->{trim($campo)}))
            {
                $this->getOwner()->{trim($campo)} = strtolower($this->getOwner()->{trim($campo)});

                /*$date = new DateTime();

                $date->createFromFormat('',$this->getOwner()->{trim($campo)});
                $this->getOwner()->{trim($campo)} = $date->format('Y-m-d');*/

                throw new Exception(CDateTimeParser::parse($this->getOwner()->{trim($campo)}, Yii::app()->locale->getDateFormat('long')));

                if($this->tipo=='1')
                {
                    $date->createFromFormat(Yii::app()->locale->getDateFormat('long'),$this->getOwner()->{trim($campo)});
                    $this->getOwner()->{trim($campo)} = $date->format('Y-m-d');
                    //$this->getOwner()->{trim($campo)} = CTimestamp::formatDate('Y-m-d',CDateTimeParser::parse($this->getOwner()->{trim($campo)},'dd-MM-yyyy'));
                }
                else
                {
                    $date->createFromFormat(Yii::app()->locale->getDateFormat('long','long'),$this->getOwner()->{trim($campo)});
                    $this->getOwner()->{trim($campo)} = $date->format('Y-m-d H:i:s');
                    //$this->getOwner()->{trim($campo)} = CTimestamp::formatDate('Y-m-d',CDateTimeParser::parse($this->getOwner()->{trim($campo)},'dd-MM-yyyy hh:mm:ss'));
                }

            }
        }

        return true;

    }

    public function afterFind($event)
    {
        $campos = explode(',', $this->campos);
        
        foreach($campos as $campo){
            if(isset($this->getOwner()->{trim($campo)})) {

                if($this->tipo=='1')
                    $this->getOwner()->{trim($campo)} = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long',false);
                    
                else 
                {   //Revisar un metodo mas optimo
                    /*$aux = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long',false);
                    $this->getOwner()->{trim($campo)} = $aux." ".date('h:i a', strtotime($this->getOwner()->{trim($campo)}));*/
                    $this->getOwner()->{trim($campo)} = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long','short');
                }
                    
            }
        
        }
        
        return true;
    }
}