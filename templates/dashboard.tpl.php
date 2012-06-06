<?php
	//Include all the necessary JS and CSS files, some external
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_dashboard.css');

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
		<h2>Files generated this month</h2>
		<?php print views_embed_view('user_file_usage') ?>
	</div>
</div>