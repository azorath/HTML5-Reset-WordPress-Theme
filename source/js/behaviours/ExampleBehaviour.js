(function ()
{
    'use strict';

    var ClassName = function (dom_element, options)
    {
        var that = this;
        options = options || {};

        that.options = {};

        $.extend(true, that.options, options);


        // DOM elements
        that.dom_element = $(dom_element);

        // Helpers


        // Start
        that.init();
    };

    ClassName.prototype.init = function ()
    {
        var that = this;
    };

    jsb.registerHandler("ClassName", ClassName);
})();
