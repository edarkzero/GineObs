<?php

class FechaHoraDetallada extends CActiveRecordBehavior
{
    public $campos; // String de campos separados por comas los cuales se les desea aplicar el formato
    public $tipo; // detalle en fecha: 1-fecha sin tiempo, 2-fecha y tiempo

    public function beforeValidate($event)
    {
        $campos = explode(',', $this->campos);

        foreach ($campos as $campo) {
            if (isset($this->getOwner()->{trim($campo) . '_alt'}) && $this->getOwner()->{trim($campo) . '_alt'} != '' && $this->getOwner()->{trim($campo) . '_bdd'} != $this->getOwner()->{trim($campo) . '_alt'}) {
                if(isset($this->getOwner()->{trim($campo) . '_time'}))
                    $aux = $this->getOwner()->{trim($campo) . '_time'};

                $this->getOwner()->{trim($campo)} = $this->getOwner()->{trim($campo) . '_alt'};

                if(isset($this->getOwner()->{trim($campo) . '_time'}))
                {
                    $this->getOwner()->{trim($campo) . '_time_bdd'} = $aux;
                }
            }
        }

        return true;

    }

    public function beforeSave($event)
    {
        $campos = explode(',', $this->campos);

        foreach ($campos as $campo) {
            if (!(isset($this->getOwner()->{trim($campo) . '_alt'}) && $this->getOwner()->{trim($campo) . '_alt'} != '' && $this->getOwner()->{trim($campo) . '_bdd'} != $this->getOwner()->{trim($campo) . '_alt'})) {
                $this->getOwner()->{trim($campo)} = $this->getOwner()->{trim($campo) . '_bdd'};
            }
            if(isset($this->getOwner()->{trim($campo) . '_time'}))
            {
                $aux = DateTools::parseAmPmTo24h($this->getOwner()->{trim($campo) . '_time_bdd'});
                $this->getOwner()->{trim($campo)} .= ' '.$aux;
            }
        }

        return true;
    }

    public function afterFind($event)
    {
        $campos = explode(',', $this->campos);

        foreach ($campos as $campo) {
            if (isset($this->getOwner()->{trim($campo)})) {

                $this->getOwner()->{trim($campo) . '_bdd'} = $this->getOwner()->{trim($campo)};

                if ($this->tipo == '1')
                    $this->getOwner()->{trim($campo)} = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long', false);

                else { //Revisar un metodo mas optimo
                    if (isset($this->getOwner()->{trim($campo) . '_time'})) {
                        $this->getOwner()->{trim($campo) . '_time'} = date('h:i A', strtotime($this->getOwner()->{trim($campo)}));
                        $this->getOwner()->{trim($campo)} = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long', false);
                    } else {
                        $aux = Yii::app()->dateFormatter->formatDateTime($this->getOwner()->{trim($campo)}, 'long', false);
                        $this->getOwner()->{trim($campo)} = $aux . " " . date('h:i A', strtotime($this->getOwner()->{trim($campo)}));
                    }
                }

            }

        }

        return true;
    }
}