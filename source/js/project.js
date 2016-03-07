(function()
{
    /******************************************\
     * Fire event once
     * http://stackoverflow.com/a/4541963
    \******************************************/
    waitForFinalEvent = (function()
    {
        var timers = {};

        return function(callback, ms, uniqueId) {

            if (!uniqueId) {
                uniqueId = "Don't call this twice without a uniqueId";
            }

            if (timers[uniqueId]) {
                clearTimeout(timers[uniqueId]);
            }

            timers[uniqueId] = setTimeout(callback, ms);
        };
    }());


    /******************************************\
     * Window resize Event & global window width
    \******************************************/
    global_window_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

    $(window).resize(function()
    {
        waitForFinalEvent(function()
        {
            global_window_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            jsb.fireEvent('Project::RESIZE_WINDOW');
        }, 100, 'window_resize_event');
    });


    /******************************************\
     * Plugins
    \******************************************/
    $(window).on('load', function()
    {
        FastClick.attach(document.body);
    });
})();


/******************************************\
 * iOS viewport scaling bug-fix
 * https://github.com/scottjehl/iOS-Orientationchange-Fix
\******************************************/
(function(w){

    // This fix addresses an iOS bug, so return early if the UA claims it's something else.
    var ua = navigator.userAgent;
    if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && /OS [1-5]_[0-9_]* like Mac OS X/i.test(ua) && ua.indexOf( "AppleWebKit" ) > -1 ) ){
        return;
    }

    var doc = w.document;

    if( !doc.querySelector ){ return; }

    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
        x, y, z, aig;

    if( !meta ){ return; }

    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true;
    }

    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false;
    }

    function checkTilt( e ){
        aig = e.accelerationIncludingGravity;
        x = Math.abs( aig.x );
        y = Math.abs( aig.y );
        z = Math.abs( aig.z );

        // If portrait orientation and in one of the danger zones
        if( (!w.orientation || w.orientation === 180) && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
            if( enabled ){
                disableZoom();
            }
        }
        else if( !enabled ){
            restoreZoom();
        }
    }

    w.addEventListener( "orientationchange", restoreZoom, false );
    w.addEventListener( "devicemotion", checkTilt, false );

})( this );
