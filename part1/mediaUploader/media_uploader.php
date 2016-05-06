<?php 

// Plugin Name: media

function meadia_add_metabox(){
	add_meta_box(
		'meadi_meta_id',
		'Media',
		'meadia_add_metabox_callback',
		'post'
	
	);
}
add_action('add_meta_boxes','meadia_add_metabox');

function meadia_add_metabox_callback(){
	wp_nonce_field(basename(__FILE__), 'media_nonce_name' );
	$value = get_post_meta(get_the_ID());
	
	?>
	<label for="media_input_id"> Media:
		<input type="text" id="media_input_id" name="media_input_name" value="<?php if($value){
			echo $value['media_input_name'][0];
		}  ?>" />
	</label>
	
	<?php
}

function media_save_meta_field(){
	$is_autosave = wp_is_post_autosave(get_the_ID());
	$is_revision = wp_is_post_revision(get_the_ID());
	
	if($is_autosave || $is_revision ){
		return;
	}
	if(!wp_verify_nonce($_POST['media_nonce_name'], basename(__FILE__) )){
				return;
		
	}
	
	if(isset($_POST['media_input_name'])){
		update_post_meta(get_the_ID(), 'media_input_name', $_POST['media_input_name'] );
	}
	
	
}
add_action('save_post','media_save_meta_field');


