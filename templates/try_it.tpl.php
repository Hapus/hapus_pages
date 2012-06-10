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
		<?php print drupal_render(tryItFormGen('conPage')) ?>
	</div>
	<div id="conHtmlContent" class="tabContent">
		<?php print drupal_render(tryItFormGen('conHtml')) ?> 
	</div>
	<div id="conWysiwygContent" class="tabContent">
		<?php print drupal_render(tryItFormGen('conWysiwyg')) ?> 
	</div>
</div>