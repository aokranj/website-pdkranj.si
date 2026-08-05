( () => {
	// WPBakery's canvas preview inserts the switch's real markup (a `.wp-dark-mode-switch` div
	// with the correct data attributes), but the plugin's own frontend script - which paints the
	// switch's SVG icon into that div - only runs on the real frontend and only scans the page
	// once at load, so it never sees elements the canvas adds afterwards. Paint a static preview
	// image ourselves instead of depending on that internal, undocumented timing.
	// Classic backend editor wraps the element in `[data-element_type="wp_dark_mode_switch_element"]`;
	// the frontend/inline editor (`vc_action=vc_inline`) instead wraps it in `.vc_wp_dark_mode_switch_element`.
	const WRAPPER_SELECTOR = '[data-element_type="wp_dark_mode_switch_element"], .vc_wp_dark_mode_switch_element';
	const SWITCH_SELECTOR = '[data-element_type="wp_dark_mode_switch_element"] .wp-dark-mode-switch, .vc_wp_dark_mode_switch_element .wp-dark-mode-switch';

	const paintPreview = ( el ) => {
		if ( ! el || el.children.length || ! window.wpDarkModeWPBakery || ! el.closest( WRAPPER_SELECTOR ) ) {
			return;
		}
		const style = el.dataset.style || '1';
		const img = document.createElement( 'img' );
		img.src = window.wpDarkModeWPBakery.switchAssetsUrl + 'switch-' + style + '.svg';
		img.alt = 'Dark Mode Switch preview';
		img.style.transform = 'scale(' + ( parseFloat( el.dataset.size, 10 ) || 1 ) + ')';
		el.appendChild( img );
	};

	const scan = ( root ) => {
		( root.querySelectorAll ? root : document )
			.querySelectorAll?.( SWITCH_SELECTOR )
			.forEach( paintPreview );
	};

	new MutationObserver( () => {
		// WPBakery frequently builds/rebuilds the canvas across several rapid mutations
		// (row, then column, then element markup), so re-scan the whole document on every
		// batch rather than trying to inspect exactly which nodes were added - `paintPreview`
		// is idempotent (it bails once a preview image is already present).
		scan( document );
	} ).observe( document.body, { childList: true, subtree: true } );

	scan( document );

	// Belt-and-suspenders: WPBakery's canvas can finish building slightly after our initial
	// scan and before the observer's first mutation batch fires. A few cheap delayed re-scans
	// catch that gap without depending on exact timing.
	[ 100, 300, 800, 1500 ].forEach( ( delay ) => setTimeout( () => scan( document ), delay ) );

	document.addEventListener( 'click', ( e ) => {
		const wrapper = e.target.closest( '.wp-dark-mode-wpbakery-switch-field' );
		if ( ! wrapper ) {
			return;
		}

		const lockedItem = e.target.closest( '.elementor-control-input-wrapper.wp-dark-mode-locked' );
		if ( lockedItem ) {
			e.preventDefault();
			window.WPDarkModePromo && window.WPDarkModePromo.show();
		}
	} );

	document.addEventListener( 'change', ( e ) => {
		const radio = e.target.closest( '.wp-dark-mode-wpbakery-switch-field input[type="radio"]' );
		if ( ! radio || ! radio.checked ) {
			return;
		}

		const wrapper = radio.closest( '.wp-dark-mode-wpbakery-switch-field' );
		const input = wrapper.querySelector( '.wp-dark-mode-wpbakery-switch-input' );
		input.value = radio.value;
		input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
	} );
} )();
