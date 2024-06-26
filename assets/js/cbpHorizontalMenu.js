/**
 * cbpHorizontalMenu.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */

jQuery(document).ready(function () {
    var $listItems = jQuery( '#cbp-hrmenu > ul > li' ),
        $menuItems = $listItems.children( 'a' ),
        $body = jQuery( 'body' ),
        current = -1;

    function init() {
        $menuItems.on( 'click', open );
        $listItems.on( 'click', function( event ) { event.stopPropagation(); } );
    }

    function open( event ) {
        console.log(1232)
        if( current !== -1 ) {
            $listItems.eq( current ).removeClass( 'cbp-hropen' );
        }

        var $item = jQuery( event.currentTarget ).parent( 'li' ),
            idx = $item.index();

        if( current === idx ) {
            $item.removeClass( 'cbp-hropen' );
            current = -1;
        }
        else {
            $item.addClass( 'cbp-hropen' );
            current = idx;
            $body.off( 'click' ).on( 'click', close );
        }

        return false;

    }

    function close( event ) {
        $listItems.eq( current ).removeClass( 'cbp-hropen' );
        current = -1;
    }
    init()
})


