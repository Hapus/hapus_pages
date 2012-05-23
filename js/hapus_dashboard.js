(function ($) {

	// When the API Key is selected, select the entire textbox
	Drupal.behaviors.apiKeySelect = {
		//Slider enablement
		attach: function (context, settings) { 
			$('#apiKey').live('click', function(e){
				$(this).select();
			});
		}
	};

}(jQuery));