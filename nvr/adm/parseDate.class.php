<?php
class ParseDate
{
	public static	function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);	
    return $d && $d->format($format) == $date;
}

	public static function chDateFormat($date, $inFormat, $outFormat)
	{
		try
		{
			$d = DateTime::createFromFormat($inFormat, $date);
			$valDate =  $d->format($outFormat);
			//echo "<br>---<br>";

			return $valDate;
		}
		catch (Exception $ex)
		{
			//echo "<br>-e-<br>";
			return false;
		}
		return false;
	}

function tryCurrDate($start, $end)
{
	if(self::validateDate($start, 'Y-m-d') && self::validateDate($end, 'Y-m-d'))
	{
		$resultArr['startStamp'] = $start." 00:00:00";
		$resultArr['endStamp']   = $end." 23:59:59";
		return $resultArr;
	}
	/*
	else
	{
		$resArrDate = prepareDateInArray($start, $end);
		if(isset($resArrDate) && is_array($resArrDate))
		{
			$resultArr['startStamp'] = $start."\T00:00:00";
			$resultArr['endStamp']   = $start."\T23:59:59";
			return $resultArr;
		}
		return;
	}*/
	return;
}

function changeFormatDate($start, $end, $separator)
{
	$sarr = explode($separator, $start);
	$earr = explode($separator, $end);
	if(isset($sarr[0]) && isset($sarr[1]) && isset($sarr[2]) && isset($earr[0]) && isset($earr[1]) && isset($earr[2]) )
	{
		$resArr[0] = $sarr[2].'-'.$sarr[1].'-'.$sarr[0];
		$resArr[1] = $earr[2].'-'.$earr[1].'-'.$earr[0];		
		return $resArr;
	}
	return;
}

public static function  prepareDateInArray($start, $end)
{
	if( !isset($start) && !isset($end) ) return;
	$resArr = self::tryCurrDate($start, $end);
	if(isset($resArr) &&  is_array($resArr))
	{		
		return $resArr;
	}
	$tmpArr = self::changeFormatDate($start, $end, '.');
	//echo "-.-<br>";
	//var_dump( $tmpArr );
	if(isset($tmpArr) && is_array($tmpArr))
	{
		$resArr = self::tryCurrDate($tmpArr[0], $tmpArr[1]);
		//echo "-тр-<br>";
		//var_dump( $tmpArr );
		if(isset($resArr) &&  is_array($resArr))
		{		
			return $resArr;
		}
	}
	$tmpArr = self::changeFormatDate($start, $end, '/');
	//echo "-/-<br>";
	//var_dump( $tmpArr );
	if(isset($tmpArr) && is_array($tmpArr))
	{
		$resArr = self::tryCurrDate($tmpArr[0], $tmpArr[1]);
		if(isset($resArr) &&  is_array($resArr))
		{		
			return $resArr;
		}
	}	
	return;
}


	public static function  prepareDateValid($inDate)
	{
		if(!isset($inDate)) return false;

		if(self::validateDate($inDate,'Y-m-d'))
		{
			return $inDate;
		}
		$tmpArr = self::changeFormat($inDate, '.');
		if(isset($tmpArr) && $tmpArr != false && self::validateDate($tmpArr,'Y-m-d'))
		{
			return $tmpArr;
		}

		$tmpArr = self::changeFormat($inDate, '/');
		if(isset($tmpArr) && $tmpArr != false && self::validateDate($tmpArr,'Y-m-d'))
		{
			return $tmpArr;
		}

		return false;
	}

	function changeFormat($inDate, $separator)
	{
		$currarr = explode($separator, $inDate);
		if(isset($currarr[0]) && isset($currarr[1]) && isset($currarr[2]) )
		{
			$resArr = $currarr[2].'-'.$currarr[1].'-'.$currarr[0];
			return $resArr;
		}
		return false;
	}

}?>