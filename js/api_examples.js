(function ($) {


	// Initialize the accordion
	Drupal.behaviors.highlightCode = {
		attach: function (context, settings) { 
			$('pre code', context).once('highlightCode', function(){
				$('pre code').each(function(i, e) {
					hljs.highlightBlock(e);
				});
			});
		}
	};

}(jQuery));