jQuery(document).ready(function($){
	
	
	
	// Set all variables to be used in scope
  var frame;
      
  // ADD IMAGE LINK
  $('#add_meia').on( 'click', function( event ){
    
    event.preventDefault();
    
    // If the media frame already exists, reopen it.
    if ( frame ) {
      frame.open();
      return;
    }
    
    // Create a new media frame
    frame = wp.media({
      title: 'Add Media For You Metabox.',
      button: {
        text: 'Select Picture'
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    
    // When an image is selected in the media frame...
    frame.on( 'select', function() {
      
      // Get media attachment details from the frame state
      var attachment = frame.state().get('selection').first().toJSON();

      $('.image_con').css({'background-image': 'url('+ attachment.url +')'});
	  $('.image_con').addClass('back-img');
	  $('#media_input_id').val(attachment.url);
	  
    });

    // Finally, open the modal on click
    frame.open();
  });
  
  
  // DELETE IMAGE LINK
  $('#remove_meia').on( 'click', function( event ){

    event.preventDefault();
	$('.image_con').css({'background-image': 'none'});
	$('.image_con').removeClass('back-img');
	 $('#media_input_id').val('');
  });
	
	
	
	
});