// Fire off Chosen plugin on the select list.
jQuery(document).ready(function($) {

	// Activate chosen select menus on each FaPW widgets
	function fpwActivateChosen() {
		$( '#widgets-right .widget[id*="fpw_widget"]' ).each( function() {
			fpwSetChosen( $(this) );
		});
	}

	// Configures a single page select menu to use chosen
	// Accepts a widget ID to target specific widget
	function fpwSetChosen( widget ) {
		$widget = $(widget);
		$selectList = $('.fpw-page-select', $widget);

		$selectList.chosen({
			no_results_text: 'No pages match:',
			allow_single_deselect: true,
			disable_search_threshold: 8 // roughly height of menu
		}).change(
			function(event){
				$selectList = event.currentTarget;
				fpwUpdateStatus( $selectList );
			}
		);

		fpwUpdateStatus( $selectList );
	}

	// Update the Excerpt/Featured Image indicators below page menu & set href for pencil icon
	function fpwUpdateStatus( selectList ) {

		$selectList = $(selectList);
		$parentWidget = $selectList.parents('.widget');
		$selectedOption = $('option', $selectList ).filter(':selected');
		
		// elements I'll select repeatedly
		$pageStatus = $( '.fpw-page-status', $parentWidget );
		$excerptStatus = $( '.fpw-page-status-excerpt', $parentWidget );
		$imageStatus = $( '.fpw-page-status-image', $parentWidget );
		$editLink = $( '.fpw-page-status-edit-link', $parentWidget );

		// data I need
		editHref = $selectedOption.data('edit-link')
		statusClasses = $selectedOption.attr('class');

		// check if we have a page selected, show status if we do
		if( $selectedOption.val() !== '' ) {
			// show and set classes on page status element
			$pageStatus.show().attr( 'class', 'fpw-page-status ' + statusClasses );
			// set edit link to the right post page
			$editLink.attr( 'href', editHref );
		} else {
			$pageStatus.hide().attr( 'class', 'fpw-page-status');
		}

	}

	// 3.9+
	$( document ).on( 'widget-updated', fpwActivateChosen );
	$( document ).on( 'widget-added', fpwActivateChosen );

	// PageOrigins Site Builder Support
	// https://siteorigin.com/docs/page-builder/widget-compatibility/
	$(document).on('panelsopen', function(e) {
		var dialog = $(e.target);
		
		// Check that this is for our widget class
		if( !dialog.has('.fpw-featured-page-id') ) return;

		fpwSetChosen( this );
	});

	/* Thanks to Codestyling Localization for this snippet to trigger contextual help */
	$(document).on('click', '.fpw-help-button', function(event) {
		event.preventDefault();
		
		window.scrollTo(0,0);
		
		$('#tab-link-fpw_help_tab a').trigger('click');

		if (!$('#contextual-help-link').hasClass('screen-meta-active'))
			$('#contextual-help-link').trigger('click');
	});

	// init chosen on page load
	fpwActivateChosen();

	// Set overflow to visible so select list isn't chopped off
	// You can thank WordPress for necessitating that awful selector
	$('.widget[id*="fpw_widget"]').css( 'overflow', 'visible' );

});