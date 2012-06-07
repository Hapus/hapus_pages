<?php
	//Include all the necessary JS and CSS files, some external
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_dashboard.css');

	//Include all the necessary JS and CSS files, some external, for code sample generation
	drupal_add_js('http://yandex.st/highlightjs/6.2/highlight.min.js', array('type' => 'external'));
	drupal_add_css('http://yandex.st/highlightjs/6.2/styles/default.min.css', array('type' => 'external'));
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/api_examples.js');

	//Empty dashboard options
	$emptyList[] = 'Go through our ' . l('documentation', 'Documentation/API');
	$emptyList[] = 'Mail us at ' . l('support@sprintpdf.com', 'mailto: support@sprintpdf.com') . '&mdash;we love answering questions :-)';

	//Set the user and profile object
	global $user;
	$userProfile = profile2_load_by_user($user, 'main');

	//Form the Basic information user block
	$blockList['basic_info']['header'] = 'API information';
	$blockList['basic_info']['content'] = array(
		'<strong>Username</strong>: ' . '<input id="apiKey" value="' . $user->name . '" />',
		'<strong>Key</strong>: Your password'
	);

	//Load the files usage  for this user
	$eQuery = new EntityFieldQuery;
	$eQuery->entityCondition('entity_type', 'file')
		   ->propertyCondition('uid', $user->uid)
		   ->propertyCondition('status', 1)
		   ->propertyCondition('filemime', 'application/pdf')
		   ->propertyCondition('timestamp', array(mktime(0, 0, 0, date('n'), 01, date('Y')), mktime(0, 0, 0, ((date('n')) + 1), 0, date('Y'))), 'BETWEEN')
		   ->count();
	$fileUsage = $eQuery->execute();

	//Plan name information
	$plan = array_values(array_intersect($user->roles, array('Freemium', 'Pro', 'Epic', 'administrator')));

	//Remaining
	$filesRemaining = $userProfile->field_user_monthly_limit['und'][0]['value'] - $fileUsage;

	//Form the usage information block
	$blockList['usage_information']['header'] = 'Usage this month';
	$blockList['usage_information']['content'] = array(
		'<strong>Current plan</strong>: ' . $plan[0],
		'<strong>Monthly limit</strong>: ' . $userProfile->field_user_monthly_limit['und'][0]['value'] . ' PDFs',
		'<strong>Usage</strong>: ' . format_plural($fileUsage, '@count PDF', number_format($fileUsage) . ' PDFs') . ' generated',
		'<strong>Remaining</strong>: ' . number_format($filesRemaining)
	);

	//Form the quick starter block
	$blockList['quick_starter']['header'] = 'Quickstarter';
	$blockList['quick_starter']['content'] = array(
		'<span class="qsNumber">1</span>Download the most recent ' . l('Sprint PDF library', 'https://github.com/Hapus/SprintPDF_PHP_Library', array('external' => true, 'attributes' => array('target' => '_BLANK'))) . ' from Github.',
		'<span class="qsNumber">2</span>Inlude it in your code ' . l('like this', 'api-example/generate-pdf/php', array('query' => array('height' => '500') ,'attributes' => array('class' => 'colorbox-node'))) . '.',
		'<span class="qsNumber">3</span>Start PDFing!'
	);	
?>

<div id="dashboard">
	<!--Left sidebar for the dashboard-->
	<div id="dashLeft">
		<?php
			$cnt = 1;
			foreach($blockList as $block){
				print render_hapus_dashboard_block($block, $cnt);
				$cnt += 1;
			}
		?>
	</div>

	<!--Right side content-->
	<div id="dashRight">
		<?php if($fileUsage > 0): ?>
			<h2>Files generated this month</h2>
			<?php print views_embed_view('user_file_usage') ?>
		<?php else: ?>
			<h2>No PDFs generated this month</h2>
			<p>If you need assistance with using Sprint PDF, you could:</p>
			<?php 
				print theme_item_list(array(
					'items' => $emptyList,
					'type' => 'ol',
					'attributes' => array('id' => 'emptyHelp'),
					'title' => null
				));
			?>
		<?php endif; ?>
	</div>
</div>