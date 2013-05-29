<?php
class NumeroRomano extends CActiveRecordBehavior
{
    public $campos;                 // String de campos separados por comas los cuales se les desea aplicar el formato
    
    public function afterFind($event) {
        
        $campos = explode(',', $this->campos);
        
        foreach($campos as $campo)
        {
            $this->getOwner()->$campo = $this->traducirNumeroNatural($this->getOwner()->$campo);
        }
        
    }
    
    public function beforeSave($event) {
        
        $campos = explode(',', $this->campos);
        
        foreach($campos as $campo)
        {
            $this->getOwner()->$campo = $this->traducirNumeroRomano($this->getOwner()->$campo);
        }
        
    }
    
    private function traducirNumeroRomano($val)
    {
        if($val == "I") return "1";
        else if($val == "II") return "2";
        else if($val == "III") return "3";
        else if($val == "IV") return "4";
        else if($val == "V") return "5";
        else if($val == "VI") return "6";
        else if($val == "VII") return "7";
        else if($val == "VIII") return "8";
        else if($val == "IX") return "9";
        else if($val == "X") return "10";
        else if($val == "XI") return "11";
        else if($val == "XII") return "12";
        else if($val == "XIII") return "13";
        else if($val == "XIV") return "14";
        else if($val == "XV") return "15";
        else if($val == "XVI") return "16";
        else if($val == "XVII") return "17";
        else if($val == "XVIII") return "18";
    }

    private function traducirNumeroNatural($val)
    {
        
        if($val == 1) return "I";
        else if($val == 2) return "II";
        else if($val == 3) return "III";
        else if($val == 4) return "IV";
        else if($val == 5) return "V";
        else if($val == 6) return "VI";
        else if($val == 7) return "VII";
        else if($val == 8) return "VIII";
        else if($val == 9) return "XI";
        else if($val == 10) return "X";
        else if($val == 11) return "XI";
        else if($val == 12) return "XII";
        else if($val == 13) return "XIII";
        else if($val == 14) return "XIV";
        else if($val == 15) return "XV";
        else if($val == 16) return "XVI";
        else if($val == 17) return "XVII";
        else if($val == 18) return "XVIII";
        
    }

}