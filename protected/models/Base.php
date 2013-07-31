<?php

    class Base
    {
        public static function toAutoCompleteFormat($data)
        {
            $string = "";

            foreach($data as $key => $model)
            {
                if($key > 0) $string .=",";

                $string .= '"'.$model->id.'-'.$model->nombre1.' '.$model->apellido1.'"';
            }

            return $string;
        }
    }