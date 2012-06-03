<?php
	
	/**
	 * Tpl.php pointer for the pricing table page
	 */
	function render_hapus_pricing_table(){
		drupal_set_title('Pricing table');
		return theme('pricing_table');
	}

	/**
	 * Tpl.php pointer for API page
	 */
	function render_hapus_api(){
		drupal_set_title('REST API Documentation');
		return theme('api');
	}

	/**
	 * Tpl.php pointer for API examples
	 */
	function render_hapus_api_example(){
		drupal_set_title('REST API examples');
		return theme('api-example');
	}

	/**
	 * Tpl.php pointer for options (options related to wkhtmltopdf)
	 */
	function render_hapus_options(){
		drupal_set_title('PDF generation options');
		return theme('gen-options');
	}

	/**
	 * Tpl.php pointer for page size options (Qt)
	 */
	function render_hapus_page_sizes(){
		drupal_set_title('Supported page sizes');
		return theme('page-sizes');
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