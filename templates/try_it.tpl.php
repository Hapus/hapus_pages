<?php
	//Add the necessary CSS and JS
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_try_it.css');
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/hapus_try_it.js');

	//Create the headers
	$tryItHeaders['conPage'] = 'Web page';
	$tryItHeaders['conHtml'] = 'HTML code';
	$tryItHeaders['conWysiwyg'] = 'WYSIWYG editor';
?>

<div id="tryHeader"><?php print render_try_it_headers($tryItHeaders) ?></div>
<div id="tryContent">
	<div id="conPageContent" class="tabContent">
		Claritas liber dignissim aliquip at liber. Per congue parum eleifend at legere. Tempor me hendrerit lius magna odio. Veniam decima nobis dignissim et commodo. 
	</div>
	<div id="conHtmlContent" class="tabContent">
		Delenit lius luptatum nunc nobis euismod. Vel quod nulla illum legere mazim. Dolor dolor facer tincidunt consectetuer in. Velit consequat dolore euismod littera volutpat. 
	</div>
</div>