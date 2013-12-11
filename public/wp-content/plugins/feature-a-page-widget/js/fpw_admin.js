// Fire off Chosen plugin on the select list.
jQuery(document).ready(function($) {

	function fpwActivateChosen() {
		$( '#widgets-right .widget[id*="fpw_widget"]' ).each( function() {
			fpwSetChosen( $(this) );
		});
	}

	function fpwSetChosen( widget ) {
		$widget = $(widget);
		$selectList = $('.fpw-page-select', $widget);

		$selectList.chosen({
			no_results_text: 'No pages match:',
			allow_single_deselect: true 
		}).change(
			function(event){
				$selectList = event.currentTarget;
				fpwUpdateStatus( $selectList );
			}
		);

		fpwUpdateStatus( $selectList );
	}

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

	// Fire off chosen on save-widget callback, else the vanilla select reappears.
	//Thanks http://www.johngadbois.com/adding-your-own-callbacks-to-wordpress-ajax-requests/
	$(document).ajaxSuccess(function(e, xhr, settings) {

		if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=fpw_widget') != -1) {
			$widget = $(e.currentTarget.activeElement).parents('.widget');
			fpwSetChosen( $widget );
		}

		if(settings.data.search('action=widgets-order') != -1) {
			fpwActivateChosen();
		}

	});	

	/* Thanks to Codestyling Localization for this snippet to trigger contextual help */
	$('.fpw-help-button').live('click', function(event) {
		event.preventDefault();
		
		window.scrollTo(0,0);
		
		$('#tab-link-fpw_help_tab a').trigger('click');

		if (!$('#contextual-help-link').hasClass('screen-meta-active'))
			$('#contextual-help-link').trigger('click');
	});

	// fire on page load
	fpwActivateChosen();

	// Set overflow to visible so select list isn't chopped off
	// You can thank WordPress for necessitating that awful selector
	$('.widget[id*="fpw_widget"]').css( 'overflow', 'visible' );

});