<?php
	//Include all the necessary JS and CSS files, some external
	drupal_add_js('http://yandex.st/highlightjs/6.2/highlight.min.js', array('type' => 'external'));
	drupal_add_css('http://yandex.st/highlightjs/6.2/styles/default.min.css', array('type' => 'external'));
	drupal_add_js(drupal_get_path('module', 'hapus_pages') . '/js/api_examples.js');

	//Get and set some user data
	global $user;
	$username = $user->uid ? $user->name : '[username]';

	//Create the valid id name
	$args = array_reverse(arg());
	$visId = $args[1] . '-' . $args[0];
	$classHide = 'style="display: none;"';
?>

<div id="user-info-curl" <?php print $visId == 'user-info-curl' ? '' : $classHide ?>>
<h2>Get user information (CURL)</h2>
<pre><code>#Get user information in JSON format
#!/bin/bash
curl "http://www.sprintpdf.com/api/me/info.json?username=<?php print $username ?>&key=[password]"
</code></pre>
<pre><code>#Get user information in XML format
#!/bin/bash
curl "http://www.sprintpdf.com/api/me/info.xml?username=<?php print $username ?>&key=[password]"
</code></pre>
</div>

<div id="user-info-php" <?php print $visId == 'user-info-php' ? '' : $classHide ?>>
<h2>Get user information (PHP)</h2>
<pre><code>#First, get the class file from https://github.com/Hapus/SprintPDF_PHP_Library
include('SprintPDF-api.php');
$sprintPdfObj = new sprintPDF("<?php print $username ?>", "[password]");
$myInfo =  $client->getInfo();
print_r($myInfo);
</code></pre>
</div>

<div id="generate-pdf-curl" <?php print $visId == 'generate-pdf-curl' ? '' : $classHide ?>>
<h2>Generate PDF (CURL)</h2>
<pre><code>#Get user information in JSON format
#!/bin/bash
curl --header "Content-Type:application/json,Accept: application/json" 
--data '{"resource":"http://editage.com1","type":"html", "key":"[password]","username":"<?php print $username ?>","outputasfile":"1"}' 
http://www.sprintpdf.com/api/pdf > test.pdf
</code></pre>
</div>

<div id="generate-pdf-php" <?php print $visId == 'generate-pdf-php' ? '' : $classHide ?>>
<h2>Generate PDF (PHP)</h2>
<pre><code>//Create a PDF from a URL
//First, get the class file from https://github.com/Hapus/SprintPDF_PHP_Library
include('SprintPDF-api.php');
$sprintPdfObj = new sprintPDF("<?php print $username ?>", "[password]");
$pdf = $sprintPdfObj->convertURI('http://www.google.com/');

//Now, set the headers
header("Content-Type: application/pdf");
header("Cache-Control: no-cache");
header("Accept-Ranges: none");

//If you want to directly open the PDF in the browser, comment the line below
header("Content-Disposition: attachment; filename=\"desired_filename.pdf\""); 

// Finally, send the generated PDF
echo $pdf;
</code></pre>

<pre><code class="php">
//Create a PDF from a URL
//First, get the class file from https://github.com/Hapus/SprintPDF_PHP_Library
include('SprintPDF-api.php');
$sprintPdfObj = new sprintPDF("<?php print $username ?>", "[password]");
$pdf = $sprintPdfObj->convertHTML('&lt;html&gt;&lt;body&gt;Hello world!&lt;/body&gt;&lt;/html&gt;');

//Now, set the headers
header("Content-Type: application/pdf");
header("Cache-Control: no-cache");
header("Accept-Ranges: none");

//If you want to directly open the PDF in the browser, comment the line below
header("Content-Disposition: attachment; filename=\"desired_filename.pdf\""); 

// Finally, send the generated PDF
echo $pdf;
</code></pre>

<pre><code>//Create a PDF and save the document at your end
//First, get the class file from https://github.com/Hapus/SprintPDF_PHP_Library
include('SprintPDF-api.php');
$sprintPdfObj = new sprintPDF("<?php print $username ?>", "[password]");
$out_file = fopen("document.pdf", "wb");
$pdf = $sprintPdfObj->convertURI('http://www.google.com/', $out_file);
fclose($out_file);
</code></pre>

<pre><code>//Use parameters to customize the PDF output. 
//All available parameters are listed here: http://www.sprintpdf.com/Documentation/options
//First, get the class file from https://github.com/Hapus/SprintPDF_PHP_Library
include('SprintPDF-api.php');
$sprintPdfObj = new sprintPDF("<?php print $username ?>", "[password]");
$out_file = fopen("document.pdf", "wb");
$params = '--page-size Letter --dpi 400 --footer-center "Page [page] of [toPage]"';
$pdf = $sprintPdfObj->convertURI('http://www.google.com/', $out_file, $params);
fclose($out_file);
</code></pre>
</div>