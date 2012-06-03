<?php
	$pageSizes[] = array('A0', '841 x 1189 mm');
	$pageSizes[] = array('A1', '594 x 841 mm');
	$pageSizes[] = array('A2', '420 x 594 mm');
	$pageSizes[] = array('A3', '297 x 420 mm');
	$pageSizes[] = array('A4', '210 x 297 mm, 8.26 x 11.69 inches');
	$pageSizes[] = array('A5', '148 x 210 mm');
	$pageSizes[] = array('A6', '105 x 148 mm');
	$pageSizes[] = array('A7', '74 x 105 mm');
	$pageSizes[] = array('A8', '52 x 74 mm');
	$pageSizes[] = array('A9', '37 x 52 mm');

	$pageSizes[] = array('B0', '1000 x 1414 mm');
	$pageSizes[] = array('B1', '707 x 1000 mm');
	$pageSizes[] = array('B2', '500 x 707 mm');
	$pageSizes[] = array('B3', '353 x 500 mm');
	$pageSizes[] = array('B4', '250 x 353 mm');
	$pageSizes[] = array('B5', '176 x 250 mm, 6.93 x 9.84 inches');
	$pageSizes[] = array('B6', '125 x 176 mm');
	$pageSizes[] = array('B7', '88 x 125 mm');
	$pageSizes[] = array('B8', '62 x 88 mm');
	$pageSizes[] = array('B9', '33 x 62 mm');
	$pageSizes[] = array('B10', '31 x 44 mm');

	$pageSizes[] = array('C5E', '163 x 229 mm');
	$pageSizes[] = array('Comm10E', '105 x 241 mm, U.S. Common 10 Envelope');
	$pageSizes[] = array('DLE', '110 x 220 mm');
	$pageSizes[] = array('Executive', '7.5 x 10 inches, 190.5 x 254 mm');
	$pageSizes[] = array('Folio', '210 x 330 mm');
	$pageSizes[] = array('Ledger', '431.8 x 279.4 mm');
	$pageSizes[] = array('Legal', '8.5 x 14 inches, 215.9 x 355.6 mm');
	$pageSizes[] = array('Letter', '8.5 x 11 inches, 215.9 x 279.4 mm');
	$pageSizes[] = array('Tabloid', '279.4 x 431.8 mm');
	$pageSizes[] = array('Custom', 'Unknown, or a user defined size.');
?>

<h3 class="subTitle">Supported page sizes</h3>
<?php
	print theme_table(array(
		'header' => array('Size', 'Dimensions'),
		'rows' => $pageSizes,
		'attributes' => array('width' => '100%'),
		'caption' => null,
		'colgroups' => null,
		'empty' => null,
		'sticky' => true
	));	
?>