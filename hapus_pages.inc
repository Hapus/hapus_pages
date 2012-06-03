<?php
	
	/**
	 * Tpl.php pointer for the pricing table page
	 */
	function render_hapus_pricing_table(){
		drupal_set_title('Pricing table');
		return theme('pricing_table');
	}

	/**
	 * Tpl.php pointer for all documentation pages
	 */
	function render_hapus_documentation(){
		switch(arg(1)){
			case 'API':
				drupal_set_title('Sprint PDF API');
				return theme('api');
				break;
			case 'options':
				drupal_set_title('PDF generation options');
				return theme('gen-options');
				break;
			case 'page_options':
				drupal_set_title('Page size options');
				return theme('page-options');
				break;
			case 'font_list':
				drupal_set_title('All currently supported fonts');
				return theme('font-list');
				break;
		}
	}

	/**
	 * Tpl.php pointer for API examples
	 */
	function render_hapus_api_example(){
		drupal_set_title('REST API examples');
		return theme('api-example');
	}

	/**
	 * Auxillary function to generate inline help for the pricing table page
	 */
	function _createInlineHelp($text, $type) {
		$queryArr = array(
			'width' => 500,
			'height' => 'auto',
			'inline' => true
		); 

		return l($text, '', array(
			'html' => TRUE,
			'fragment' => $type,
			'query' => $queryArr,
			'attributes' => array(
				'class' => 'colorbox-inline'
			)
		));
	}

	/**
	 * Auxillary function to generate a table out of API parameters for documentation
	 */
	function _createParamTable($params) {
		$variables['caption'] = null;
		$variables['colgroups'] = null;
		$variables['sticky'] = null;
		$variables['empty'] = null;
		$variables['attributes'] = array(
			'class' => 'apiParamsDesc'
		);
		$variables['header'] = array('Name', array('data' => 'Mandatory', 'class' => 'thCenter') , 'Permissible values', array('data' => 'Description', 'width' => '50%'));
		foreach($params as $key => $val){
			$variables['rows'][] = array(
				array('data' => $key, 'class' => 'paramName'),
				array('data' => $val['mandatory'] ? 'm' : '', 'class' => 'paramMandatory pictos'),
				array('data' => ($val['permVals'] ? implode(', ', $val['permVals']) . ' ' : '') . '<span class="paramType">(' . $val['type'] . ')</span>', 'class' => 'paramValues'),
				array('data' => $val['desc'], 'class' => 'paramDesc')
			);
		}

		return theme_table($variables);
	}

	/**
	 * Auxillary function to generate a example links for APIs
	 */
	function _createExampleLinks($params){
		$exArr = array('curl', 'php');

		foreach($exArr as $ex){
			$output[] = l($ex, 'api-example/' . $params['api'] . '/' . $ex, array('attributes' => array('class' => 'exLink colorbox-node')));
		}

		return implode(', ', $output);
	}