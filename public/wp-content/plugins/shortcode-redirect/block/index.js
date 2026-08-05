( function ( wp ) {
	var registerBlockType = wp.blocks.registerBlockType;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;
	var ToggleControl = wp.components.ToggleControl;
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var __ = wp.i18n.__;

	registerBlockType( 'shortcode-redirect/redirect', {
		edit: function ( props ) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;
			var url = attributes.url || '';
			var sec = typeof attributes.sec === 'number' ? attributes.sec : 0;
			var showMessage = attributes.showMessage !== false;

			var blockProps = useBlockProps( { className: 'scr-block' } );

			var preview;
			if ( url ) {
				preview = el(
					'div',
					{ className: 'scr-block__body' },
					el( 'span', { className: 'scr-block__arrow', 'aria-hidden': 'true' }, '\u2192' ),
					el(
						'div',
						{ className: 'scr-block__text' },
						el( 'div', { className: 'scr-block__line' },
							el( 'strong', null, __( 'Redirects to', 'shortcode-redirect' ) ),
							' ',
							el( 'code', null, url )
						),
						el( 'div', { className: 'scr-block__meta' },
							( sec > 0
								? __( 'after', 'shortcode-redirect' ) + ' ' + sec + ' ' + ( sec === 1 ? __( 'second', 'shortcode-redirect' ) : __( 'seconds', 'shortcode-redirect' ) )
								: __( 'immediately on page load', 'shortcode-redirect' )
							) + ' · ' + ( showMessage
								? __( 'message shown', 'shortcode-redirect' )
								: __( 'silent', 'shortcode-redirect' )
							)
						)
					)
				);
			} else {
				preview = el(
					'div',
					{ className: 'scr-block__body scr-block__body--empty' },
					el( 'span', { className: 'scr-block__arrow', 'aria-hidden': 'true' }, '\u2192' ),
					el(
						'div',
						{ className: 'scr-block__text' },
						el( 'em', null, __( 'Set a destination URL in the block settings.', 'shortcode-redirect' ) )
					)
				);
			}

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Redirect settings', 'shortcode-redirect' ), initialOpen: true },
						el( TextControl, {
							label: __( 'Destination URL', 'shortcode-redirect' ),
							type: 'url',
							value: url,
							placeholder: 'https://example.com',
							onChange: function ( value ) {
								setAttributes( { url: value } );
							},
						} ),
						el( TextControl, {
							label: __( 'Seconds to wait', 'shortcode-redirect' ),
							type: 'number',
							min: 0,
							value: String( sec ),
							onChange: function ( value ) {
								var n = parseInt( value, 10 );
								setAttributes( { sec: isNaN( n ) || n < 0 ? 0 : n } );
							},
							help: __( 'Leave at 0 to redirect immediately.', 'shortcode-redirect' ),
						} ),
						el( ToggleControl, {
							label: __( 'Show "redirecting" message', 'shortcode-redirect' ),
							checked: showMessage,
							onChange: function ( value ) {
								setAttributes( { showMessage: !! value } );
							},
							help: showMessage
								? __( 'Visitors see a short message with a manual link while they wait.', 'shortcode-redirect' )
								: __( 'The page stays blank — the browser redirects silently.', 'shortcode-redirect' ),
						} )
					)
				),
				el( 'div', blockProps, preview )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
