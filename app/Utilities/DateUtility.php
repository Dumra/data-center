<?php

namespace App\Utilities;

use DateTime;
use DateTimeZone;

class DateUtility
{

	private function __construct()
	{
		;
	}

	public static function formatDate(DateTime $date)
	{
		return gmdate('Y-m-d H:i:s', $date->getTimestamp());
	}

	public static function getTZUTC($utc)
	{
		if (!isset($utc))
		{
			$utc = new DateTimeZone('UTC');
		}
		return $utc;
	}

	public static function getDateRange($sdate)
	{
		if (preg_match('/\d+(:|-)?(\d+:|-)?(\d+)?/', $sdate) === 0)
		{
			return DateUtility::getRangeByPointer(strtolower($sdate));
		}		
		$tstart = array((int) date('Y'), 1, 1, 0, 0, 0);
		$sdate = trim($sdate);
		if (strlen($sdate))
		{
			$splitted = preg_split('/[^0-9]+/', $sdate);
		}
		else
		{
			$splitted = array();
		}

		$count = is_array($splitted) ? count($splitted) : 0;
		$adate = array("%'04d-%'02d-%'02d %'02d:%'02d:%'02d");
		for ($i = 0; $i < 6; ++$i)
		{
			$adate[] = ($count > $i ? $splitted[$i] : $tstart[$i]);
		}
		$sdate = call_user_func_array('sprintf', $adate);
		$start = strtotime($sdate);
		if ($start)
		{
			$ival = array('Y', 'Y', 'M', 'D', 'H', 'M', 'S');
			$end = new \DateTime($sdate);
			$res = array($end->format('Y-m-d H:i:s'));
			$end->add(new \DateInterval('P' . ($count > 3 ? 'T' : '') . '1' . $ival[$count]));
			$res[] = $end->format('Y-m-d H:i:s');
			return $res;
		}
		return null;
	}
	
	private static function getRangeByPointer($pointer)
	{
		$date = new DateTime();
		if ($pointer === 'today' || $pointer === 'thisday' || $pointer === 'day')
		{
			return array($date->format('Y-m-d 00:00:00'), $date->format('Y-m-d 23:59:59'));
		}
		if ($pointer === 'yesterday' || $pointer === 'lastday')
		{
			$date = $date->modify("-1 day");
			return array($date->format('Y-m-d 00:00:00'), $date->format('Y-m-d 23:59:59'));
		}
		$interval = '';
		if (strpos($pointer, 'this') === 0 || strpos($pointer, 'last') === 0)
		{
			$interval = substr($pointer, 0, 4);
			$pointer = substr($pointer, 4);
		}
		switch ($pointer)
		{
			case 'minute':
				if ($interval === 'last')
				{
					$date = $date->modify("-1 minutes");
				}
				$startTime = $date->format('Y-m-d H:m:00');
				return array($startTime, $date->format('Y-m-d H:m:59'));
				break;
			case 'hour':
				if ($interval === 'last')
				{
					$date = $date->modify("-1 hours");
				}
				$startTime = $date->format('Y-m-d H:00:00');
				return array($startTime, $date->format('Y-m-d H:59:59'));
				break;
			case 'week':
				if ($interval === 'last')
				{
					$date = $date->modify("-1 weeks");
				}
				$startTime = $date->modify("Monday this week")->format('Y-m-d 00:00:00');
				$endTime = $date->modify("Sunday this week")->format('Y-m-d 23:59:59');
				return array($startTime, $endTime);
				break;
			case 'month':
				if ($interval === 'last')
				{
					$date = $date->modify("-1 month");
				}
				$startTime = $date->modify("first day of this month")->format('Y-m-d 00:00:00');
				$endTime = $date->modify("last day of this month")->format('Y-m-d 23:59:59');
				return array($startTime, $endTime);
				break;
			case 'year':
				if ($interval === 'last')
				{
					$date = $date->modify("-1 year");
				}
				$startTime = $date->modify("first day of January this year")->format('Y-m-d 00:00:00');
				$endTime = $date->modify("last day of December this year")->format('Y-m-d 23:59:59');
				return array($startTime, $endTime);
				break;
		}
	}

}
