<?php

namespace app\excel;

use Yii;

class TestParser
{
	public static function getParsedData($test_name, $teach_id) {
		$key = "parsing_cache_".$test_name;
		$cache = Yii::$app->cache;
		$data = json_decode($cache->get($key));
		if (!isset($data)) {
			$data = self::parsing($test_name, $teach_id);
			$cache->set($key, json_encode($data), 3600);
		}
		return $data;
	}

	private static function parsing($test_name, $teach_id) {
		$s3_file_key = $teach_id.'/'.$test_name;
		$file = Yii::$app->minio->getFile($s3_file_key);
		return SimpleXLSX::parse($file, true)->rows();
	}
}