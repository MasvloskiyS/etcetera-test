(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function() {
		$('body').addClass('filter-active');
		$('#filter').submit(function(e){
			console.log('atata');
			e.preventDefault();
			var filter = $('#filter');
			$.ajax({
				url:filter.attr('action'),
				data:filter.serialize(), // form data
				type:filter.attr('method'), // POST
				beforeSend:function(xhr){
					filter.find('button').text('Выполняется поиск...'); // changing the button label
				},
				success:function(data){
					console.log(data);
					filter.find('button').text('Поиск'); // changing the button label back
					$('#response').html(data); // insert data
				}
			});
			return false;
		});
		$('#filter-widget').submit(function(e){
		
			e.preventDefault();
			var filter = $('#filter-widget');
			$.ajax({
				url:filter.attr('action'),
				data:filter.serialize(), // form data
				type:filter.attr('method'), // POST
				beforeSend:function(xhr){
					filter.find('button').text('Выполняется поиск...'); // changing the button label
				},
				success:function(data){
					filter.find('button').text('Поиск'); // changing the button label back
					$('#response-widget').html(data); // insert data
				}
			});
			return false;
		});

		
});

	

		


})( jQuery );
