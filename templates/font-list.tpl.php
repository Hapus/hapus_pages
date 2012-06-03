<?php 
	// Populate the array only - do not display it
    exec("convert -list font", $IMarray, $code);

	print_r($IMarray);
	print_r($code);
?>

<h3 class="subTitle">Fonts list</h3>