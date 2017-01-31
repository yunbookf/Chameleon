<?php
/**
 * Created by PhpStorm.
 * User: yunbo
 * Date: 2015/10/26
 * Time: 14:23
 */

namespace C\lib {

	class Net {

		public static function get($url) {

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			$output = curl_exec($ch);
			curl_close($ch);
			if ($output) return $output;
			else return false;

		}

		public static function post($url, $data = []) {

            $upload = false;
            foreach ($data as $i) {
                if ($i[0] === '@') {
                    $upload = true;
                    break;
                }
            }
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                $upload ? $data : http_build_query($data));
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $output = curl_exec($ch);
            curl_close($ch);
            if ($output) {
                return $output;
            } else {
                return false;
            }

		}

		public static function getIP() {

			if (getenv('HTTP_CLIENT_IP')) {
				return getenv('HTTP_CLIENT_IP');
            } else if (getenv('HTTP_X_FORWARDED_FOR')) {
                return getenv('HTTP_X_FORWARDED_FOR');
            } else
				return getenv('REMOTE_ADDR');

		}

		public static function getCityByIP($ip = NULL) {

			$ip = $ip === NULL ? self::getIP() : $ip;
			$r = self::get('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$ip);
			if(strlen($r) > 10) {
				$j = json_decode(substr($r, strpos($r, '{'), -1));
				return $j->city;
			} else
				return '';

		}

	}

}

