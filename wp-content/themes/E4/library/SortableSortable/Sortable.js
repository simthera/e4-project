jQuery(document).ready(function () {

    jQuery('table.posts #the-list, table.pages #the-list').sortable({
        'items': 'tr',
        'axis': 'y',
        'helper': fixHelper,
        'update': function (e, ui) {
            var sorted = jQuery( '#the-list' ).sortable( "toArray");
            jQuery.ajax({
                    method: "POST",
                    url: ajaxurl,
                    data: {'action':'csipostsortable','data':sorted}
                })
                .done(function (msg) {
                    console.log(msg);
                });

        }
    });

    var fixHelper = function (e, ui) {
        ui.children().children().each(function () {
            jQuery(this).width(jQuery(this).width());
        });
        console.log(ui);
        return ui;
    };
});