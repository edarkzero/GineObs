<?php
class MtMActiveRecord extends CActiveRecord
{
        /*
         * relData: {0:Nombre de Tabla relacion, 1: Nombre de atributo 1, 2: Nombre de atributo 2}
         */
    
        public function saveMtM($relData,$id,$ginecologiaEnfermedads)
        {
            foreach ($ginecologiaEnfermedads as $enfermedad)
            {
                $sql = "INSERT INTO $relData[0] ($relData[1], $relData[2]) VALUES (".$id.",".$enfermedad.");";
                Yii::app()->db->createCommand($sql)->query();
            }
                
        }
        
        public function updateMtM($relData,$id,$ginecologiaEnfermedadsNEW, $ginecologiaEnfermedadsOLD)
        {
            $ocurrencia=false;
            $i = 0;
            $sqlDEL = "";
            $sqlINSERT = "";
            
            if(count($ginecologiaEnfermedadsNEW) > 0)
                $sqlDEL = "DELETE FROM $relData[0] WHERE $relData[1] = $id AND ";
            
            foreach ($ginecologiaEnfermedadsNEW as $enfermedadNEW)
            {   
                $ocurrencia=false;
                
                if($i < count($ginecologiaEnfermedadsNEW)-1)
                    $sqlDEL .= "$relData[2] != $enfermedadNEW AND ";
                
                else
                    $sqlDEL .= "$relData[2] != $enfermedadNEW;";
                
                foreach($ginecologiaEnfermedadsOLD as $enfermedadOLD)
                {
                    if($enfermedadNEW == $enfermedadOLD->id)
                    {
                        $ocurrencia = true;
                        break;
                    }
                
                }
                
                if(!$ocurrencia)
                    $sqlINSERT .= "INSERT INTO $relData[0] ($relData[1], $relData[2]) VALUES (".$id.",".$enfermedadNEW.");";
                
                $i++;
                
            }
            
            if($sqlDEL!="")Yii::app()->db->createCommand($sqlDEL)->query();
            if($sqlINSERT!="")Yii::app()->db->createCommand($sqlINSERT)->queryAll();
            
        }
        
        public function deleteMtM($relData,$id,$ginecologiaEnfermedads)
        {
            foreach ($ginecologiaEnfermedads as $enfermedad)
            {
                $sql = "DELETE FROM $relData[0] WHERE $relData[1] = $id;";
                Yii::app()->db->createCommand($sql)->query();
            }
                
        }
        
}
?>
