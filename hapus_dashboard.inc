<?php

	function render_hapus_dashboard(){
		//Add the necessary externals
		drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_dashboard.css');
		drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/hapus_dashboard.js');

		//Build all block data
		$block_list['basic_info']['header'] = 'API information';
		$block_list['basic_info']['content'] = _getBasicInformation();

		$block_list['usage_info']['header'] = 'Usage';
		$block_list['usage_info']['content'] = 'ssds';

		$block_list['billing_info']['header'] = 'Billing';
		$block_list['billing_info']['content'] = 'sdds';

		//Assemble HTML
		$retHTML = '<div id="hapus_dashboard">';
		$cnt = 1;
		foreach($block_list as $block){
			$retHTML .= render_hapus_dashboard_block($block, $cnt);
			$cnt += 1;
		}
		$retHTML .= '</div>';

		//Return the dashboard
		return $retHTML;
	}

	function render_hapus_dashboard_block($block, $cnt){
		$class = 'dashboardBlock ';
		if($cnt%2 ==0)
			$class .= 'center';
		if($cnt%3 ==0)
			$class .= 'right';

		$output = '<div class="' . $class . '">';
		$output .= '<h3>' . $block['header'] . '</h3>';
		$output .= '<div class="hbContent">' . $block['content'] . '</div>';
		$output .= '</div>';

		return $output;
	}

	function _getBasicInformation(){
		global $user;

		$items[] = '<strong>Username</strong>: ' . $user->name;
		$items[] = '<strong>API Key</strong>: <input id="apiKey" value="' . $user->pass . '" />';

		return theme_item_list(array(
			'items' => $items,
			'type' => 'ul',
			'title' => null,
			'attributes' => array()
		));
	}