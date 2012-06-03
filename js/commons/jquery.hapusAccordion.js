(function($){
	$.fn.extend({
		hapusAccordion: function(){
			//Get the element
			var $el = $(this);

			//The actual listener
			var accordionClick = function($this, e){
				e.preventDefault();

				$el.find('dt').removeClass('activeDT');
				$this.addClass('activeDT');

				$el.find('dd').slideUp('fast');
				$this.next().slideDown('fast');
			}

			//Add listeners
			$el.find('dt').live('click', function(e){
				accordionClick($(this), e);
			});

			//Click on the first guy
			$el.find('dt:first').click();
		}
	});
})(jQuery);	