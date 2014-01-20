<?php

/**
 * Class SpecialOperations
 */
class SpecialOperations
{

    /**
     * @param $string
     * @return mixed
     */
    public static function CLEAR_SPECIAL_CHARACTERS($string)
    {
        $s = mb_strtolower($string, 'UTF-8');

        $s = preg_replace("[áàâãªä@]", "a", $s);
        $s = preg_replace("[ÁÀÂÃÄ]", "A", $s);
        $s = preg_replace("[éèêë]", "e", $s);
        $s = preg_replace("[ÉÈÊË]", "E", $s);
        $s = preg_replace("[íìîï]", "i", $s);
        $s = preg_replace("[ÍÌÎÏ]", "I", $s);
        $s = preg_replace("[óòôõºö]", "o", $s);
        $s = preg_replace("[ÓÒÔÕÖ]", "O", $s);
        $s = preg_replace("[úùûü]", "u", $s);
        $s = preg_replace("[ÚÙÛÜ]", "U", $s);
        $s = str_replace("[¿ ? \]", "_", $s);
        $s = str_replace(" ", "", $s);
        $s = str_replace("ñ", "n", $s);
        $s = str_replace("Ñ", "N", $s);

        return $s;
    }

    /**
     * @param string $datetime
     * @param string $format
     * @param bool $capitalize
     * @return string
     */
    public static function DATETIME_FORMAT($datetime, $format = "y MM dd", $capitalize = true)
    {
        return $capitalize ? ucfirst(Yii::app()->dateFormatter->format($format,$datetime)) : Yii::app()->dateFormatter->format($format,$datetime);
    }

    public static function ORDER_ARRAY($array,$field,$invert = false)
    {

        function cmp($a,$b)
        {
            $aa = $a['qpCuponCount'];
            $bb = $b['qpCuponCount'];

            if ($aa == $bb) {
                return 0;
            }

            return ($aa < $bb) ? -1 : 1;

        }

        function cmpInv($a,$b)
        {
            $aa = $a['qpCuponCount'];
            $bb = $b['qpCuponCount'];

            if ($aa == $bb) {
                return 0;
            }

            return ($aa < $bb) ? 1 : -1;

        }

        $invert ? usort($array, "cmp") : usort($array, "cmpInv");
        return $array;

    }

    public static function ORDER_ARRAY_COUNT($array, $invert = false)
    {

        function cmp($a,$b)
        {
            $aa = count($a);
            $bb = count($b);

            if ($aa == $bb) {
                return 0;
            }

            return ($aa < $bb) ? -1 : 1;

        }

        function cmpInv($a,$b)
        {
            $aa = count($a);
            $bb = count($b);

            if ($aa == $bb) {
                return 0;
            }

            return ($aa < $bb) ? 1 : -1;

        }

        $invert ? usort($array, "cmp") : usort($array, "cmpInv");
        return $array;

    }

}