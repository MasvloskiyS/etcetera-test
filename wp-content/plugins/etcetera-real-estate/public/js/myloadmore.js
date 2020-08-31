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
		$('body').on('click', '#response #pagination a', function(){
			let pageID = $(this).attr('id');

			$.ajax({
				url : misha_loadmore_params.ajaxurl, // AJAX handler
				data : {
					'action': 'myfilter', // the parameter for admin-ajax.php
					'query': misha_loadmore_params.posts, // loop parameters passed by wp_localize_script()
					'page' : misha_loadmore_params.current_page = pageID-1, // current page
					'first_page' : misha_loadmore_params.first_page,
				},
				type : 'POST',
				beforeSend : function ( xhr ) {
					$('#misha_loadmore').text('Loading...'); // some type of preloader
				},
				success : function( data ){
						console.log(misha_loadmore_params.current_page);
						console.log(pageID-1);
						$('#misha_loadmore').remove();
						$('#misha_pagination').before(data).remove();
						misha_loadmore_params.current_page = pageID-1;
						$('#response').html(data); // insert data

				}
			});
			return false;
		});
		$('body').on('click', '#response-widget #pagination a', function(){
			let pageID = $(this).attr('id');
	
			$.ajax({
				url : misha_loadmore_params.ajaxurl, // AJAX handler
				data : {
					'action': 'myfilter', // the parameter for admin-ajax.php
					'query': misha_loadmore_params.posts, // loop parameters passed by wp_localize_script()
					'page' : misha_loadmore_params.current_page = pageID-1, // current page
					'first_page' : misha_loadmore_params.first_page,
				},
				type : 'POST',
				beforeSend : function ( xhr ) {
					$('#misha_loadmore').text('Loading...'); // some type of preloader
				},
				success : function( data ){

						$('#misha_loadmore').remove();
						$('#misha_pagination').before(data).remove();
						misha_loadmore_params.current_page = pageID-1;
						$('#response-widget').html(data); // insert data
	
				}
			});
			return false;
		});
	});
	


})( jQuery );
