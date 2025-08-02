<?php

namespace app\excel;

class StartOfFile {
	public static function getStartOfTheTest($rows) {
		for ($i = 0; $i < count($rows); $i++) {
			if ((!empty($rows[$i][0]) && $rows[$i][0] == 'T/r') || (!empty($rows[$i][0]) && $rows[$i][0] == '№')) {
				$start = $i + 1;
			} else if ((!empty($rows[$i][1]) && $rows[$i][1] == 'Savollar') || (!empty($rows[$i][1]) && $rows[$i][1] == 'Savol')) {
				$start = $i + 1;
			}
		}
		return $start ?? false;
	}
}