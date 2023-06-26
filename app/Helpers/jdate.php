<?php
/*
 * JDate Class writed by Seyed Bahram Siadati <bahram@siadati.com>
 * @license http://www.opensource.org/licenses/gpl-3.0.php GNU/GPL
 */



class jdate {
	var $kabise = 0;
	var $days = 0;
	public function __construct(){
		$this->iranian_months =
			array(
				1 => 0,
				2 => 31,
				3 => 62,
				4 => 93,
				5 => 124,
				6 => 155,
				7 => 186,
				8 => 216,
				9 => 246,
				10 => 276,
				11 => 306,
				12 => 336
			);

		$this->week_days =
			array(
				0 => 5,
				1 => 6,
				2 => 0,
				3 => 1,
				4 => 2,
				5 => 3,
				6 => 4
			);
	
		$this->week_days_name =
			array(
				0 => 'شنبه',
				1 => 'یک شنبه',
				2 => 'دو شنبه',
				3 => 'سه شنبه',
				4 => 'چهار شنبه',
				5 => 'پنج شنبه',
				6 => 'آدینه'
			);

		$this->week_days_shortname =
			array(
				0 => 'شنبه',
				1 => 'یک',
				2 => 'دو',
				3 => 'سه',
				4 => 'چهار',
				5 => 'پنج',
				6 => 'آدینه'
			);
			
		$this->months_name =
			array(
				1 => 'فروردین',
				2 => 'اردیبهشت',
				3 => 'خرداد',
				4 => 'تیر',
				5 => 'مرداد',
				6 => 'شهریور',
				7 => 'مهر',
				8 => 'آبان',
				9 => 'آذر',
				10 => 'دی',
				11 => 'بهمن',
				12 => 'اسفند',
			);

		$this->months_shortname =
			array(
				1 => 'فرو',
				2 => 'ارد',
				3 => 'خرد',
				4 => 'تیر',
				5 => 'مرد',
				6 => 'شهر',
				7 => 'مهر',
				8 => 'آبان',
				9 => 'آذر',
				10 => 'دی',
				11 => 'بهمن',
				12 => 'اسف',
			);

		$this->kabise_days = array(
				1,
				5,
				9,
				13,
				17,
				22,
				26,
				30
			);
	}
	
	public function jdate($time){
		if($time < 3000 && $time > 0){
			$time = strtotime($time);
		}
		
		//24796800 is 306 days for set 1 month and 1 day of year
		$time = $time + 24796800;
		
		$days = intval($time / 86400);
		$day_name = $this->week_days[abs($days % 7)];
		
		//remove kabise date
		$this->create_kabise_find($time);
		
		//Start Calculate Time
		$seconds = ($time % 86400);
		
		if($seconds < 0){
			$seconds = 86400 + $seconds;
			$time -= $seconds;
		}
		
		$day_sec = $seconds;
		
		$hours = intval($seconds/3600);
		$seconds = ($seconds % 3600);
		$minutes = intval($seconds / 60);
		$seconds = ($seconds % 60);
		//End Calculate Time
		
		//Start Calculate Date
		$days = intval($time / 86400);
		$years = intval(1348 + ($days / 365));
		$days = ($days % 365);
		
		if($days < 0){
			$days = (($this->kabise == true) ? 366 : 365) + $days ;
		}elseif($days == 0){
			$years	-= 1;
			if($time < 0){
				$this->is_kabise($this->days, 2);
			}
			$days	= ($this->kabise == true) ? 366 : 365;
		}
		
		$months = $this->find_month($days);
		
		$day_of_year = abs($days);
		$days = $days-$this->iranian_months[$months];
		//End Calculate Date
		
		return array (
			'y' => $years,
			'm' => $months,
			'd' => $days,
			'h' => $hours,
			'i' => $minutes,
			's' => $seconds,
			'day_name' => $day_name,
			'day_sec' => $day_sec,
			'day_of_year' => $day_of_year
			);
	}
	
	public function show_date($formats = "Y-m-d H:i:s", $time = 0){
		
		date_default_timezone_set("Asia/Tehran");
		
		if(!$time) $time = time();
		
		
		$date = $this->jdate($time);
		$date['time'] = $time;
		
		preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $formats, $formats);
		
		$output = null;
		foreach($formats[0] as $format){
			if(preg_match("/[a-z]/i", $format)){
				$output .= $this->format($format, $date);
			}else{
				$output .= $format;
			}
		}
		
		return $output;
	}
	
	private function format($format, &$date){
		switch ($format){
			case 'd':
				return sprintf("%02d", $date['d']);
				break;

			case 'D':
				return $this->week_days_shortname[$date['day_name']];
				break;
			
			case 'j':
				return intval($date['d']);
				break;

			case 'l':
				return $this->week_days_name[$date['day_name']];
				break;

			case 'w':
				return $date['day_name'];
				break;

			case 'z':
				return $date['day_of_year'];
				break;
				
			case 'm':
				return sprintf("%02d", $date['m']);
				break;

			case 'n':
				return intval($date['m']);
				break;

			case 'F':
				return $this->months_name[intval($date['m'])];
				break;

			case 'M':
				return $this->months_shortname[intval($date['m'])];
				break;

			case 'L':
				if(in_array(($date['y'] % 33), $this->kabise_days)){
					return 1;
				}else{
					return 0;
				}
				break;

			case 'Y':
				return sprintf("%04d", $date['y']);
				break;

			case 'y':
				return substr($date['y'], 2);
				break;

			case 'B':
				return intval($date['day_sec'] / 86.4);
				break;
				
			case 'T':
				return $date['day_sec'];
				break;

			case 'G':
				return intval($date['h']);
				break;

			case 'H':
				return sprintf("%02d", $date['h']);
				break;

			case 'a':
				return $this->ampm($date['h'], $date['m'], $date['s']) ? 'ب.ظ' : 'ق.ظ';
				break;

			case 'A':
				return $this->ampm($date['h'], $date['m'], $date['s']) ? 'بعد از ظهر' : 'قبل از ظهر';
				break;

			case 'g':
				return intval($this->hours12($date['h'], $date['m'], $date['s']));
				break;

			case 'h':
				return sprintf("%02d", $this->hours12($date['h'], $date['m'], $date['s']));
				break;

			case 'i':
				return sprintf("%02d", $date['i']);
				break;

			case 's':
				return sprintf("%02d", $date['s']);
				break;

			case 'U':
				return $date['time'];
				break;
		}
	}
	
	private function hours12($hours, $minutes, $seconds){
		if($hours >= 12 && $minutes > 0 && $seconds > 0){
			if($hours == 12){
				return 12;
			}elseif($hours == 24){
				return 0;
			}else{
				return ($hours%12);
			}
		}else{
			if($hours == 0){
				return 12;
			}else{
				return $hours;
			}	
		}
	}
	
	private function ampm($hours, $minutes, $seconds){
		if($hours >= 12 && $minutes > 0 && $seconds > 0){
			if($hours == 24){
				return 0;
			}else{
				return 1;
			}
		}else{
			return 0;
		}
	}
	
	public function junixtime($date){
		$date = preg_split('/[- :\\/]/', $date);
		$unixtime = 0;
		
		$years = $date[0] - 1348;
		$unixtime = (($years * 365) * 86400);
		
		$days_ago = (($this->iranian_months[(int)$date[1]] + $date[2]) * 86400);
		$unixtime += $days_ago;
		
		if(count($date) > 5){
			$time = ($date[3] * 3600) + ($date[4] * 60) + $date[5];
			$unixtime += $time;
		}
		
		//kabise find
		$unixtime += ($this->convert_kabise_find($years) * 86400);
		
		return $unixtime - 24796800;
	}
	
	private function find_month($days){
		foreach($this->iranian_months as $month => $day){
			if($day < $days){
				if(isset($this->iranian_months[$month+1])){
					if($days <= ($this->iranian_months[$month+1])){
						return $month;
					}
				}else{
					return $month;
				}
			}
		}
	}
	
	private function convert_kabise_find($years){
		$calculate_years = 1348 + $years;
		
		$kabise = 0;
		if($years > 0){
			for($i=1348; $i < $calculate_years; $i++){
				if(in_array(intval($i % 33), $this->kabise_days)){
					$kabise++;
				}
			}
		}else{
			for($i=$calculate_years; $i <= 1348; $i++){
				if(in_array(intval($i % 33), $this->kabise_days)){
					$kabise--;
				}
			}
		}
		
		return $kabise;
	}
	
	private function create_kabise_find(&$time){
		$days = ($time / 86400);
		$days = (1348 + intval($days / 365.24219852));
		$kabise = 0;
		if($days > 1348){
			for($i=1348; $i < $days; $i++){
				if(in_array(intval($i % 33), $this->kabise_days)){
					$kabise++;
				}
			}
		}else{
			for($i=$days; $i <= 1348; $i++){
				if(in_array(intval($i % 33), $this->kabise_days)){
					$kabise--;
				}
			}
		}
		
		$this->days = $days;
		$this->is_kabise($days);
		
		$time -= ($kabise * 86400);
	}
	
	private function is_kabise($year, $number = 1){
		if(in_array((($year-$number) % 33), $this->kabise_days)){
			$this->kabise = true;
		}else{
			$this->kabise = false;
		}
	}
}
