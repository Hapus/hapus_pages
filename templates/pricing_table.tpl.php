<?php
	//Add the necessary externals
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_pricing_table.css');
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/hapus_dashboard.js');

	//Get the path and keep
	$path = isset($_GET['q']) ? $_GET['q'] : '<front>';

	//Coming soon attributes
	$comingSoonLink = l('Coming soon', 'http://localhost/~avadhutp/hapus/?q=colorbox/paid-plans-coming-soon&width=500', array('attributes' => array('class' => 'colorbox-node')));

	//Load the necessary nodes
	$plans = entity_load('node', array(11, 12, 13));

	$freemium = $plans[11];
	$pro = $plans[12];
	$epic = $plans[13];

	//Create the content for later rendering
	$pt['freemium']['type'] = 'ul';
	$pt['freemium']['title'] = null;
	$pt['freemium']['attributes'] = array('id' => 'freemium', 'class' => 'ptList');
	$pt['freemium']['items'][] = '<h6>Freemium</h6><div class="ptPrice"><strong>' . $freemium->field_cost[$freemium->language][0]['value'] . '$</strong>/month</div><div class="ptByLine">Best bet for any freelancer</div>';
	$pt['freemium']['items'][] = number_format($freemium->field_monthly_limit[$freemium->language][0]['value']) . ' PDFs<sup>' . _createInlineHelp(1, 'help-freemium-monthy-limit') . '</sup>';
	$pt['freemium']['items'][] = 'Unlimited apps<sup>' . _createInlineHelp(2, 'help-unlimited-apps') . '</sup>';
	$pt['freemium']['items'][] = 'Full font support';
	$pt['freemium']['items'][] = 'E-mail support';
	$pt['freemium']['items'][] = l('<input class="form-submit light-gray" type="submit" value="Sign up" />', 'user/register', array('html' => true, 'attributes' => array('class' => 'button-link')));

	$pt['pro']['type'] = 'ul';
	$pt['pro']['title'] = null;
	$pt['pro']['attributes'] = array('id' => 'pro', 'class' => 'ptList');
	$pt['pro']['items'][] = '<div id="proTriangle"></div><h6>Pro</h6><div class="ptPrice"><strong>' . $pro->field_cost[$pro->language][0]['value'] . '$</strong>/month</div><div class="ptByLine">Most popular plan</div>';
	$pt['pro']['items'][] = number_format($pro->field_monthly_limit[$pro->language][0]['value']) . ' PDFs<sup>' . _createInlineHelp(1, 'help-pro-monthy-limit') . '</sup>';
	$pt['pro']['items'][] = 'Unlimited apps<sup>' . _createInlineHelp(2, 'help-unlimited-apps') . '</sup>';
	$pt['pro']['items'][] = 'Full font support';
	$pt['pro']['items'][] = 'E-mail support';
	$pt['pro']['items'][] = $comingSoonLink;

	$pt['epic']['type'] = 'ul';
	$pt['epic']['title'] = null;
	$pt['epic']['attributes'] = array('id' => 'epic', 'class' => 'ptList');
	$pt['epic']['items'][] = '<h6>Epic</h6><div class="ptPrice"><strong>' . $epic->field_cost[$epic->language][0]['value'] . '$</strong>/month</div><div class="ptByLine">For large applications</div>';
	$pt['epic']['items'][] = number_format($epic->field_monthly_limit[$epic->language][0]['value']) . ' PDFs<sup>' . _createInlineHelp(1, 'help-epic-monthy-limit') . '</sup>';
	$pt['epic']['items'][] = 'Unlimited apps<sup>' . _createInlineHelp(2, 'help-unlimited-apps') . '</sup>';
	$pt['epic']['items'][] = 'Full font support';
	$pt['epic']['items'][] = 'E-mail support';
	$pt['epic']['items'][] = $comingSoonLink;

	//Help text
	$help = array(
		'type' => 'ol',
		'title' => null,
		'attributes' => array('id' => 'ptHelp'),
		'items' => array(
			array(
				'id' => 'help-freemium-monthy-limit',
				'data' => 'You will only be charged for unique PDFs only; ' . $freemium->field_single_pdf_size_limit[$freemium->language][0]['value'] . ' Kb HTML will be treated as one 1 PDF.'
			),
			array(
				'id' => 'help-pro-monthy-limit',
				'data' => 'You will only be charged for unique PDFs only; ' . $pro->field_single_pdf_size_limit[$pro->language][0]['value'] . ' Kb HTML will be treated as one 1 PDF.'
			),
			array(
				'id' => 'help-epic-monthy-limit',
				'data' => 'You will only be charged for unique PDFs only; ' . $epic->field_single_pdf_size_limit[$epic->language][0]['value'] . ' Kb HTML will be treated as one 1 PDF.'
			),
			array(
				'id' => 'help-unlimited-apps',
				'data' => '	One API key can used with any number of applications.'
			),
		)
	);
?>

<h3 class="pageTitle">Pricing table</h3>
<div id="ptContainer">
	<div id="ptParent">
		<div id="ptLeft"><?php print theme_item_list($pt['freemium']) ?></div>
		<div id="ptCentre"><?php print theme_item_list($pt['pro']) ?></div>
		<div id="ptRight"><?php print theme_item_list($pt['epic']) ?></div>
	</div>
</div>
<div id="ptDesc"><?php print theme_item_list($help) ?></div>
