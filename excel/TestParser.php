<?php

namespace app\excel;

use Yii;

class TestParser
{
	public static function getParsedData($test_name) {
		$key = "parsing_cache_".$test_name;
		$cache = Yii::$app->cache;
		$data = json_decode($cache->get($key));
		if (!isset($data)) {
			$data = self::parsing($test_name);
			$cache->set($key, json_encode($data), 3600);
		}
		return $data;
	}

	private static function parsing($test_name) {
		$src = "./../web/tests/$test_name";
		return SimpleXLSX::parse($src)->rows();
	}
}