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
	 * Tpl.php pointer for all User/pages (reports)
	 */
	function render_hapus_reports(){
		switch(arg(1)){
			case 'dashboard':
				drupal_set_title('Your Dashboard');
				return theme('dashboard');
				break;
		}
	}

	/**
	 * Tpl.php pointer for Sprint PDF Dxamples
	 */
	function render_hapus_api_example(){
		drupal_set_title('REST API examples');
		return theme('api-example');
	}

	/**
	 * Tpl.php pointer for Sprint PDF *Try It* page
	 */
	function render_hapus_try_it(){
		drupal_set_title('Try it!');
		return theme('try-it');
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

	/**
	 * Redirect the user to the login page
	 */
	function sprintpdf_redirect_login_page(){
		drupal_goto('user');
	}

	/**
	 * Render the blocks on Hapus Dashboard
	 */
	function render_hapus_dashboard_block($block, $cnt){
		$class = 'dashboardBlock ';
		if($cnt%2 ==0)
			$class .= 'center';
		if($cnt%3 ==0)
			$class .= 'right';

		$blockContent = theme_item_list(array(
			'items' => $block['content'],
			'type' => 'ul',
			'title' => null,
			'attributes' => array()
		));

		$output = '<div class="' . $class . '" id="' . str_replace(' ', '_', strtolower($block['header'])) . '">';
		$output .= '<h3>' . $block['header'] . '</h3>';
		$output .= '<div class="hbContent">' . $blockContent . '</div>';
		$output .= '</div>';

		return $output;
	}

	/**
	 * Render the headers on the *Try it* page
	 */
	function render_try_it_headers($headers){
		$ret = '';
		foreach($headers as $id => $label){
			$ret .= '<div id="' . $id . '" class="tryItTab"><div class="headerLabel">' . $label . '</div><div class="headerTriangle"></div></div>';
		}
		return $ret;
	}

	/**
	 * The *try it* form 
	 **/
	function tryItFormGen($type){
		switch ($type) {
			case 'conPage':
				return drupal_get_form('conPageFormGen');
				break;
			case 'conHtml':
				return drupal_get_form('conHtmlFormGen');
				break;
			case 'conWysiwyg':
				return drupal_get_form('conWysiwygFormGen');
				break;
		}
	}

	/**
	 * The *convert a web page* form
	 **/
	function conPageFormGen($form_state){
		$conPageForm['urlPath'] = array(
			'#title' => t('URL of the page to convert'),
			'#type' => 'textfield',
			'#description' => t('Enter the URL you\'d like to convert. Please include http:// or https://.'),
			'#required' => true
		);
		$conPageForm['submit'] = array(
			'#type' => 'submit',
			'#value' => t('Submit')
		);

		return $conPageForm;
	}

	/**
	 * The *convert HTML* form
	 **/
	function conHtmlFormGen($form_state){
		$defVal[] = '<html>';
		$defVal[] = '&#09;<body>';
		$defVal[] = '&#09;&#09;Hello world!';
		$defVal[] = '&#09;</body>';
		$defVal[] = '</html>';

		$conHtmlForm['rawHtml'] = array(
			'#title' => t('Raw HTML code'),
			'#type' => 'textarea',
			'#description' => t('Enter valid HTML. You can include inline CSS, JS, and even remote images.'),
			'#required' => true,
			'#default_value' => html_entity_decode(implode('&#13;&#10;', $defVal))
		);
		$conHtmlForm['submit'] = array(
			'#type' => 'submit',
			'#value' => t('Submit')
		);

		return $conHtmlForm;
	}

	/**
	 * The *convert WYSIWYG* form
	 **/
	function conWysiwygFormGen($form_state){
		$defVal = '<p>Hey there. Type here and we will convert it into PDF! Experiment with font, style, color, etc. You can even insert images.</p>';
		$defVal .= '<p><strong>Hint:</strong> Generally, the funnies render really well:</p>';
		$defVal .= '<img src="http://1.bp.blogspot.com/-tjRCV3oKnCw/Tr1HGrDTSCI/AAAAAAAALHE/Re0BocoIu-M/s1600/Loldog-funny-pictures-you-got-it-babe.jpg" />';

		$conWysiwygForm['wysiwygHtml'] = array(
			'#title' => t('Type in the text you\'d like to convert'),
			'#type' => 'text_format',
			'#required' => true,
			'#default_value' => html_entity_decode($defVal),
			'#format' => 'full_html'
		);
		$conWysiwygForm['submit'] = array(
			'#type' => 'submit',
			'#value' => t('Submit')
		);

		return $conWysiwygForm;
	}	

	/**
	 * The form submit handler for page converter
	**/
	function conPageFormGen_submit($form, &$form_state){
		//Include the SprintPDF PHP library
		module_load_include('php', 'hapus_pages', 'phplibs/sprintpdf');

		//Instantiate the object
		$sprintPdfObj = new SprintPDF('admin', 'coldcoldbmap');
		$pdf = $sprintPdfObj->convertURI($form['urlPath']['#value']);

		//Echo out the PDF as an attachment
		header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"sprintpdf_example.pdf\"");
		echo $pdf; 
		drupal_exit();
	}

	/**
	 * The form submit handler for html converter
	**/
	function conHtmlFormGen_submit($form, &$form_state){
		//Include the SprintPDF PHP library
		module_load_include('php', 'hapus_pages', 'phplibs/sprintpdf');

		//Instantiate the object
		$sprintPdfObj = new SprintPDF('admin', 'coldcoldbmap');
		$pdf = $sprintPdfObj->convertHTML($form['rawHtml']['#value']);

		//Echo out the PDF as an attachment
		header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"sprintpdf_example.pdf\"");
		echo $pdf; 
		drupal_exit();
	}

	/**
	 * The form submit handler for the WYSIWYG editor
	**/
	function conWysiwygFormGen_submit($form, &$form_state){
		//Include the SprintPDF PHP library
		module_load_include('php', 'hapus_pages', 'phplibs/sprintpdf');

		//Instantiate the object
		$sprintPdfObj = new SprintPDF('admin', 'coldcoldbmap');
		$pdf = $sprintPdfObj->convertHTML($form['wysiwygHtml']['value']['#value']);

		//Echo out the PDF as an attachment
		header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"sprintpdf_example.pdf\"");
		echo $pdf; 
		drupal_exit();
	}