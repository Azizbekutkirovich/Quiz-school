<?php

use app\excel\SimpleXLSX;
$src = "./../web/tests/test4.xlsx";
$excel = SimpleXLSX::parse($src);
$rows = $excel->rows();

// 10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,
// i = 1
$correct_test = "1,2,3,4,";
$i = 1;
while ($i <= 30) {
	for ($j = 0; $j < strlen($correct_test); $j++) {
		if ($j == 0 || $j % 2 == 0) {
			if ($i == $correct_test[$j]) {
				$i++;
				echo "Correct index: ".$i.'<br>';
				echo "Correct test: ".$correct_test[$j].'<br>';
			} else {
				continue;
			}
		}
	}
	$i++;
}