/**
 * Function that sends API call to retrieve post page information
 * @author   Zac
 * @param    {JS Event} ev  -   Click Event
 * @return   {NA}           -   NA
 */

export function displayResults(ev) {
    ev.preventDefault();

    // just do beforesend stuff here...
    $('#loading-search-gif').show();
    $('#pfl-link').attr('disabled', 'true');

    const link  = $('#pfl-link').val();

    let data    = {
        'action': 'post_from_link',
        'pfl-url': link
    };

    $.post(ajaxurl, data)
        .done( function(response) {

            const resp  = JSON.parse(response);
            const title = resp.title;
            const desc  = resp.description;
            const url   = resp.url;
            const image = resp.image;

            $('#ret-title').text(title);
            $('#ret-description').text(desc);
            $('#ret-image').css('background-image', 'url(' + image + ')');

            $('#ret-container').css('display', 'flex');
            $('#publish-container').css('display', 'flex');

            $('#loading-search-gif').hide();
            $('#pfl-link').removeAttr('disabled');

        })
        .fail( function(error) {
            console.log('API call failed. Please consult plugin developer.');
        })

}



/**
 * Function that sends API call to publish the selected post
 * @author   Zac
 * @param    {JS Event} ev  -   Click Event
 * @return   {NA}           -   NA
 */

export function publishResults(ev) {

    ev.preventDefault();

    let title       = $('#ret-title').text();
    let description = $('#ret-description').text();
    let image       = $('#ret-image').css('background-image');
    let category    = $('#ret-category').val();
    let url         = $('#pfl-link').val();
    image           = image.replace('url("', '').replace('")', '');

    const postData = {
        'title':        title,
        'description':  description,
        'image':        image,
        'category':     category,
        'url':          url
    }

    const data = {
        'action':   'save_post_from_link',
        'pfl-data': postData
    }

    $.post(ajaxurl, data, function(response) {

        $('.success-message').addClass('status-message-success');

    })
        .fail( function() {
            console.log('API call failed. Please consult plugin developer.')
        });

}



/**
 * Function that handles the WordPress Media Library
 * @author   Zac
 * @param    {JS Event} ev  -   Click Event
 * @return   {NA}           -   NA
 */

export function handleMediaLibrary(ev) { // This section of the plugin was copied and pasted from https://webkul.com/blog/how-to-use-wordpress-media-upload-in-plugin-theme/

    let wkMedia;

    ev.preventDefault();
    // If the upload object has already been created, reopen the dialog
    if (wkMedia) {
        wkMedia.open();
        return;
    }
    // Extend the wp.media object
    wkMedia = wp.media.frames.file_frame = wp.media({
        title: 'Select media',
        button: {
            text: 'Select media'
        }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    wkMedia.on('select', function() {
        var attachment = wkMedia.state().get('selection').first().toJSON();
        $('#ret-image').css('background-image', 'url(' + attachment.url + ')');
    });
    // Open the upload dialog
    wkMedia.open();
}