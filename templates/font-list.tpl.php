<?php
	exec('/opt/local/bin/convert -list font', $output, $code);

	//Loop through and extract everything
	if(!$code){
		foreach($output as $font){
			$font = explode(":", $font);
			if(preg_match('/family/', $font[0])) {
				$fontFamily[$font[1]] = $font[1];
				$prev = $font[1];
			}
			if(preg_match('/style/', $font[0])) {
				$styles[$prev][] = $font[1];
			}
		}
	}

	//Create the rows
	foreach($fontFamily as $font){
		$rows[] = array(
			$font, 
			implode(', ', array_unique($styles[$font]))
		);
	}
?>
<h3 class="subTitle">Supported font families and styles</h3>
<p>We currently support the following font families. However, if you do wish add a font of your own to this list, just <?php print l('drop us a line', 'add-font-form', array('query' => array('width' => 500), 'attributes' => array('class' => 'colorbox-node'))) ?> and we will have it done for at no extra charges.</p>
<?php
	print theme_table(array(
		'header' => array('Font family', 'Supported styles'),
		'rows' => $rows,
		'attributes' => array('width' => '100%'),
		'sticky' => true,
		'caption' => null,
		'colgroups' => null,
		'empty' => null
	));	
?>