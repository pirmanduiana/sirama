(function($){
    $.fn.pusherrlog = function(options){
        console.log("Plugin ini dibuat oleh Pirman, utk mencatat error ajax");
        var opts = {
            errtext : "",
            cicontr : "",
            errmodl : "",
            spinner : "",
            xhrsttx : "",
            xhrstat : "",
            xhrrspn : ""
        };
        var opts = $.extend(opts, options);
        $('#' + opts.errtext).show().html("Error: " + opts.xhrsttx + opts.xhrstat).fadeOut(12000);
        jQuery.ajax({
            type: "POST",
            url: opts.cicontr,
            data: {
                errmodule : opts.errmodl,
                status: opts.xhrstat,
                statusText: opts.xhrsttx,
                responseText: opts.xhrrspn
            },
            success: function(res){
                $('#' + opts.spinner).hide();
            }
        })
    };
})(jQuery);