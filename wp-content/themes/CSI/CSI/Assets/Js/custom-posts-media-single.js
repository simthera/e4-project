jQuery('.upload_image_button').live('click', function( event ){
    var uploader;
    var field_id;
    event.preventDefault();
    field_id = jQuery(this).data('field_id');

    if(uploader){
        uploader.open();
        return;
    }

    var uploader = wp.media(
        {
            title : jQuery(this).data( 'uploader_title' ),
            button : {
                text : jQuery(this).data( 'uploader_button_text' ),
            },
            multiple : false
        })

        .on('select', function()
        {
            var selection = uploader.state().get('selection');

            attachment = uploader.state().get('selection').first().toJSON();
            console.log(attachment.title);
            jQuery('#name_'+field_id).html(attachment.title);
            jQuery('#'+field_id).val(attachment.id);
            jQuery('#csi_brand logo').val(attachment.id);
            console.log(jQuery('#name_'+field_id));
            console.log(attachment);

        })
        .open();

});