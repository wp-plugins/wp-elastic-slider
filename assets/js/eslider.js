jQuery(document).ready(function($){


$('.eslider-color').each(function(){

    var picker = $(this);
    var val = picker.val();

    picker.ColorPicker({
        color: val,
        onChange: function (hsb, hex, r) {
            // 
            var val = r.r + ',' + r.g + ',' + r.b;
            picker.val(val);
        }
    });

});


$(".slider-range").each(function(){
    var slider = $(this);
    var min = slider.data('min');
    var max = slider.data("max");
    var step = slider.data('step');
    var input = slider.closest('.ui-slider-wraper').find('.eslider-ui-val');
    var val = input.val();


    $(slider).slider({
        range: "max",
        min: min,
        max: max,
        step : step,
        value: val,
        slide: function(event, ui) {
            input.val(ui.value);
        }
    });

});
 

$('.eslider-config > .helper ').tipsy({
    gravity : 'e',
    fade : true
});

// Uploading files
var file_frame; 

	$(document).on('click', '.eslide-tab-header a', function(e){
        e.preventDefault();
        
        var tab = $(this).closest('.eslide-tab');
        var t = $(this).data('toggle');
        
        tab.find('.eslide-tab-item').hide();
        tab.find('[data-id="'+t+'"]').fadeIn();


        tab.find('.eslide-tab-header a').removeClass('active')
        $(this).addClass('active');
    });

    // $(document).on('click', '.eslide-upload-media', function(e) {

    //     e.preventDefault();

    //     var button = $(this);

    //     // If the media frame already exists, reopen it.
    //     if (file_frame) {
    //         file_frame.open();
    //         return;
    //     }
    //     console.log(this);
    //     // Create the media frame.
    //     file_frame = wp.media.frames.file_frame = wp.media({
    //         title: button.data('title'),
    //         button: {
    //             text: button.data('text'),
    //         },
    //         multiple: false // Set to true to allow multiple files to be selected
    //     });
    //     // When an image is selected, run a callback.
    //     file_frame.on('select', function() {
    //         // We set multiple to false so only get one image from the uploader
    //         attachment = file_frame.state().get('selection').first().toJSON();
    //         console.log(attachment);
    //         // Do something with attachment.id and/or attachment.url here
    //     });
    //     // Finally, open the modal
    //     file_frame.open();

    // });




    var add_slide_frame;
    var change_slide_frame;

    jQuery(document.body).on('click', '.eslide-upload-media', function(event){
        event.preventDefault();

        var button = $(this);
        console.log(button);
        var container = button.next('input');
        var thumb = button.closest('.thumb'); 
        console.log(thumb);

        // If the media frame already exists, reopen it.
        if ( add_slide_frame ) {
            add_slide_frame = null;
        }

        console.log(thumb);

        // Create the media frame.
        add_slide_frame = wp.media.frames.file_frame = wp.media({
            multiple: false,
            frame: 'post',
            library: {type: 'image'}
        });

        // When an image is selected, run a callback.
        add_slide_frame.on('insert', function() {

            var image = add_slide_frame.state().get('selection').first().toJSON();
            container.val(image.id);
            thumb.css('background-image', 'url(' + image.url + ')');
            add_slide_frame = null;

        });

        add_slide_frame.open();
    });
 



});