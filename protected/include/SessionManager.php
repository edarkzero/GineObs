<?php
/**
 * Created by JetBrains PhpStorm.
 * User: edark_000
 * Date: 04/10/13
 * Time: 03:06 PM
 * To change this template use File | Settings | File Templates.
 */

class SessionManager 
{
    const TESTING_USER = 51;
	const CLIENTE_USER = 'cliente';
	const PERSONAL_USER = 'personal';
	const VISITANTE_USER = 'visitante';

    public static function  GET_SESSION($name, $throwException = false)
    {
        if (!isset(Yii::app()->session[$name])) {
            //TODO: cambiar esto por un render para mostrar un error amigable sin detalles de codigo php.
            if ($throwException)
                throw new CHttpException(403, Yii::t('app', 'The specified request cannot be found') . '.');

            return -1;
        }

        return Yii::app()->session[$name];
    }

    public static function  SET_SESSION($name, $value)
    {
        Yii::app()->session[$name] = $value;
    }

    public static function GET_USER($attribute = null)
    {
        if($attribute != null)
            return isset(Yii::app()->user->{$attribute}) ? Yii::app()->user->{$attribute} : null;
        else
            return Validator::HAS_DATA(Yii::app()->user) ? Yii::app()->user : null;
    }

}