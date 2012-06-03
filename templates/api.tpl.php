<?php
	//Include all the necessary JS and CSS files, some external
	drupal_add_js('http://yandex.st/highlightjs/6.2/highlight.min.js', array('type' => 'external'));
	drupal_add_css('http://yandex.st/highlightjs/6.2/styles/default.min.css', array('type' => 'external'));
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/api_examples.js');


	//User object
	global $user;

	//Add the necessary CSS and JS files
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/commons/accordion.css');
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_api.css');

	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/hapus_api.js');
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/commons/jquery.hapusAccordion.js');
	

	$api['user-info']['api'] = 'user-info';
	$api['user-info']['title'] = 'Retrieve your account information';
	$api['user-info']['method'] = 'get';
	$api['user-info']['endpoint'] = '/api/me/info';
	$api['user-info']['desc'] = 'This call provides user information, account details, usage details, etc.';
	$api['user-info']['params'] = array(
		"username" => array(
			"desc"=> "Your Sprint PDF username " . ($user->uid ? ' (' . $user->name . ')' : ''),
			"mandatory"=> true,
			"permVals" => null,
			"type" => "string"
		),
		"key" => array(
			"desc"=> "Your Sprint PDF password",
			"mandatory"=> true,
			"permVals" => null,
			"type" => "string"
		),
	);

	$api['generate-pdf']['api'] = 'generate-pdf';
	$api['generate-pdf']['title'] = 'Generate a PDF';
	$api['generate-pdf']['method'] = 'post';
	$api['generate-pdf']['endpoint'] = '/api/pdf';
	$api['generate-pdf']['desc'] = 'This call generates the PDF.';
	$api['generate-pdf']['params'] = array(
		"username" => array(
			"desc"=> "Your Sprint PDF username " . ($user->uid ? ' (' . $user->name . ')' : ''),
			"mandatory"=> true,
			"permVals" => null,
			"type" => "string"
		),
		"key" => array(
			"desc"=> "Your Sprint PDF password",
			"mandatory"=> true,
			"permVals" => null,
			"type" => "string"
		),
		"resource" => array(
			"desc"=> "The actual HTML or public URL to convert. When using a URL, it must start with http:// or https://",
			"mandatory"=> true,
			"permVals" => null,
			"type" => "string"
		),
		"type" => array(
			"desc"=> "The type of resource you are passing",
			"mandatory"=> true,
			"permVals" => array('html', 'url'),
			"type" => "string"
		),
		"parameters" => array(
			"desc"=> l('Various options', 'Documentation/options', array('attributes' => array('TARGET' => '_BLANK'))) . " you can provide for PDF generation",
			"mandatory"=> false,
			"permVals" => null,
			"type" => "string"
		),
		"outputasfile" => array(
			"desc"=> "Determines whether the file will be outputted as raw content or and actual PDF file&mdash-very handy when working with CURL",
			"mandatory"=> false,
			"permVals" => array('true', 'false'),
			"type" => "boolean"
		),
	);
?>

<h3 class="pageTitle">REST API Documentation</h3>

<dl id="apiDocs" class="accordion">
	<?php foreach($api as $apiItem): ?>
		<dt>
			<?php 
				$endpoints = array();
				$endpoints[] =  $apiItem['endpoint'] . '.json';
				$endpoints[] =  $apiItem['endpoint'] . '.xml';
			?>
			<div class="acToggle"><span class="plus">+</span><span class="minus">-</span></div><div class="acTitle"><?php print $apiItem['title'] ?></div><div class="apiEndpoint"><?php print implode(', ', $endpoints) ?></div><div class="acMethod apimethod_<?php print $apiItem['method'] ?>"><?php print $apiItem['method'] ?></div>
		</dt>
		<dd><div class="ddContent">
			<div class="desc"><?php print $apiItem['desc'] ?></div>
			<div class="params"><?php print _createParamTable($apiItem['params']) ?></div>
			<div class="examples">
				Examples: <?php print _createExampleLinks($apiItem) ?>
			</div>
		</div></dd>
	<?php endforeach; ?>
</dl>