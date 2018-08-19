<?php 

namespace AlphaLeonisAddons\Helpers;

/**
* Date
*/
class Date
{
	
	public static function toPolish($date)
	{
		return str_replace(
			array('January','February','March','April','May','June','July','August','September','October','November','December'),
			array('Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'),
			$date
		);
	}
}


