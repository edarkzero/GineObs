<?php

class DateTools
{
    const LONG_DATE_FORMAT_JS = "d 'de' MM 'de' yy";

    static function TIEMPO_TRANSCURRIDO($time, $time2 = null)
    {
        $calc = self::TIME_DIFF($time, $time2);
        $tc = $calc['tc'];
        $transcurido = $calc['transcurido'];

        $plu['minutos'] = (intval($tc['minutos']) == 1) ? NULL : 's';
        $plu['horas'] = (intval($tc['horas']) == 1) ? NULL : 's';
        $plu['dias'] = (intval($tc['dias']) == 1) ? NULL : 's';
        $plu['meses'] = (intval($tc['meses']) == 1) ? NULL : 's';
        $plu['años'] = (intval($tc['años']) == 1) ? NULL : 's';
        $frase = "Hace ";
        $frase = ($transcurido < 60 AND $transcurido > 15) ? 'menos de un minuto' : $frase;
        $frase = ($transcurido > 60 AND $transcurido < 3600) ? intval($tc['minutos']) . ' minuto' . $plu['minutos'] : $frase;
        $frase = ($transcurido > 3600 AND $transcurido < 86400) ? intval($tc['horas']) . ' hora' . $plu['horas'] : $frase;
        $frase = ($transcurido > 86000 AND $transcurido < '2629743,83') ? intval($tc['dias']) . ' dia' . $plu['dias'] : $frase;
        $frase = ($transcurido > '2629743,83' AND $transcurido < 31556926) ? intval($tc['meses']) . ' mes' . $plu['meses'] : $frase;
        $frase = ($transcurido > 31556926 AND $transcurido < 315569260) ? intval($tc['años']) . ' año' . $plu['años'] : $frase;
        $frase = ($transcurido > 3155692600) ? 'mas de 10 años' : $frase;
        return $frase == 'Hace ' ? $frase . 'segundos' : $frase;
    }

    static function ELAPSED_TIME($time, $time2 = null)
    {
        $calc = self::TIME_DIFF($time, $time2);
        $tc = $calc['tc'];
        $transcurido = $calc['transcurido'];

        $plu['minutos'] = (intval($tc['minutos']) == 1) ? NULL : 's';
        $plu['horas'] = (intval($tc['horas']) == 1) ? NULL : 's';
        $plu['dias'] = (intval($tc['dias']) == 1) ? NULL : 's';
        $plu['meses'] = (intval($tc['meses']) == 1) ? NULL : 's';
        $plu['años'] = (intval($tc['años']) == 1) ? NULL : 's';
        $frase = "Ago";
        $frase = ($transcurido < 60 AND $transcurido > 15) ? 'Less than a minute' : $frase;
        $frase = ($transcurido > 60 AND $transcurido < 3600) ? intval($tc['minutos']) . ' minute' . $plu['minutos'] : $frase;
        $frase = ($transcurido > 3600 AND $transcurido < 86400) ? intval($tc['horas']) . ' hour' . $plu['horas'] : $frase;
        $frase = ($transcurido > 86000 AND $transcurido < '2629743,83') ? intval($tc['dias']) . ' day' . $plu['dias'] : $frase;
        $frase = ($transcurido > '2629743,83' AND $transcurido < 31556926) ? intval($tc['meses']) . ' month' . $plu['meses'] : $frase;
        $frase = ($transcurido > 31556926 AND $transcurido < 315569260) ? intval($tc['años']) . ' year' . $plu['años'] : $frase;
        $frase = ($transcurido > 3155692600) ? 'more than 10 years' : $frase;
        return $frase == 'Ago' ? 'seconds ' . $frase : $frase;
    }

    private static function TIME_DIFF($time, $time2)
    {
        if ($time2 === null) $time2 = time();

        $transcurido = time() - $time;
        $tc['minutos'] = @$transcurido / 60;
        $tc['horas'] = @$transcurido / 3600;
        $tc['dias'] = @$transcurido / 86400;
        $tc['meses'] = @$transcurido / '2629743,83';
        $tc['años'] = @$transcurido / 31556926;
        return array('tc' => $tc, 'transcurido' => $transcurido);
    }



    public static function yiiLocaleFormatToClientFormat($type = 'long')
    {
        $php_format = Yii::app()->locale->getDateFormat($type);

        $SYMBOLS_MATCHING = array(
            // Day
            'd' => 'dd',
            'D' => 'D',
            'j' => 'd',
            'l' => 'DD',
            'N' => '',
            'S' => '',
            'w' => '',
            'z' => 'o',
            // Week
            'W' => '',
            // Month
            'F' => 'MM',
            'm' => 'mm',
            'M' => 'M',
            'n' => 'm',
            't' => '',
            // Year
            'L' => '',
            'o' => '',
            'Y' => 'yy',
            'y' => 'y',
            // Time
            'a' => '',
            'A' => '',
            'B' => '',
            'g' => '',
            'G' => '',
            'h' => '',
            'H' => '',
            'i' => '',
            's' => '',
            'u' => ''
        );
        $jqueryui_format = "";
        $escaping = false;
        for($i = 0; $i < strlen($php_format); $i++)
        {
            $char = $php_format[$i];
            if($char === '\\') // PHP date format escaping character
            {
                $i++;
                if($escaping) $jqueryui_format .= $php_format[$i];
                else $jqueryui_format .= '\'' . $php_format[$i];
                $escaping = true;
            }
            else
            {
                if($escaping) { $jqueryui_format .= "'"; $escaping = false; }
                if(isset($SYMBOLS_MATCHING[$char]))
                    $jqueryui_format .= $SYMBOLS_MATCHING[$char];
                else
                    $jqueryui_format .= $char;
            }
        }
        return $jqueryui_format;
    }

}