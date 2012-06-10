(function ($) {

	// The tab listener
	Drupal.behaviors.listenTabClick = {
		attach: function (context, settings) { 
			$('#tryHeader', context).once('listenTabClick', function(){
				//The listener function
				var tabClickListener = function($this, e){
					//Show the correct content
					var contentTabID = $this.attr('id') + 'Content';
					$('.tabContent').hide();
					$('#' + contentTabID).show();

					//Add the active class to the clicked tab
					$('.tryItTab').removeClass('activeTab');
					$this.addClass('activeTab');
				}

				//Add the listener
				$('.tryItTab').live('click', function(e){
					tabClickListener($(this), e);
				});

				//Call the first click
				$('#conPage').click();
			});
		}
	};

}(jQuery));