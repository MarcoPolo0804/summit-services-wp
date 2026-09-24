/**
 * Summit Services: mobile menu, submenu toggles and sticky header shadow.
 */
( function () {
	'use strict';

	var header = document.querySelector( '.summit-header' );
	var nav = document.getElementById( 'site-navigation' );
	var toggle = document.querySelector( '.summit-menu-toggle' );

	function setMenu( open ) {
		if ( ! nav || ! toggle ) {
			return;
		}
		nav.classList.toggle( 'is-open', open );
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
	}

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			setMenu( toggle.getAttribute( 'aria-expanded' ) !== 'true' );
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' && nav.classList.contains( 'is-open' ) ) {
				setMenu( false );
				toggle.focus();
			}
		} );

		// Close the mobile menu when an in-page link is followed.
		nav.addEventListener( 'click', function ( event ) {
			if ( event.target.closest( 'a' ) ) {
				setMenu( false );
			}
		} );

		// Add expand buttons to parent items for the mobile menu.
		nav.querySelectorAll( '.menu-item-has-children, .page_item_has_children' ).forEach( function ( item, index ) {
			var submenu = item.querySelector( ':scope > .sub-menu, :scope > .children' );
			if ( ! submenu ) {
				return;
			}
			submenu.classList.add( 'sub-menu' );
			submenu.id = submenu.id || 'summit-submenu-' + index;

			var button = document.createElement( 'button' );
			button.type = 'button';
			button.className = 'summit-submenu-toggle';
			button.setAttribute( 'aria-expanded', 'false' );
			button.setAttribute( 'aria-controls', submenu.id );
			button.innerHTML = '<span class="screen-reader-text">Show submenu</span>';
			item.insertBefore( button, submenu );

			button.addEventListener( 'click', function () {
				var open = button.getAttribute( 'aria-expanded' ) !== 'true';
				button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
				submenu.classList.toggle( 'is-open', open );
			} );
		} );

		// Reset the mobile menu when resizing up to desktop.
		window.matchMedia( '(min-width: 1025px)' ).addEventListener( 'change', function ( mq ) {
			if ( mq.matches ) {
				setMenu( false );
			}
		} );
	}

	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 10 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}
} )();
