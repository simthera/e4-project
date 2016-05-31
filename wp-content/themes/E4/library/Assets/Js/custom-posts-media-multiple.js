jQuery('.upload_multiple_image_button').live('click', function (event) {
    var uploader;
    var field_id;
    console.log(event);
    event.preventDefault();
    field_id = jQuery(this).data('field_id');

    if (uploader) {
        uploader.open();
        return;
    }

    var uploader = wp.media(
        {
            title: 'Use this media',
            button: {
                text: 'Use this media',
            },
            multiple: true
        })

        .on('select', function () {
            var selection = uploader.state().get('selection').toJSON();
            console.log(uploader.state().get('selection').toJSON());
            var x = '';
            var htmlImages = '';
            for (var key in selection) {
                x = x+","+selection[key].id;
                htmlImages = htmlImages + '<img src="'+selection[key].url+'" height="50"/>';
            }
            jQuery('#images_'+field_id).html(htmlImages);
            jQuery('#'+field_id).val(x);
        })
        .open();

});