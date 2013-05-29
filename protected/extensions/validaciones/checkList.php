<?php

class checkList extends CValidator
{
    
    /**
    * Validates the attribute of the object.
    * If there is any error, the error message is added to the object.
    * @param CModel $object the object being validated
    * @param string $attribute the attribute being validated
    */
    protected function validateAttribute($object,$attribute)
    {
        //como minimo debe de haber un valor y si es vacio devolvera un objeto
        // extract the attribute value from it's model object
        $value=$object->$attribute;
        if(empty($value)||is_object($value[0]))
        {
            $this->addError($object,$attribute,'Debe seleccionar al menos una opcion.');
        }
        
    }
    
}

?>
