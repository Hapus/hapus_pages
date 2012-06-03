(function ($) {

	// Initialize the accordion
	Drupal.behaviors.initAccordion = {
		attach: function (context, settings) { 
			$('#apiDocs', context).once('initAccordion', function(){
				$(this).hapusAccordion();
			});
		}
	};

}(jQuery));