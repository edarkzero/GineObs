<?php

class DateTools
{
    static function TIEMPO_TRANSCURRIDO($time,$time2 = null)
    {
	    $calc = self::TIME_DIFF($time,$time2);
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
        return $frase == 'Hace ' ? $frase.'segundos' : $frase;
    }

	static function ELAPSED_TIME($time,$time2 = null)
	{
		$calc = self::TIME_DIFF($time,$time2);
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
		return $frase == 'Ago' ? 'seconds '.$frase : $frase;
	}

	private static function TIME_DIFF($time,$time2)
	{
		if($time2 === null) $time2 = time();

		$transcurido = time() - $time;
		$tc['minutos'] = @$transcurido / 60;
		$tc['horas'] = @$transcurido / 3600;
		$tc['dias'] = @$transcurido / 86400;
		$tc['meses'] = @$transcurido / '2629743,83';
		$tc['años'] = @$transcurido / 31556926;
		return array('tc' => $tc,'transcurido' => $transcurido);
	}

}