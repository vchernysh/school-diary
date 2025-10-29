<?php 
	
	function debug($arr) // print_r($array)
	{	
		echo '<pre>' . print_r($arr, true) . '</pre>';

		// END function debug();
	}

	function generateRandomString($length = 8) // generate random string
	{

		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZqwertyuioplkjhgfdsazxcvbnm';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
		    $randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;

		// END function generateRandomString();
	}

	function code($string, $underline = true) // show error code with styles
	{

		$styles = 'word-wrap: break-word; padding: 2px 4px; font-size: 90%; background-color: transparent; border-radius: 4px;';
		if ($underline) {
			$styles .= ' text-decoration: underline;';
		}
		return '<code style="' . $styles . '">' . $string . '</code>';

		// END function code();
	}

	function relativeTime($timestamp) // a year ago | a month ago | 2 years ago
	{
	    if(!ctype_digit($timestamp)) {
	        $timestamp = strtotime($timestamp);
	    }
	    $diff = time() - $timestamp;
	    if($diff == 0) {
	        return 'now';
	    } elseif($diff > 0) {
	        $day_diff = floor($diff / 86400);
	        if($day_diff == 0) {
	            if($diff < 60) return 'just now';
	            if($diff < 120) return '1 minute ago';
	            if($diff < 3600) return floor($diff / 60) . ' minutes ago';
	            if($diff < 7200) return '1 hour ago';
	            if($diff < 86400) return floor($diff / 3600) . ' hours ago';
	        }
	        if($day_diff == 1) { return 'Yesterday'; }
	        if($day_diff < 7) { return $day_diff . ' days ago'; }
	        if($day_diff < 31) { return ceil($day_diff / 7) . ' weeks ago'; }
	        if($day_diff < 60) { return 'a month ago'; }
	        if($day_diff <= 334) { return ceil($day_diff/31) . ' months ago'; }
	        if($day_diff > 334 && $day_diff < 730) { return 'a year ago'; }
	        if($day_diff > 730) { return ceil($day_diff/365) - 1 . ' years ago'; }
	        return date('F Y', $timestamp);
	    } else {
	        $diff = abs($diff);
	        $day_diff = floor($diff / 86400);
	        if($day_diff == 0) {
	            if($diff < 120) { return 'in a minute'; }
	            if($diff < 3600) { return 'in ' . floor($diff / 60) . ' minutes'; }
	            if($diff < 7200) { return 'in an hour'; }
	            if($diff < 86400) { return 'in ' . floor($diff / 3600) . ' hours'; }
	        }
	        if($day_diff == 1) { return 'Tomorrow'; }
	        if($day_diff < 4) { return date('l', $timestamp); }
	        if($day_diff < 7 + (7 - date('w'))) { return 'next week'; }
	        if(ceil($day_diff / 7) < 4) { return 'in ' . ceil($day_diff / 7) . ' weeks'; }
	        if(date('n', $timestamp) == date('n') + 1) { return 'next month'; }
	        return date('F Y', $timestamp);
	    }
	    // END function relativeTime();
	}

	function myDateDiff($date_1, $date_2, $differenceFormat = '%R%a')
	{

		//////////////////////////////////////////////////////////////////////
			//PARA: Date Should In YYYY-MM-DD Format
			//RESULT FORMAT:
				// '%y Year %m Month %d Day %h Hours %i Minute %s Seconds'      =>  1 Year 3 Month 14 Day 11 Hours 49 Minute 36 Seconds
				// '%y Year %m Month %d Day'                                    =>  1 Year 3 Month 14 Days
				// '%m Month %d Day'                                            =>  3 Month 14 Day
				// '%d Day %h Hours'                                            =>  14 Day 11 Hours
				// '%d Day'                                                     =>  14 Days
				// '%h Hours %i Minute %s Seconds'                              =>  11 Hours 49 Minute 36 Seconds
				// '%i Minute %s Seconds'                                       =>  49 Minute 36 Seconds
				// '%h Hours                                                    =>  11 Hours
				// '%a Days                                                     =>  468 Days
		//////////////////////////////////////////////////////////////////////
		
		$day = date('d', $date_1);
		$month = date('m', $date_1);
		$year = date('Y', $date_2);

        $today = date('Y-m-d', $date_2);

	    $datetime1 = date_create($year . '-' . $month . '-' . $day);
	    $datetime2 = date_create($today);
	    
	    $interval = date_diff($datetime1, $datetime2);

	    return $interval->format($differenceFormat);
    	// END function myDateDiff();
	}

	function this_page() // return current page
	{	
		return yii\helpers\Url::base(true) . yii\helpers\Url::to();

		// END function this_page();
	}

	function getDateOfNextYearIfThisDayHasNotPass($date = '01-06') # $date = '01-06' - day-month;
	{
		$current_year = date('Y', time());
	    $needed_time = $date . '-' . $current_year; # '01-06-' . $current_year;
	    if (time() > strtotime($needed_time)) {
	    	$needed_time = $date . '-' . intval($current_year + 1);
	    }

	    $result = strtotime($needed_time);

	    return $result;

	    # END function getDateOfNextYearIfThisDayHasNotPass($date);
	}

	function shuffle_assoc($array)
	{
		if (!is_array($array)) return $array;

		$keys = array_keys($array);
		shuffle($keys);
		$random = array();
		foreach ($keys as $key) {
			$random[$key] = $array[$key];
		}

		return $random;
	}

	function custom_assoc_sort($a, $b, $field) // $field doesn't use - only 2 parameters
	{
        $a = $a[$field];
        $b = $b[$field];

        if ($a == $b) return 0;
        return ($a < $b) ? 1 : -1;

        // END function custom_assoc_sort();

        // EXAMPLE TO USE:     usort($array, 'custom_assoc_sort');
	}

	function remove_spaces($string) // remove all spaces in string
	{
		return str_replace(' ', '', $string);
		
		// END function remove_spaces();
	}

	function trunc_words($phrase, $max_words, $dots = TRUE) // truncate words in long string
	{
		$phrase_array = explode(' ',$phrase);

		if (count($phrase_array) > $max_words && $max_words > 0) {
			$phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . (!$dots  ? '' : '...');
		}
		return $phrase;

		// END function trunc_words();
	}

	function trunc_letters($phrase, $min_letter, $max_letter, $dots = TRUE) // truncate letters in long string
	{
		if ($dots) {

			$dots = ' ...';
		} else {

			$dots = '';
		}

		$phrase = mb_strimwidth($phrase, $min_letter, $max_letter, $dots);

		return $phrase;

		// END function trunc_letters();
	}

	function translit($string) // translit string in another language string
    {
        $converter = array(
          	'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch', 'ь' => '\'', 'ы' => 'y', 'ъ' => '\'','э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch','Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'', 'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya', 'ї' => 'i', 'Ї' => 'I', 'є' => 'ye',  'Є' => 'YE', ' ' => '_', ',' => '', 'ґ' => 'g', 'Ґ' => 'G', '—' => '-',
        );

        $forbidden_chars = '/[№#@!\-"<>&\/?\`~":;=+()*&,.^%$»«\\\|{}\[\]]/i';
 
    	$string = preg_replace($forbidden_chars, '', $string);
        $string = trim(preg_replace('/\s+/', ' ', $string)); // delete 2 and more spaces

        return strtolower(strtr($string, $converter));

        // END function translit();
    }

    function myDayOfWeek($lang = 'ua', $time = NULL)
    {

    	if (is_null($time)) {
    		$time = time();
    	}

    	$numberDayOfWeek = date('w', $time);

    	$dayOfWeek = '';
		
    	if ($lang == 'ua') {

    		switch ($numberDayOfWeek) :
    			case '0': $dayOfWeek = 'Неділя'; break;
    			case '1': $dayOfWeek = 'Понеділок'; break;
    			case '2': $dayOfWeek = 'Вівторок'; break;
    			case '3': $dayOfWeek = 'Середа'; break;
    			case '4': $dayOfWeek = 'Четвер'; break;
    			case '5': $dayOfWeek = 'П\'ятниця'; break;
    			case '6': $dayOfWeek = 'Субота'; break;
    			
    			default: $dayOfWeek = 'Не визначено'; break;

    		endswitch;
    		
    	} elseif ($lang == 'en') {

    		switch ($numberDayOfWeek) :
    			case '0': $dayOfWeek = 'Sunday'; break;
    			case '1': $dayOfWeek = 'Monday'; break;
    			case '2': $dayOfWeek = 'Tuesday'; break;
    			case '3': $dayOfWeek = 'Wednesday'; break;
    			case '4': $dayOfWeek = 'Thursday'; break;
    			case '5': $dayOfWeek = 'Friday'; break;
    			case '6': $dayOfWeek = 'Saturday'; break;
    			
    			default: $dayOfWeek = 'Not specified'; break;

    		endswitch;

    	} elseif ($lang == 'ru') {

    		switch ($numberDayOfWeek) :
    			case '0': $dayOfWeek = 'Воскресенье'; break;
    			case '1': $dayOfWeek = 'Понедельник'; break;
    			case '2': $dayOfWeek = 'Вторник'; break;
    			case '3': $dayOfWeek = 'Среда'; break;
    			case '4': $dayOfWeek = 'Четверг'; break;
    			case '5': $dayOfWeek = 'Пятница'; break;
    			case '6': $dayOfWeek = 'Суббота'; break;
    			
    			default: $dayOfWeek = 'Не определено'; break;

    		endswitch;

    	}

    	return $dayOfWeek;
    }

	function myDate($lang = 'ua', $time = NULL) // new date
	{

		if ($lang == 'ru') {

			$monthes = array(
			    1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
			    5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
			    9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
		
		} elseif ($lang == 'en') {

			$monthes = array(
			    1 => 'Januray', 2 => 'February', 3 => 'March', 4 => 'April',
			    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
			    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
		
		} elseif ($lang == 'ua') {

			$monthes = array(
			    1 => 'Січня', 2 => 'Лютого', 3 => 'Березня', 4 => 'Квітня',
			    5 => 'Травня', 6 => 'Червня', 7 => 'Липня', 8 => 'Серпня',
			    9 => 'Вересня', 10 => 'Жовтня', 11 => 'Листопада', 12 => 'Грудня');
		}

		if (is_null($time)) {
			$time = time();
		}

		return date('d ', $time).$monthes[date('n', $time)].date(' Y', $time);

		// END function myDate();
	}

	function myDateOfBirthdayOfThisYear($lang = 'ua', $time = NULL) // new date
	{

		if ($lang == 'ru') {

			$monthes = array(
			    1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
			    5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
			    9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
		
		} elseif ($lang == 'en') {

			$monthes = array(
			    1 => 'Januray', 2 => 'February', 3 => 'March', 4 => 'April',
			    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
			    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
		
		} elseif ($lang == 'ua') {

			$monthes = array(
			    1 => 'Січня', 2 => 'Лютого', 3 => 'Березня', 4 => 'Квітня',
			    5 => 'Травня', 6 => 'Червня', 7 => 'Липня', 8 => 'Серпня',
			    9 => 'Вересня', 10 => 'Жовтня', 11 => 'Листопада', 12 => 'Грудня');
		}

		if (is_null($time)) {
			$time = time();
		}

		return date('d ', $time).$monthes[date('n', $time)].date(' Y', time());

		// END function myDate();
	}

	function checkDaysString($day)
	{
		$result = $day;
    	$last_number = substr($day, -1);

        if ($day == 0) {
        	$result = '0 днів';
        } elseif ($day <= 20 && $day >= 11) {
        	$result .= ' днів';
        } elseif ($last_number == 1) {
        	$result .= ' день';
        } elseif ($last_number == 2 || $last_number == 3 || $last_number == 4) {
        // } elseif (in_array($last_number, [2, 3, 4])) {
        	$result .= ' дні';
        } else {
        	$result .= ' днів';
        }

    	return $result;

		// END function checkDaysString();
	}

	function age($birthday, $onlyNumeric = true)
	{

		$date1 = date('Y-m-d', time());
        $date2 = date('Y-m-d', $birthday);

        $date1 = str_replace('-', '', $date1);
        $date2 = str_replace('-', '', $date2);

        $age = abs($date1 - $date2);

        if (strlen($age) == 4) {
        	$age = '0' . $age;
        }

        $age = substr($age, 0, -4);

        if ($onlyNumeric)
        {
        	$last_number = substr($age, -1);

	        if ($age == 0) {
	        	$age = '0 років';
	        } elseif ($age <= 20 && $age >= 11) {
	        	$age .= ' років';
	        } elseif ($last_number == 1) {
	        	$age .= ' рік';
	        } elseif ($last_number == 2 || $last_number == 3 || $last_number == 4) {
	        	$age .= ' роки';
	        } else {
	        	$age .= ' років';
	        }
        } else {
        	if ($age == 0) {
	        	$age = '0';
	        }
        }

        return $age;

		// END function age();
	}

	function myTime($hour = 'H', $time = NULL) // new time
	{
		if (is_null($time)) {
			$time = time();
		}
		
		return date('' . $hour . ':i:s', $time);

		// END function myTime();
	}

	function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) // IP info about user
	{
	    $output = NULL;
	    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
	        $ip = $_SERVER["REMOTE_ADDR"];
	        if ($deep_detect) {
	            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	    }
	    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	    $continents = array(
	        "AF" => "Africa",
	        "AN" => "Antarctica",
	        "AS" => "Asia",
	        "EU" => "Europe",
	        "OC" => "Australia (Oceania)",
	        "NA" => "North America",
	        "SA" => "South America"
	    );
	    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
	        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
	        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
	            switch ($purpose) {
	                case "location":
	                    $output = array(
	                        "city"           => @$ipdat->geoplugin_city,
	                        "state"          => @$ipdat->geoplugin_regionName,
	                        "country"        => @$ipdat->geoplugin_countryName,
	                        "country_code"   => @$ipdat->geoplugin_countryCode,
	                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
	                        "continent_code" => @$ipdat->geoplugin_continentCode
	                    );
	                    break;
	                case "address":
	                    $address = array($ipdat->geoplugin_countryName);
	                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
	                        $address[] = $ipdat->geoplugin_regionName;
	                    if (@strlen($ipdat->geoplugin_city) >= 1)
	                        $address[] = $ipdat->geoplugin_city;
	                    $output = implode(", ", array_reverse($address));
	                    break;
	                case "city":
	                    $output = @$ipdat->geoplugin_city;
	                    break;
	                case "state":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "region":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "country":
	                    $output = @$ipdat->geoplugin_countryName;
	                    break;
	                case "countrycode":
	                    $output = @$ipdat->geoplugin_countryCode;
	                    break;
	            }
	        }
	    }
	    return $output;

	    // END function ip_info();
	}

	// _____________________ EXAMPLE FOR function ip_info(); _____________________ //

	// $country_c = ip_info($_SERVER['REMOTE_ADDR'], "Country Code");
	// if ($country_c == "US") {
	// 	header("Location: https://tsianalytics.com/en/us");
	// }

	// ___________________ END EXAMPLE FOR function ip_info(); ___________________ //


?>