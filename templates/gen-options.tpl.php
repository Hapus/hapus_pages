<?php
	//Add the required CSS and JS files
	drupal_add_js('http://yandex.st/highlightjs/6.2/highlight.min.js', array('type' => 'external'));
	drupal_add_css('http://yandex.st/highlightjs/6.2/styles/default.min.css', array('type' => 'external'));
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/api_examples.js');
	drupal_add_css(drupal_get_path('module', 'hapus_pages') . '/css/hapus_options.css');

	//Global options
	$headers = array('Option', 'Type', 'Description');
	$attributes = array(
		'width' => '100%',
		'class' => array ('optionsTable')
	);

	//Additional header footer help
	$addHeaderFooterHelp[] = '<code>page</code>: Replaced by the number of the pages currently being printed';
	$addHeaderFooterHelp[] = '<code>frompage</code>: Replaced by the number of the first page to be printed';
	$addHeaderFooterHelp[] = '<code>topage</code>: Replaced by the number of the last page to be printed';
	$addHeaderFooterHelp[] = '<code>webpage</code>: Replaced by the URL of the page being printed';
	$addHeaderFooterHelp[] = '<code>section</code>: Replaced by the name of the current section';
	$addHeaderFooterHelp[] = '<code>subsection</code>: Replaced by the name of the current subsection';
	$addHeaderFooterHelp[] = '<code>date</code>: Replaced by the current date in system local format';
	$addHeaderFooterHelp[] = '<code>time</code>: Replaced by the current time in system local format';
	$addHeaderFooterHelp[] = '<code>title</code>: Replaced by the title of the of the current page object';
	$addHeaderFooterHelp[] = '<code>doctitle</code>: Replaced by the title of the output document';

	//All generic options
	$genericOptions[] = array('--collate', '' , 'Collate when printing multiple copies (default)');
	$genericOptions[] = array('--no-collate', '' , 'Do not collate when printing multiple copies');
	$genericOptions[] = array('--cookie-jar', '&lt;url&gt;' , '	Read and write cookies from and to the supplied cookie jar file');
	$genericOptions[] = array('--copies', '&lt;integer&gt;' , 'The number of copies to print of the specified PDF (default is 1)');
	$genericOptions[] = array('--dpi', '&lt;integer&gt;' , 'Change the dpi explicitly');
	$genericOptions[] = array('--grayscale', '' , 'Generate the PDF in greyscale');
	$genericOptions[] = array('--image-dpi', '&lt;integer&gt' , 'DPI to use when embedding images (default 600)');
	$genericOptions[] = array('--image-quality', '&lt;integer&gt' , 'Quality to use when compressing JPEG images (default 94)');
	$genericOptions[] = array('--lowquality', '' , 'Generates lower, smaller-size quality pdf/ps.');
	$genericOptions[] = array('--margin-bottom', '&lt;integer&gt' , 'Set the page bottom margin (default 10mm)');
	$genericOptions[] = array('--margin-left', '&lt;integer&gt' , 'Set the page left margin (default 10mm)');
	$genericOptions[] = array('--margin-right', '&lt;integer&gt' , 'Set the page right margin (default 10mm)');
	$genericOptions[] = array('--margin-top', '&lt;integer&gt' , 'Set the page top margin (default 10mm)');
	$genericOptions[] = array('--orientation', '&lt;orientation&gt' , 'Set orientation to Landscape or Portrait (default Portrait)');
	$genericOptions[] = array('--page-height', '&lt;integer&gt' , 'Page height');
	$genericOptions[] = array('--page-size', '&lt;string&gt' , 'Set paper size to: A4, Letter, etc (default A4). See the ' . l('list of supported sizes', 'page-sizes/?height=500&width=500', array('attributes' => array('class' => 'colorbox-node'))) . '.');
	$genericOptions[] = array('--page-width', '&lt;integer&gt' , 'Page width');

	//All page options
	$pageOptions[] = array('--allow', '&lt;url&gt;', '	Allow the file or files from the specified folder to be loaded (repeatable)');
	$pageOptions[] = array('--background', '', 'Do print background (default)');
	$pageOptions[] = array('--no-background', '', 'Do no print background');
	$pageOptions[] = array('--checkbox-checked-svg', '&lt;url&gt;', 'Use this SVG file when rendering checked checkboxes');
	$pageOptions[] = array('--checkbox-svg', '&lt;url&gt;', 'Use this SVG file when rendering unchecked checkboxes');
	$pageOptions[] = array('--cookie', '&lt;name&gt; &lt;value&gt;', 'Set an additional cookie (repeatable)');
	$pageOptions[] = array('--custom-header', '&lt;name&gt; &lt;value&gt;', 'Set an additional HTTP header (repeatable)');
	$pageOptions[] = array('--debug-javascript', '', 'Show javascript debugging output');
	$pageOptions[] = array('--no-debug-javascript', '', 'Do not show javascript debugging output (default)');
	$pageOptions[] = array('--default-header', '', 'Add a default header, with the name of the page to the left, and the page number to the right, this is short for: <code>--header-left=\'[webpage]\' --header-right=\'[page]/[toPage]\' --top 2cm --header-line</code>');
	$pageOptions[] = array('--encoding', '&lt;encoding&gt;', 'Set the default text encoding, for input');
	$pageOptions[] = array('--disable-external-links', '', 'Do not make links to remote web pages');
	$pageOptions[] = array('--enable-external-links', '', 'Make links to remote web pages (default)');
	$pageOptions[] = array('--disable-forms', '', 'Do not turn HTML form fields into pdf form fields (default)');
	$pageOptions[] = array('--enable-forms', '', 'Turn HTML form fields into pdf form fields (Depends on the viewer. Currently only text fields, text areas, and checkboxes are supported.)');
	$pageOptions[] = array('--images', '', 'Load and print images (default)');
	$pageOptions[] = array('--no-images', '', 'Do not load or print images');
	$pageOptions[] = array('--disable-internal-links', '', 'Do not make local links');
	$pageOptions[] = array('--enable-internal-links', '', 'Make local links (default)');
	$pageOptions[] = array('--disable-javascript', '', 'Do not run any javascript');
	$pageOptions[] = array('--enable-javascript', '', 'Run javascript (default)');
	$pageOptions[] = array('--javascript-delay', '&lt;msec&gt;', 'Wait some milliseconds for javascript finish (default 200)');
	$pageOptions[] = array('--minimum-font-size', '&lt;integer&gt;', 'Minimum font size');
	$pageOptions[] = array('--page-offset', '&lt;integer&gt;', 'Set the starting page number (default 0)');
	$pageOptions[] = array('--password', '&lt;string&gt;', 'HTTP Authentication password');
	$pageOptions[] = array('--print-media-type', '', 'Use print media-type instead of screen');
	$pageOptions[] = array('--no-print-media-type', '', 'Do not use print media-type instead of screen (default)');
	$pageOptions[] = array('--radiobutton-checked-svg', '&lt;url&gt;', 'Use this SVG file when rendering checked radiobuttons');
	$pageOptions[] = array('--radiobutton-svg', '&lt;url&gt;', 'Use this SVG file when rendering unchecked radiobuttons');
	$pageOptions[] = array('--run-script', '&lt;js&gt;', 'Run this additional javascript after the page is done loading (repeatable)');
	$pageOptions[] = array('--disable-smart-shrinking', '', 'Disable the intelligent shrinking strategy used by WebKit that makes the pixel/dpi ratio none constant');
	$pageOptions[] = array('--enable-smart-shrinking', '', 'Enable the intelligent shrinking strategy used by WebKit that makes the pixel/dpi ratio none constant (default)');
	$pageOptions[] = array('--stop-slow-scripts', '', 'Stop slow running javascripts (default)');
	$pageOptions[] = array('--no-stop-slow-scripts', '', 'Do not Stop slow running javascripts (default)');
	$pageOptions[] = array('--user-style-sheet', '&lt;url&gt;', 'Specify a user style sheet, to load with every page');
	$pageOptions[] = array('--username', '&lt;string&gt;', 'HTTP Authentication username');
	$pageOptions[] = array('--zoom', '&lt;float&gt;', 'Use this zoom factor (default 1)');

	//Header and footer options
	$headerFooterOptions[] = array('--footer-center', '&lt;string&gt;', 'Centered footer text');
	$headerFooterOptions[] = array('--footer-font-name', '&lt;string&gt;', 'Set footer font name (default Arial)');
	$headerFooterOptions[] = array('--footer-font-size', '&lt;integer&gt;', 'Set footer font size (default 12)');
	$headerFooterOptions[] = array('--footer-html', '&lt;url&gt;', 'Adds a html footer');
	$headerFooterOptions[] = array('--footer-left', '&lt;string&gt;', 'Left aligned footer text');
	$headerFooterOptions[] = array('--footer-line', '', 'Display line above the footer');
	$headerFooterOptions[] = array('--no-footer-line', '', 'Do not display line above the footer (default)');
	$headerFooterOptions[] = array('--footer-right', '&lt;string&gt;', 'Right aligned footer text');
	$headerFooterOptions[] = array('--footer-spacing', '&lt;float&gt;', 'Spacing between footer and content in mm (default 0)');
	$headerFooterOptions[] = array('--header-center', '&lt;string&gt;', 'Centered header text');
	$headerFooterOptions[] = array('--header-font-name', '&lt;string&gt;', 'Set header font name (default Arial)');
	$headerFooterOptions[] = array('--header-font-size', '&lt;integer&gt;', 'Set header font size (default 12)');
	$headerFooterOptions[] = array('--header-html', '&lt;url&gt;', 'Adds a html header');
	$headerFooterOptions[] = array('--header-left', '&lt;string&gt;', 'Left aligned header text');
	$headerFooterOptions[] = array('--header-line', '', 'Display line below the header');
	$headerFooterOptions[] = array('--no-header-line', '', 'Do not display line below the header (default)');
	$headerFooterOptions[] = array('--header-right', '&lt;string&gt;', 'Right aligned header text');
	$headerFooterOptions[] = array('--header-spacing', '&lt;float&gt;', '--header-spacing');
	$headerFooterOptions[] = array('--replace', '&lt;name&gt; &lt;value&gt;', 'Replace <code>[name]</code> with value in header and footer (repeatable)');


?>
<div id="genericOptions" class="optionsSection">
	<h3 class="subTitle">Generic options</h3>
	<?php
		print theme_table(array(
			'sticky' =>true,
			'caption' => null,
			'empty' => null,
			'colgroups' => null,
			'header' => $headers,
			'rows' => $genericOptions,
			'attributes' => $attributes
		));
	?>
</div>

<div id="pageOptions" class="optionsSection">
	<h3 class="subTitle">Page options</h3>
	<?php
		print theme_table(array(
			'sticky' =>true,
			'caption' => null,
			'empty' => null,
			'colgroups' => null,
			'header' => $headers,
			'rows' => $pageOptions,
			'attributes' => $attributes
		));
	?>
</div>

<div id="headerFooterOptions" class="optionsSection">
	<h3 class="subTitle">Header and footer options</h3>
	<?php
		print theme_table(array(
			'sticky' =>true,
			'caption' => null,
			'empty' => null,
			'colgroups' => null,
			'header' => $headers,
			'rows' => $headerFooterOptions,
			'attributes' => $attributes
		));
	?>
	<p class="additionalOptions">
		Headers and footers can be added to the document by the <code>--header-*</code> and <code>--footer*</code> arguments respectfully. In header and footer text string supplied to e.g. <code>--header-left</code>, the following variables will be substituted:
		<?php print theme_item_list(array(
			'items' => $addHeaderFooterHelp,
			'type' => 'ul',
			'attributes' => array(),
			'title' => null
		)); ?>
		As an example, specifying <code>--header-right "Page [page] of [toPage]"</code>, will result in the text "Page x of y" where x is the number of the current page and y is the number of the last page, to appear in the upper left corner in the document. <br/><br/>Headers and footers can also be supplied with HTML documents. As an example one could specify <code>--header-html header.html</code>, and use the following content in <code>header.html</code>:
<pre><code>&lt;html&gt;&lt;head&gt;&lt;script&gt;
function subst() {
  var vars={};
  var x=document.location.search.substring(1).split('&');
  for (var i in x) {var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}
  var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
  for (var i in x) {
    var y = document.getElementsByClassName(x[i]);
    for (var j=0; j&lt;y.length; ++j) y[j].textContent = vars[x[i]];
  }
}
&lt;/script&gt;&lt;/head&gt;&lt;body style="border:0; margin: 0;" onload="subst()"&gt;
&lt;table style="border-bottom: 1px solid black; width: 100%"&gt;
  &lt;tr&gt;
    &lt;td class="section"&gt;&lt;/td&gt;
    &lt;td style="text-align:right"&gt;
      Page &lt;span class="page"&gt;&lt;/span&gt; of &lt;span class="topage"&gt;&lt;/span&gt;
    &lt;/td&gt;
  &lt;/tr&gt;
&lt;/table&gt;
&lt;/body&gt;&lt;/html&gt;
</code></pre>
	</p>
</div>